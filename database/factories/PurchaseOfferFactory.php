<?php

namespace Database\Factories;

use App\Models\PurchaseTarget;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseOffer>
 */
class PurchaseOfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            //'purchase_target_id' => PurchaseTarget::factory(),
            // 'price' => fake()->randomElement($array = array (10000,15000,20000,25000,30000,35000,40000,45000,5000)),
            // 'quantity' => fake()->randomDigit(),
            // 'evidence_url' => fake()->url(),
            'status' => fake()->numberBetween($min = 1, $max = 4)
        ];
    }
}
