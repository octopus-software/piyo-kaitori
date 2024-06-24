<?php

namespace App\Http\Controllers\Web\PurchaseTarget;

use App\Http\Controllers\Controller;
use App\Models\PurchaseTarget;

class PurchaseTargetGetEditController extends Controller
{
    public function __invoke($id){
        $purchase_target = PurchaseTarget::where('id',$id)
        ->get();

        return $purchase_target;
    }
}
