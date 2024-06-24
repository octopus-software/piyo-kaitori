<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseOfferPostRequest;
use App\Models\PurchaseOffer;
use Illuminate\Support\Facades\DB;

class PurchaseOfferPostController extends Controller
{
    public function __invoke(PurchaseOfferPostRequest $request){
        return DB::transaction(function () use($request) {
            // =====================
            // 登録や更新などの複数の処理
            // =====================
            $created_offer = PurchaseOffer::create([
                'user_id' => 8,//←要修正！！！！！！！！！！！！！！！！！！
                'status' => PurchaseOffer::STATUS['unapproved']
            ]);
    
            $data = $request->toArray();
            foreach ($data as $item){
                $created_offer->purchase_targets()->attach($item['purchase_target_id'],[
                    'purchase_offer_id' => $created_offer['id'],
                    'purchase_target_id' => $item['purchase_target_id'],
                    'price' => $item['price'],
                    'amount' => $item['amount'],
                    'evidence_url' => $item['evidence_url']
                ]);
            }
            return $created_offer;
        });
    }
}
