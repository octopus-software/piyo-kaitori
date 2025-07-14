<?php

namespace App\Http\Controllers\Web\Dashboard\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardGetClientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        return Inertia::render('Dashboard/Client/Index');
    }
}
