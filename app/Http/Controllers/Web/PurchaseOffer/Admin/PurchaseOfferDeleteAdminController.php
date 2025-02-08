<?php

namespace App\Http\Controllers\Web\PurchaseOffer\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOffer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PurchaseOfferDeleteAdminController extends Controller
{
    public function __invoke(int $id): RedirectResponse
    {
        $delete_offer = PurchaseOffer::query()->find($id);
        DB::transaction(function () use ($delete_offer) {
            $delete_offer->purchase_targets()->detach();
            $delete_offer->delete();
        });
        return Redirect::route('admin.purchase_offer.list');
    }
}
