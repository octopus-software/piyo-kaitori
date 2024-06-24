<?php

use App\Http\Controllers\GetTestController;
use App\Http\Controllers\PostTestController;
use App\Http\Controllers\UserGetListController;
use App\Http\Controllers\Web\Dashboard\GetDashboardController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\PurchaseOffer\PurchaseOfferDeleteController;
use App\Http\Controllers\Web\PurchaseOffer\PurchaseOfferGetEditController;
use App\Http\Controllers\Web\PurchaseOffer\PurchaseOfferGetListController;
use App\Http\Controllers\Web\PurchaseOffer\PurchaseOfferStoreController;
use App\Http\Controllers\Web\PurchaseTarget\PurchaseTargetDeleteController;
use App\Http\Controllers\Web\PurchaseTarget\PurchaseTargetGetEditController;
use App\Http\Controllers\Web\PurchaseTarget\PurchaseTargetGetListController;
use App\Http\Controllers\Web\PurchaseTarget\PurchaseTargetStoreController;
use App\Http\Controllers\Web\PurchaseTarget\PurchaseTargetUpdateController;
use App\Http\Controllers\Web\User\UserGetEditController;
use App\Http\Controllers\Web\User\UserStoreController;
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

Route::get('/users',UserGetListController::class);

Route::get('/purchase_offers',PurchaseOfferGetListController::class);
Route::get('purchase_offer/{id}/edit',PurchaseOfferGetEditController::class);
Route::post('purchase_offer',PurchaseOfferStoreController::class);
Route::delete('purchase_offer/{id}',PurchaseOfferDeleteController::class);

Route::get('/purchase_targets',PurchaseTargetGetListController::class);
Route::get('/purchase_target/{id}/edit',PurchaseTargetGetEditController::class);
Route::post('/purchase_target',PurchaseTargetStoreController::class);
Route::put('/purchase_target',PurchaseTargetUpdateController::class);
Route::delete('/purchase_target/{id}',PurchaseTargetDeleteController::class);

Route::post('/test',UserStoreController::class);

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
