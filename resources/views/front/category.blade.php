@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mt-8 mb-16">
        <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-8">
            <a href="{{ route('front.index') }}" class="hover:text-gray-900 transition-colors">
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Beranda
                </span>
            </a>
            <span class="text-gray-400">/</span>
            <span class="font-medium text-gray-900">{{ $category->name }}</span>
        </nav>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-lg shadow-gray-100/50 overflow-hidden">
            <div class="flex flex-col lg:flex-row">
                <div class="lg:w-1/2 h-64 lg:h-[520px] relative">
                    <img src="{{ asset('storage/' . $category->icon) }}" 
                        class="w-full h-full object-cover object-center" 
                        alt="{{ $category->name }}">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/20 to-transparent"></div>
                </div>
                <div class="flex-1 p-8 lg:p-16 flex flex-col justify-center">
                    <div class="max-w-xl">
                        <div class="inline-flex items-center px-4 py-2 bg-gray-50 text-gray-700 rounded-full text-sm font-medium mb-6">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            {{ $category->name }}
                        </div>
                        
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                            Koleksi {{ $category->name }} Premium
                        </h1>
                        
                        <p class="text-gray-600 text-lg leading-relaxed mb-8">
                            Temukan koleksi {{ strtolower($category->name) }} terbaik kami dengan desain yang trendy dan 
                            nyaman digunakan. Dibuat dengan bahan berkualitas tinggi dan memperhatikan detail untuk 
                            memastikan kenyamanan dan gaya Anda.
                        </p>

                        <div class="grid grid-cols-3 gap-6 p-6 bg-gray-50 rounded-2xl mb-8">
                            <div class="text-center">
                                <p class="text-2xl font-bold text-gray-900">{{ $category->shirts->count() }}</p>
                                <p class="text-sm text-gray-600 mt-1">Produk</p>
                            </div>
                            <div class="text-center border-x border-gray-200">
                                <p class="text-2xl font-bold text-gray-900">4.8</p>
                                <p class="text-sm text-gray-600 mt-1">Rating</p>
                            </div>
                            <div class="text-center">
                                <p class="text-2xl font-bold text-gray-900">1.2k+</p>
                                <p class="text-sm text-gray-600 mt-1">Terjual</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <span class="inline-flex items-center px-4 py-2 bg-gray-100 rounded-lg text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Premium Quality
                            </span>
                            <span class="inline-flex items-center px-4 py-2 bg-gray-100 rounded-lg text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Fast Delivery
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Produk -->
    <div class="mb-16">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Koleksi Terbaru</h2>
                <p class="text-gray-600 mt-2">Pilihan terbaik untuk gaya Anda</p>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @forelse ($category->shirts as $itemShirt)
            <a href="{{ route('front.details', $itemShirt->slug) }}" 
               class="group bg-white rounded-xl border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
                <div class="relative aspect-square rounded-t-xl overflow-hidden">
                    <img src="{{ asset('storage/' . $itemShirt->thumbnail) }}" 
                         class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" 
                         alt="{{ $itemShirt->name }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>
                <div class="p-4">
                    <div class="flex items-start justify-between gap-2 mb-2">
                        <h3 class="font-medium text-gray-900 group-hover:text-gray-700 transition-colors line-clamp-1">
                            {{ $itemShirt->name }}
                        </h3>
                        <div class="flex items-center text-yellow-400 shrink-0">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-700 ml-1">4.5</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-500">{{ $itemShirt->category->name }}</p>
                        <p class="text-sm font-semibold text-gray-900">
                            Rp {{ number_format($itemShirt->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full">
                <div class="bg-gray-50 rounded-2xl p-12 text-center">
                    <svg class="w-20 h-20 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Belum Ada Produk</h3>
                    <p class="text-gray-600">Koleksi untuk kategori ini akan segera hadir.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
