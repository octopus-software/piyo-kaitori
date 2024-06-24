<?php

namespace App\Http\Controllers;

use App\Models\PurchaseTarget;
use Illuminate\Http\Request;

class PurchaseTargetGetEditController extends Controller
{
    public function __invoke($id){
        $purchase_target = PurchaseTarget::where('id',$id)
        ->get();

        return $purchase_target;
    }
}
