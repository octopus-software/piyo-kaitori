<?php

namespace App\Http\Controllers\Web\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartStoreRequest;

class CartStoreController extends Controller
{
    public function __invoke(CartStoreRequest $request)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$request['purchase_target_id']])) {
            $cart[$request['purchase_target_id']]['quantity'] += $request['quantity'];
        } else {
            // 商品をカートに追加
            $cart[$request['purchase_target_id']] = [
                'name' => $request['name'],
                'price' => $request['price'],
                'quantity' => $request['quantity'],
            ];
        }
        session()->put('cart', $cart);
    }
}
