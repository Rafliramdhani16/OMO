<div class="bg-white rounded-xl shadow-sm border border-gray-100" x-data="{ showPasswordModal: false }">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Ganti Password</h2>
                <p class="text-sm text-gray-500 mt-1">Ubah password akun Anda untuk keamanan yang lebih baik</p>
            </div>
            <button @click="showPasswordModal = true"
                class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300 hover:scale-105">
                Ganti Password
            </button>
        </div>

        <div class="bg-blue-50 rounded-lg p-4">
            <h3 class="text-sm font-medium text-blue-800 mb-2">Syarat Password:</h3>
            <ul class="text-sm text-blue-700 space-y-1">
                <li class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Minimal 8 karakter
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Password lama dan baru harus berbeda
                </li>
            </ul>
        </div>
    </div>

    <div x-show="showPasswordModal" 
        x-cloak
        class="fixed inset-0 z-50 overflow-y-auto">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>

        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-white w-full max-w-md rounded-2xl shadow-xl p-6"
                @click.away="showPasswordModal = false">
                
                <div class="flex items-center justify-between mb-6 ml-4 w-full">
                    <h3 class="text-lg font-semibold text-gray-800">Ganti Password</h3>
                    <button @click="showPasswordModal = false" class="text-gray-400 hover:text-gray-600">×</button>
                </div>

                <form action="{{ route('auth.changepassword') }}" method="POST"
                    @submit.prevent="$event.target.submit(); $dispatch('notification', {
                        type: 'success',
                        message: 'Password berhasil diperbarui'
                    })">
                    @csrf
                    <div class="space-y-4">
                        <div x-data="{ passwordShown: false }">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Saat Ini</label>
                            <div class="relative">
                                <input 
                                    :type="passwordShown ? 'text' : 'password'"
                                    name="current_password" 
                                    class="block w-full px-4 pr-12 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200"
                                    placeholder="Masukkan password saat ini"
                                    required
                                >
                                <button 
                                    type="button"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                                    @click="passwordShown = !passwordShown"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        :class="{ 'hidden': passwordShown }">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        :class="{ 'hidden': !passwordShown }">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div x-data="{ passwordShown: false }">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru</label>
                            <div class="relative">
                                <input 
                                    :type="passwordShown ? 'text' : 'password'"
                                    name="password" 
                                    class="block w-full px-4 pr-12 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200"
                                    placeholder="Masukkan password baru"
                                    required
                                >
                                <button 
                                    type="button"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                                    @click="passwordShown = !passwordShown"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        :class="{ 'hidden': passwordShown }">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        :class="{ 'hidden': !passwordShown }">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div x-data="{ passwordShown: false }">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
                            <div class="relative">
                                <input 
                                    :type="passwordShown ? 'text' : 'password'"
                                    name="password_confirmation" 
                                    class="block w-full px-4 pr-12 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200"
                                    placeholder="Konfirmasi password baru"
                                    required
                                >
                                <button 
                                    type="button"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                                    @click="passwordShown = !passwordShown"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        :class="{ 'hidden': passwordShown }">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        :class="{ 'hidden': !passwordShown }">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button"
                            @click="showPasswordModal = false"
                            class="px-6 py-2.5 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-all duration-300">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300">
                            Simpan Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
