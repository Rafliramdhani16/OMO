@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-blue-50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-block px-4 py-1 bg-blue-100 text-blue-600 rounded-full text-sm font-medium mb-4">Koleksi Baru</span>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-6">
                    Temukan Gayamu dengan Koleksi Terbaru Kami
                </h1>
                <p class="text-lg text-gray-600 mb-8">Jelajahi pilihan pakaian premium kami yang dirancang untuk gaya unik Anda.</p>
            </div>
            <div class="hidden md:block relative">
                <img src="{{ asset('image/hero.jpg') }}" alt="Hero Image" class="w-full h-auto rounded-2xl shadow-2xl transform hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-tr from-blue-500/10 to-transparent"></div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section id="category" class="max-w-7xl mx-auto px-4 mt-20">
    <div class="flex items-end justify-between mb-8">
        <div>
            
            <h2 class="text-3xl font-bold text-gray-900">Kategori Unggulan</h2>
            <p class="text-gray-600 mt-2">Telusuri kategori populer kami</p>
        </div>
        <a href="#" class="group inline-flex items-center text-sm text-blue-600 hover:text-blue-700 font-medium">
            <span class="border-b border-transparent group-hover:border-blue-600 transition-all duration-200">
                Lihat Semua Kategori
            </span>
            <svg class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </a>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse ($category as $itemCategory)
        <a href="{{ route('front.category', $itemCategory->slug) }}" class="group">
            <div class="bg-blue-50 rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="aspect-[3/4] overflow-hidden relative">
                    <img src="{{ asset($itemCategory->icon) }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                         alt="{{ $itemCategory->name }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-2xl font-bold text-white mb-2">{{ $itemCategory->name }}</h3>
                        <p class="text-sm text-white/90">{{ $itemCategory->shirts->count() }} Item</p>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-full text-center py-12">
            <div class="bg-gray-50 rounded-3xl p-12">
                <svg class="w-20 h-20 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Kategori</h3>
                <p class="text-gray-500">Silahkan cek kembali nanti</p>
            </div>
        </div>
        @endforelse
    </div>
</section>

<!-- Featured Products Section -->
<section id="featured" class="max-w-7xl mx-auto px-4 mt-20">
    <div class="flex items-end justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Produk Unggulan</h2>
            <p class="text-gray-600 mt-2">Temukan item populer kami</p>
        </div>
        <a href="#" class="group inline-flex items-center text-sm text-blue-600 hover:text-blue-700 font-medium">
            <span class="border-b border-transparent group-hover:border-blue-600 transition-all duration-200">
                Lihat Semua Produk
            </span>
            <svg class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </a>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @forelse ($popularShirt as $itemPopularShirt)
        <a href="{{ route('front.details', $itemPopularShirt->slug) }}" class="group">
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="aspect-square overflow-hidden relative">
                    <img src="{{ asset($itemPopularShirt->thumbnail) }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                         alt="{{ $itemPopularShirt->name }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-4">
                    <div class="flex items-start justify-between gap-2">
                        <h3 class="font-semibold text-gray-900 truncate">{{ $itemPopularShirt->name }}</h3>
                        <span class="flex items-center text-yellow-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-700 ml-1">4.5</span>
                        </span>
                    </div>
                    <div class="mt-3 flex items-center justify-between">
                        <p class="text-slate-700 font-semibold">
                            Rp {{ number_format($itemPopularShirt->price, 0, ',', '.') }}
                        </p>
                        <span class="text-xs text-gray-500">(18.4k ulasan)</span>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-full text-center py-12">
            <div class="bg-gray-50 rounded-2xl p-8">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Produk</h3>
                <p class="text-gray-500">Silahkan cek kembali nanti</p>
            </div>
        </div>
        @endforelse
    </div>
</section>

<!-- New Arrivals Section -->
<section id="fresh" class="max-w-7xl mx-auto px-4 mt-16 mb-16">
    <div class="flex items-end justify-between mb-6">
        <div>
        
            <h2 class="text-2xl font-bold text-gray-900">Produk Terbaru</h2>
            <p class="text-sm text-gray-600 mt-1">Langsung dari para desainer kami</p>
        </div>
        <a href="#" class="group inline-flex items-center text-sm text-blue-600 hover:text-blue-700 font-medium">
            <span class="border-b border-transparent group-hover:border-blue-600 transition-all duration-200">
                Lihat Semua
            </span>
            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($newShirt->take(6) as $itemNewShirt)
        <a href="{{ route('front.details', $itemNewShirt->slug) }}" class="group">
            <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex h-40">
                <div class="w-40 flex-shrink-0">
                    <div class="aspect-square relative">
                        <img src="{{ asset($itemNewShirt->thumbnail) }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             alt="{{ $itemNewShirt->name }}">

                    </div>
                </div>
                <div class="flex-1 p-4 flex flex-col relative">
                    <div>
                        <div class="absolute top-2 left-2">
                            <span class="px-2 py-0.5 bg-blue-600 text-white text-xs font-medium rounded-full">Baru</span>
                        </div>
                        <h3 class="font-medium text-gray-900 group-hover:text-blue-600 transition-colors duration-200 pt-6">
                            {{ $itemNewShirt->name }}
                        </h3>
                        <div class="mt-1 flex items-center gap-2">
                            <span class="text-xs text-gray-500">{{ $itemNewShirt->category->name }}</span>
                            <span class="text-xs text-gray-300">•</span>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-xs text-gray-600 ml-1">4.5</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-slate-700 font-medium absolute bottom-4 right-4">
                        Rp {{ number_format($itemNewShirt->price, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-full">
            <div class="bg-gray-50 rounded-xl p-6 text-center">
                <div class="max-w-md mx-auto">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <h3 class="text-base font-medium text-gray-900 mb-2">Belum Ada Produk Baru</h3>
                    <p class="text-sm text-gray-500">Nantikan koleksi terbaru kami yang akan datang segera.</p>
                    <a href="#" class="inline-flex mt-4 px-5 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Lihat Koleksi Lainnya
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>
    
</section>
@endsection