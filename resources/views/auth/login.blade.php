<x-auth-layout>
    <x-slot name="title">Masuk - OMO! Your Fashion Partner</x-slot>
    
    <div x-data="{ loading: false }" class="space-y-6">
        <div class="text-center space-y-2">
            <h2 class="text-2xl font-bold text-gray-800">Selamat Datang di OMO!</h2>
            <p class="text-gray-600">Temukan gaya fashion terbaikmu bersama kami</p>
        </div>

        <form method="POST" 
              action="{{ route('auth.login') }}" 
              class="space-y-5" 
              @submit="loading = true">
            @csrf
            
            <div>
                <x-auth-input 
                    type="email" 
                    name="email" 
                    placeholder="Masukkan email Anda" 
                    icon="envelope"
                    :value="old('email')"
                    required
                    autocomplete="email"
                />
            </div>

            <div>
                <x-auth-input 
                    type="password" 
                    name="password" 
                    placeholder="Masukkan kata sandi" 
                    icon="lock"
                    required
                    autocomplete="current-password"
                />
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('auth.forget') }}" 
                   class="text-sm text-blue-500 hover:text-blue-700 hover:underline transition-colors duration-200">
                    Lupa Kata Sandi?
                </a>
            </div>

            <x-auth-button>
                <span x-show="!loading" class="flex items-center justify-center space-x-2">
                    <span>Mulai Berbelanja</span>
                </span>
                <span x-show="loading" class="flex items-center justify-center space-x-2">
                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Memproses...</span>
                </span>
            </x-auth-button>
        </form>

        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">atau</span>
            </div>
        </div>

        <p class="text-center text-gray-600">
            Belum punya akun? 
            <a href="{{ route('auth.register') }}" 
               class="text-blue-500 hover:text-blue-700 font-medium hover:underline transition-colors duration-200">
                Bergabung Sekarang
            </a>
        </p>
    </div>
</x-auth-layout>
