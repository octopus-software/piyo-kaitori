<?php

namespace App\Http\Controllers\Web\PurchaseTarget;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOffer;
use App\Models\PurchaseTarget;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PurchaseTargetGetListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        $paginator = PurchaseTarget::with(['purchase_offers' => function ($query) {
            $query->where('status', PurchaseOffer::STATUS['unapproved']);
        }, 'purchase_offers.user'])
            ->skip(((int)$request['page'] - 1) * 5 ?? 0)
            ->paginate(5);
        $purchase_targets = $paginator->getCollection()->map(function ($target) {
            return [
                'id' => $target['id'],
                'name' => $target['name'],
                'jan_code' => $target['jan_code'],
                'image_url' => $target['image_url'],
                'is_active' => $target['is_active'],
                'max_amount' => $target['amount'],
                'current_amount' => $target['purchase_offers']->sum('pivot.amount'),
                'purchase_offers' => $target['purchase_offers']->map(function ($offer) {
                    return [
                        'purchase_offer_id' => $offer['id'],
                        'user_id' => $offer['user_id'],
                        'user_name' => $offer['user']['name'],
                        'price' => $offer['pivot']['price'],
                        'amount' => $offer['pivot']['amount'],
                    ];
                })
            ];
        });
        return Inertia::render('PurchaseTarget/PurchaseTargetList', [
            'purchase_targets' => $purchase_targets,
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'params' => [
//                'name' => $request['name'] ?? '',
//                'email' => $request['email'] ?? '',
            ]
        ]);
    }
}
