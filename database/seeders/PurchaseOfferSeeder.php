<?php

namespace Database\Seeders;

use App\Models\PurchaseOffer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PurchaseOffer::factory()->count(10)->create();
    }
}
