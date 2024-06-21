<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostPurchaseTargetRequest;
use App\Models\PurchaseTarget;
use Illuminate\Http\Request;

class PostPurchaseTargetController extends Controller
{
    public function __invoke(PostPurchaseTargetRequest $request){
        
        PurchaseTarget::create([
            'name'=> $request -> name,
            'jan_code' => $request -> jan_code ,
            'image_url' => $request -> image_url,
            'amount' => $request -> amount,
            'is_active' => $request -> is_active
        ]);

        return $request->input();
    }
}
