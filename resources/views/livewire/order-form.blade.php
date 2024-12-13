<div>
    <div class="flex w-[260px] h-[160px] shrink-0 overflow-hidden mx-auto mb-10">
        <img src="{{ asset($shirt->thumbnail) }}"
            class="w-full h-full object-contain object-center" alt="thumbnail" />
    </div>
    
    <form wire:submit.prevent="submit" class="flex flex-col gap-5">
        <div class="flex flex-col rounded-[20px] p-4 mx-4 pb-5 gap-5 bg-white">
            <div id="info" class="flex items-center justify-between">
                <div class="flex flex-col">
                    <h1 id="title" class="font-bold text-[22px] leading-[30px]">
                        {{$shirt->name}}
                    </h1>
                    <p class="font-semibold text-lg leading-[27px]">
                        Rp {{number_format($shirt->price, 0, ',', '.')}} • {{$orderData['shirt_size']}}
                    </p>
                </div>
                <div class="flex items-center gap-1">
                    <img src="{{asset('assets/images/icons/Star 1.svg')}}" class="w-[26px] h-[26px]" alt="star" />
                    <span class="font-semibold text-xl leading-[30px]">4.5</span>
                </div>
            </div>
            
            <hr class="border-[#EAEAED]">
            
            <!-- Customer Information -->
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">Complete Name</label>
                <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] gap-[10px] overflow-hidden transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <img src="{{asset('assets/images/icons/user.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <input wire:model="name" type="text" name="name" id="name" 
                           class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#878785] py-[14px]" 
                        placeholder="Type your complete name">
                </div>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="email" class="font-semibold">Email Address</label>
                <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] gap-[10px] overflow-hidden transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <img src="{{asset('assets/images/icons/sms.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <input wire:model="email" type="email" name="email" id="email" 
                           class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#878785] py-[14px]" 
                           placeholder="Type your email address">
                </div>
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="phone" class="font-semibold">Phone Number</label>
                <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] gap-[10px] overflow-hidden transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <img src="{{asset('assets/images/icons/phone.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <input wire:model="phone" type="tel" name="phone" id="phone" 
                           class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#878785] py-[14px]" 
                           placeholder="Type your phone number">
                </div>
                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="city" class="font-semibold">City</label>
                <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] gap-[10px] overflow-hidden transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <img src="{{asset('assets/images/icons/city.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <input wire:model="city" type="text" name="city" id="city" 
                           class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#878785] py-[14px]" 
                           placeholder="Type your city">
                </div>
                @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="postCode" class="font-semibold">Post Code</label>
                <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] gap-[10px] overflow-hidden transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <img src="{{asset('assets/images/icons/postcode.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <input wire:model="postCode" type="text" name="postCode" id="postCode" 
                           class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#878785] py-[14px]" 
                           placeholder="Type your post code">
                </div>
                @error('postCode') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="address" class="font-semibold">Complete Address</label>
                <div class="flex items-start w-full rounded-2xl ring-1 ring-[#090917] px-[14px] gap-[10px] overflow-hidden transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <img src="{{asset('assets/images/icons/location.svg')}}" class="w-6 h-6 flex shrink-0 mt-3" alt="icon">
                    <textarea wire:model="address" name="address" id="address" rows="3"
                              class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#878785] py-[14px]" 
                              placeholder="Type your complete address"></textarea>
                </div>
                @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <hr class="border-[#EAEAED]">

            <!-- Quantity Section -->
            <div class="flex flex-col gap-2">
                <p class="font-semibold">Quantity</p>
                <div class="relative flex items-center gap-[30px]">
                    <button wire:click="decrementQuantity" type="button" 
                            class="flex w-full h-[54px] items-center justify-center rounded-full bg-[#2A2A2A] overflow-hidden">
                        <span class="font-bold text-xl leading-[30px] text-white">-</span>
                    </button>
                    <p id="quantity-display" class="font-bold text-xl leading-[30px]">{{ $quantity }}</p>
                    <button wire:click="incrementQuantity" type="button" 
                            class="flex w-full h-[54px] items-center justify-center rounded-full bg-[#C5F277] overflow-hidden">
                        <span class="font-bold text-xl leading-[30px]">+</span>
                    </button>
                </div>
            </div>

            <!-- Promo Code Section -->
            <div class="flex flex-col gap-2">
                <label for="promo" class="font-semibold">Promo Code</label>
                <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] gap-[10px]">
                    <input wire:model.live.debounce.500ms="promoCode" type="text" name="promo" id="promo" 
                           class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#878785] py-[14px]" 
                           placeholder="Input the promo code">
                </div>
                @if (session()->has('message'))
                <span class="font-semibold text-sm leading-[21px] text-[#01A625]">{{ session('message') }}</span>
            @endif
            @if (session()->has('error'))
                <span class="font-semibold text-sm leading-[21px] text-[#FF1943]">{{ session('error') }}</span>
            @endif
        </div>

        <hr class="border-[#EAEAED]">

        <!-- Price Summary -->
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <p class="font-semibold">Sub Total</p>
                <p id="total-price" class="font-bold">Rp {{number_format($subTotalAmount, 0, ',', '.')}}</p>
            </div>
            
            <div class="flex items-center justify-between">
                <p class="font-semibold">Tax (11%)</p>
                <p id="tax-amount" class="font-bold">Rp {{number_format($subTotalAmount * 0.11, 0, ',', '.')}}</p>
            </div>

            <div class="flex items-center justify-between">
                <p class="font-semibold">Discount</p>
                <p id="discount" class="font-bold text-[#FF1943]">- Rp {{number_format($discount, 0, ',', '.')}}</p>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation -->
    <div id="bottom-nav" class="relative flex h-[100px] w-full shrink-0 mt-5">
        <div class="fixed bottom-5 w-full max-w-[640px] z-30 px-4">
            <div class="flex items-center justify-between rounded-full bg-[#2A2A2A] p-[10px] pl-6">
                <div class="flex flex-col gap-[2px]">
                    <p id="grand-total" class="font-bold text-[20px] leading-[30px] text-white">
                        Rp {{number_format($grandTotalAmount, 0, ',', '.')}}
                    </p>
                    <p class="text-sm leading-[21px] text-[#878785]">Grand total</p>
                </div>
                <button type="submit" 
                        class="rounded-full p-[12px_20px] bg-[#C5F277] font-bold hover:bg-[#b3e065] transition-colors">
                    Continue to Payment
                </button>
            </div>
        </div>
    </div>

    <!-- Loading State Overlay -->
    <div wire:loading class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-4 rounded-lg shadow-lg flex items-center">
            <svg class="animate-spin h-5 w-5 mr-3 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Processing...</span>
        </div>
    </div>
</form>

<!-- Flash Messages -->
<div x-data="{ show: false, message: '' }" 
     x-show="show" 
     x-init="
        $wire.on('flash-message', (message) => {
            message = message;
            show = true;
            setTimeout(() => show = false, 3000);
        })
     "
     class="fixed top-4 right-4 z-50">
    <div class="bg-green-500 text-white px-4 py-2 rounded shadow-lg" x-show="show" x-transition>
        <p x-text="message"></p>
    </div>
</div>
</div>