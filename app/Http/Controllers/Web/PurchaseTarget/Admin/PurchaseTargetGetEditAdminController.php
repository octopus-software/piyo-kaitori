<?php

namespace App\Http\Controllers\Web\PurchaseTarget\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseTarget;
use Inertia\Inertia;

class PurchaseTargetGetEditAdminController extends Controller
{
    public function __invoke($id)
    {
        $purchase_target = PurchaseTarget::query()->where('id', $id)->first();
        return Inertia::render('PurchaseTarget/Admin/Edit', [
            'purchase_target' => $purchase_target
        ]);
    }
}
