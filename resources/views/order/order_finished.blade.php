@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-blue-50/30 min-h-screen">
    <!-- Desktop: max-w-7xl, Tablet: max-w-3xl, Mobile: max-w-lg -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="flex flex-col items-center justify-center">
            <!-- Success Animation -->
            {{-- <div class="mb-8 relative">
                <div class="absolute -inset-4 bg-green-100/50 rounded-full animate-pulse"></div>
                <div class="relative w-20 sm:w-24 h-20 sm:h-24 rounded-full bg-gradient-to-br from-green-100 to-emerald-50 flex items-center justify-center animate-bounce">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div> --}}

            <!-- Main Content Grid - Desktop: 2 columns, Tablet/Mobile: 1 column -->
            <div class="grid lg:grid-cols-2 gap-6 lg:gap-12 w-full">
                <!-- Left Column: Order Details -->
                <div class="space-y-6">
                    <!-- Success Message Card -->
                    <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-lg border border-slate-200/60">
                        <div class="text-center sm:text-left space-y-4">
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-green-50 border border-green-100 rounded-full text-green-600 text-sm font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Yeay! Pesanan Berhasil
                            </div>
                            <div>
                                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 mb-3">Terima Kasih, {{ Auth::user()->name }}! 🎉</h1>
                                <p class="text-slate-600">Pesanan Anda telah berhasil dibuat dan tim kami akan segera memprosesnya dengan penuh perhatian. Bukti pembayaran akan dikirim ke email yang telah terdaftar</p>
                            </div>
                        </div>
                    </div>

                    <!-- Order Info Card -->
                    <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-lg border border-slate-200/60">
                        <!-- Booking ID Section -->
                        <div class="flex flex-col p-4 rounded-xl border-2 border-blue-100 bg-gradient-to-br from-blue-50/50 to-indigo-50/30 mb-6">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-lg bg-blue-600 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-slate-600">ID Pesanan Anda</p>
                                        <p class="font-bold text-slate-900" id="bookingId">{{ $productTransaction->booking_trx_id }}</p>
                                    </div>
                                </div>
                                <button onclick="copyBookingId()" 
                                    class="flex items-center justify-center gap-2 px-4 py-2 bg-white rounded-lg hover:bg-blue-50 border border-blue-100 transition-all duration-300 group">
                                    <svg class="w-5 h-5 text-blue-600 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-2M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                                    </svg>
                                    <span class="text-sm font-medium text-blue-600">Salin ID</span>
                                </button>
                            </div>
                            <p class="text-sm text-slate-600 mt-2">Simpan ID pesanan ini untuk melacak status pesanan Anda</p>
                        </div>

                        <!-- Order Timeline -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-slate-900 flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Proses Pesanan Anda
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-xl border border-slate-100 hover:border-blue-200 transition-colors duration-300">
                                    <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center flex-shrink-0">
                                        <span class="text-sm font-medium text-white">1</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-slate-900 mb-1">Verifikasi Pembayaran</h4>
                                        <p class="text-sm text-slate-600">Pembayaran Anda akan diverifikasi dalam waktu 1x24 jam. Kami akan mengirimkan notifikasi setelah pembayaran terkonfirmasi.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-xl border border-slate-100 hover:border-blue-200 transition-colors duration-300">
                                    <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center flex-shrink-0">
                                        <span class="text-sm font-medium text-white">2</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-slate-900 mb-1">Persiapan Pesanan</h4>
                                        <p class="text-sm text-slate-600">Tim kami akan menyiapkan pesanan Anda dengan teliti untuk memastikan kualitas terbaik.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-xl border border-slate-100 hover:border-blue-200 transition-colors duration-300">
                                    <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center flex-shrink-0">
                                        <span class="text-sm font-medium text-white">3</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-slate-900 mb-1">Pengiriman</h4>
                                        <p class="text-sm text-slate-600">Anda akan menerima email dengan informasi pengiriman lengkap beserta nomor resi untuk pelacakan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Product Details -->
                <div class="space-y-6">
                    <!-- Product Card -->
                    <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-lg border border-slate-200/60">
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-slate-900 flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                Detail Produk
                            </h3>
                            
                            <div class="aspect-[4/3] rounded-xl bg-gradient-to-br from-slate-50 to-blue-50 p-4 mb-6 overflow-hidden">
                                <img src="{{Storage::url($productTransaction->shirt->photos()->latest()->first()->photo)}}"
                                     class="w-full h-full object-contain hover:scale-105 transition-transform duration-500" 
                                     alt="Product Image">
                            </div>

                            <div class="space-y-4">
                                <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                                    <span class="text-slate-600">Nama Produk</span>
                                    <span class="font-medium text-slate-900">{{ $productTransaction->shirt->name }}</span>
                                </div>
                                <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                                    <span class="text-slate-600">Kategori</span>
                                    <span class="font-medium text-slate-900">{{ $productTransaction->shirt->category->name }}</span>
                                </div>
                                <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                                    <span class="text-slate-600">Kuantitas</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $productTransaction->quantity }}
                                    </span>
                                </div>
                                {{-- <div class="pt-4 mt-4 border-t border-slate-100">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-medium text-slate-700">Total Pembayaran</span>
                                        <span class="text-xl font-bold text-slate-900">Rp {{number_format($orderData['grand_total_amount'], 0, ',', '.')}}</span>
                                    </div>
                                </div> --}}
                                <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                                    <span class="text-slate-600">Total Pembayaran</span>
                                    <span class="font-bold text-lg text-slate-900">Rp {{ number_format($productTransaction['grand_total_amount'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="grid sm:grid-cols-2 gap-4">
                        <a href="{{ route('front.check_booking') }}" 
                            class="flex items-center justify-center gap-2 px-6 py-4 bg-blue-600 text-white font-medium rounded-xl
                            hover:bg-blue-700 transform hover:scale-[1.02] transition-all duration-300 order-2 sm:order-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <span>Status Pesanan</span>
                        </a>
                        <a href="{{ route('front.index') }}" 
                            class="flex items-center justify-center gap-2 px-6 py-4 bg-slate-100 text-slate-700 font-medium rounded-xl
                            hover:bg-slate-200 transform hover:scale-[1.02] transition-all duration-300 order-1 sm:order-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            <span>Lanjut Belanja</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Help Section -->
            {{-- <div class="mt-12 text-center">
                <div class="inline-block bg-white rounded-2xl shadow-lg p-6 border border-slate-200/60">
                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="text-left">
                                <p class="text-sm text-slate-600">Butuh bantuan?</p>
                                <p class="text-sm font-medium text-slate-900">Tim kami siap membantu Anda</p>
                            </div>
                        </div>
                        <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>
                        <a href="#" 
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-50 text-blue-600 font-medium rounded-xl hover:bg-blue-100 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <span>Hubungi Customer Service</span>
                        </a>
                    </div>
                    <p class="text-xs text-slate-500 mt-4">Layanan pelanggan tersedia 24/7 untuk membantu Anda</p>
                </div>
            </div> --}}

            <!-- Additional Info -->
            <div class="mt-12 grid sm:grid-cols-3 gap-6 max-w-3xl mx-auto px-4 ">
                <div class="text-center">
                    <div class="w-12 h-12 mx-auto rounded-full bg-green-50 flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h4 class="font-medium text-slate-900 mb-1">Garansi Kualitas</h4>
                    <p class="text-sm text-slate-600">100% produk original dengan kualitas terbaik</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 mx-auto rounded-full bg-blue-50 flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h4 class="font-medium text-slate-900 mb-1">Pengiriman Cepat</h4>
                    <p class="text-sm text-slate-600">Dikirim dalam 1-3 hari kerja</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 mx-auto rounded-full bg-purple-50 flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h4 class="font-medium text-slate-900 mb-1">Transaksi Aman</h4>
                    <p class="text-sm text-slate-600">Pembayaran dan data terlindungi</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function copyBookingId() {
        const bookingId = document.getElementById('bookingId').textContent;
        navigator.clipboard.writeText(bookingId).then(() => {
            const button = document.querySelector('button[onclick="copyBookingId()"]');
            const originalContent = button.innerHTML;
            
            button.innerHTML = `
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span class="text-sm font-medium text-green-500">ID Tersalin!</span>
            `;
            
            setTimeout(() => {
                button.innerHTML = originalContent;
            }, 2000);

            // Optional: Show toast notification
            if (window.showToast) {
                window.showToast('ID Pesanan berhasil disalin!', 'success');
            }
        });
    }
</script>
@endpush
@endsection