<?php

namespace App\Http\Controllers\Web\PurchaseOffer;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOffer;
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
