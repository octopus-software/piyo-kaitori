<?php

namespace App\Http\Controllers\Web\PurchaseOffer;

use App\Helper\FormatHelper;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOffer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Inertia\Inertia;

class PurchaseOfferGetEditController extends Controller
{
    public function __invoke($id)
    {
        $purchase_offer = $this->transformPurchaseOffer(PurchaseOffer::query()->with(['purchase_targets'])->find($id));
        return Inertia::render('PurchaseOffer/Admin/Edit', [
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
            'id' => $purchase_offer['id'],
            'user_id' => $purchase_offer['user_id'],
            'user_name' => $purchase_offer['user']['name'],
            'status' => $purchase_offer['status'],
            'offer_date' => (new Carbon($purchase_offer['created_at']))->format('Y-m-d'),
            'send_date' => $purchase_offer['send_date'],
            'total_price' => FormatHelper::formatYen($purchase_offer['purchase_targets']->sum(fn ($target) => $target['pivot']['price'] * $target['pivot']['amount'])),
            'purchase_targets' => $purchase_offer['purchase_targets']->map(function ($target) {
                return [
                    'id' => $target['pivot']['purchase_target_id'],
                    'name' => $target['name'],
                    'jan_code' => $target['jan_code'],
                    'price' => FormatHelper::formatYen($target['pivot']['price']),
                    'amount' => $target['pivot']['amount'] . '点',
                    'total_price' => FormatHelper::formatYen($target['pivot']['price'] * $target['pivot']['amount']),
                    'evidence_url' => $target['pivot']['evidence_url']
                ];
            })->toArray()
        ];
    }
}
