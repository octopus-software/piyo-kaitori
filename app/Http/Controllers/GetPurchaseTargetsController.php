<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOffer;
use App\Models\PurchaseTarget;
use Illuminate\Http\Request;

class GetPurchaseTargetsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return PurchaseTarget::with(['purchase_offers' => function($query){
            $query -> where('status',PurchaseOffer::STATUS['unapproved']);
        },'purchase_offers.user'])
        ->get()
        ->map(function($target){
            return [
                'id' => $target['id'],
                'name' => $target['name'],
                'jan_code' => $target['jan_code'],
                'image_url' => $target['image_url'],
                'amount' => $target['amount'],
                'purchase_offers' => $target['purchase_offers']->map(function($offer){
                    return [
                        'purchase_offer_id' => $offer['id'],
                        'user_id' => $offer['user_id'],
                        'user_name' => $offer['user']['name'],
                        'price' => $offer['pivot']['price'],
                        'amount' => $offer['pivot']['amount'],
                    ];
                })
            ];
        });
    }
}
