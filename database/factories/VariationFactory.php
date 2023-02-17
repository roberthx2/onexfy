<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variation>
 */
class VariationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reference' => Str::random(10),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 0, 10000),
            'product_id' => \App\Models\Product::factory()
        ];
    }
}
