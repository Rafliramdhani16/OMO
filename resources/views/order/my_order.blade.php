@extends('layouts.app')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center bg-gradient-to-b from-blue-50/50">
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="flex flex-col md:flex-row items-center gap-12 md:gap-24">
            <div class="w-full max-w-md">
                <div class="text-center md:text-left mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">Cek Status Pesanan</h1>
                    <p class="text-gray-600">Pantau status pesanan Anda dengan mudah. Masukkan ID pemesanan dan nomor telepon yang terdaftar untuk melihat detail pesanan.</p>
                </div>

                <form method="POST" action="{{ route('front.check_booking_details') }}" 
                      class="bg-white rounded-2xl shadow-sm p-8">
                    @csrf
                    <div class="mb-6">
                        <label for="booking-id" class="block text-sm font-medium text-gray-700 mb-2">
                            ID Pemesanan
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="booking_trx_id" 
                                   id="booking-id"
                                   class="block w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors bg-gray-50/50"
                                   placeholder="Masukkan ID Pemesanan">
                        </div>
                        <p class="mt-2 text-sm text-gray-500">ID pemesanan dapat ditemukan di email konfirmasi Anda</p>
                    </div>

                    <div class="mb-8">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Telepon
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <input type="tel" 
                                   name="phone" 
                                   id="phone"
                                   class="block w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors bg-gray-50/50"
                                   placeholder="Masukkan nomor telepon">
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-600 text-white font-medium py-3 px-4 rounded-xl hover:bg-blue-700 transition-colors">
                        Cek Status Pesanan
                    </button>
                </form>
            </div>

            <div class="hidden md:grid grid-cols-2 gap-6 w-full max-w-lg">
                <div class="bg-white rounded-2xl p-6 shadow-sm">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Pelacakan Real-time</h3>
                    <p class="text-gray-600 text-sm">Pantau status pesanan Anda secara real-time dengan mudah dan cepat</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Aman & Terpercaya</h3>
                    <p class="text-gray-600 text-sm">Sistem pelacakan yang aman dengan verifikasi data pelanggan</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Dukungan 24/7</h3>
                    <p class="text-gray-600 text-sm">Tim support kami siap membantu Anda kapanpun dibutuhkan</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm">
                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Riwayat Pesanan</h3>
                    <p class="text-gray-600 text-sm">Akses riwayat pesanan Anda dengan mudah dan detail</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection