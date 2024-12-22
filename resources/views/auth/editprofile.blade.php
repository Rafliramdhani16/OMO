@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="w-full md:w-64 bg-white h-auto md:h-screen shadow-lg">
        <nav class="mt-6 space-y-4">
            <a href="{{ route('front.index') }}" 
               class="flex items-center p-4 text-gray-700 hover:bg-blue-600 hover:text-white transition duration-200 {{ request()->routeIs('front.index') ? 'bg-blue-600 text-white' : '' }}">
                <i class="fas fa-home mr-3"></i> Beranda
            </a>
            <a href="#" 
               class="flex items-center p-4 text-gray-700 hover:bg-blue-600 hover:text-white transition duration-200 {{ request()->routeIs('front.category') ? 'bg-blue-600 text-white' : '' }}">
                <i class="fas fa-user-edit mr-3"></i> Edit Profile
            </a>
            <a href="#" 
               class="flex items-center p-4 text-gray-700 hover:bg-blue-600 hover:text-white transition duration-200 {{ request()->routeIs('front.support') ? 'bg-blue-600 text-white' : '' }}">
                <i class="fas fa-lock mr-3"></i> Ganti Password
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <form action="{{ route('auth.profile') }}" method="POST" class="w-full px-6 py-8">
        @csrf
        <div class="flex-1 bg-white p-6 rounded-lg shadow-lg">
            <!-- Header -->
            <div class="mb-8 text-left">
                <h1 class="text-4xl font-semibold text-gray-800">User Profile</h1>
                <p class="text-sm text-gray-500">Manage your profile settings and preferences.</p>
            </div>

            @if (session()->has('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                    <p>{{ session('error') }}</p>
                </div>
            @elseif(session()->has('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Profile Section -->
            <div class="flex flex-col items-center mb-8">
                <img alt="User profile picture" class="rounded-full h-32 w-32 mb-4 shadow-xl" src="{{ auth()->user()->image }}" />
                <div class="flex space-x-4">
                    <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">Upload Foto Baru</button>
                    <button class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition duration-200">Hapus</button>
                </div>
            </div>

            <!-- Form Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-lg text-gray-700 font-semibold">Nama Depan</label>
                    <input class="w-full max-w-xs mt-2 p-4 border rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-600 focus:border-transparent transition duration-200" placeholder="Your First Name" type="text" name="name" required value="{{ auth()->user()->name }}" />
                    @error('name')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-lg text-gray-700 font-semibold">Nama Belakang</label>
                    <input class="w-full max-w-xs mt-2 p-4 border rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-600 focus:border-transparent transition duration-200" placeholder="Your Last Name" type="text" name="last_name" />
                </div>
                <div>
                    <label class="block text-lg text-gray-700 font-semibold">Username</label>
                    <input class="w-full max-w-xs mt-2 p-4 border rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-600 focus:border-transparent transition duration-200" placeholder="Your Username" type="text" name="username" />
                </div>
                <div>
                    <label class="block text-lg text-gray-700 font-semibold">Email</label>
                    <input class="w-full max-w-xs mt-2 p-4 border rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-600 focus:border-transparent transition duration-200" placeholder="Your Email" type="email" name="email" value="{{ auth()->user()->email }}" required />
                    @error('email')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end mt-6 space-x-4">
                <button type="reset" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition duration-200">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection
