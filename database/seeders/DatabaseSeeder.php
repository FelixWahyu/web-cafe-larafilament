<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat Kategori Dummy
        $kopi = Category::create(['name' => 'Kopi', 'slug' => 'kopi']);
        $nonKopi = Category::create(['name' => 'Non-Kopi', 'slug' => 'non-kopi']);
        $makanan = Category::create(['name' => 'Makanan', 'slug' => 'makanan']);
        $dessert = Category::create(['name' => 'Dessert', 'slug' => 'dessert']);

        // 2. Membuat Produk Dummy
        Product::create([
            'category_id' => $kopi->id,
            'name' => 'Kopi Susu Aren',
            'slug' => 'kopi-susu-aren',
            'price' => 18000,
            'description' => 'Kopi espresso dengan susu segar dan manisnya gula aren asli Purwokerto.',
            'ingredients' => 'Espresso, Susu Fresh Milk, Gula Aren Asli',
            'is_featured' => true, // Tampil di Homepage
        ]);

        Product::create([
            'category_id' => $kopi->id,
            'name' => 'Caramel Macchiato',
            'slug' => 'caramel-macchiato',
            'price' => 24000,
            'description' => 'Perpaduan espresso, vanilla, susu, dan sirup karamel yang lembut.',
            'ingredients' => 'Espresso, Vanilla Syrup, Susu, Caramel Sauce',
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $nonKopi->id,
            'name' => 'Matcha Latte Premium',
            'slug' => 'matcha-latte-premium',
            'price' => 22000,
            'description' => 'Bubuk matcha premium Jepang yang di-blend dengan susu segar pilihan.',
            'ingredients' => 'Premium Matcha Powder, Susu Fresh Milk',
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $makanan->id,
            'name' => 'Nasi Goreng Spesial Lav',
            'slug' => 'nasi-goreng-spesial-lav',
            'price' => 25000,
            'description' => 'Nasi goreng bumbu rempah rahasia dengan telur mata sapi dan ayam suwir.',
            'ingredients' => 'Nasi, Bumbu Rempah, Telur, Ayam',
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $dessert->id,
            'name' => 'Classic Croffle',
            'slug' => 'classic-croffle',
            'price' => 15000,
            'description' => 'Croissant waffle yang renyah di luar dan lembut di dalam.',
            'ingredients' => 'Adonan Croissant, Mentega, Gula',
            'is_featured' => true,
        ]);
    }
}