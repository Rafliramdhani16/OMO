@extends('layouts.app')

@section('content')
<div class="pt-20 pb-16">
    <!-- Back Button & Title -->
    <div class="flex items-center justify-between mb-8">
        <a href="{{ route('front.details', $shirt->slug) }}" 
           class="p-2 hover:bg-gray-100 rounded-full transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1 class="text-xl font-bold">Detail Pemesanan</h1>
        <div class="w-10"></div>
    </div>

    <!-- Order Form -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        @livewire('order-form', ['shirt' => $shirt, 'orderData' => $orderData])
    </div>
</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const orderForm = document.getElementById("orderForm");
    const sizeRadios = document.querySelectorAll('input[name="shirt_size"]');
    const sizeIdInput = document.getElementById("size_id");

    sizeRadios.forEach((radio) => {
        radio.addEventListener("change", function () {
            const selectedSizeId = this.getAttribute("data-size-id");
            sizeIdInput.value = selectedSizeId;
        });
    });

    if (orderForm) {
        orderForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const selectedSize = document.querySelector(
                'input[name="shirt_size"]:checked'
            );
            if (!selectedSize) {
                alert("Silakan pilih ukuran terlebih dahulu");
                return;
            }

            sizeIdInput.value = selectedSize.getAttribute("data-size-id");

            this.submit();
        });
    }
});
</script>
@endpush
@endsection