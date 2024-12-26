<?php

namespace App\Http\Controllers\Web\PurchaseTarget\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOffer;
use App\Models\PurchaseTarget;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PurchaseTargetGetListAdminController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        $paginator = PurchaseTarget::query()
            ->when(isset($request['name']), function ($query) use ($request) {
                return $query->where('name', 'LIKE', '%' . $request["name"] . '%');
            })
            ->when(isset($request['jan_code']), function ($query) use ($request) {
                return $query->where('jan_code', $request['jan_code']);
            })
            ->when(isset($request['is_active']), function ($query) use ($request) {
                return $query->where('is_active', (int)$request['is_active']);
            })
            ->with(['purchase_offers' => function ($query) {
            $query->where('status', PurchaseOffer::STATUS['unapproved']);
        }, 'purchase_offers.user'])
            ->orderByDesc('created_at')
            ->skip(((int)$request['page'] - 1) * 5 ?? 0)
            ->paginate(5);
        $purchase_targets = $paginator->getCollection()->map(function ($target) {
            return [
                'id' => $target['id'],
                'name' => $target['name'],
                'jan_code' => $target['jan_code'],
                'image_url' => $target['image_url'],
                'is_active' => $target['is_active'],
                'max_quantity' => $target['max_quantity'],
                'current_quantity' => $target['purchase_offers']->sum('pivot.quantity'),
                'purchase_offers' => $target['purchase_offers']->map(function ($offer) {
                    return [
                        'purchase_offer_id' => $offer['id'],
                        'user_id' => $offer['user_id'],
                        'user_name' => $offer['user']['name'],
                        'price' => $offer['pivot']['price'],
                        'quantity' => $offer['pivot']['quantity'],
                    ];
                })
            ];
        });
        return Inertia::render('PurchaseTarget/Admin/List', [
            'purchase_targets' => $purchase_targets,
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'params' => [
                'name' => $request['name'] ?? '',
                'jan_code' => $request['jan_code'] ?? '',
                'is_active' => $request['is_active'] ?? '',
            ]
        ]);
    }
}
