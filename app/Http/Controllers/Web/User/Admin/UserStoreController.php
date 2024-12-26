<?php

namespace App\Http\Controllers\Web\User\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestFormRequest;
use App\Models\User;

class UserStoreController extends Controller
{
    public function __invoke(TestFormRequest $request){
        User::query()->create([
            "name" => $request['name'],
            "email" => $request['email'],
            "password" => $request['password']
        ]);
        return $request->input();
    }
};
