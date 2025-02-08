<?php

namespace App\Http\Controllers\Web\PurchaseOffer\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseOffer\Client\PurchaseOfferUpdateStatusClientRequest;
use App\Mail\PurchaseOfferShippedMail;
use App\Models\PurchaseOffer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class PurchaseOfferUpdateStatusClientController extends Controller
{

    public function __invoke(PurchaseOfferUpdateStatusClientRequest $request, int $id)//: RedirectResponse
    {
        //purchase_offer_idを取得
        $purchase_offer_id = $request['id'];

        //purchase_offerを取得
        $purchase_offer = PurchaseOffer::query()
            ->with('purchase_targets')
            ->where('id',$request['id'])
            ->first();

        //purchase_targetを取得
        $purchase_targets = $purchase_offer['purchase_targets'];

        //差し戻しの場合、shipped_dateをnullにする
        if ((int)$request['status'] === PurchaseOffer::STATUS['approved']) $request['shipped_date'] = null;
        $purchase_offer->update([
            'status' => $request['status'],
            'shipped_date' => $request['shipped_date'] ?? null,
        ]);

        //メール送信
        Mail::to(config('mail')['from']['address'])->send(new PurchaseOfferShippedMail($purchase_offer_id,$purchase_targets));
        return Redirect::route('client.purchase_offer.list');
    }
}
