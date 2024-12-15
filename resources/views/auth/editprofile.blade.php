@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row">
    <!-- Sidebar -->
    <div class="w-full md:w-64 bg-white h-auto md:h-screen shadow-md">
        <div class="p-6">
            <h1 class="text-2xl font-bold">OMO !</h1>
        </div>
        <nav class="mt-6">
            <ul>
                <li class="flex items-center p-4 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-home mr-3"></i>
                    Beranda
                </li>
                <li class="flex items-center p-4 text-white bg-blue-500 hover:bg-blue-600">
                    <i class="fas fa-edit mr-3"></i>
                    Edit Profile
                </li>
                <li class="flex items-center p-4 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-key mr-3"></i>
                    Ganti Password
                </li>
            </ul>
        </nav>
    </div>
    <!-- Main Content -->
    <form action="{{ route('auth.profile') }}" method="POST" class="w-full">
        @csrf
        <div class="flex-1 p-4 md:p-10">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl font-semibold">User Profile</h1>
                    <p class="text-sm text-gray-500">Settings / User Profile</p>
                </div>
                <div class="flex items-center">
                    <input class="border rounded-lg px-4 py-2 mr-4" placeholder="Search" type="text" />
                    <img alt="User avatar" class="rounded-full h-10 w-10" height="40"
                        src="https://storage.googleapis.com/a1aa/image/CoH2WXH8UTIZGZVeJKfKSK7r2SYQeeJvYTwgVAkv0pCeUfFeJA.jpg"
                        width="40" />
                </div>
            </div>
            @if (session()->has('error'))
            <p>{{ session('error') }}</p>
            @elseif(session()->has('success'))
            <p>{{ session('success') }}</p>
            @endif
            <div class="bg-white p-4 md:p-8 rounded-lg shadow-md">
                <div class="flex flex-col md:flex-row items-center mb-6">
                    <img alt="User profile picture" class="rounded-full h-24 w-24 mr-4" height="100"
                        src="{{ auth()->user()->image }}" width="100" />
                    <div class="text-center md:text-left">
                        <h2 class="text-xl font-semibold"> {{ auth()->user()->name }} </h2>
                    </div>
                    <div class="ml-auto mt-4 md:mt-0">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg mr-2">Upload Foto Baru</button>
                        <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Hapus</button>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700">Nama Depan</label>
                        <input class="w-full mt-2 p-3 border rounded bg-gray-100" placeholder="Your First Name"
                            type="text" name="name" required value="{{ auth()->user()->name }}" />
                        @error('name')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700">Nama Belakang</label>
                        <input class="w-full mt-2 p-3 border rounded bg-gray-100" placeholder="Your First Name"
                            type="text" />

                    </div>
                    <div>
                        <label class="block text-gray-700">Username</label>
                        <div class="relative">
                            <input class="w-full mt-2 p-3 border rounded bg-gray-100" placeholder="Your First Name"
                                type="text" />

                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700">Email</label>
                        <div class="relative">
                            <input class="w-full mt-2 p-3 border rounded bg-gray-100" placeholder="Your First Name"
                                type="email" name="email" value="{{ auth()->user()->email }}" required />
                            @error('email')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-end">
                            <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg mr-2">Cancel</button>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection