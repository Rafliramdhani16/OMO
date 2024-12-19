<div>
    <form wire:submit.prevent="submit" class="space-y-6">
        <!-- Personal Info Section -->
        <div class="space-y-6">
            <h3 class="text-lg font-bold text-gray-900">Informasi Pribadi</h3>

            <!-- Name Input -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <div
                    class="relative rounded-xl border border-gray-300 focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600 bg-white">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input wire:model="name" type="text" id="name"
                        class="block w-full pl-10 pr-4 py-3 rounded-xl border-0 focus:ring-0 bg-transparent"
                        placeholder="Masukkan nama lengkap" value="{{ $a }}">
                </div>
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Email Input -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div
                    class="relative rounded-xl border border-gray-300 focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600 bg-white">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input wire:model="email" type="email" id="email"
                        class="block w-full pl-10 pr-4 py-3 rounded-xl border-0 focus:ring-0 bg-transparent"
                        placeholder="Masukkan alamat email">
                </div>
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Order Details Section -->
        <div class="space-y-6 pt-6 border-t">
            <h3 class="text-lg font-bold text-gray-900">Detail Pesanan</h3>

            <!-- Quantity -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                <div class="flex items-center gap-4">
                    <button wire:click="decrementQuantity" type="button"
                        class="w-12 h-12 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors">
                        <span class="text-xl font-bold">-</span>
                    </button>
                    <span class="text-xl font-bold w-12 text-center">{{ $quantity }}</span>
                    <input type="number" wire:model.live.debounce.500ms="quantity" class="sr-only">
                    <button wire:click="incrementQuantity" type="button"
                        class="w-12 h-12 rounded-xl bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center transition-colors">
                        <span class="text-xl font-bold">+</span>
                    </button>
                </div>
            </div>

            <!-- Promo Code -->
            <div class="space-y-2">
                <label for="promo" class="block text-sm font-medium text-gray-700">Kode Promo</label>
                <div
                    class="relative rounded-xl border border-gray-300 focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600 bg-white">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <input wire:model.live.debounce.500ms="promoCode" type="text" id="promo"
                        class="block w-full pl-10 pr-4 py-3 rounded-xl border-0 focus:ring-0 bg-transparent"
                        placeholder="Masukkan kode promo">
                </div>
                @if (session()->has('message'))
                <p class="text-green-600 text-sm font-medium">{{ session('message') }}</p>
                @endif
                @if (session()->has('error'))
                <p class="text-red-600 text-sm font-medium">{{ session('error') }}</p>
                @endif
            </div>

            <!-- Price Summary -->
            <div class="space-y-3 p-4 bg-gray-50 rounded-xl">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-semibold">Rp {{number_format($subTotalAmount, 0, ',', '.')}}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Diskon</span>
                    <span class="font-semibold text-red-600">- Rp {{number_format($discount, 0, ',', '.')}}</span>
                </div>
                <div class="flex justify-between text-sm pt-3 border-t">
                    <span class="font-medium text-gray-900">Total</span>
                    <span class="font-bold text-gray-900">Rp {{number_format($grandTotalAmount, 0, ',', '.')}}</span>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition-colors">
            Lanjutkan ke Pembayaran
        </button>
    </form>
</div>