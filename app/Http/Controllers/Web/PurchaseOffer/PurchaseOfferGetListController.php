<?php

namespace App\Http\Controllers\Web\PurchaseOffer;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOffer;

class PurchaseOfferGetListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(){
        return PurchaseOffer::with(['user','purchase_targets'])
        ->get()->map(function($offer){
            return [
                'user_id' => $offer['user_id'],
                'user_name' => $offer['user']['name'],
                'status' => $offer['status'],
                'detail' => $offer['purchase_targets']->map(function($target) {
                    return [
                        'target_id' => $target['pivot']['purchase_target_id'],
                        'target_name' => $target['name'],
                        'price' => $target['pivot']['price'],
                        'amount' => $target['pivot']['amount'],
                        'evidence_url' => $target['pivot']['evidence_url']
                    ];
                })
            ];
        });

        // $responce = [];
        // foreach ( $purchase_offers as $offer ){
        //     $array_offer = [
        //         'user_id' => $offer['user_id'],
        //         'user_name' => $offer['user']['name'],
        //         'status' => $offer['status'],
        //     ];
        //     $detail = [];
        //     foreach ( $offer['purchase_targets'] as $target){
        //         $detail[] = [
        //             'target_id' => $target['pivot']['purchase_target_id'],
        //             'target_name' => $target['name'],
        //             'price' => $target['pivot']['price'],
        //             'amount' => $target['pivot']['amount'],
        //             'evidence_url' => $target['pivot']['evidence_url']
        //         ];
        //     }
        //     $array_offer['detail'] = $detail;
        //     $responce[] = $array_offer;
        // }

        // return $responce;
    }
}
