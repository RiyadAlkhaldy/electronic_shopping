<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $name = $this->faker->words(5,true);
        return [ 
        // 'parent_id'=>fake()-,
        'name' =>  $name,
        'slug' =>  Str::slug($name),
        'description' => fake()->sentence(15),
        'image' => fake()->imageUrl ,
        'status'=> 'active'
    ];
    }
}
