<?php

namespace App\Http\Controllers\Web\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardGetAdminController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        return Inertia::render('Dashboard/Admin/Index');
    }
}
