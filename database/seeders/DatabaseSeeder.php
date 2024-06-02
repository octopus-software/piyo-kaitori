<?php

namespace Database\Seeders;

use Database\Seeders\Dummy\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // シーダーを呼び出す
        $this->call([
            // Dummy\UserSeeder::class,
            UserSeeder::class,
        ]);
    }
}
