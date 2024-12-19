<x-auth-layout>
    <x-slot name="title">Reset Password - OMO! Your Fashion Partner</x-slot>
    
    <div x-data="{ loading: false }" class="space-y-6">
        <div class="text-center space-y-2">
            <h2 class="text-2xl font-bold text-gray-800">Reset Kata Sandi</h2>
            <p class="text-gray-600">Buat kata sandi baru untuk akunmu</p>
        </div>

        <form method="POST" action="{{ route('auth.reset') }}" class="space-y-4"
              @submit="loading = true">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
            
            <div>
                <x-auth-input 
                    type="password" 
                    name="password" 
                    placeholder="Kata sandi baru" 
                    icon="lock"
                    required
                />
            </div>

            <div>
                <x-auth-input 
                    type="password" 
                    name="password_confirmation" 
                    placeholder="Konfirmasi kata sandi baru" 
                    icon="lock"
                    required
                />
            </div>

            <x-auth-button>
                <span x-show="!loading">Perbarui Kata Sandi</span>
                <span x-show="loading" class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memproses...
                </span>
            </x-auth-button>
        </form>
    </div>
</x-auth-layout>