<?php

namespace App\Http\Controllers\Web\User\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id)
    {
        User::query()->where('id', $id)->update([
            'is_active' => $request['is_active'],
        ]);
        return redirect()->route('user.edit', ['id' => $id]);
    }
}
