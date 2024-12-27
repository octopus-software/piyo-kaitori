<?php

namespace App\Http\Controllers\Web\User\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserDeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id): RedirectResponse
    {
        User::destroy($id);
        return redirect()->route('admin.user.list');
    }
}
