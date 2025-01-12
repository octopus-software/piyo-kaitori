<?php

namespace App\Http\Controllers\Web\PurchaseOffer\Client;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOffer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PurchaseOfferDeleteClientController extends Controller
{
    public function __invoke(int $id): RedirectResponse
    {
        $delete_offer = PurchaseOffer::query()->find($id);
        // 未承認オファーでは無いなら削除不可
        if ($delete_offer['status'] !== PurchaseOffer::STATUS['unapproved']) abort(400, '未承認のオファーのみ削除可能です');
        DB::transaction(function () use ($delete_offer) {
            $delete_offer->purchase_targets()->detach();
            $delete_offer->delete();
        });
        return Redirect::route('client.purchase_offer.list');
    }
}
