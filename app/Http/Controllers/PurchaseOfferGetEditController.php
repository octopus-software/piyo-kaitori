<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOffer;
use Illuminate\Http\Request;

class PurchaseOfferGetEditController extends Controller
{
    public function __invoke($id){
        $purchase_offer = PurchaseOffer::where('id',$id)
        // return $purchase_offer;
        ->with(['purchase_targets'])
        ->get()
        ->map(function($offer){
            return [
                'id' => $offer['id'],
                'user_id' => $offer['user_id'],
                'status' => $offer['status'],
                'created_at' => $offer['created_at'],
                'purchase_targets' => $offer['purchase_targets']->map(function($target) {
                    return [
                        'purchase_target_id' => $target['pivot']['purchase_target_id'],
                        'target_name' => $target['name'],
                        'price' => $target['pivot']['price'],
                        'amount' => $target['pivot']['amount'],
                        'evidence_url' => $target['pivot']['evidence_url']
                    ];
                })
            ]; 
        });

        return $purchase_offer;
    }
}
