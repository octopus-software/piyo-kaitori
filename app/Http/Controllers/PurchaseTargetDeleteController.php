<?php

namespace App\Http\Controllers;

use App\Models\PurchaseTarget;

class PurchaseTargetDeleteController extends Controller
{
    public function __invoke($id){
        return PurchaseTarget::find($id)->delete();
    }
}
