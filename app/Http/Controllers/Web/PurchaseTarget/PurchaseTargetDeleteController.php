<?php

namespace App\Http\Controllers\Web\PurchaseTarget;

use App\Http\Controllers\Controller;
use App\Models\PurchaseTarget;

class PurchaseTargetDeleteController extends Controller
{
    public function __invoke($id){
        return PurchaseTarget::find($id)->delete();
    }
}
