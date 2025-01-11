<?php

namespace App\Http\Controllers\Web\PurchaseOffer\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseOffer\Client\PurchaseOfferUpdateStatusClientRequest;
use App\Models\PurchaseOffer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class PurchaseOfferUpdateStatusClientController extends Controller
{
    public function __invoke(PurchaseOfferUpdateStatusClientRequest $request, int $id): RedirectResponse
    {
        $purchase_offer = PurchaseOffer::query()->find($request['id']);
        // 差し戻しの場合、shipped_dateをnullにする
        if ((int)$request['status'] === PurchaseOffer::STATUS['approved']) $request['shipped_date'] = null;
        $purchase_offer->update([
            'status' => $request['status'],
            'shipped_date' => $request['shipped_date'] ?? null,
        ]);
        return Redirect::route('client.purchase_offer.list');
    }
}
