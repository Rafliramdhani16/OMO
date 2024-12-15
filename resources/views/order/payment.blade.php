@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-blue-50/30 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 py-8 mt-20">
        <form method="POST" enctype="multipart/form-data" action="{{ route('front.payment_confirm') }}">
            @csrf
            <!-- Page Header -->
            <div class="flex items-center justify-between mb-8">
                <a href="{{ route('front.customer_data') }}" 
                   class="group flex items-center gap-2 p-2 hover:bg-blue-50 rounded-xl transition-colors duration-300">
                    <svg class="w-5 h-5 text-slate-600 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span class="text-sm font-medium text-slate-600 group-hover:text-blue-600">Kembali</span>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Review & Pembayaran</h1>
                <div class="w-24"></div>
            </div>

            <!-- Main Content -->
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Left Column - Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Your Order -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-bold text-slate-900">Pesanan Anda</h2>
                        </div>
                        <div class="flex gap-6 mb-6">
                            <div class="w-24 h-24 bg-slate-100 rounded-xl overflow-hidden flex-shrink-0">
                                <img src="{{Storage::url($shirt->photos()->latest()->first()->photo)}}"
                                     class="w-full h-full object-cover hover:scale-110 transition-all duration-500"
                                     alt="{{ $shirt->name }}">
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $shirt->name }}</h3>
                                <div class="space-y-1 text-sm text-slate-600">
                                    <div class="flex justify-between">
                                        <span>Brand</span>
                                        <span class="font-medium">{{ $shirt->brand->name }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Ukuran</span>
                                        <span class="font-medium">{{ $orderData['shirt_size'] }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Jumlah</span>
                                        <span class="font-medium">{{ $orderData['quantity'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Info -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                        <h2 class="text-lg font-bold text-slate-900 mb-6">Informasi Pelanggan</h2>
                        <div class="space-y-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-500">Nama</p>
                                    <p class="font-medium text-slate-900">{{ $orderData['name'] }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-500">Telepon</p>
                                    <p class="font-medium text-slate-900">{{ $orderData['phone'] }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-500">Email</p>
                                    <p class="font-medium text-slate-900">{{ $orderData['email'] }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-500">Alamat Pengiriman</p>
                                    <p class="font-medium text-slate-900">{{ $orderData['address'] }}, {{ $orderData['city'] }}, {{ $orderData['post_code'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Info -->
<!-- Payment Info dengan Upload Fixed -->
<div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
    <h2 class="text-lg font-bold text-slate-900 mb-6">Rekening Pembayaran</h2>
    <div class="space-y-4">
        <!-- BCA Account -->
        <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-xl">
            <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center p-2">
                <img src="{{asset('assets/images/logos/bca-bank-central-asia 1.svg')}}" 
                     class="w-full h-full object-contain" alt="BCA">
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <p class="font-medium text-slate-900">OhMyOutfit</p>
                    <img src="{{asset('assets/images/icons/verify.svg')}}" class="w-4 h-4" alt="Verified">
                </div>
                <p class="text-sm text-slate-600">8008129839</p>
            </div>
        </div>

        <!-- Mandiri Account -->
        <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-xl">
            <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center p-2">
                <img src="{{asset('assets/images/logos/bank-mandiri 1.svg')}}" 
                     class="w-full h-full object-contain" alt="Mandiri">
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <p class="font-medium text-slate-900">JuaraTiket Indonesia</p>
                    <img src="{{asset('assets/images/icons/verify.svg')}}" class="w-4 h-4" alt="Verified">
                </div>
                <p class="text-sm text-slate-600">12379834983281</p>
            </div>
        </div>

        <!-- Upload Section Fixed -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-slate-700 mb-2">
                Bukti Transfer
            </label>
            <div class="group relative">
                <div class="relative flex items-center w-full rounded-xl border-2 border-slate-200 
                            hover:border-blue-400 focus-within:border-blue-500 focus-within:ring-4 
                            focus-within:ring-blue-200/50 transition-all duration-300">
                    <div class="flex-shrink-0 pl-4">
                        <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                d="M15 7h3a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2h3m3-3h3a2 2 0 012 2v3M9 3h3v3"/>
                        </svg>
                    </div>
                    <button type="button" id="Upload-btn" 
                        onclick="document.getElementById('Proof').click()"
                        class="w-full px-4 py-3 text-left text-sm text-slate-400 hover:text-slate-600
                               focus:outline-none transition-colors duration-300">
                        Pilih file bukti transfer
                    </button>
                    <input type="file" name="proof" id="Proof" 
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                        accept="image/*" required>
                </div>
            </div>
            <!-- File Preview -->
            <div id="file-preview" class="hidden mt-2">
                <div class="flex items-center gap-2 text-sm text-slate-600">
                    <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span id="file-name"></span>
                </div>
            </div>
        </div>
    </div>
</div>

                    <!-- Security Notice -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-100">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0 w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <p class="text-sm text-blue-600">Data pribadi Anda terlindungi dengan sistem enkripsi terkini</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Payment Summary -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24">
                        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                            <h3 class="text-lg font-bold text-slate-900 mb-4">Ringkasan Pembayaran</h3>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-600">Subtotal</span>
                                    <span class="font-medium">Rp {{number_format($orderData['sub_total_amount'], 0, ',', '.')}}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-600">Kode Promo</span>
                                    <span class="font-medium">{{ $orderData['promo_code'] }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-600">Diskon</span>
                                    <span class="font-medium text-green-600">- Rp {{number_format($orderData['total_discount_amount'], 0, ',', '.')}}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-600">PPN 11%</span>
                                    <span class="font-medium">Rp {{number_format($orderData['total_tax'], 0, ',', '.')}}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-600">Pengiriman</span>
                                    <span class="font-medium text-green-600">Gratis</span>
                                </div>
                                <div class="pt-3 border-t border-slate-100">
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-slate-700">Total Pembayaran</span>
                                        <span class="text-lg font-bold text-slate-900">Rp {{number_format($orderData['grand_total_amount'], 0, ',', '.')}}</span>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" 
                                class="w-full mt-6 py-4 bg-blue-600 text-white text-sm font-medium rounded-xl
                                transform transition-all duration-300 
                                hover:bg-blue-700 hover:scale-[1.02]
                                focus:outline-none focus:ring-4 focus:ring-blue-500/20
                                active:scale-[0.98]
                                disabled:opacity-50 disabled:cursor-not-allowed
                                flex items-center justify-center gap-2 group">
                                <span>Konfirmasi Pembayaran</span>
                                <svg class="w-5 h-5 transform transition-transform duration-300 group-hover:translate-x-1" 
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Handle file input
    const fileInput = document.getElementById("Proof");
    const fileBtn = document.getElementById("Upload-btn");
    
    fileInput.addEventListener("change", function() {
        const file = this.files[0];
        if(file) {
            fileBtn.innerHTML = `
                <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-slate-700">${file.name}</span>
            `;
            fileBtn.classList.add('border-blue-500');
        } else {
            fileBtn.innerHTML = `
                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                        d="M15 7h3a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2h3m3-3h3a2 2 0 012 2v3M9 3h3v3"/>
                </svg>
                <span class="text-slate-400">Pilih file bukti transfer</span>
            `;
            fileBtn.classList.remove('border-blue-500');
        }
    });

    // Form Submit Handler
    document.querySelector('form').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Memproses...</span>
        `;
    });
</script>
@endpush
@endsection