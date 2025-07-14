<?php

namespace App\Http\Controllers\Web\PurchaseTarget\Client;

use App\Http\Controllers\Controller;
use App\Models\PurchaseTarget;
use Inertia\Inertia;

class PurchaseTargetGetShowClientController extends Controller
{
    public function __invoke($id)
    {
        $purchase_target = PurchaseTarget::query()->where('id', $id)->first();
        return Inertia::render('PurchaseTarget/Client/Show', [
            'purchase_target' => $purchase_target
        ]);
    }
}
