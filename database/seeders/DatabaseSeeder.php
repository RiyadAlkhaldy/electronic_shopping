<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->call([CategorySeeder::class]);
        // Catogory::factory()->count(3) ;
        // new
        \App\Models\User::factory(5)->create();
        Store::factory(5)->create();
        Category::factory(10)->create();
        Product::factory(100)->create();
        //new
        Admin::factory(3)->create();

    }
}
