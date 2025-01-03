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
            <!-- Download PDF Button -->
            <a href="{{ route('orders.pdf', $orderDetails->id) }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 
                      transform transition-all duration-300 hover:scale-105 shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Download Invoice PDF
            </a>
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
                                    <p class="font-semibold text-yellow-600">Menunggu Konfirmasi Pembayaran</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-500">ID Pesanan:</span>
                            <button class="font-mono text-sm bg-gray-100 px-2 py-1 rounded hover:bg-gray-200 transition-colors"
                                    onclick="copyToClipboard('{{ $orderDetails->booking_trx_id }}', this)">
                                {{ $orderDetails->booking_trx_id }}
                            </button>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    {{ $orderDetails->shirt->brand->name }}
                                </span>
                                <span class="inline-flex items-center gap-1 text-gray-600">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                                    </svg>
                                    Size {{ $orderDetails->shirtSize->size }}
                                </span>
                                <span class="inline-flex items-center gap-1 text-gray-600">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
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
                            @if($orderDetails->discount_amount > 0)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Diskon</span>
                                <span class="text-green-600">- Rp {{number_format($orderDetails->discount_amount, 0, ',', '.')}}</span>
                            </div>
                            @endif
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Pajak (11%)</span>
                                <span class="text-gray-900">Rp {{number_format($orderDetails->total_tax, 0, ',', '.')}}</span>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Pesanan Dibuat</h4>
                                    <p class="text-sm text-gray-500 mt-1">{{ $orderDetails->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            <!-- Payment -->
                            <div class="relative flex gap-4">
                                <div class="w-8 h-8 rounded-full {{ $orderDetails->is_paid ? 'bg-blue-500' : 'bg-gray-200' }} flex items-center justify-center relative z-10">
                                    @if($orderDetails->is_paid)
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
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
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
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
        <a href="https://wa.me/085511515656" class="text-sm text-blue-500 hover:text-blue-600 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            Chat WhatsApp
        </a>
    </div>
    
    <a href="https://wa.me/085511515656?text=Halo, saya ingin bertanya tentang pesanan dengan ID: {{ $orderDetails->booking_trx_id }}" 
       class="flex items-center justify-center gap-2 w-full px-6 py-3 bg-blue-500 text-white font-medium rounded-xl 
              hover:bg-blue-600 transform transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 
              focus:ring-blue-500 focus:ring-offset-2">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
        </svg>
        <span>Hubungi Customer Service</span>
    </a>
</div>

@push('scripts')
<script>
    // Function to copy text to clipboard
    function copyToClipboard(text, button) {
        navigator.clipboard.writeText(text).then(() => {
            const originalText = button.innerHTML;
            button.innerHTML = 'Tersalin!';
            setTimeout(() => {
                button.innerHTML = originalText;
            }, 2000);
        }).catch(err => {
            console.error('Failed to copy:', err);
        });
    }

    // Initialize tooltips and other interactive elements
    document.addEventListener('DOMContentLoaded', function() {
        const copyButtons = document.querySelectorAll('[data-copy]');
        copyButtons.forEach(button => {
            button.addEventListener('click', function() {
                const textToCopy = this.getAttribute('data-copy');
                copyToClipboard(textToCopy, this);
            });
        });
    });
</script>
@endpush
@endsection