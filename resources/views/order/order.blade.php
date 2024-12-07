<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Styles -->
    <link href="{{asset('output.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Livewire Styles -->
    @livewireStyles
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <title>Order Booking - {{ $shirt->name }}</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F5F5F0;
        }
        [x-cloak] { 
            display: none !important; 
        }
    </style>
</head>
<body>
    <div class="relative flex flex-col w-full max-w-[640px] min-h-screen gap-5 mx-auto bg-[#F5F5F0]">
        <!-- Top Bar -->
        <div id="top-bar" class="flex justify-between items-center px-4 mt-[60px]">
            <a href="{{ route('front.details', $shirt->slug) }}" class="transition hover:opacity-80">
                <img src="{{asset('assets/images/icons/back.svg')}}" class="w-10 h-10" alt="icon">
            </a>
            <p class="font-bold text-lg leading-[27px]">Booking</p>
            <div class="dummy-btn w-10"></div>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('error'))
            <div class="mx-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        @if (session()->has('success'))
            <div class="mx-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <form id="orderForm" method="POST" action="{{ route('front.save_order', $shirt->slug) }}" class="flex flex-col gap-5">
            @csrf
            <input type="hidden" name="shirt_id" value="{{ $shirt->id }}">
            <input type="hidden" name="size_id" id="sizeId">
            <input type="hidden" name="total_amount" id="totalAmount">
            
            <div class="flex flex-col rounded-[20px] p-4 mx-4 pb-5 gap-5 bg-white">
                <!-- Product Info -->
                <div class="flex w-[260px] h-[160px] shrink-0 overflow-hidden mx-auto">
                    <img src="{{ asset($shirt->thumbnail) }}" class="w-full h-full object-contain" alt="thumbnail">
                </div>
                
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="font-bold text-[22px] leading-[30px]">{{ $shirt->name }}</h1>
                        <p class="text-gray-600">Rp {{ number_format($shirt->price, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Size Selection -->
                <div class="mt-4">
                    <label class="font-semibold mb-2 block">Select Size</label>
                    <div class="flex gap-3">
                        @foreach($shirt->sizes as $size)
                            <label class="size-option cursor-pointer">
                                <input type="radio" name="shirt_size" value="{{ $size->size }}" 
                                       data-size-id="{{ $size->id }}" class="hidden">
                                <div class="px-4 py-2 rounded-lg border-2 border-gray-300 hover:border-blue-500">
                                    {{ $size->size }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Quantity -->
                <div class="mt-4">
                    <label class="font-semibold mb-2 block">Quantity</label>
                    <div class="flex items-center gap-4">
                        <button type="button" class="quantity-btn minus">-</button>
                        <input type="number" name="quantity" value="1" min="1" max="{{ $shirt->stock }}" 
                               class="w-20 text-center border rounded-lg">
                        <button type="button" class="quantity-btn plus">+</button>
                    </div>
                </div>

                <!-- Total -->
                <div class="mt-4 pt-4 border-t">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold">Total</span>
                        <span class="font-bold text-xl" id="displayTotal">
                            Rp {{ number_format($shirt->price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="fixed bottom-5 w-full max-w-[640px] px-4">
                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-full font-bold hover:bg-blue-700">
                    Continue to Payment
                </button>
            </div>
        </form>
    </div>

    <!-- Scripts -->
    @livewireScripts

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('orderForm');
            const sizeInputs = document.querySelectorAll('input[name="shirt_size"]');
            const quantityInput = document.querySelector('input[name="quantity"]');
            const minusBtn = document.querySelector('.quantity-btn.minus');
            const plusBtn = document.querySelector('.quantity-btn.plus');
            const sizeIdInput = document.getElementById('sizeId');
            const totalAmountInput = document.getElementById('totalAmount');
            const displayTotal = document.getElementById('displayTotal');
            
            const basePrice = {{ $shirt->price }};
            const maxStock = {{ $shirt->stock }};

            // Handle size selection
            sizeInputs.forEach(input => {
                input.addEventListener('change', function() {
                    // Update visual selection
                    sizeInputs.forEach(si => {
                        si.closest('.size-option').querySelector('div')
                            .classList.remove('border-blue-500', 'bg-blue-50');
                    });
                    this.closest('.size-option').querySelector('div')
                        .classList.add('border-blue-500', 'bg-blue-50');
                    
                    // Update hidden size_id input
                    sizeIdInput.value = this.dataset.sizeId;
                });
            });

            // Handle quantity changes
            function updateQuantity(newValue) {
                newValue = Math.max(1, Math.min(newValue, maxStock));
                quantityInput.value = newValue;
                updateTotal();
            }

            minusBtn.addEventListener('click', () => {
                updateQuantity(parseInt(quantityInput.value) - 1);
            });

            plusBtn.addEventListener('click', () => {
                updateQuantity(parseInt(quantityInput.value) + 1);
            });

            quantityInput.addEventListener('change', function() {
                updateQuantity(parseInt(this.value));
            });

            // Update total amount
            function updateTotal() {
                const quantity = parseInt(quantityInput.value);
                const total = basePrice * quantity;
                totalAmountInput.value = total;
                displayTotal.textContent = `Rp ${total.toLocaleString('id-ID')}`;
            }

            // Form submission handling
            form.addEventListener('submit', function(e) {
                // Validate size selection
                if (!sizeIdInput.value) {
                    e.preventDefault();
                    alert('Please select a size first');
                    return;
                }

                // Validate quantity
                const quantity = parseInt(quantityInput.value);
                if (isNaN(quantity) || quantity < 1 || quantity > maxStock) {
                    e.preventDefault();
                    alert('Please enter a valid quantity');
                    return;
                }
            });

            // Initial total update
            updateTotal();
        });
    </script>
</body>
</html>