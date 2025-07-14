<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

class WelcomeController extends Controller
{
    public function __invoke(): Response
    {
        $companies = Company::all();
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'companies' => $companies
        ]);
    }
}
