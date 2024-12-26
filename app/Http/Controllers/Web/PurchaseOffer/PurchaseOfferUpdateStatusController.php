<?php

namespace App\Http\Controllers\Web\PurchaseOffer;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseOffer\PurchaseOfferUpdateStatusRequest;
use App\Models\PurchaseOffer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class PurchaseOfferUpdateStatusController extends Controller
{
    public function __invoke(PurchaseOfferUpdateStatusRequest $request, int $id): RedirectResponse
    {
        $purchase_offer = PurchaseOffer::query()->find($request['id']);
        $purchase_offer->update([
            'status' => $request['status']
        ]);
        return Redirect::route('purchase_offer.edit', ['id' => $purchase_offer['id']]);
    }
}
