<?php

namespace App\Http\Controllers\Web\PurchaseOffer;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseOfferUpdateStatusRequest;
use App\Models\PurchaseOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOfferUpdateStatusController extends Controller
{
    public function __invoke(PurchaseOfferUpdateStatusRequest $request, int $id){
        $purchase_offer = PurchaseOffer::query()->find($request['id']);
        $purchase_offer->update([
            'status' => $request['status']
        ]);
        return [
            'id' => $purchase_offer['id']
        ];
    }
}
