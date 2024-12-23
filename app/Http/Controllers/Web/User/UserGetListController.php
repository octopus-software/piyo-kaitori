<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserGetListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        $paginator = User::query()->where('role', User::USER_ROLE['user'])
            ->when($request['name'], function ($query, $name) {
                return $query->where('name', 'LIKE', "%$name%");
            })
            ->when($request['email'], function ($query, $email) {
                return $query->where('email', 'LIKE', "%$email%");
            })
            ->with(['purchase_offers', 'purchase_offers.purchase_targets'])
            ->skip(((int)$request['page'] - 1) * 10 ?? 0)
            ->paginate(10);
        $users = $paginator->getCollection()->map(function ($user) {
            return [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'is_active' => $user['is_active'],
                'offers' => $user['purchase_offers']->map(function ($offer) {
                    return [
                        'id' => $offer['id'], // オファーID
                        'status' => $offer['status'],
                        'total_price' => $offer['purchase_targets']->sum('pivot.price'),
                        'total_amount' => $offer['purchase_targets']->sum('pivot.amount'),
                        'targets' => $offer['purchase_targets']->map(function ($target) {
                            return [
                                'id' => $target['id'],
                                'name' => $target['name'],
                                'price' => $target['pivot']['price'],
                                'amount' => $target['pivot']['amount']
                            ];
                        })
                    ];
                })
            ];
        });

        return Inertia::render('User/List', [
            'users' => $users,
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'params' => [
                'name' => $request['name'] ?? '',
                'email' => $request['email'] ?? '',
            ]
        ]);
    }
}
