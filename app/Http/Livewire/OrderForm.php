<?php

namespace App\Livewire;

use App\Models\Shirt;
use App\Services\OrderService;
use Livewire\Component;

class OrderForm extends Component
{
    public Shirt $shirt;
    public $orderData;
    public $subTotalAmount;
    public $promoCode = null;
    public $promoCodeId = null;
    public $quantity = 1;
    public $discount = 0;
    public $grandTotalAmount;
    public $totalDiscountAmount = 0;
    public $name = '';
    public $email = '';
    public $phone = '';
    public $city = '';
    public $postCode = '';
    public $address = '';

    protected $orderService;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|min:10',
        'city' => 'required',
        'postCode' => 'required',
        'address' => 'required|min:10',
        'quantity' => 'required|integer|min:1'
    ];

    public function boot(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function mount(Shirt $shirt, $orderData)
    {
        $this->shirt = $shirt;
        $this->orderData = $orderData;
        $this->subTotalAmount = $shirt->price;
        $this->grandTotalAmount = $shirt->price;
        
        if (isset($orderData['name'])) $this->name = $orderData['name'];
        if (isset($orderData['email'])) $this->email = $orderData['email'];
        if (isset($orderData['phone'])) $this->phone = $orderData['phone'];
        if (isset($orderData['city'])) $this->city = $orderData['city'];
        if (isset($orderData['post_code'])) $this->postCode = $orderData['post_code'];
        if (isset($orderData['address'])) $this->address = $orderData['address'];
        if (isset($orderData['quantity'])) $this->quantity = $orderData['quantity'];
    }

    public function updatedQuantity()
    {
        $this->validateOnly('quantity', [
            'quantity' => 'required|integer|min:1|max:' . $this->shirt->stock,
        ], [
            'quantity.max' => 'Stock tidak tersedia!',
        ]);

        $this->calculateTotal();
    }

    protected function calculateTotal(): void
    {
        $this->subTotalAmount = $this->shirt->price * $this->quantity;
        $this->grandTotalAmount = $this->subTotalAmount - $this->discount;
        
        $taxAmount = $this->subTotalAmount * 0.11; 
        $this->grandTotalAmount += $taxAmount;
    }

    public function incrementQuantity()
    {
        if ($this->quantity < $this->shirt->stock) {
            $this->quantity++;
            $this->calculateTotal();
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->calculateTotal();
        }
    }

    public function updatedPromoCode()
    {
        $this->applyPromoCode();
    }

    public function applyPromoCode()
    {
        if (!$this->promoCode) {
            $this->resetDiscount();
            return;
        }

        $result = $this->orderService->applyPromoCode($this->promoCode, $this->subTotalAmount);

        if (isset($result['error'])) {
            session()->flash('error', $result['error']);
            $this->resetDiscount();
        } else {
            session()->flash('message', 'Kode promo tersedia, yay!');
            $this->discount = $result['discount'];
            $this->calculateTotal();
            $this->promoCodeId = $result['promoCodeId'];
            $this->totalDiscountAmount = $result['discount'];
        }
    }

    protected function resetDiscount()
    {
        $this->discount = 0;
        $this->calculateTotal();
        $this->promoCodeId = null;
        $this->totalDiscountAmount = 0;
    }

    public function submit()
    {
        $this->validate();

        try {
            $customerData = [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'city' => $this->city,
                'post_code' => $this->postCode,
                'address' => $this->address,
                'quantity' => $this->quantity,
                'sub_total_amount' => $this->subTotalAmount,
                'grand_total_amount' => $this->grandTotalAmount,
                'total_discount_amount' => $this->totalDiscountAmount,
                'promo_code_id' => $this->promoCodeId
            ];

            $this->orderService->updateCustomerData($customerData);

            return redirect()->route('front.payment');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to process order. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.order-form');
    }
}