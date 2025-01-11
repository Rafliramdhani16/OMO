@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50/30 pt-5 pb-16">
    <!-- Breadcrumb -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="py-3">
            <ol class="flex items-center gap-2 text-sm">
                <li>
                    <a href="{{ route('front.index') }}" class="text-gray-500 hover:text-blue-600 transition-colors">
                        Beranda
                    </a>
                </li>
                <li class="text-gray-400">/</li>
                <li>
                    <a href="#" class="text-gray-500 hover:text-blue-600 transition-colors">
                        {{ $shirt->category->name }}
                    </a>
                </li>
                <li class="text-gray-400">/</li>
                <li class="text-gray-900 font-medium">{{ $shirt->name }}</li>
            </ol>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-8">
            <!-- Left Column - Image Gallery -->
            <div class="lg:col-span-7 space-y-4">
                <!-- Main Image -->
                <div class="relative group">
                    <div class="aspect-[4/3] rounded-2xl bg-white shadow-lg overflow-hidden">
                        <img id="mainImage" 
                            src="{{ asset('storage/' . $shirt->thumbnail) }}"
                            class="w-full h-full object-contain transform group-hover:scale-105 transition-transform duration-500" 
                            alt="{{ $shirt->name }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    <!-- Zoom Icon -->
                    <button class="absolute top-4 right-4 p-2 bg-white/90 backdrop-blur-sm rounded-xl shadow-lg text-gray-600 hover:text-blue-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                        </svg>
                    </button>
                </div>

                <!-- Thumbnail Grid -->
                <div class="grid grid-cols-6 gap-2">
                    @foreach($shirt->photos as $photo)
                    <button onclick="updateMainImage('{{ asset('storage/' . $photo->photo) }}')"
                            class="relative aspect-square rounded-lg overflow-hidden hover:ring-2 ring-blue-600 transition-all duration-300 transform hover:scale-105">
                        <img src="{{ asset('storage/' . $photo->photo) }}" 
                            class="w-full h-full object-cover" 
                            alt="{{ $shirt->name }}">
                        <div class="absolute inset-0 bg-black/5 hover:bg-black/0 transition-colors"></div>
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Right Column - Product Info -->
            <div class="lg:col-span-5 mt-8 lg:mt-0">
                <div class="sticky top-24 space-y-6">
                    <!-- Product Info Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">
                        <!-- Header -->
                        <div class="space-y-4">
                            <div class="flex items-start justify-between gap-4">
                                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $shirt->name }}</h1>
                                <div class="flex flex-col items-end">
                                    <div class="flex items-center gap-1 px-3 py-1 bg-blue-50 rounded-full">
                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span class="text-sm font-semibold text-gray-900">4.5</span>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">(18.4k ulasan)</p>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-bold text-gray-900">
                                    Rp {{ number_format($shirt->price, 0, ',', '.') }}
                                </span>
                                <span class="text-sm text-gray-500">/pcs</span>
                            </div>
                        </div>

                        <!-- Brand Info -->
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                            <div class="w-16 h-16 bg-white rounded-lg overflow-hidden p-2 shadow-sm">
                                <img src="{{ asset('storage/' . $shirt->brand->logo) }}"
                                    class="w-full h-full object-contain" 
                                    alt="{{ $shirt->brand->name }}">
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Official Store</p>
                                <h3 class="text-lg font-bold text-gray-900">{{ $shirt->brand->name }}</h3>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="space-y-3">
                            <h2 class="text-lg font-semibold text-gray-900">Deskripsi Produk</h2>
                            <div class="prose prose-sm text-gray-600">
                                <p class="leading-relaxed">{{ $shirt->about }}</p>
                            </div>
                        </div>

                        <!-- Size Selection Form -->
                        <form action="{{ route('front.save_order', $shirt->slug) }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="shirt_id" value="{{ $shirt->id }}">

                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-lg font-semibold text-gray-900">Pilih Ukuran</h2>
                                </div>

                                <div class="grid grid-cols-4 sm:grid-cols-6 gap-3">
                                    @foreach($shirt->sizes as $itemSize)
                                    <label class="relative group">
                                        <input type="radio" 
                                               name="size_id" 
                                               value="{{ $itemSize->id }}"
                                               {{ old('size_id') == $itemSize->id ? 'checked' : '' }}
                                               class="peer hidden">
                                        <div class="h-14 flex items-center justify-center rounded-xl border-2 bg-white cursor-pointer
                                                 peer-checked:border-blue-600 peer-checked:bg-blue-50 
                                                 group-hover:border-blue-600 group-hover:bg-blue-50/50 
                                                 transition-all duration-300">
                                            <span class="text-sm font-medium peer-checked:text-blue-600">
                                                {{ $itemSize->size }}
                                            </span>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>

                                @error('size_id')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                @error('shirt_id')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Product Features -->
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="text-sm text-gray-600">100% Original</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-sm text-gray-600">Express Delivery</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                    <span class="text-sm text-gray-600">7 Days Return</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    <span class="text-sm text-gray-600">Secure Payment</span>
                                </div>
                            </div>

                            <!-- Buy Button -->
                            <button type="submit" 
                                class="w-full inline-flex items-center justify-center gap-2 px-8 py-4 bg-blue-600 text-white font-medium rounded-xl
                                     hover:bg-blue-700 transform hover:scale-[1.02] transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                <span>Beli Sekarang</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function updateMainImage(src) {
        const mainImage = document.getElementById('mainImage');
        if (mainImage) {
            mainImage.src = src;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize zoom functionality if needed
        const zoomButton = document.querySelector('[data-zoom]');
        if (zoomButton) {
            zoomButton.addEventListener('click', function() {
                // Add zoom functionality here
            });
        }
    });
</script>
@endpush

@endsection