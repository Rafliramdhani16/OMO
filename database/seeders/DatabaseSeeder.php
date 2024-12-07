<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\PromoCode;
use App\Models\Shirt;
use App\Models\ShirtPhoto;
use App\Models\ShirtSize;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Baju',
                'icon' => 'seeder-assets/kategori/baju.jpg'
            ],
            [
                'name' => 'Hoodie',
                'icon' => 'seeder-assets/kategori/hoodie.jpg'
            ],
            [
                'name' => 'Jaket',
                'icon' => 'seeder-assets/kategori/jaket.jpg'
            ],
            [
                'name' => 'Kemeja',
                'icon' => 'seeder-assets/kategori/kemeja.jpg'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $brands = [
            [
                'name' => 'Adidas',
                'logo' => 'seeder-assets/brand/adidas.jpg'
            ],
            [
                'name' => 'H&M',
                'logo' => 'seeder-assets/brand/h&m.jpg'
            ],
            [
                'name' => 'Uniqlo',
                'logo' => 'seeder-assets/brand/uniqlo.jpg'
            ],
            [
                'name' => 'Zara',
                'logo' => 'seeder-assets/brand/zara.jpg'
            ],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }

        $promoCodes = [
            [
                'code' => 'WELCOME2024',
                'discount_amount' => 50000
            ],
            [
                'code' => 'TAHUNBARU',
                'discount_amount' => 100000
            ],
            [
                'code' => 'SPESIAL10',
                'discount_amount' => 75000
            ],
        ];

        foreach ($promoCodes as $promoCode) {
            PromoCode::create($promoCode);
        }

        $shirts = [
            [
                'name' => 'Kaos Basic',
                'thumbnail' => 'seeder-assets/baju/baju1.jpg',
                'about' => 'Kaos katun berkualitas untuk pakaian sehari-hari',
                'price' => 150000,
                'stock' => 100,
                'is_popular' => true,
                'category_id' => 1,
                'brand_id' => 2,
                'photos' => [
                    'seeder-assets/baju/baju1.jpg',
                    'seeder-assets/baju/baju2.jpg',
                    'seeder-assets/baju/baju3.jpg',
                    'seeder-assets/baju/baju4.jpg',
                    'seeder-assets/baju/baju5.jpg'
                ],
                'sizes' => ['S', 'M', 'L', 'XL']
            ],
            [
                'name' => 'Kaos Premium',
                'thumbnail' => 'seeder-assets/baju/baju1.jpg',
                'about' => 'Kaos premium dengan bahan pilihan',
                'price' => 175000,
                'stock' => 80,
                'is_popular' => false,
                'category_id' => 1,
                'brand_id' => 3,
                'photos' => [
                    'seeder-assets/baju/baju1.jpg',
                    'seeder-assets/baju/baju1.jpg'
                ],
                'sizes' => ['S', 'M', 'L', 'XL']
            ],
            
            [
                'name' => 'Hoodie Klasik',
                'thumbnail' => 'seeder-assets/hoodie/hoodie1.jpg',
                'about' => 'Hoodie klasik dengan desain timeless',
                'price' => 299000,
                'stock' => 75,
                'is_popular' => true,
                'category_id' => 2,
                'brand_id' => 1,
                'photos' => [
                    'seeder-assets/hoodie/hoodie1.jpg',
                    'seeder-assets/hoodie/hoodie2.jpg',
                    'seeder-assets/hoodie/hoodie3.jpg'
                ],
                'sizes' => ['M', 'L', 'XL', 'XXL']
            ],
            [
                'name' => 'Hoodie Olahraga',
                'thumbnail' => 'seeder-assets/hoodie/hoodie1.jpg',
                'about' => 'Hoodie nyaman untuk berolahraga',
                'price' => 325000,
                'stock' => 60,
                'is_popular' => false,
                'category_id' => 2,
                'brand_id' => 1,
                'photos' => [
                    'seeder-assets/hoodie/hoodie1.jpg',
                    'seeder-assets/hoodie/hoodie1.jpg'
                ],
                'sizes' => ['M', 'L', 'XL']
            ],
            
            [
                'name' => 'Jaket Musim Dingin',
                'thumbnail' => 'seeder-assets/jaket/jaket1.jpg',
                'about' => 'Jaket hangat untuk musim dingin',
                'price' => 450000,
                'stock' => 50,
                'is_popular' => true,
                'category_id' => 3,
                'brand_id' => 3,
                'photos' => [
                    'seeder-assets/jaket/jaket1.jpg',
                    'seeder-assets/jaket/jaket2.jpg',
                    'seeder-assets/jaket/jaket3.jpg',
                    'seeder-assets/jaket/jaket4.jpg',
                    'seeder-assets/jaket/jaket5.jpg'
                ],
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL']
            ],
            [
                'name' => 'Jaket Olahraga',
                'thumbnail' => 'seeder-assets/jaket/jaket1.jpg',
                'about' => 'Jaket ringan untuk aktivitas olahraga',
                'price' => 375000,
                'stock' => 60,
                'is_popular' => false,
                'category_id' => 3,
                'brand_id' => 1,
                'photos' => [
                    'seeder-assets/jaket/jaket1.jpg',
                    'seeder-assets/jaket/jaket1.jpg'
                ],
                'sizes' => ['S', 'M', 'L', 'XL']
            ],
            
            [
                'name' => 'Kemeja Formal',
                'thumbnail' => 'seeder-assets/kemeja/kemeja1.jpg',
                'about' => 'Kemeja formal untuk kegiatan kantor',
                'price' => 350000,
                'stock' => 60,
                'is_popular' => true,
                'category_id' => 4,
                'brand_id' => 4,
                'photos' => [
                    'seeder-assets/kemeja/kemeja1.jpg',
                    'seeder-assets/kemeja/kemeja2.jpg',
                    'seeder-assets/kemeja/kemeja3.jpg'
                ],
                'sizes' => ['15', '16', '17', '18']
            ],
            [
                'name' => 'Kemeja Kasual',
                'thumbnail' => 'seeder-assets/kemeja/kemeja1.jpg',
                'about' => 'Kemeja santai untuk sehari-hari',
                'price' => 325000,
                'stock' => 70,
                'is_popular' => false,
                'category_id' => 4,
                'brand_id' => 2,
                'photos' => [
                    'seeder-assets/kemeja/kemeja1.jpg',
                    'seeder-assets/kemeja/kemeja1.jpg'
                ],
                'sizes' => ['15', '16', '17', '18']
            ]
        ];

        foreach ($shirts as $shirtData) {
            $photos = $shirtData['photos'];
            $sizes = $shirtData['sizes'];
            unset($shirtData['photos'], $shirtData['sizes']);

            $shirt = Shirt::create($shirtData);

            foreach ($photos as $photo) {
                ShirtPhoto::create([
                    'shirt_id' => $shirt->id,
                    'photo' => $photo
                ]);
            }

            foreach ($sizes as $size) {
                ShirtSize::create([
                    'shirt_id' => $shirt->id,
                    'size' => $size
                ]);
            }
        }
    }
}