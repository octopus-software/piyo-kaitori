<?php

namespace App\Http\Controllers\Web\PurchaseOffer\Client;

use App\Helper\FormatHelper;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOffer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Inertia\Inertia;

class PurchaseOfferGetEditClientController extends Controller
{
    public function __invoke($id)
    {
        $purchase_offer = $this->transformPurchaseOffer(PurchaseOffer::query()->with(['purchase_targets'])->find($id));
        return Inertia::render('PurchaseOffer/Client/Edit', [
            'purchase_offer' => $purchase_offer
        ]);
    }

    /**
     * @param PurchaseOffer $purchase_offer
     * @return array
     */
    private function transformPurchaseOffer(Model $purchase_offer): array
    {
        return [
            'id'           => $purchase_offer['id'],
            'user_id'      => $purchase_offer['user_id'],
            'user_name'    => $purchase_offer['user']['name'],
            'status'       => $purchase_offer['status'],
            'offer_date'   => (new Carbon($purchase_offer['created_at']))->format('Y-m-d'),
            'shipped_date' => $purchase_offer['shipped_date'],
            'total_price'  => FormatHelper::formatYen($purchase_offer['purchase_targets']->sum(fn ($target) => $target['pivot']['price'] * $target['pivot']['quantity'])),
            'remark'       => $purchase_offer['remark'],
            'purchase_targets' => $purchase_offer['purchase_targets']->map(function ($target) {
                return [
                    'id'           => $target['pivot']['purchase_target_id'],
                    'name'         => $target['name'],
                    'jan_code'     => $target['jan_code'],
                    'price'        => FormatHelper::formatYen($target['pivot']['price']),
                    'quantity'     => $target['pivot']['quantity'] . '点',
                    'total_price'  => FormatHelper::formatYen($target['pivot']['price'] * $target['pivot']['quantity']),
                    'remarks' => $target['pivot']['remarks']
                ];
            })->toArray()
        ];
    }
}
