<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\PromoCode;
use App\Models\Shirt;
use App\Models\ShirtPhoto;
use App\Models\ShirtSize;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Baju',
                'icon' => database_path('seeders/seeder-assets/kategori/baju.jpg')
            ],
            [
                'name' => 'Hoodie',
                'icon' => database_path('seeders/seeder-assets/kategori/hoodie.jpg')
            ],
            [
                'name' => 'Jaket',
                'icon' => database_path('seeders/seeder-assets/kategori/jaket.jpg')
            ],
            [
                'name' => 'Kemeja',
                'icon' => database_path('seeders/seeder-assets/kategori/kemeja.jpg')
            ],
        ];

        foreach ($categories as $category) {
            $iconPath = $category['icon'];
            $extension = pathinfo($iconPath, PATHINFO_EXTENSION);
            $filename = 'seeder-assets/kategori/' . Str::slug($category['name']) . '.' . $extension;
            
            // Copy file to storage
            if (file_exists($iconPath)) {
                Storage::disk('public')->putFileAs(
                    dirname($filename),
                    $iconPath,
                    basename($filename)
                );
                
                $category['icon'] = $filename;
            }
            
            Category::create($category);
        }

        $brands = [
            [
                'name' => 'Adidas',
                'logo' => database_path('seeders/seeder-assets/brand/adidas.jpg')
            ],
            [
                'name' => 'H&M',
                'logo' => database_path('seeders/seeder-assets/brand/h&m.jpg')
            ],
            [
                'name' => 'Uniqlo',
                'logo' => database_path('seeders/seeder-assets/brand/uniqlo.jpg')
            ],
            [
                'name' => 'Zara',
                'logo' => database_path('seeders/seeder-assets/brand/zara.jpg')
            ],
        ];

        foreach ($brands as $brand) {
            $logoPath = $brand['logo'];
            $extension = pathinfo($logoPath, PATHINFO_EXTENSION);
            $filename = 'seeder-assets/brand/' . Str::slug($brand['name']) . '.' . $extension;
            
            // Copy file to storage
            if (file_exists($logoPath)) {
                Storage::disk('public')->putFileAs(
                    dirname($filename),
                    $logoPath,
                    basename($filename)
                );
                
                $brand['logo'] = $filename;
            }
            
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
                'thumbnail' => database_path('seeders/seeder-assets/baju/baju1.jpg'),
                'about' => 'Kaos katun berkualitas untuk pakaian sehari-hari',
                'price' => 150000,
                'stock' => 100,
                'is_popular' => false,
                'category_id' => 1,
                'brand_id' => 2,
                'photos' => [
                    database_path('seeders/seeder-assets/baju/baju1.jpg'),
                    database_path('seeders/seeder-assets/baju/baju2.jpg'),
                    database_path('seeders/seeder-assets/baju/baju3.jpg'),
                    database_path('seeders/seeder-assets/baju/baju4.jpg'),
                    database_path('seeders/seeder-assets/baju/baju5.jpg')
                ],
                'sizes' => ['S', 'M', 'L', 'XL']
            ],
            [
                'name' => 'Kaos Premium',
                'thumbnail' => database_path('seeders/seeder-assets/baju/baju1.jpg'),
                'about' => 'Kaos premium dengan bahan pilihan',
                'price' => 175000,
                'stock' => 80,
                'is_popular' => true,
                'category_id' => 1,
                'brand_id' => 3,
                'photos' => [
                    database_path('seeders/seeder-assets/baju/baju1.jpg'),
                    database_path('seeders/seeder-assets/baju/baju1.jpg')
                ],
                'sizes' => ['S', 'M', 'L', 'XL']
            ],
            [
                'name' => 'Hoodie Klasik',
                'thumbnail' => database_path('seeders/seeder-assets/hoodie/hoodie1.jpg'),
                'about' => 'Hoodie klasik dengan desain timeless',
                'price' => 299000,
                'stock' => 75,
                'is_popular' => true,
                'category_id' => 2,
                'brand_id' => 1,
                'photos' => [
                    database_path('seeders/seeder-assets/hoodie/hoodie1.jpg'),
                    database_path('seeders/seeder-assets/hoodie/hoodie2.jpg'),
                    database_path('seeders/seeder-assets/hoodie/hoodie3.jpg')
                ],
                'sizes' => ['M', 'L', 'XL', 'XXL']
            ],
            [
                'name' => 'Hoodie Olahraga',
                'thumbnail' => database_path('seeders/seeder-assets/hoodie/hoodie1.jpg'),
                'about' => 'Hoodie nyaman untuk berolahraga',
                'price' => 325000,
                'stock' => 60,
                'is_popular' => false,
                'category_id' => 2,
                'brand_id' => 1,
                'photos' => [
                    database_path('seeders/seeder-assets/hoodie/hoodie1.jpg'),
                    database_path('seeders/seeder-assets/hoodie/hoodie1.jpg')
                ],
                'sizes' => ['M', 'L', 'XL']
            ],
            [
                'name' => 'Jaket Musim Dingin',
                'thumbnail' => database_path('seeders/seeder-assets/jaket/jaket1.jpg'),
                'about' => 'Jaket hangat untuk musim dingin',
                'price' => 450000,
                'stock' => 50,
                'is_popular' => false,
                'category_id' => 3,
                'brand_id' => 3,
                'photos' => [
                    database_path('seeders/seeder-assets/jaket/jaket1.jpg'),
                    database_path('seeders/seeder-assets/jaket/jaket2.jpg'),
                    database_path('seeders/seeder-assets/jaket/jaket3.jpg'),
                    database_path('seeders/seeder-assets/jaket/jaket4.jpg'),
                    database_path('seeders/seeder-assets/jaket/jaket5.jpg')
                ],
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL']
            ],
            [
                'name' => 'Jaket Olahraga',
                'thumbnail' => database_path('seeders/seeder-assets/jaket/jaket1.jpg'),
                'about' => 'Jaket ringan untuk aktivitas olahraga',
                'price' => 375000,
                'stock' => 60,
                'is_popular' => true,
                'category_id' => 3,
                'brand_id' => 1,
                'photos' => [
                    database_path('seeders/seeder-assets/jaket/jaket1.jpg'),
                    database_path('seeders/seeder-assets/jaket/jaket1.jpg')
                ],
                'sizes' => ['S', 'M', 'L', 'XL']
            ],
            [
                'name' => 'Kemeja Formal',
                'thumbnail' => database_path('seeders/seeder-assets/kemeja/kemeja1.jpg'),
                'about' => 'Kemeja formal untuk kegiatan kantor',
                'price' => 350000,
                'stock' => 60,
                'is_popular' => true,
                'category_id' => 4,
                'brand_id' => 4,
                'photos' => [
                    database_path('seeders/seeder-assets/kemeja/kemeja1.jpg'),
                    database_path('seeders/seeder-assets/kemeja/kemeja2.jpg'),
                    database_path('seeders/seeder-assets/kemeja/kemeja1.jpg')
                ],
                'sizes' => ['M', 'L', 'XL', 'XXL']
            ],
            [
                'name' => 'Kemeja Kasual',
                'thumbnail' => database_path('seeders/seeder-assets/kemeja/kemeja1.jpg'),
                'about' => 'Kemeja santai untuk sehari-hari',
                'price' => 325000,
                'stock' => 70,
                'is_popular' => true,
                'category_id' => 4,
                'brand_id' => 2,
                'photos' => [
                    database_path('seeders/seeder-assets/kemeja/kemeja3.jpg'),
                    database_path('seeders/seeder-assets/kemeja/kemeja1.jpg')
                ],
                'sizes' => ['M', 'L', 'XL', 'XXL']
            ]
        ];

        foreach ($shirts as $shirtData) {
            $photos = $shirtData['photos'];
            $sizes = $shirtData['sizes'];
            
            // Handle thumbnail upload
            $thumbPath = $shirtData['thumbnail'];
            $extension = pathinfo($thumbPath, PATHINFO_EXTENSION);
            $filename = 'seeder-assets/' . Str::slug($shirtData['name']) . '-thumb.' . $extension;
            
            if (file_exists($thumbPath)) {
                Storage::disk('public')->putFileAs(
                    dirname($filename),
                    $thumbPath,
                    basename($filename)
                );
                $shirtData['thumbnail'] = $filename;
            }
            
            unset($shirtData['photos'], $shirtData['sizes']);
            $shirt = Shirt::create($shirtData);

            // Handle multiple photos
            foreach ($photos as $index => $photoPath) {
                if (file_exists($photoPath)) {
                    $extension = pathinfo($photoPath, PATHINFO_EXTENSION);
                    $filename = 'seeder-assets/' . Str::slug($shirt->name) . '-' . ($index + 1) . '.' . $extension;
                    
                    Storage::disk('public')->putFileAs(
                        dirname($filename),
                        $photoPath,
                        basename($filename)
                    );
                    
                    ShirtPhoto::create([
                        'shirt_id' => $shirt->id,
                        'photo' => $filename
                    ]);
                }
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