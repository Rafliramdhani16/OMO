@extends('layouts.app')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center bg-gradient-to-br from-blue-50 via-indigo-50/30 to-slate-50/20">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-100/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-100/20 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 py-16">
        <div class="flex flex-col md:flex-row items-center gap-12 md:gap-24">
            <div class="w-full max-w-md">
                <div class="text-center md:text-left mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">Cek Status Pesanan</h1>
                    <p class="text-gray-600">Pantau status pesanan Anda dengan mudah. Masukkan ID pemesanan untuk melihat detail pesanan.</p>
                </div>

                <form method="POST" action="{{ route('front.check_booking_details') }}" 
                      class="bg-white rounded-2xl shadow-sm p-8 border-2 border-gray-100 hover:border-gray-200 transition-colors">
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
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg outline-none transition-all duration-300 hover:border-gray-400 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                   placeholder="Masukkan ID Pemesanan">
                        </div>
                        <p class="mt-2 text-sm text-gray-500">ID pemesanan dapat ditemukan di email konfirmasi Anda</p>
                    </div>

                    
                    <button type="submit" 
                            class="w-full bg-blue-600 text-white font-medium py-3 px-4 rounded-xl 
                            transform transition-all duration-300 
                            hover:bg-blue-700 hover:scale-[1.02]
                            focus:outline-none focus:ring-4 focus:ring-blue-500/20
                            active:scale-[0.98] group">
                        <span class="flex items-center justify-center gap-2">
                            <span>Cek Status Pesanan</span>
                            <svg class="w-5 h-5 transform transition-transform duration-300 group-hover:translate-x-1" 
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </span>
                    </button>
                </form>
            </div>

            <div class="hidden md:grid grid-cols-2 gap-6 w-full max-w-lg">
                <div class="bg-white rounded-2xl p-6 shadow-sm border-2 border-gray-100 hover:border-gray-200 group transition-all duration-300">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Pelacakan Real-time</h3>
                    <p class="text-gray-600 text-sm">Pantau status pesanan Anda secara real-time dengan mudah dan cepat</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border-2 border-gray-100 hover:border-gray-200 group transition-all duration-300">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Aman & Terpercaya</h3>
                    <p class="text-gray-600 text-sm">Sistem pelacakan yang aman dengan verifikasi data pelanggan</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border-2 border-gray-100 hover:border-gray-200 group transition-all duration-300">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Dukungan 24/7</h3>
                    <p class="text-gray-600 text-sm">Tim support kami siap membantu Anda kapanpun dibutuhkan</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border-2 border-gray-100 hover:border-gray-200 group transition-all duration-300">
                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
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
