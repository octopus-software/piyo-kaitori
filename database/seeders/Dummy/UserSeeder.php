<?php

namespace Database\Seeders\Dummy;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'Test User',
            'email' => 'test1@example.com',
            'password' => bcrypt('password'),
            'role' => User::USER_ROLE['admin'],
        ]);
    }
}
