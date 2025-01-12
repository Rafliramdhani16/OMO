<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Shirt;
use App\Models\Category;
use App\Models\PromoCode;
use App\Models\ShirtSize;
use App\Models\ShirtPhoto;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
