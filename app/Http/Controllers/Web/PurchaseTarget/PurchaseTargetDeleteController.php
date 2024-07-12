<?php

namespace App\Http\Controllers\Web\PurchaseTarget;

use App\Http\Controllers\Controller;
use App\Models\PurchaseTarget;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class PurchaseTargetDeleteController extends Controller
{
    /**
     * @param $id
     * @return RedirectResponse
     */
    public function __invoke($id): RedirectResponse
    {
        PurchaseTarget::query()->find($id)->delete();
        return Redirect::route('purchase_target.list', [], 302, ['X-Inertia', true]);
    }
}
