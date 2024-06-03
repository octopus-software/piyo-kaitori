<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class HomeController extends Controller
{
    public function __invoke(){
        $user = User::query()->find(auth()->user()["id"]);
        return view('home',['name' => $user["name"]]);
    }
}
