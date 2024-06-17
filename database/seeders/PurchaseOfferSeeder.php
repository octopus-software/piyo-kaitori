<?php

namespace Database\Seeders;

use App\Models\PurchaseOffer;
use App\Models\PurchaseTarget;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $offers = PurchaseOffer::factory()->count(10)->create();

        // foreach( $offers as $offer){
        //     $offer->purchase_targets()->attach(User::factory()->create()['id']);
        //     $offer->purchase_targets()->saveMany(PurchaseTarget::factory()->count(5)->create());
        // }
    }
}
