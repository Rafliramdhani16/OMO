@extends('layouts.app')

@section('content')
<div class="pt-20 pb-16">
    <!-- Breadcrumb -->
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('front.index') }}" class="hover:text-blue-600">Beranda</a>
            <span>/</span>
            <a href="#" class="hover:text-blue-600">{{ $shirt->category->name }}</a>
            <span>/</span>
            <span class="text-gray-900">{{ $shirt->name }}</span>
        </nav>
    </div>

    <!-- Product Details -->
    <div class="max-w-7xl mx-auto px-4 mt-6">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Image Gallery - Ukuran dikurangi -->
            <div class="space-y-3">
                <div class="aspect-[4/3] bg-white rounded-2xl overflow-hidden">
                    <img id="mainImage" src="{{ asset($shirt->thumbnail) }}" 
                         class="w-full h-full object-contain" 
                         alt="{{ $shirt->name }}">
                </div>
                <!-- Thumbnail Gallery - Ukuran dikurangi -->
                <div class="grid grid-cols-6 gap-2">
                    @foreach($shirt->photos as $photo)
                    <button onclick="updateMainImage('{{ asset($photo->photo) }}')" 
                            class="aspect-square bg-gray-100 rounded-lg overflow-hidden hover:ring-2 ring-blue-600 transition-all">
                        <img src="{{ asset($photo->photo) }}" 
                             class="w-full h-full object-cover" 
                             alt="{{ $shirt->name }}">
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Product Info -->
            <div class="flex flex-col">
                <div class="pb-4 border-b">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $shirt->name }}</h1>
                            <p class="mt-2 text-xl font-semibold text-blue-600">
                                Rp {{ number_format($shirt->price, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="flex items-center bg-blue-50 px-3 py-1 rounded-full">
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-900">4.5</span>
                            <span class="mx-1.5 text-gray-500">•</span>
                            <span class="text-sm text-gray-500">(18.4k ulasan)</span>
                        </div>
                    </div>
                </div>

                <!-- Brand Info -->
                <div class="py-4 border-b">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 bg-white rounded-xl shadow-sm overflow-hidden p-2">
                            <img src="{{ asset($shirt->brand->logo) }}" 
                                 class="w-full h-full object-contain" 
                                 alt="{{ $shirt->brand->name }}">
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Brand</p>
                            <h3 class="text-lg font-semibold">{{ $shirt->brand->name }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Product Description -->
                <div class="py-4 border-b">
                    <h2 class="text-lg font-semibold mb-3">Deskripsi Produk</h2>
                    <p class="text-gray-600 leading-relaxed text-sm">{{ $shirt->about }}</p>
                </div>

                <!-- Size Selection -->
                <form action="{{ route('front.save_order', $shirt->slug) }}" method="POST" class="py-4">
                    @csrf
                    <h2 class="text-lg font-semibold mb-3">Pilih Ukuran</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($shirt->sizes as $itemSize)
                        <label class="relative">
                            <input type="radio" 
                                   name="shirt_size" 
                                   value="{{ $itemSize->size }}"
                                   data-size-id="{{ $itemSize->id }}"
                                   class="peer hidden" 
                                   required>
                            <div class="w-14 h-14 flex items-center justify-center rounded-xl border-2 cursor-pointer
                                     peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:border-blue-600 transition-all">
                                <span class="text-sm font-medium">{{ $itemSize->size }}</span>
                            </div>
                        </label>
                        @endforeach
                        <input type="hidden" name="size_id" id="size_id">
                    </div>

                    <!-- Add to Cart Button -->
                    <div class="fixed bottom-0 left-0 right-0 bg-white border-t md:relative md:border-t-0 md:bg-transparent md:mt-6">
                        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between gap-4">
                            <div>
                                <p class="text-xl font-bold text-gray-900">
                                    Rp {{ number_format($shirt->price, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-gray-500">Harga sudah termasuk pajak</p>
                            </div>
                            <button type="submit" 
                                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors">
                                Beli Sekarang
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function updateMainImage(src) {
    document.getElementById('mainImage').src = src;
}

document.addEventListener('DOMContentLoaded', function() {
    const sizeRadios = document.querySelectorAll('input[name="shirt_size"]');
    const sizeIdInput = document.getElementById('size_id');

    sizeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            const selectedSizeId = this.getAttribute('data-size-id');
            sizeIdInput.value = selectedSizeId;
        });
    });
});
</script>
@endpush
@endsection