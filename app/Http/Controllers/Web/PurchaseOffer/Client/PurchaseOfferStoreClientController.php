<?php

namespace App\Http\Controllers\Web\PurchaseOffer\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseOffer\Client\PurchaseOfferStoreClientRequest;
use App\Models\PurchaseOffer;
use Illuminate\Support\Facades\DB;

class PurchaseOfferStoreClientController extends Controller
{
    public function __invoke(PurchaseOfferStoreClientRequest $request){
        return DB::transaction(function () use($request) {
            $created_offer = PurchaseOffer::create([
                'user_id' => auth()->id(),
                'status' => PurchaseOffer::STATUS['unapproved']
            ]);

            $data = $request->session()->get('cart');
            
            foreach ($data as $item){
                $created_offer->purchase_targets()->attach($item['purchase_target_id'],[
                    'purchase_offer_id' => $created_offer['id'],
                    'purchase_target_id' => $item['purchase_target_id'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'evidence_url' => $item['evidence_url']
                ]);
            }
            return $created_offer;
        });
    }
}
