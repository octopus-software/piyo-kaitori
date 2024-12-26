<?php

namespace App\Http\Controllers\Web\Cart;

use App\Http\Controllers\Controller;

class CartGetListController extends Controller
{
    public function __invoke()
    {
        $cart = session()->get('cart', []);
        return $cart;
    }
}
