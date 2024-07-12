<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
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
            'name' => fake()->name(),
            'jan_code' => fake()->unique()->ean13(),
            'image_url' => "https://dummyimage.com/100x100/000/fff",
            'amount' => fake()->randomDigit(),
            'is_active' => fake()->numberBetween($min = 0, $max = 1)
        ];
    }
}
