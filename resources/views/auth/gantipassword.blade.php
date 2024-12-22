@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row">
    <!-- Sidebar -->
    <div class="w-full md:w-64 bg-white h-auto md:h-screen shadow-md">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-blue-600">OMO!</h1>
        </div>
        <nav class="mt-6">
            <ul>
                <li
                    class="flex items-center p-4 text-gray-700 hover:bg-gray-200"
                >
                    <i class="fas fa-home mr-3"></i>
                    <span>Beranda</span>
                </li>
                <li
                    class="flex items-center p-4 text-gray-700 hover:bg-gray-200"
                >
                    <i class="fas fa-edit mr-3"></i>
                    <span>Edit Profile</span>
                </li>
                <li
                    class="flex items-center p-4 text-white bg-blue-500 hover:bg-blue-600"
                >
                    <i class="fas fa-key mr-3"></i>
                    <span>Ganti Password</span>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Main Content -->
    <div class="flex-1 p-6">
        <header
            class="flex flex-col md:flex-row items-center justify-between"
        ></header>
        <main class="mt-6 bg-white p-6 rounded-md shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                Ganti Password
            </h2>
            <div class="w-full lg:w-2/3 lg:ml-6">
                <form>
                    <div class="mb-4">
                        <label
                            class="block text-gray-700 font-medium"
                            for="old-password"
                            >Password Lama :</label
                        >
                        <div class="relative">
                            <input
                                class="w-1/2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200"
                                id="old-password"
                                placeholder="Password Lama"
                                type="password"
                            />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label
                            class="block text-gray-700 font-medium"
                            for="new-password"
                            >Password Baru :</label
                        >
                        <div class="relative">
                            <input
                                class="w-1/2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200"
                                id="new-password"
                                placeholder="Masukan Password Baru"
                                type="password"
                            />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label
                            class="block text-gray-700 font-medium"
                            for="confirm-password"
                            >Konfirmasi Password :</label
                        >
                        <div class="relative">
                            <input
                                class="w-1/2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200"
                                id="confirm-password"
                                placeholder="Konfirmasi Password"
                                type="password"
                            />
                        </div>
                    </div>
                    <div class="flex">
                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium mr-2"
                            type="submit"
                        >
                            Simpan Perubahan
                        </button>
                        <button
                            class="border border-blue-600 text-blue-600 px-6 py-2 rounded-md font-medium hover:bg-blue-50"
                            type="reset"
                        >
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection