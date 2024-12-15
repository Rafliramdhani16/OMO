@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-blue-50/30 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Detail Pesanan</h1>
                <p class="text-gray-600 mt-1">Lacak dan pantau status pesanan Anda</p>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Status Card -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Status Pesanan</p>
                                @if ($orderDetails->is_paid)
                                    <p class="font-semibold text-green-600">Pembayaran Berhasil</p>
                                @else
                                    <p class="font-semibold text-yellow-600">Menunggu Pembayaran</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-500">ID Pesanan:</span>
                            <span class="font-mono text-sm bg-gray-100 px-2 py-1 rounded">{{ $orderDetails->booking_trx_id }}</span>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="flex items-start gap-6 p-4 bg-slate-50 rounded-xl mb-6">
                        <div class="w-24 h-24 flex-shrink-0 bg-white rounded-xl p-2 border border-slate-200">
                            <img src="{{Storage::url($orderDetails->shirt->photos()->latest()->first()->photo)}}" 
                                 class="w-full h-full object-contain hover:scale-105 transition-transform duration-500" 
                                 alt="{{ $orderDetails->shirt->name }}">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-lg text-gray-900 mb-2 truncate">{{ $orderDetails->shirt->name }}</h3>
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm">
                                <span class="inline-flex items-center gap-1 text-gray-600">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    {{ $orderDetails->shirt->brand->name }}
                                </span>
                                <span class="inline-flex items-center gap-1 text-gray-600">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                                    </svg>
                                    Size {{ $orderDetails->shirtSize->size }}
                                </span>
                                <span class="inline-flex items-center gap-1 text-gray-600">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    {{ $orderDetails->quantity }} item
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Price Breakdown -->
                    <div class="space-y-4">
                        <h4 class="font-medium text-gray-900">Rincian Pembayaran</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Harga Produk</span>
                                <span class="text-gray-900">Rp {{number_format($orderDetails->shirt->price, 0, ',', '.')}}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Jumlah</span>
                                <span class="text-gray-900">× {{ $orderDetails->quantity }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="text-gray-900">Rp {{number_format($orderDetails->shirt->price * $orderDetails->quantity, 0, ',', '.')}}</span>
                            </div>
                            <div class="pt-3 border-t border-dashed border-slate-200">
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-900">Total Pembayaran</span>
                                    <span class="text-lg font-bold text-blue-500">
                                        Rp {{number_format($orderDetails->grand_total_amount, 0, ',', '.')}}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Harga sudah termasuk pajak</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delivery Status -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Status Pengiriman</h3>
                    
                    <div class="relative">
                        <!-- Timeline Track -->
                        <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>

                        <!-- Timeline Items -->
                        <div class="space-y-8">
                            <!-- Order Placed -->
                            <div class="relative flex gap-4">
                                <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center relative z-10">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Pesanan Dibuat</h4>
                                    <p class="text-sm text-gray-500 mt-1">{{ $orderDetails->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            <!-- Payment -->
                            <div class="relative flex gap-4">
                                <div class="w-8 h-8 rounded-full {{ $orderDetails->is_paid ? 'bg-blue-500' : 'bg-gray-200' }} 
                                    flex items-center justify-center relative z-10">
                                    @if($orderDetails->is_paid)
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M5 13l4 4L19 7"/>
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Pembayaran</h4>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $orderDetails->is_paid ? 'Pembayaran telah dikonfirmasi' : 'Menunggu pembayaran' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Processing -->
                            <div class="relative flex gap-4">
                                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center relative z-10">
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Pemrosesan</h4>
                                    <p class="text-sm text-gray-500 mt-1">Pesanan akan diproses setelah pembayaran</p>
                                </div>
                            </div>

                            <!-- Shipping -->
                            <div class="relative flex gap-4">
                                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center relative z-10">
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Pengiriman</h4>
                                    <p class="text-sm text-gray-500 mt-1">Pesanan akan dikirim ke alamat tujuan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Customer Info Card -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Informasi Penerima</h3>
                    
                    <div class="space-y-6">
                        <!-- Name -->
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-600">Nama Lengkap</p>
                                <p class="font-medium text-gray-900 truncate">{{ $orderDetails->name }}</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-600">Nomor Telepon</p>
                                <p class="font-medium text-gray-900">{{ $orderDetails->phone }}</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-600">Email</p>
                                <p class="font-medium text-gray-900">{{ $orderDetails->email }}</p>
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-600">Alamat Pengiriman</p>
                                <div class="mt-1 space-y-1">
                                    <p class="font-medium text-gray-900">{{ $orderDetails->address }}</p>
                                    <p class="text-gray-600">{{ $orderDetails->city }}, {{ $orderDetails->post_code }}</p>
                                </div>
                            </div>
                        </div>

                        <hr class="border-slate-200">

                        <!-- Contact Support Section -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-600">Butuh bantuan?</p>
                                <a href="https://wa.me/6281234567890" class="text-sm text-blue-500 hover:text-blue600">
                                    Chat WhatsApp
                                </a>
                            </div>
                            
                            <a href="#" class="flex items-center justify-center gap-2 w-full px-6 py-3 bg-blue-500 text-white font-medium rounded-xl hover:bg-blue-600 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                <span>Hubungi Customer Service</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Security Notice -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900 mb-1">Transaksi Aman & Terpercaya</h4>
                            <p class="text-sm text-gray-600">Seluruh data pribadi Anda dilindungi dengan enkripsi end-to-end dan tidak akan dibagikan kepada pihak ketiga.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Mobile Action Bar -->
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t p-4 md:hidden">
            <div class="flex gap-4">
                <a href="https://wa.me/6281234567890" class="flex items-center justify-center gap-2 px-6 py-3 bg-blue-500 text-white font-medium rounded-xl flex-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <span>Chat WhatsApp</span>
                </a>
                <button type="button" class="flex items-center justify-center w-12 h-12 rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const copyButtons = document.querySelectorAll('[data-copy]');
        copyButtons.forEach(button => {
            button.addEventListener('click', function() {
                const textToCopy = this.getAttribute('data-copy');
                navigator.clipboard.writeText(textToCopy);
                
                const originalText = this.innerHTML;
                this.innerHTML = 'Tersalin!';
                setTimeout(() => {
                    this.innerHTML = originalText;
                }, 2000);
            });
        });
    });
</script>
@endpush
@endsection