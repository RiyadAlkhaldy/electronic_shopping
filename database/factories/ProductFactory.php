<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(10,true);
        return [ 
        // 'parent_id'=>fake()-,
        'name' =>  $name,
        'slug' =>  Str::slug($name),
        'description' => fake()->sentence(15),
        'image' => $this->faker->imageUrl(600,600) ,
        'price' => $this->faker->randomFloat(2,1,500) ,
        'compare_price' => $this->faker->randomFloat(2,500,999) ,
        'quantity' => $this->faker->numberBetween(50,200),
        'category_id' => Category::inRandomOrder()->first()->id ,
        'store_id' => Store::inRandomOrder()->first()->id ,
        'featured'=> rand(0,1),
        'status'=> 'active'
    ];
    }
}
