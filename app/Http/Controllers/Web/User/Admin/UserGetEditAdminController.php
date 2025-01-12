<?php

namespace App\Http\Controllers\Web\User\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserGetEditAdminController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id): Response
    {
        $user = User::query()->find($id);
        return Inertia::render('User/Admin/Edit', [
            'user' => [
                'id' => $id,
                'name' => $user['name'],
                'email' => $user['email'],
                'is_active' => (bool)$user['is_active'],
            ]
        ]);
    }
}
