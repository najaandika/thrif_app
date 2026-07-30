<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DemoThriftProductSeeder extends Seeder
{
    public function run(): void
    {
        $owner = User::query()->where('role', User::ROLE_ADMIN)->first()
            ?? User::query()->firstOrCreate(
                ['email' => 'demo-admin@thrif.test'],
                [
                    'name' => 'Demo Admin',
                    'password' => Hash::make('password'),
                    'role' => User::ROLE_ADMIN,
                ]
            );

        $categories = ['T-Shirt', 'Flannel', 'Hoodie', 'Jacket', 'Long Sleeve', 'Crewneck', 'Pants', 'Jersey'];

        foreach ($categories as $category) {
            Category::query()->firstOrCreate(['name' => $category]);
        }

        $images = collect(Storage::disk('public')->files('products'))
            ->reject(fn (string $path) => str_starts_with($path, 'products/demo/'))
            ->filter(fn (string $path) => preg_match('/\.(jpe?g|png|webp)$/i', $path))
            ->unique()
            ->values();

        $products = [
            ['Vintage Navy Crewneck', 'Crewneck navy dengan bahan tebal, cocok untuk daily wear. Minor sign pemakaian normal.', 185000, 'good', 'Crewneck', 'L', 10],
            ['Washed Black Hoodie', 'Hoodie hitam crop dengan warna washed natural. Cutting santai dan mudah dipadukan.', 165000, 'good', 'Hoodie', 'M', null],
            ['Plaid Flannel Shirt Green', 'Flannel motif kotak warna hijau dengan bahan lembut. Kondisi masih layak pakai.', 125000, 'like-new', 'Flannel', 'L', null],
            ['American Eagle Flannel', 'Kemeja flannel American Eagle, warna earthy dan cocok untuk layered outfit.', 147500, 'good', 'Flannel', 'L', 15],
            ['Adidas Track Jacket Black Pink', 'Track jacket Adidas warna black-pink, detail logo masih jelas dan zipper aman.', 185000, 'good', 'Jacket', 'M', 20],
            ['Adidas Red Half-Zip Jacket', 'Jacket half-zip merah Adidas dengan bahan ringan. Statement piece untuk sporty look.', 210000, 'good', 'Jacket', 'L', null],
            ['Tommy Hilfiger Long Sleeve', 'Long sleeve Tommy Hilfiger warna navy, kondisi kain masih nyaman dipakai.', 200000, 'like-new', 'Long Sleeve', 'L', 10],
            ['Mark Gonzales Angel Tee', 'T-shirt Mark Gonzales dengan graphic kecil di dada. Cutting regular fit.', 135000, 'good', 'T-Shirt', 'M', null],
            ['Carhartt Work Jacket Brown', 'Work jacket warna brown dengan feel utilitarian. Ada faded natural khas thrift.', 245000, 'fair', 'Jacket', 'L', null],
            ['Nike Vintage Windbreaker', 'Windbreaker Nike ringan dengan detail sporty. Cocok untuk outer harian.', 225000, 'good', 'Jacket', 'M', 12],
            ['Stussy Basic Logo Tee', 'T-shirt basic logo dengan warna netral. Kondisi print masih cukup bagus.', 155000, 'good', 'T-Shirt', 'M', null],
            ['Champion Reverse Weave Crewneck', 'Crewneck Champion bahan tebal dengan rib masih aman. Fit oversized.', 235000, 'like-new', 'Crewneck', 'XL', 18],
            ['Uniqlo Wide Chino Pants', 'Celana chino wide fit warna khaki. Bahan adem dan clean untuk outfit harian.', 145000, 'good', 'Pants', '32', null],
            ['Levis 501 Washed Denim', 'Denim Levi\'s 501 wash biru dengan fade natural. Struktur celana masih bagus.', 250000, 'fair', 'Pants', '31', null],
            ['Ralph Lauren Striped Shirt', 'Shirt stripe Ralph Lauren, cocok untuk smart casual dan layering.', 175000, 'good', 'Long Sleeve', 'L', 10],
            ['Vintage Football Jersey', 'Jersey vintage dengan warna kuat dan bahan ringan. Cocok untuk casual sporty.', 160000, 'good', 'Jersey', 'M', null],
            ['Polo Sport Navy Jacket', 'Jacket navy Polo Sport dengan detail sederhana. Kondisi zipper aman.', 220000, 'good', 'Jacket', 'L', 15],
            ['Gap Essential Hoodie Grey', 'Hoodie Gap abu-abu dengan fleece lembut. Warna netral dan mudah dipakai.', 180000, 'like-new', 'Hoodie', 'L', null],
            ['Dickies Work Pants Black', 'Work pants Dickies warna hitam, cutting straight dan bahan kokoh.', 190000, 'good', 'Pants', '33', null],
            ['Vintage Striped Rugby Shirt', 'Rugby shirt stripe dengan bahan tebal. Detail collar masih rapi.', 170000, 'good', 'Long Sleeve', 'L', 12],
            ['Harley Davidson Graphic Tee', 'Graphic tee Harley Davidson dengan print depan-belakang. Ada fade natural.', 195000, 'fair', 'T-Shirt', 'XL', null],
            ['Columbia Outdoor Fleece', 'Fleece Columbia ringan dan hangat. Cocok untuk outer outdoor casual.', 205000, 'good', 'Jacket', 'M', 15],
            ['Minimal Black Crewneck', 'Crewneck hitam polos dengan cutting clean. Aman untuk basic wardrobe.', 130000, 'good', 'Crewneck', 'M', null],
            ['Oversized Cream Hoodie', 'Hoodie cream oversized dengan warna soft. Kondisi bersih dan siap pakai.', 175000, 'like-new', 'Hoodie', 'XL', 10],
        ];

        foreach ($products as $index => [$name, $description, $price, $condition, $category, $size, $discount]) {
            Product::query()->updateOrCreate(
                ['name' => $name],
                [
                    'user_id' => $owner->id,
                    'description' => $description,
                    'price' => $price,
                    'discount_percentage' => $discount,
                    'discount_start' => $discount ? now()->subDay() : null,
                    'discount_end' => $discount ? now()->addDays(14) : null,
                    'condition' => $condition,
                    'category' => $category,
                    'size' => $size,
                    'image' => $images->isNotEmpty() ? $images[$index % $images->count()] : null,
                    'is_available' => true,
                    'updated_at' => now()->subMinutes($index),
                ]
            );
        }

        Cache::forget('landing_page_data');
    }
}
