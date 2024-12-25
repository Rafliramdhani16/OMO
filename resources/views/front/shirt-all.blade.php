
@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-br from-blue-50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="py-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('front.index') }}" 
                    class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-blue-600 transition-all duration-300">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                        Beranda
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-slate-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium text-slate-500">Koleksi Lengkap</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="py-16 md:py-20">
            <div class="max-w-3xl relative">
                <div class="absolute -top-6 -left-6 w-20 h-20 bg-blue-50 rounded-full blur-2xl opacity-60"></div>
                <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-indigo-50 rounded-full blur-3xl opacity-60"></div>

                <div class="relative">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-900 mb-6 tracking-tight leading-tight">
                        Temukan Gayamu dalam Koleksi Kami
                    </h1>
                    <p class="text-lg text-slate-600 leading-relaxed max-w-2xl">
                        Setiap potong pakaian memiliki ceritanya sendiri. Dari kasual hingga formal, temukan pilihan yang sempurna untuk setiap momen spesial Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse ($shirts as $shirt)
            <a href="{{ route('front.details', $shirt->slug) }}" class="group block">
                <div class="relative bg-white rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-2xl border border-gray-100">
                    <div class="relative aspect-[3/4] overflow-hidden bg-gray-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10"></div>
                        
                        <img src="{{ asset('storage/' . $shirt->thumbnail) }}" 
                            alt="{{ $shirt->name }}" 
                            class="h-full w-full object-cover object-center transform transition-all duration-700 ease-out scale-100 group-hover:scale-110">
                        
                        
                        <div class="absolute inset-0 bg-gradient-to-tr from-white/0 via-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-20"></div>
                        
                        <div class="absolute top-4 left-4 flex flex-col gap-2 z-30">
                            @if($shirt->is_popular)
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 shadow-md backdrop-blur-sm">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Terfavorit
                            </span>
                            @endif
                            @if($shirt->stock <= 5 && $shirt->stock > 0)
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-red-100 text-red-800 shadow-md backdrop-blur-sm">
                                Stok Terbatas
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="p-4 bg-white">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-base font-medium text-slate-800 line-clamp-1 transition-colors duration-300">
                                {{ $shirt->name }}
                            </h3>
                            <div class="flex items-center bg-gray-50 rounded-lg px-2 py-1">
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="ml-1 text-sm text-slate-600 font-medium">{{ $shirt->rating ?? '4.9' }}</span>
                            </div>
                        </div>

                        
                        <p class="text-sm text-slate-500 mb-3">{{ $shirt->category->name }}</p>

                        
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                                <p class="text-lg font-semibold text-slate-800">
                                    Rp {{ number_format($shirt->price, 0, ',', '.') }}
                                </p>
                            </div>
                            @if($shirt->stock > 0)
                                <span class="text-sm text-slate-600 bg-gray-50 px-3 py-1 rounded-full">
                                    {{ $shirt->stock }} tersedia
                                </span>
                            @else
                                <span class="text-sm text-red-500 bg-red-50 px-3 py-1 rounded-full">
                                    Stok Habis
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full py-32 text-center">
                <div class="max-w-md mx-auto">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M34 40h10v-4a6 6 0 00-10.712-3.714M34 40H14m20 0v-4a9.971 9.971 0 00-.712-3.714M14 40H4v-4a6 6 0 0110.713-3.714M14 40v-4c0-1.313.253-2.566.713-3.714m0 0A10.003 10.003 0 0124 26c4.21 0 7.813 2.602 9.288 6.286"/>
                    </svg>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Koleksi Akan Hadir Segera</h3>
                    <p class="mt-3 text-sm text-gray-500">Kami sedang mempersiapkan koleksi terbaik untuk Anda. Mohon tunggu kabar selanjutnya dari kami.</p>
                    <div class="mt-8">
                        <a href="{{ route('front.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:-translate-y-1">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        @if($shirts->hasPages())
        <div class="mt-16 animate-fade-in">
            {{ $shirts->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
