<?php

namespace App\Http\Controllers;

use App\Http\Requests\PutPurchaseTargetRequest;
use App\Models\PurchaseTarget;

class PutPurchaseTargetController extends Controller
{
    public function __invoke(PutPurchaseTargetRequest $request){
        $purchase_target = PurchaseTarget::find($request->id);
        // return $purchase_target;
        $purchase_target->update([
            'name'=> $request -> name,
            'jan_code' => $request -> jan_code ,
            'image_url' => $request -> image_url,
            'amount' => $request -> amount
        ]);
        
        return $purchase_target;
        // return redirect('/purchase_targets');
    }
}
