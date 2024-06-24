<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use http\Exception;
use Illuminate\Http\Request;

class UserUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // TODO: ユーザー情報の更新処理を実装する（返り値は更新後のデータ）
        return [
            'id' => $request['id'],
            'name' => $request['name'],
            'email' => $request['email'],
        ];
    }
}
