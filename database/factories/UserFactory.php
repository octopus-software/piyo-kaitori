<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */

class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     public function definition(): array
     {
         $faker = FakerFactory::create('ja_JP'); // 日本語のロケールを指定

         return [
             'name' => $faker->name(),
             'email' => $faker->unique()->safeEmail(),
             'email_verified_at' => now(),
             'password' => static::$password ??= Hash::make('password'),
             'remember_token' => Str::random(10),
             'is_active' => true,
             'role' => $faker->numberBetween(1, 2), // 1: admin, 2: client
             'name_kana' => $faker->kanaName(),
             'birthday' => $faker->date(),
             'gender' => $faker->numberBetween(1, 3),
             'post_code' => $faker->postcode1().'-'.$faker->postcode2(),
             'address' => $faker->prefecture().$faker->city().$faker->streetAddress().$faker->secondaryAddress(),
             'tel' => $faker->phoneNumber(),
             'job' => $faker->jobTitle(),
             'bank_name' => $faker->randomElement(['みずほ銀行','三菱ＵＦＪ銀行','三井住友銀行','りそな銀行','埼玉りそな銀行','ゆうちょ銀行']),
             'bank_branch_name' => $faker->city(),
             'bank_branch_code' => $faker->randomNumber(3),
             'bank_account_type' => $faker->randomElement(['普通', '当座', '定期']),
             'bank_account_number' => $faker->randomNumber(7),
             'bank_account_name_kana' => $faker->kanaName(),
             'is_qualified_supplier' => true,
             'invoice_number' => $faker->numberBetween(1000000000000, 9999999999999),
         ];
     }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
