<x-auth-layout>
    <x-slot name="title">Masuk - OMO! Your Fashion Partner</x-slot>

    <div x-data="{ loading: false }" class="space-y-6">
        <div class="text-center space-y-2 initial-animate">
            <h2 class="text-2xl font-bold text-gray-800">Selamat Datang di OMO!</h2>
            <p class="text-gray-600">Temukan gaya fashion terbaikmu bersama kami</p>
        </div>

        <form method="POST" action="{{ route('auth.login') }}" class="space-y-5 initial-animate stagger-1"
            @submit="loading = true">
            @csrf

            <div>
                <x-auth-input type="text" name="username" placeholder="Masukkan username Anda" icon="envelope"
                    :value="old('username')" required autocomplete="username" />
            </div>

            <div>
                <x-auth-input type="password" name="password" placeholder="Masukkan kata sandi" icon="lock" required
                    autocomplete="current-password" />
            </div>
            <div class="flex items-center justify-between initial-animate stagger-2">
                <a href="{{ route('auth.forget') }}"
                    class="forgot-password-link text-sm text-blue-500 relative group inline-block">
                    <span
                        class="inline-block transform transition-all duration-300 group-hover:scale-105 group-hover:text-blue-600">
                        Lupa Kata Sandi?
                    </span>
                    <span
                        class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-500 transform origin-left scale-x-0 transition-transform duration-300 ease-out group-hover:scale-x-100"></span>
                </a>
            </div>

            <x-auth-button>
                <span x-show="!loading" class="flex items-center justify-center space-x-2">
                    <span>Mulai Berbelanja</span>
                </span>
                <span x-show="loading" class="flex items-center justify-center space-x-2">
                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span>Memproses...</span>
                </span>
            </x-auth-button>
        </form>

        <div class="relative initial-animate stagger-2">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">atau masuk dengan</span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 initial-animate stagger-3">
            <a href="{{ route('auth.diakun') }}"
                class="group flex items-center justify-center space-x-2 px-4 py-3 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                <img src="{{ asset('image/diakun.png') }}" alt="DIAKUN"
                    class="h-5 w-auto transform transition-transform duration-300 group-hover:scale-110">
                <span class="text-gray-700 text-sm font-medium">DIAKUN</span>
            </a>

            <a href="{{ route('auth.google') }}"
                class="group flex items-center justify-center space-x-2 px-4 py-3 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                <img src="{{ asset('image/google.png') }}" alt="Google"
                    class="h-6 w-auto transform transition-transform duration-300 group-hover:scale-110">
                <span class="text-gray-700 text-sm font-medium">Google</span>
            </a>
        </div>

        <p class="text-center text-gray-600 initial-animate stagger-4">
            Belum punya akun?
            <a href="{{ route('auth.register') }}" class="text-blue-500 relative group inline-block">
                <span
                    class="inline-block transform transition-all duration-300 group-hover:scale-105 group-hover:text-blue-600 hover:ml-2">
                    Bergabung Sekarang
                </span>
                <span
                    class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-500 transform origin-left scale-x-0 transition-transform duration-300 ease-out group-hover:scale-x-100"></span>
            </a>
        </p>
    </div>
</x-auth-layout>