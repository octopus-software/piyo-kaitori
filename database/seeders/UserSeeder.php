<?php

namespace Database\Seeders;

use App\Models\PurchaseOffer;
use App\Models\PurchaseTarget;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory()->count(30)->create();
        $purchase_targets = PurchaseTarget::factory()->count(20)->create();

        foreach( $users as $user){
            $offers = PurchaseOffer::factory()->count(3)->state(function(array $attributes) use($user){
                return [
                    'user_id' => $user['id']
                ];
            })->create();
            foreach($offers as $offer){
                $rand = rand(1,5);
                for ($i = 0 ; $i < $rand ; $i++){
                    $purchase_target = $purchase_targets[rand(0,$purchase_targets->count()-1)];
                    $offer->purchase_targets()
                        ->attach($purchase_target['id'],[
                            'price' => fake()->randomElement([5000,10000,15000,20000,25000,30000,35000,40000,45000,50000]),
                            'quantity' => rand(1,10),
                            'evidence_url' => fake()->url()
                        ]);
                }
            }
        }
    }
}
