@extends('layouts.app')

@section('content')
<div class=" bg-gradient-to-br from-gray-50 to-blue-50/30 h-screen">
    <div class="max-w-7xl mx-auto px-4 py-8 ">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Pengiriman</h1>
                <p class="text-slate-500 mt-1">Mohon isi detail alamat pengiriman dengan lengkap</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <form action="{{ route('front.save_customer_data') }}" method="POST" id="shipping-form">
                    @csrf
                    
                    <!-- Product Card -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 hover:border-slate-300 transition-all duration-300 shadow-sm">
                        <div class="flex gap-6">
                            <div class="w-24 h-24 bg-slate-100 rounded-xl overflow-hidden flex-shrink-0">
                                <img src="{{Storage::url($shirt->photos()->latest()->first()->photo)}}"
                                    class="w-full h-full object-cover hover:scale-110 transition-all duration-500"
                                    alt="{{ $shirt->name }}">
                            </div>
                            <div class="flex-1">
                                <h2 class="text-lg font-bold text-slate-900 mb-1">{{ $shirt->name }}</h2>
                                <div class="flex items-center gap-6 text-sm text-slate-500 mb-2">
                                    <span>{{ $orderData['shirt_size'] }}</span>
                                    <span>•</span>
                                    <span>{{ $orderData['quantity'] }} item</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-1 bg-amber-50 px-2.5 py-1 rounded-lg">
                                        <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span class="font-medium text-slate-700">4.5</span>
                                    </div>
                                    <div class="text-lg font-bold text-blue-600">
                                        Rp {{number_format($orderData['grand_total_amount'], 0, ',', '.')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Form -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 hover:border-slate-300 transition-all duration-300 shadow-sm mt-6">
                        <div class="space-y-6">
                            <!-- Address -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-slate-700 mb-2">
                                    Alamat Lengkap
                                </label>
                                <div class="relative">
                                    <textarea 
                                        name="address" 
                                        id="address" 
                                        rows="3" 
                                        required
                                        class="w-full px-4 py-3 text-sm rounded-xl text-slate-600 placeholder:text-slate-400
                                        border-2 border-slate-200 hover:border-blue-400/50 
                                        focus:border-blue-500 focus:ring-4 focus:ring-blue-200/50
                                        transition-all duration-300 resize-none appearance-none"
                                        placeholder="Masukkan alamat lengkap pengiriman Anda"
                                    ></textarea>
                                </div>
                            </div>

                            <!-- Two Column Layout -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-slate-700 mb-2">
                                        Nomor Telepon
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-slate-400 group-hover:text-slate-500 peer-focus:text-slate-700 transition-colors duration-300" 
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                        </div>
                                        <input 
                                            type="tel" 
                                            name="phone" 
                                            id="phone" 
                                            required
                                            class="peer w-full pl-12 pr-4 py-3 text-sm rounded-xl text-slate-600 placeholder:text-slate-400
                                            border-2 border-slate-200 hover:border-blue-400/50 
                                            focus:border-blue-500 focus:ring-4 focus:ring-blue-200/50
                                            transition-all duration-300 appearance-none"
                                            placeholder="Contoh: 08123456789">
                                    </div>
                                </div>

                                <!-- City -->
                                <div>
                                    <label for="city" class="block text-sm font-medium text-slate-700 mb-2">
                                        Kota
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-slate-400 group-hover:text-slate-500 peer-focus:text-blue-500 transition-colors duration-300" 
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                        </div>
                                        <input 
                                            type="text" 
                                            name="city" 
                                            id="city" 
                                            required
                                            class="peer w-full pl-12 pr-4 py-3 text-sm rounded-xl text-slate-600 placeholder:text-slate-400
                                            border-2 border-slate-200 hover:border-blue-400/50 
                                            focus:border-blue-500 focus:ring-4 focus:ring-blue-200/50
                                            transition-all duration-300 appearance-none"
                                            placeholder="Masukkan nama kota">
                                    </div>
                                </div>
                            </div>

                            <!-- Post Code -->
                            <div>
                                <label for="post" class="block text-sm font-medium text-slate-700 mb-2">
                                    Kode Pos
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400 group-hover:text-slate-500 peer-focus:text-blue-500 transition-colors duration-300" 
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        name="post_code" 
                                        id="post" 
                                        required
                                        class="peer w-full pl-12 pr-4 py-3 text-sm rounded-xl text-slate-600 placeholder:text-slate-400
                                        border-2 border-slate-200 hover:border-blue-400/50 
                                        focus:border-blue-500 focus:ring-4 focus:ring-blue-200/50
                                        transition-all duration-300 appearance-none"
                                        placeholder="Contoh: 12345">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Notice -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-100/50 mt-4">
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
                </form>
            </div>

            <!-- Right Column - Order Summary -->
            <div class="lg:col-span-1">
                <div class="sticky top-24">
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Ringkasan Pembayaran</h3>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Subtotal</span>
                                <span class="font-medium text-slate-700">Rp {{number_format($orderData['grand_total_amount'], 0, ',', '.')}}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Biaya Pengiriman</span>
                                <span class="font-medium text-green-600">Gratis</span>
                            </div>
                            <div class="pt-3 border-t border-slate-100">
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-slate-700">Total Pembayaran</span>
                                    <span class="text-lg font-bold text-slate-900">Rp {{number_format($orderData['grand_total_amount'], 0, ',', '.')}}</span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" form="shipping-form"
                            class="w-full mt-6 py-4 px-6 bg-blue-600 text-white text-sm font-medium rounded-xl
                            transform transition-all duration-300 
                            hover:bg-blue-700 hover:scale-[1.02]
                            focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:scale-[1.02]
                            active:scale-[0.98]
                            disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100
                            flex items-center justify-center gap-2 group">
                            <span>Lanjutkan ke Pembayaran</span>
                            <svg class="w-5 h-5 transform transition-transform duration-300 group-hover:translate-x-1" 
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Hanya style yang tidak bisa ditangani Tailwind */
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    textarea:-webkit-autofill,
    textarea:-webkit-autofill:hover,
    textarea:-webkit-autofill:focus {
        -webkit-box-shadow: 0 0 0px 1000px white inset;
        transition: background-color 5000s ease-in-out 0s;
    }

    /* Menghilangkan spinner di input number */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
    /* Menghilangkan outline bawaan browser */
    textarea:focus, input:focus {
        outline: none !important;
    }

    /* Remove browser default styles */
    textarea, input {
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        appearance: none !important;
    }

</style>
@endpush

@push('scripts')
<script>
    // Form Submission Handler
    const form = document.getElementById('shipping-form');
    const submitButton = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function(e) {
        // Disable button
        submitButton.disabled = true;
        
        // Change button content to loading state
        submitButton.innerHTML = `
            <div class="flex items-center gap-2">
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Memproses...</span>
            </div>
        `;
    });

    // Input Field Validation
    const inputs = document.querySelectorAll('input[required], textarea[required]');
    
    inputs.forEach(input => {
        input.addEventListener('invalid', (e) => {
            e.preventDefault();
            input.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-200/50');
            
            setTimeout(() => {
                input.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-200/50');
            }, 3000);
        });

        input.addEventListener('input', () => {
            if (input.validity.valid) {
                input.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-200/50');
            }
        });
    });
</script>
@endpush
@endsection