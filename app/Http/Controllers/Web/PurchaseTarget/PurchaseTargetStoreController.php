<?php

namespace App\Http\Controllers\Web\PurchaseTarget;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostPurchaseTargetRequest;
use App\Models\PurchaseTarget;

class PurchaseTargetStoreController extends Controller
{
    public function __invoke(PostPurchaseTargetRequest $request){

        PurchaseTarget::create([
            'name'=> $request -> name,
            'jan_code' => $request -> jan_code ,
            'image_url' => $request -> image_url,
            'amount' => $request -> amount
        ]);

        return $request->input();
    }
}
