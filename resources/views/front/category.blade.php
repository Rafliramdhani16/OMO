@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <!-- Category Header -->
    <div class="mt-20">
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
            <a href="{{ route('front.index') }}" class="hover:text-blue-600">Beranda</a>
            <span>/</span>
            <span class="text-gray-900">{{ $category->name }}</span>
        </nav>

        <!-- Category Banner -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 h-48 md:h-[450px] relative overflow-hidden">
                    <img src="{{ asset($category->icon) }}" 
                        class="w-full h-[130%] object-cover object-center" 
                        alt="{{ $category->name }}">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/5 via-transparent to-white/10"></div>
                </div>
                <!-- Category Info -->
                <div class="flex-1 p-6 md:p-12 flex flex-col justify-center">
                    <div class="max-w-lg">
                        <span class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm font-medium mb-4">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Kategori
                        </span>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $category->name }}</h1>
                        
                        <!-- Category Description -->
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Temukan koleksi {{ strtolower($category->name) }} terbaik kami dengan desain yang trendy dan 
                            nyaman digunakan. Dibuat dengan bahan berkualitas tinggi dan memperhatikan detail untuk 
                            memastikan kenyamanan dan gaya Anda.
                        </p>

                        <div class="flex flex-col gap-4">
                            <div class="flex items-center gap-4">
                                <span class="px-4 py-2 bg-gray-100 rounded-lg text-sm text-gray-700 flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Premium Quality
                                </span>
                                <span class="px-4 py-2 bg-gray-100 rounded-lg text-sm text-gray-700 flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Fast Delivery
                                </span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="py-2 text-gray-600">
                                    <span class="font-semibold text-gray-900">{{ $category->shirts->count() }}</span> Produk Tersedia
                                </div>
                                <span class="text-gray-300">•</span>
                                <div class="py-2 text-gray-600">
                                    <span class="font-semibold text-gray-900">4.8</span> Rating
                                </div>
                                <span class="text-gray-300">•</span>
                                <div class="py-2 text-gray-600">
                                    <span class="font-semibold text-gray-900">1.2k+</span> Terjual
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Koleksi Terbaru</h2>
                    <p class="text-gray-500 mt-1">Pilihan terbaik untuk gaya Anda</p>
                </div>
                <button class="group flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700">
                    <span class="border-b border-transparent group-hover:border-blue-600 transition-all">Lihat Semua</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                @forelse ($category->shirts as $itemShirt)
                <a href="{{ route('front.details', $itemShirt->slug) }}" 
                   class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="relative aspect-square">
                        <img src="{{ asset($itemShirt->thumbnail) }}" 
                             class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500" 
                             alt="{{ $itemShirt->name }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    <div class="p-3">
                        <div class="flex items-start justify-between gap-2 mb-1">
                            <h3 class="font-medium text-sm text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-1">
                                {{ $itemShirt->name }}
                            </h3>
                            <div class="flex items-center text-yellow-400 shrink-0">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-xs font-medium text-gray-700 ml-1">4.5</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-xs text-gray-500">{{ $itemShirt->category->name }}</p>
                            <p class="text-sm font-semibold text-slate-700">
                                Rp {{ number_format($itemShirt->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-full">
                    <div class="bg-gray-50 rounded-xl p-8 text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Produk</h3>
                        <p class="text-gray-500">Koleksi untuk kategori ini akan segera hadir.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection