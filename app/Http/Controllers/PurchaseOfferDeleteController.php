<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOfferDeleteController extends Controller
{
    public function __invoke($id){
        return DB::transaction(function () use($id) {
            // =====================
            // 登録や更新などの複数の処理
            // =====================
            $delete_offer = PurchaseOffer::find($id);
            $delete_offer->purchase_targets()->detach();

            return $delete_offer->delete();
        });
    }
}
