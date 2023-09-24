<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoryFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    //   protected $model = Catogory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        return [ 
        // 'parent_id'=>fake()-,
        'name' => fake()->country() ,
        'slug' => fake()->slug(),
        'description' => fake()->sentence(),
        'image' => fake()->imageUrl() ,
        'status'=> 'active'
    ];
    }
}
