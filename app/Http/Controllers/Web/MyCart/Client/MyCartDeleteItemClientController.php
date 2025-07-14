<?php

namespace App\Http\Controllers\Web\MyCart\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MyCartDeleteItemClientController extends Controller
{
    public function __invoke(Request $request, int $id): RedirectResponse
    {
        // 対象となるキーの商品を削除する
        $request->session()->forget('cart.' . $id);
        return Redirect::route('client.my_cart.list');
    }
}
