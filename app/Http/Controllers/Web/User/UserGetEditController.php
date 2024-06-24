<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserGetEditController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(int $id, Request $request): Response
    {
        return Inertia::render('User/UserEdit', [
            'user' => [
                'id' => $id,
                'name' => 'test',
                'email' => 'test@example.com',
            ]
        ]);
    }
}
