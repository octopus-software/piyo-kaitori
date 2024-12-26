<?php

namespace App\Http\Controllers\Web\PurchaseTarget\Admin;

use Inertia\Inertia;

class PurchaseTargetGetCreateAdminController
{
    public function __invoke()
    {
        return Inertia::render('PurchaseTarget/Admin/Create');
    }
}
