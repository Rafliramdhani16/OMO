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
  public $name;
  public $email;

  protected $orderService;

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

  public function render()
  {
    return view('livewire.order-form');
  }
}
