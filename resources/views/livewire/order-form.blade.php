<div>
  <div class="flex flex-col gap-6 p-6">
      <!-- Product Image -->
      <div class="relative h-[200px] rounded-xl overflow-hidden bg-gray-50">
          <img id="main-thumbnail"
              src="{{asset('storage/' .$shirt->photos()->latest()->first()->photo)}}"
              class="w-full h-full object-contain" 
              alt="{{ $shirt->name }}" />
      </div>

      <!-- Order Form -->
      <form wire:submit.prevent="submit" class="space-y-6">
          <!-- Product Info -->
          <div class="flex items-center justify-between">
              <div>
                  <h2 class="text-xl font-bold text-gray-900">{{ $shirt->name }}</h2>
                  <p class="text-lg font-medium text-gray-700">
                      Rp {{number_format($shirt->price, 0, ',', '.')}} • {{$orderData['shirt_size']}}
                  </p>
              </div>
              <div class="flex items-center gap-1 bg-blue-50 px-3 py-1 rounded-full">
                  <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                  </svg>
                  <span class="font-medium">4.5</span>
              </div>
          </div>

          <!-- Name Input -->
          <div class="space-y-2">
              <label for="name" class="block font-medium text-gray-700">Nama Lengkap</label>
              <div class="relative rounded-full border border-gray-300 focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                      </svg>
                  </div>
                  <input wire:model="name" type="text" name="name" id="name" 
                         class="block w-full pl-10 pr-4 py-3 rounded-full border-0 focus:ring-0"
                         placeholder="Masukkan nama lengkap">
              </div>
              @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
          </div>

          <!-- Email Input -->
          <div class="space-y-2">
              <label for="email" class="block font-medium text-gray-700">Email</label>
              <div class="relative rounded-full border border-gray-300 focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                      </svg>
                  </div>
                  <input wire:model="email" type="email" name="email" id="email"
                         class="block w-full pl-10 pr-4 py-3 rounded-full border-0 focus:ring-0"
                         placeholder="Masukkan alamat email">
              </div>
              @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
          </div>

          <!-- Quantity -->
          <div class="space-y-2">
              <label class="block font-medium text-gray-700">Jumlah</label>
              <div class="flex items-center gap-4">
                  <button wire:click="decrementQuantity" type="button"
                          class="w-12 h-12 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center">
                      <span class="text-xl font-bold">-</span>
                  </button>
                  <span class="text-xl font-bold">{{ $quantity }}</span>
                  <input type="number" wire:model.live.debounce.500ms="quantity" class="sr-only" >
                  <button wire:click="incrementQuantity" type="button"
                          class="w-12 h-12 rounded-full bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center">
                      <span class="text-xl font-bold">+</span>
                  </button>
              </div>
          </div>

          <!-- Promo Code -->
          <div class="space-y-2">
              <label for="promo" class="block font-medium text-gray-700">Kode Promo</label>
              <div class="relative rounded-full border border-gray-300 focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                      </svg>
                  </div>
                  <input wire:model.live.debounce.500ms="promoCode" type="text" name="promo" id="promo"
                         class="block w-full pl-10 pr-4 py-3 rounded-full border-0 focus:ring-0"
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
          <div class="space-y-3 pt-4">
              <div class="flex justify-between">
                  <span class="font-medium text-gray-700">Subtotal</span>
                  <span class="font-bold">Rp {{number_format($subTotalAmount, 0, ',', '.')}}</span>
              </div>
              <div class="flex justify-between">
                  <span class="font-medium text-gray-700">Diskon</span>
                  <span class="font-bold text-red-600">- Rp {{number_format($discount, 0, ',', '.')}}</span>
              </div>
          </div>
      </form>
  </div>

  <!-- Bottom Navigation -->
  <div class="fixed bottom-0 left-0 right-0 bg-white border-t max-w-[640px] mx-auto">
      <div class="px-6 py-4 flex items-center justify-between">
          <div>
              <p class="text-2xl font-bold">Rp {{number_format($grandTotalAmount, 0, ',', '.')}}</p>
              <p class="text-sm text-gray-500">Total Pembayaran</p>
          </div>
          <button type="submit" form="order-form"
                  class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-full">
              Lanjutkan
          </button>
      </div>
  </div>
</div>