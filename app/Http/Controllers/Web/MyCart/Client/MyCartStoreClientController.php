<?php

namespace App\Http\Controllers\Web\MyCart\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\MyCart\Client\MyCartStoreClientRequest;

class MyCartStoreClientController extends Controller
{
    public function __invoke(MyCartStoreClientRequest $request)
    {
        $cart = session()->get('cart', []);
        // 商品をカートに追加・更新
        if (isset($cart[$request['purchase_target_id']])) {
            $cart[$request['purchase_target_id']]['price'] = $request['price'];
            $cart[$request['purchase_target_id']]['quantity'] = $request['quantity'];
            $cart[$request['purchase_target_id']]['evidence_url'] = $request['evidence_url'];
        } else {
            $cart[$request['purchase_target_id']] = [
                'purchase_target_id' => $request['purchase_target_id'],
                'name' => $request['name'],
                'price' => $request['price'],
                'quantity' => $request['quantity'],
                'evidence_url' => $request['evidence_url'],
            ];
        }
        session()->put('cart', $cart);
    }
}
