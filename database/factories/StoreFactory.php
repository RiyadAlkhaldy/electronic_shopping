<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(5,true);
        return [ 
        // 'parent_id'=>fake()-,
        'name' =>  $name,
        'slug' =>  Str::slug($name),
        'description' => fake()->sentence(15),
        'logo_image' => fake()->imageUrl(300,300) ,
        'cover_image' => fake()->imageUrl(800,600) ,
        'status'=> 'active'
    ];
    }
}
