<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Eymen Optik',
                'shipping_free_threshold' => 3000,
                'shipping_cost' => 59.99,
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@eymenoptik.com'],
            [
                'name' => 'Eymen Optik Admin',
                'phone' => '05427639975',
                'password' => Hash::make('12345678'),
                'is_admin' => true,
            ]
        );

        $categoryNames = [
            'Güneş Gözlüğü',
            'Optik Çerçeve',
            'Polarize Gözlük',
            'Luxury Seri',
            'Spor Gözlük',
            'Çocuk Gözlük',
        ];

        foreach ($categoryNames as $categoryName) {
            Category::updateOrCreate(
                ['slug' => Str::slug($categoryName)],
                ['name' => $categoryName, 'is_active' => true]
            );
        }

        foreach (['Eymen', 'RayLux', 'VisionPro'] as $brandName) {
            Brand::updateOrCreate(
                ['slug' => Str::slug($brandName)],
                ['name' => $brandName, 'is_active' => true]
            );
        }

        $brand = Brand::first();
        $products = [
            [
                'name' => 'Eymen Milano Black',
                'category' => 'Güneş Gözlüğü',
                'brand' => 'Eymen',
                // 'type' removed
                'price' => 1649,
                'discount_price' => 1249,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=700&q=80',
                'short_description' => 'Siyah premium çerçeve, UV400 koruma ve günlük kullanıma uygun modern form.',
            ],
            [
                'name' => 'Eymen Classic Frame',
                'category' => 'Optik Çerçeve',
                'brand' => 'Eymen',
                // 'type' removed
                'price' => 1199,
                'discount_price' => 899,
                'stock' => 18,
                'image' => 'https://images.unsplash.com/photo-1574258495973-f010dfbb5371?auto=format&fit=crop&w=700&q=80',
                'short_description' => 'Hafif çerçeve yapısı ve sade çizgisiyle günlük kullanıma uygun optik model.',
            ],
            [
                'name' => 'Eymen Polar Vision',
                'category' => 'Polarize Gözlük',
                'brand' => 'RayLux',
                // 'type' removed
                'price' => 1899,
                'discount_price' => 1499,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=700&q=80',
                'short_description' => 'Polarize camlı, yansıma azaltan ve net görüş sunan günlük model.',
            ],
            [
                'name' => 'Eymen Gold Edition',
                'category' => 'Luxury Seri',
                'brand' => 'VisionPro',
                // 'type' removed
                'price' => 3199,
                'discount_price' => 2499,
                'stock' => 12,
                'image' => 'https://images.unsplash.com/photo-1556306535-38febf6782e7?auto=format&fit=crop&w=700&q=80',
                'short_description' => 'Gold detaylı özel seri, şık kutu sunumu ve premium tasarım hissi.',
            ],
            [
                'name' => 'Eymen Active Sport',
                'category' => 'Spor Gözlük',
                'brand' => 'RayLux',
                // 'type' removed
                'price' => 1999,
                'discount_price' => 1599,
                'stock' => 16,
                'image' => 'https://images.unsplash.com/photo-1509695507497-903c140c43b0?auto=format&fit=crop&w=700&q=80',
                'short_description' => 'Aktif kullanım için dayanıklı, konforlu ve hafif spor gözlük modeli.',
            ],
            [
                'name' => 'Eymen Mini Sun',
                'category' => 'Çocuk Gözlük',
                'brand' => 'VisionPro',
                // 'type' removed
                'price' => 799,
                'discount_price' => null,
                'stock' => 14,
                'image' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=700&q=80',
                'short_description' => 'Çocuk kullanıcılar için hafif, dayanıklı ve renkli günlük model.',
            ],
        ];

        foreach ($products as $product) {
            $category = Category::where('slug', Str::slug($product['category']))->first();

            Product::updateOrCreate(
                ['slug' => Str::slug($product['name'])],
                [
                    'category_id' => $category->id,
                    'brand_id' => Brand::where('slug', Str::slug($product['brand']))->value('id') ?? $brand?->id,
                    'name' => $product['name'],
                    'gender' => 'unisex',
                    'price' => $product['price'],
                    'discount_price' => $product['discount_price'],
                    'stock' => $product['stock'],
                    'image' => $product['image'],
                    'short_description' => $product['short_description'],
                    'is_active' => true,
                    'is_featured' => true,
                ]
            );
        }
    }
}
