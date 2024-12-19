@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/20 to-indigo-50/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <form method="POST" enctype="multipart/form-data" action="{{ route('front.payment_confirm') }}" class="space-y-8">
            @csrf
            <!-- Header with Progress -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
                <a href="{{ route('front.customer_data') }}" 
                   class="group flex items-center gap-2 p-2.5 hover:bg-white/80 rounded-xl transition-all duration-300 hover:shadow-sm">
                    <svg class="w-5 h-5 text-slate-600 group-hover:text-blue-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span class="text-sm font-medium text-slate-600 group-hover:text-blue-600">Kembali</span>
                </a>
                <div class="flex flex-col items-center">
                    <h1 class="text-2xl font-bold text-slate-900">Review & Pembayaran</h1>
                    <p class="text-sm text-slate-500 mt-1">Langkah terakhir untuk menyelesaikan pesanan Anda</p>
                </div>
                <div class="w-24"></div>
            </div>

            <!-- Main Content -->
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Left Column - Order Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Order Summary Card -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-bold text-slate-900">Pesanan Anda</h2>
                            <span class="px-3 py-1 bg-blue-50 text-blue-700 text-sm font-medium rounded-full">
                                Menunggu Pembayaran
                            </span>
                        </div>
                        <div class="flex gap-6">
                            <div class="relative group w-24 h-24 bg-slate-100 rounded-xl overflow-hidden flex-shrink-0">
                                <img src="{{Storage::url($shirt->photos()->latest()->first()->photo)}}"
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                     alt="{{ $shirt->name }}">
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-slate-900 mb-2 hover:text-blue-600 transition-colors">
                                    {{ $shirt->name }}
                                </h3>
                                <div class="grid grid-cols-2 gap-4 text-sm text-slate-600">
                                    <div class="flex justify-between items-center py-1 px-3 bg-slate-50 rounded-lg">
                                        <span>Brand</span>
                                        <span class="font-medium text-slate-700">{{ $shirt->brand->name }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-1 px-3 bg-slate-50 rounded-lg">
                                        <span>Ukuran</span>
                                        <span class="font-medium text-slate-700">{{ $orderData['shirt_size'] }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-1 px-3 bg-slate-50 rounded-lg">
                                        <span>Jumlah</span>
                                        <span class="font-medium text-slate-700">{{ $orderData['quantity'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Info -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-bold text-slate-900">Informasi Pelanggan</h2>
                            <button type="button" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                                Edit Info
                            </button>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-500">Nama Lengkap</p>
                                    <p class="font-medium text-slate-900">{{ $orderData['name'] }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-500">Nomor Telepon</p>
                                    <p class="font-medium text-slate-900">{{ $orderData['phone'] }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-500">Email</p>
                                    <p class="font-medium text-slate-900">{{ $orderData['email'] }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-500">Alamat Pengiriman</p>
                                    <p class="font-medium text-slate-900">{{ $orderData['address'] }}</p>
                                    <p class="text-sm text-slate-600">{{ $orderData['city'] }}, {{ $orderData['post_code'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Info -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <h2 class="text-lg font-bold text-slate-900 mb-6">Metode Pembayaran</h2>
                        <div class="space-y-4">
                            <!-- BCA Account -->
                            <div class="group flex items-center gap-4 p-4 bg-slate-50 rounded-xl hover:bg-blue-50/50 transition-colors cursor-pointer">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center p-2 shadow-sm group-hover:shadow transition-shadow">
                                    <img src="{{asset('assets/images/logos/bca-bank-central-asia 1.svg')}}" 
                                         class="w-full h-full object-contain" alt="BCA">
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2">
                                        <p class="font-medium text-slate-900">OhMyOutfit</p>
                                        <img src="{{asset('assets/images/icons/verify.svg')}}" class="w-4 h-4" alt="Verified">
                                    </div>
                                    <p class="text-sm text-slate-600">8008129839</p>
                                </div>
                                <button type="button" class="text-sm text-blue-600 font-medium opacity-0 group-hover:opacity-100 transition-opacity">
                                    Salin
                                </button>
                            </div>

                            <!-- Mandiri Account -->
                            <div class="group flex items-center gap-4 p-4 bg-slate-50 rounded-xl hover:bg-blue-50/50 transition-colors cursor-pointer">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center p-2 shadow-sm group-hover:shadow transition-shadow">
                                    <img src="{{asset('assets/images/logos/bank-mandiri 1.svg')}}" 
                                         class="w-full h-full object-contain" alt="Mandiri">
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2">
                                        <p class="font-medium text-slate-900">Rafli Ramdhani</p>
                                        <img src="{{asset('assets/images/icons/verify.svg')}}" class="w-4 h-4" alt="Verified">
                                    </div>
                                    <p class="text-sm text-slate-600">1340027478733</p>
                                </div>
                                <button type="button" class="text-sm text-blue-600 font-medium opacity-0 group-hover:opacity-100 transition-opacity">
                                    Salin
                                </button>
                            </div>

                            <!-- Upload Section -->
                            <div class="mt-6 space-y-4">
                                <div class="flex items-center justify-between">
                                    <label class="block text-sm font-medium text-slate-700">
                                        Bukti Transfer
                                    </label>
                                    <span class="text-xs text-slate-500">Maksimal 5MB (JPG, PNG)</span>
                                </div>
                                <div class="group relative">
                                    <div class="relative flex items-center w-full rounded-xl border-2 border-dashed border-slate-200 
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
                                            class="w-full px-4 py-4 text-left text-sm text-slate-400 hover:text-slate-600
                                                   focus:outline-none transition-colors duration-300">
                                            Pilih file bukti transfer atau drag and drop di sini
                                        </button>
                                        <input type="file" name="proof" id="Proof" 
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                            accept="image/*" required>
                                    </div>
                                </div>
                                <!-- File Preview -->
                                <div id="file-preview" class="hidden">
                                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                        <div class="flex items-center gap-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span id="file-name" class="text-sm text-slate-600"></span>
                                        </div>
                                        <button type="button" id="remove-file" class="text-sm text-red-500 hover:text-red-600">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Notice -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-5 border border-blue-100">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-white rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-blue-700 mb-1">Pembayaran Aman & Terpercaya</h3>
                                <p class="text-sm text-blue-600">Data pribadi Anda terlindungi dengan sistem enkripsi terkini. Transaksi Anda dijamin aman.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Payment Summary -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24">
                        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <h3 class="text-lg font-bold text-slate-900 mb-6">Ringkasan Pembayaran</h3>
                            
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-slate-600">Subtotal</span>
                                    <span class="font-medium">Rp {{number_format($orderData['sub_total_amount'], 0, ',', '.')}}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-slate-600">Kode Promo</span>
                                    <span class="font-medium px-2 py-1 bg-green-50 text-green-700 rounded-lg">{{ $orderData['promo_code'] }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-slate-600">Diskon</span>
                                    <span class="font-medium text-green-600">- Rp {{number_format($orderData['total_discount_amount'], 0, ',', '.')}}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-slate-600">PPN 11%</span>
                                    <span class="font-medium">Rp {{number_format($orderData['total_tax'], 0, ',', '.')}}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-slate-600">Pengiriman</span>
                                    <span class="font-medium text-green-600">Gratis</span>
                                </div>
                                
                                <div class="pt-4 mt-4 border-t border-slate-100">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-medium text-slate-700">Total Pembayaran</span>
                                        <span class="text-xl font-bold text-slate-900">Rp {{number_format($orderData['grand_total_amount'], 0, ',', '.')}}</span>
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
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById("Proof");
    const fileBtn = document.getElementById("Upload-btn");
    const filePreview = document.getElementById("file-preview");
    const fileName = document.getElementById("file-name");
    const removeFileBtn = document.getElementById("remove-file");
    
    function updateFilePreview(file) {
        if(file) {
            fileName.textContent = file.name;
            filePreview.classList.remove('hidden');
            fileBtn.innerHTML = `
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-slate-700">File terpilih</span>
                </div>
            `;
            fileBtn.parentElement.classList.add('border-blue-500', 'bg-blue-50/50');
        } else {
            filePreview.classList.add('hidden');
            fileBtn.innerHTML = `
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                            d="M15 7h3a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2h3m3-3h3a2 2 0 012 2v3M9 3h3v3"/>
                    </svg>
                    <span class="text-slate-400">Pilih file bukti transfer atau drag and drop di sini</span>
                </div>
            `;
            fileBtn.parentElement.classList.remove('border-blue-500', 'bg-blue-50/50');
        }
    }

    fileInput.addEventListener("change", function() {
        updateFilePreview(this.files[0]);
    });

    removeFileBtn.addEventListener("click", function() {
        fileInput.value = '';
        updateFilePreview(null);
    });

    // Form Submit Handler with Loading State
    document.querySelector('form').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Memproses Pembayaran...</span>
        `;
    });

    // Copy to Clipboard Functionality
    document.querySelectorAll('.group button').forEach(button => {
        if (button.textContent.trim() === 'Salin') {
            button.addEventListener('click', function(e) {
                const accountNumber = this.parentElement.querySelector('.text-slate-600').textContent;
                navigator.clipboard.writeText(accountNumber).then(() => {
                    const originalText = this.textContent;
                    this.textContent = 'Tersalin!';
                    setTimeout(() => {
                        this.textContent = originalText;
                    }, 2000);
                });
            });
        }
    });
});
</script>
@endpush
@endsection