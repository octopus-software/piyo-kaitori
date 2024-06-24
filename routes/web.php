<?php

use App\Http\Controllers\GetPurchaseOffersController;
use App\Http\Controllers\GetPurchaseTargetsController;
use App\Http\Controllers\GetTestController;
use App\Http\Controllers\GetUsersController;
use App\Http\Controllers\PostPurchaseTargetController;
use App\Http\Controllers\PostTestController;
use App\Http\Controllers\PurchaseOfferDeleteController;
use App\Http\Controllers\PurchaseOfferGetEditController;
use App\Http\Controllers\PurchaseOfferPostController;
use App\Http\Controllers\PurchaseTargetDeleteController;
use App\Http\Controllers\PurchaseTargetGetEditController;
use App\Http\Controllers\PutPurchaseTargetController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\Web\Dashboard\GetDashboardController;
use App\Http\Controllers\Web\ProfileController;
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

Route::get('/users',GetUsersController::class);

Route::get('/purchase_offers',GetPurchaseOffersController::class);
Route::get('purchase_offer/{id}/edit',PurchaseOfferGetEditController::class);
Route::post('purchase_offer',PurchaseOfferPostController::class);
Route::delete('purchase_offer/{id}',PurchaseOfferDeleteController::class);

Route::get('/purchase_targets',GetPurchaseTargetsController::class);
Route::get('/purchase_target/{id}/edit',PurchaseTargetGetEditController::class);
Route::post('/purchase_target',PostPurchaseTargetController::class);
Route::put('/purchase_target',PutPurchaseTargetController::class);
Route::delete('/purchase_target/{id}',PurchaseTargetDeleteController::class);

Route::post('/test',UserPostController::class);

Route::get('/dashboard', GetDashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
