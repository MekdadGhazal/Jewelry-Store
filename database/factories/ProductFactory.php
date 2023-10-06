<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'karat' => random_int(10,30),
            'category' => random_int(1,4),
            'closed_image' => fake()->imageUrl ,
            'far_image' => fake()->imageUrl,
            'price' => random_int(50,200),
        ];
    }
}
