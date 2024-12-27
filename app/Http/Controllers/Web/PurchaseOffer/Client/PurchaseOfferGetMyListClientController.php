<?php

namespace App\Http\Controllers\Web\PurchaseOffer\Client;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOffer;
use Illuminate\Http\Request;

class PurchaseOfferGetMyListClientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $my_list = PurchaseOffer::query()
        ->with('purchase_targets')
        ->where('user_id',$request['user_id'])
        ->orderByDesc('created_at')
        ->get()
        ->map(function($purchase_offer){
            return [
                "id" => $purchase_offer['id'],
                "offer_date" => $purchase_offer['created_at'],
                "send_date" => $purchase_offer['send_date'],
                "status" => $purchase_offer['status'],
                "purchase_targets" => $purchase_offer['purchase_targets']
                ->map(function($purchase_target){
                    return [
                        "id" => $purchase_target['id'],
                        "name" => $purchase_target['name'],
                        "jan_code" => $purchase_target['jan_code'],
                        "image_url" => $purchase_target['image_url'],
                        "quantity" => $purchase_target['pivot']['quantity'],
                        "price" => $purchase_target['pivot']['price'],
                        "max_quantity" => $purchase_target['max_quantity'],
                        'is_active' => $purchase_target['is_active']
                    ];
                }),
            ];
        });

        return $my_list;
    }
}
