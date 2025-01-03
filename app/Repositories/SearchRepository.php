<?php

namespace App\Repositories;

use App\Models\Shirt;
use App\Repositories\Contracts\SearchRepositoryInterface;

class SearchRepository implements SearchRepositoryInterface
{
    public function search(string $query)
    {
        return Shirt::where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('about', 'like', "%{$query}%");
            })
            ->orWhereHas('brand', function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->orWhereHas('category', function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->with(['brand', 'category', 'sizes'])
            ->where('stock', '>', 0) // Hanya tampilkan yang masih ada stock
            ->take(5)
            ->get()
            ->map(function($shirt) {
                return [
                    'id' => $shirt->id,
                    'name' => $shirt->name,
                    'slug' => $shirt->slug,
                    'thumbnail' => $shirt->thumbnail,
                    'price' => $shirt->price,
                    'stock' => $shirt->stock,
                    'is_popular' => $shirt->is_popular,
                    'brand' => $shirt->brand ? $shirt->brand->name : null,
                    'category' => $shirt->category->name,
                    'sizes' => $shirt->sizes->pluck('size'),
                    'url' => route('front.details', $shirt->slug)
                ];
            });
    }
}