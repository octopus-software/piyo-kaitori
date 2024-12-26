<?php

namespace App\Http\Controllers\Web\MyCart\Client;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class MyCartGetListClientController extends Controller
{
    public function __invoke()
    {
        $cart = session()->get('cart', []);
        return Inertia::render('MyCart/Client/List', [
            'cart' => $cart,
        ]);
    }
}
