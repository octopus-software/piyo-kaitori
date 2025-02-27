<?php

namespace App\Http\Controllers\Web\PurchaseOffer\Client;

use App\Helper\FormatHelper;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOffer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PurchaseOfferGetListClientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user_id = auth()->id();//sessionからuser_idを取得
        $paginator = PurchaseOffer::query()->with(['user', 'purchase_targets'])
            ->when(isset($request['user_name']), function ($query) use ($request) {
                $query->whereHas('user', function ($relation_query) use ($request) {
                    $relation_query->where('name', 'LIKE', '%' . $request["user_name"] . '%');
                });
            })
            ->when(isset($request['jan_code']), function ($query) use ($request) {
                $query->whereHas('purchase_targets', function ($relation_query) use ($request) {
                    $relation_query->where('jan_code', '=', $request["jan_code"]);
                });
            })
            ->when(isset($request['status']), function ($query) use ($request) {
                $query->where('status', '=', $request["status"]);
            })
            ->where('user_id',$user_id)
            ->orderByDesc('created_at')
            ->skip(((int)$request['page'] - 1) * 10 ?? 0)
            ->paginate(10);
        $purchase_offers = $paginator->getCollection()->map(function ($offer) {
                return [
                    'id' => $offer['id'],
                    'user_id' => $offer['user_id'],
                    'user_name' => $offer['user']['name'],
                    'status' => $offer['status'],
                    'shipped_date' => $offer['shipped_date'] ? (new Carbon($offer['shipped_date']))->format('Y年m月d日') : null,
                    'summary' => implode(', ', $offer['purchase_targets']->map(function ($target) {
                        return substr($target['name'], 0, 20) . '×' . $target['pivot']['quantity'];
                    })->toArray()),
                    'total_price' => FormatHelper::formatYen($offer['purchase_targets']->sum(function ($target) {
                        return $target['pivot']['price'] * $target['pivot']['quantity'];
                    })),
                    'offer_date' => (new Carbon($offer['created_at']))->format('Y年m月d日'),
                    'detail' => $offer['purchase_targets']->map(function ($target) {
                        return [
                            'target_id' => $target['pivot']['purchase_target_id'],
                            'target_name' => $target['name'],
                            'price' => $target['pivot']['price'],
                            'quantity' => $target['pivot']['quantity'],
                            'remarks' => $target['pivot']['remarks']
                        ];
                    })
                ];
            });
        return Inertia::render('PurchaseOffer/Client/List', [
            'purchase_offers' => $purchase_offers,
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'params' => [
                'user_name' => $request['user_name'] ?? '',
                'jan_code' => $request['jan_code'] ?? '',
                'status' => $request['status'] ?? '',
            ]
        ]);
    }
}
