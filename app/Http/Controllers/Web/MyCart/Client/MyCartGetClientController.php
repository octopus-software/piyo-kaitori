<?php

namespace App\Http\Controllers\Web\MyCart\Client;

use App\Helper\FormatHelper;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class MyCartGetClientController extends Controller
{
    public function __invoke()
    {
        $cart = session()->get('cart', []);
        $all_total_price = 0;
        foreach ($cart as $key => $value) {
            $all_total_price += $value['price'] * $value['quantity'];
            $cart[$key]['price'] =  FormatHelper::formatYen($value['price']);
            $cart[$key]['total_price'] = FormatHelper::formatYen($value['price'] * $value['quantity']);
        }
        return Inertia::render('MyCart/Client/Index', [
            'cart' => $cart,
            'total_price' => FormatHelper::formatYen($all_total_price),
        ]);
    }
}
