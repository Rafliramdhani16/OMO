@extends('layouts.app')

@section('content')
<div class="pt-5 pb-16">
    <!-- Breadcrumb -->
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('front.index') }}" class="hover:text-blue-600">Beranda</a>
            <span>/</span>
            <a href="{{ route('front.details', $shirt->slug) }}" class="hover:text-blue-600">{{ $shirt->name }}</a>
            <span>/</span>
            <span class="text-gray-900">Detail Pemesanan</span>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 mt-6">
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Left Column - Product Preview -->
                <div class="p-6 border-b md:border-b-0 md:border-r">
                    <div class="aspect-square bg-gray-50 rounded-xl overflow-hidden mb-4">
                        <img id="main-thumbnail"
                            src="{{asset('storage/' .$shirt->photos()->latest()->first()->photo)}}"
                            class="w-full h-full object-contain" 
                            alt="{{ $shirt->name }}" />
                    </div>
                    
                    <!-- Product Summary -->
                    <div class="bg-blue-50 rounded-xl p-4">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">{{ $shirt->name }}</h2>
                                <p class="text-gray-600">{{ $shirt->brand->name }}</p>
                            </div>
                            <div class="flex items-center gap-1 bg-white px-3 py-1 rounded-full">
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-sm font-medium">4.5</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Ukuran</span>
                                <span class="font-medium">{{$orderData['shirt_size']}}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Kategori</span>
                                <span class="font-medium">{{$shirt->category->name}}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Livewire Form -->
                <div class="p-6">
                    @livewire('order-form', ['shirt' => $shirt, 'orderData' => $orderData])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection