<?php

namespace App\Http\Controllers\Web\PurchaseOffer\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOffer;
use Illuminate\Support\Facades\DB;

class PurchaseOfferDeleteAdminController extends Controller
{
    public function __invoke(int $id)
    {
        return DB::transaction(function () use ($id) {
            $delete_offer = PurchaseOffer::query()->find($id);
            $delete_offer->purchase_targets()->detach();
            return $delete_offer->delete();
        });
    }
}
