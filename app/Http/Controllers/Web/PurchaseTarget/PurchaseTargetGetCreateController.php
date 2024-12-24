<?php

namespace App\Http\Controllers\Web\PurchaseTarget;

use Inertia\Inertia;

class PurchaseTargetGetCreateController
{
    public function __invoke()
    {
        return Inertia::render('PurchaseTarget/Create');
    }
}
