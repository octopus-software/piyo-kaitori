<?php

use App\Http\Controllers\GetPurchaseOffersController;
use App\Http\Controllers\GetPurchaseTargetsController;
use App\Http\Controllers\GetTestController;
use App\Http\Controllers\GetUsersController;
use App\Http\Controllers\PostTestController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\Web\Dashboard\GetDashboardController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\User\UserGetEditController;
use App\Http\Controllers\Web\User\UserGetListController;
use App\Http\Controllers\Web\User\UserUpdateController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/token',function(){
    return csrf_token();
});
Route::get('/purchase_offers',GetPurchaseOffersController::class);
Route::get('/users',GetUsersController::class);
Route::get('/purchase_targets',GetPurchaseTargetsController::class);
Route::post('/test',UserPostController::class);

Route::get('/dashboard', GetDashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user', UserGetListController::class)->name('user.list');
    Route::get('/user/{id}/edit', UserGetEditController::class)->name('user.edit');
    Route::put('/user/{id}', UserUpdateController::class)->name('user.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
