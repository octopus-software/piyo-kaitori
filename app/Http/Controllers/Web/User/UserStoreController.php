<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestFormRequest;
use App\Models\User;

class UserStoreController extends Controller
{
    public function __invoke(TestFormRequest $request){
        // $input = $request->input();
        // dd($input);
        // return $input;
        User::create([
            "name" => $request -> name,
            "email" => $request -> email,
            "password" => $request -> password
        ]);

        return $request->input();
    }
};
