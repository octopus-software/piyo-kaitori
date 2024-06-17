<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
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
