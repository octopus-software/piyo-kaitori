<?php

namespace App\Http\Controllers\Web\PurchaseOffer\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseOffer\Admin\PurchaseOfferUpdateStatusAdminRequest;
use App\Models\PurchaseOffer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class PurchaseOfferUpdateStatusClientController extends Controller
{
    public function __invoke(PurchaseOfferUpdateStatusAdminRequest $request, int $id): RedirectResponse
    {
        $purchase_offer = PurchaseOffer::query()->find($request['id']);
        $purchase_offer->update([
            'status' => $request['status']
        ]);
        return Redirect::route('admin.purchase_offer.edit', ['id' => $purchase_offer['id']]);
    }
}
