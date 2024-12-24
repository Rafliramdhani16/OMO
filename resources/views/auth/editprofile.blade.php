@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50" x-data="{ showUploadOption: false }">
    @include('components.sidebar')
    @include('components.notification')
    
    <div class="flex-1 lg:ml-64">
        <div class="max-w-6xl mx-auto p-4 lg:p-8">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Edit Profil</h1>
                <p class="text-sm text-gray-500 mt-1">Pengaturan / Profil Pengguna</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <form action="{{ route('auth.profile') }}" method="POST" enctype="multipart/form-data"
                    @submit.prevent="$event.target.submit(); $dispatch('notification', {
                        type: 'success',
                        message: 'Profil berhasil diperbarui'
                    })">
                    @csrf
                    
                    <div class="p-6 border-b border-gray-100 flex justify-center">
                        <div class="relative group">
                            <img src="{{ auth()->user()->image }}" 
                                alt="Foto profil" 
                                class="w-32 h-32 rounded-full object-cover border-4 border-gray-100 shadow-sm group-hover:border-blue-100 transition-all duration-300"
                            />
                            <button 
                                @click.prevent="showUploadOption = !showUploadOption"
                                class="absolute bottom-0 right-0 bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full shadow-lg transition-all duration-300 hover:scale-110 active:scale-95"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>

                            <div x-show="showUploadOption" 
                                @click.away="showUploadOption = false"
                                class="absolute mt-2 right-0 bg-white rounded-lg shadow-xl border border-gray-100 py-2 z-10 w-40"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95">
                                <label class="block px-4 py-2 hover:bg-gray-50 cursor-pointer transition-colors duration-200">
                                    <span>Unggah Foto</span>
                                    <input type="file" name="image" class="hidden" accept="image/*"
                                        @change="$dispatch('notification', {
                                            type: 'success',
                                            message: 'Foto berhasil diunggah'
                                        })">
                                </label>
                                <button type="button" class="w-full text-left px-4 py-2 hover:bg-red-50 text-red-600 transition-colors duration-200">
                                    Hapus Foto
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Nama Lengkap
                                </label>
                                <input type="text" 
                                    name="name" 
                                    value="{{ old('name', auth()->user()->name) }}"
                                    class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200"
                                    placeholder="Masukkan nama lengkap"
                                    required
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Email
                                </label>
                                <input type="email" 
                                    name="email" 
                                    value="{{ old('email', auth()->user()->email) }}"
                                    class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200"
                                    placeholder="Masukkan email"
                                    required
                                >
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-2">
                            <a href="{{ route('auth.profile') }}" 
                                class="px-5 py-2.5 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md active:translate-y-0 active:shadow-none">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md active:translate-y-0 active:shadow-none">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="mt-6">
                @include('components.password-card')
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end mt-6 space-x-4">
                <button type="reset" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition duration-200">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200">Simpan</button>
            </div>
        </div>
    </div>
</div>

<style>
[x-cloak] {
    display: none !important;
}

input:focus {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.hover\:shadow-md {
    --tw-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --tw-shadow-colored: 0 4px 6px -1px var(--tw-shadow-color), 0 2px 4px -2px var(--tw-shadow-color);
}

.active\:shadow-none {
    --tw-shadow: 0 0 #0000;
    --tw-shadow-colored: 0 0 #0000;
}

button, a {
    transform: translateZ(0);
    backface-visibility: hidden;
}
</style>
@endsection

