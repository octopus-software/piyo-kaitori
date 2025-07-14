<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseTargetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->domainWord() . '-' . fake()->word(),
            'jan_code' => fake()->unique()->ean13(),
            'image_url' => "",
            'max_quantity' => fake()->randomDigit(),
            'is_active' => fake()->numberBetween($min = 0, $max = 1)
        ];
    }
}
