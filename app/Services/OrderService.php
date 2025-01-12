<?php

namespace App\Services;

use App\Models\ProductTransaction;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ReportRepositoryInterface;
use App\Repositories\Contracts\ShirtRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\PromoCodeRepositoryInterface;
use App\Repositories\ReportRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{
    protected $categoryRepository;
    protected $promoCodeRepository;
    protected $orderRepository;
    protected $shirtRepository;
    protected $reportRepository;

    public function __construct(
        PromoCodeRepositoryInterface $promoCodeRepository,
        CategoryRepositoryInterface $categoryRepository,
        OrderRepositoryInterface $orderRepository,
        ShirtRepositoryInterface $shirtRepository,
        ReportRepository $reportRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->promoCodeRepository = $promoCodeRepository;
        $this->orderRepository = $orderRepository;
        $this->shirtRepository = $shirtRepository;
        $this->reportRepository = $reportRepository;
    }

    public function beginOrder(array $data)
    {
        $orderData = [
            'shirt_size' => $data['shirt_size'],
            'size_id' => $data['size_id'],
            'shirt_id' => $data['shirt_id'],
        ];

        $this->orderRepository->saveToSession($orderData);
    }

    public function getMyOrderDetails(array $validated)
    {
        return $this->orderRepository->findByTrxIdAndPhoneNumber($validated['booking_trx_id']);
    }

    public function getOrderDetails()
    {
        $orderData = $this->orderRepository->getOrderDataFormSession();
        $shirt = $this->shirtRepository->find($orderData['shirt_id']);

        $quantity = isset($orderData['quantity']) ? $orderData['quantity'] : 1;
        $subTotalAmount = $shirt->price * $quantity;

        $taxRate = 0.11;
        $totalTax = $subTotalAmount * $taxRate;

        $grandTotalAmount = $subTotalAmount + $totalTax;

        $orderData['sub_total_amount'] = $subTotalAmount;
        $orderData['total_tax'] = $totalTax;
        $orderData['grand_total_amount'] = $grandTotalAmount;

        return compact('orderData', 'shirt');
    }

    public function applyPromoCode(string $code, int $subTotalAmount)
    {
        $promo = $this->promoCodeRepository->findByCode($code);

        if ($promo) {
            $discount = $promo->discount_amount;
            $grandTotalAmount = $subTotalAmount - $discount;
            $promoCodeId = $promo->id;

            return [
                'discount' => $discount,
                'grandTotalAmount' => $grandTotalAmount,
                'promoCodeId' => $promoCodeId
            ];
        }

        return ['error' => 'Promo code not available!'];
    }

    public function updateCustomerData(array $data)
    {
        $this->orderRepository->updateSessionData($data);
    }

    public function paymentConfirm(array $validated)
    {
        $orderData = $this->orderRepository->getOrderDataFormSession();
        $productTransactionId = null;

        try {
            DB::transaction(function () use ($validated, &$productTransactionId, $orderData) {
                if (isset($validated['proof'])) {
                    $proofPath = $validated['proof']->store('proofs', 'public');
                    $validated['proof'] = $proofPath;
                }

                $validated['name'] = $orderData['name'];
                $validated['email'] = $orderData['email'];
                $validated['phone'] = $orderData['phone'];
                $validated['address'] = $orderData['address'];
                $validated['post_code'] = $orderData['post_code'];
                $validated['city'] = $orderData['city'];
                $validated['quantity'] = $orderData['quantity'];
                $validated['sub_total_amount'] = $orderData['sub_total_amount'];
                $validated['grand_total_amount'] = $orderData['grand_total_amount'];
                $validated['discount_amount'] = $orderData['total_discount_amount'] ?? 0;
                $validated['promo_code_id'] = $orderData['promo_code_id'] ?? null;
                $validated['shirt_id'] = $orderData['shirt_id'];
                $validated['shirt_size'] = $orderData['size_id'];
                $validated['is_paid'] = false;
                $validated['booking_trx_id'] = ProductTransaction::generateUniqueTrxId();

                $newTransaction = $this->orderRepository->createTransaction($validated);

                // Generate and send PDF
                $pdf = $this->reportRepository->generateOrderPdf($newTransaction);
                $this->reportRepository->sendOrderReport($newTransaction->email, $newTransaction, $pdf);

                $productTransactionId = $newTransaction->id;
                $this->orderRepository->clearSession();
            });
        } catch (\Exception $e) {
            Log::error('Error in payment confirmation: ' . $e->getMessage());
            return null;
        }

        return $productTransactionId;
    }

    public function generateOrderPdf($productTransaction)
    {
        return $this->reportRepository->generateOrderPdf($productTransaction);
    }
}
