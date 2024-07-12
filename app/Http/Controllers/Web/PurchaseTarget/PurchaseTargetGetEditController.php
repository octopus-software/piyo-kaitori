<?php

namespace App\Http\Controllers\Web\PurchaseTarget;

use App\Http\Controllers\Controller;
use App\Models\PurchaseTarget;
use Inertia\Inertia;

class PurchaseTargetGetEditController extends Controller
{
    public function __invoke($id)
    {
        $purchase_target = PurchaseTarget::query()->where('id', $id)->first();
        return Inertia::render('PurchaseTarget/PurchaseTargetEdit', [
            'purchase_target' => $purchase_target
        ]);
    }
}
