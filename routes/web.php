<?php

use App\Http\Controllers\CsvDownloadController;
use App\Http\Controllers\Web\Dashboard\Admin\DashboardGetAdminController;
use App\Http\Controllers\Web\Dashboard\Client\DashboardGetClientController;
use App\Http\Controllers\Web\MyCart\Client\MyCartDeleteItemClientController;
use App\Http\Controllers\Web\MyCart\Client\MyCartGetClientController;
use App\Http\Controllers\Web\MyCart\Client\MyCartStoreClientController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\PurchaseOffer\Admin\PurchaseOfferDeleteAdminController;
use App\Http\Controllers\Web\PurchaseOffer\Admin\PurchaseOfferGetEditAdminController;
use App\Http\Controllers\Web\PurchaseOffer\Admin\PurchaseOfferGetListAdminController;
use App\Http\Controllers\Web\PurchaseOffer\Admin\PurchaseOfferUpdateStatusAdminController;
use App\Http\Controllers\Web\PurchaseOffer\Client\PurchaseOfferDeleteClientController;
use App\Http\Controllers\Web\PurchaseOffer\Client\PurchaseOfferFormGenerateController;
use App\Http\Controllers\Web\PurchaseOffer\Client\PurchaseOfferGetEditClientController;
use App\Http\Controllers\Web\PurchaseOffer\Client\PurchaseOfferGetListClientController;
use App\Http\Controllers\Web\PurchaseOffer\Client\PurchaseOfferStoreClientController;
use App\Http\Controllers\Web\PurchaseOffer\Client\PurchaseOfferUpdateStatusClientController;
use App\Http\Controllers\Web\PurchaseTarget\Admin\PurchaseTargetDeleteAdminController;
use App\Http\Controllers\Web\PurchaseTarget\Admin\PurchaseTargetGetCreateAdminController;
use App\Http\Controllers\Web\PurchaseTarget\Admin\PurchaseTargetGetEditAdminController;
use App\Http\Controllers\Web\PurchaseTarget\Admin\PurchaseTargetGetListAdminController;
use App\Http\Controllers\Web\PurchaseTarget\Admin\PurchaseTargetStoreAdminController;
use App\Http\Controllers\Web\PurchaseTarget\Admin\PurchaseTargetUpdateAdminController;
use App\Http\Controllers\Web\PurchaseTarget\Client\PurchaseTargetGetListClientController;
use App\Http\Controllers\Web\PurchaseTarget\Client\PurchaseTargetGetShowClientController;
use App\Http\Controllers\Web\User\Admin\UserDeleteAdminController;
use App\Http\Controllers\Web\User\Admin\UserGetEditAdminController;
use App\Http\Controllers\Web\User\Admin\UserGetListAdminController;
use App\Http\Controllers\Web\User\Admin\UserStoreAdminController;
use App\Http\Controllers\Web\User\Admin\UserUpdateAdminController;
use App\Http\Controllers\Web\User\Client\UserGetEditClientController;
use App\Http\Controllers\Web\User\Client\UserUpdateClientController;
use App\Http\Middleware\RoleMiddleware;
use App\Models\User;
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
Route::get('/token', function () {
    return csrf_token();
});

// 管理者ルート
Route::prefix('admin')
    ->middleware([RoleMiddleware::class . ':' . User::USER_ROLE['admin']])
    ->group(function () {
        // 買取オファー
        Route::get('/purchase_offers', PurchaseOfferGetListAdminController::class)->name('admin.purchase_offer.list');
        Route::get('purchase_offer/{id}/edit', PurchaseOfferGetEditAdminController::class)->name('admin.purchase_offer.edit');
        Route::delete('purchase_offer/{id}', PurchaseOfferDeleteAdminController::class)->name('admin.purchase_offer.delete');
        Route::put('purchase_offer/{id}/status', PurchaseOfferUpdateStatusAdminController::class)->name('admin.purchase_offer.update.status');

        // 買取対象
        Route::get('/purchase_targets', PurchaseTargetGetListAdminController::class)->name('admin.purchase_target.list');
        Route::get('/purchase_target/{id}/edit', PurchaseTargetGetEditAdminController::class)->name('admin.purchase_target.edit');
        Route::get('/purchase_target/create', PurchaseTargetGetCreateAdminController::class)->name('admin.purchase_target.create');
        Route::post('/purchase_target', PurchaseTargetStoreAdminController::class)->name('admin.purchase_target.store');
        Route::put('/purchase_target/{id}', PurchaseTargetUpdateAdminController::class)->name('admin.purchase_target.update');
        Route::delete('/purchase_target/{id}', PurchaseTargetDeleteAdminController::class)->name('admin.purchase_target.delete');

        // ダッシュボード
        Route::get('/dashboard', DashboardGetAdminController::class)->middleware(['auth', 'verified'])->name('admin.dashboard');

        // 買取依頼者
        Route::get('/users', UserGetListAdminController::class)->name('admin.user.list');
        Route::get('/user/{id}/edit', UserGetEditAdminController::class)->name('admin.user.edit');
        Route::put('/user/{id}', UserUpdateAdminController::class)->name('admin.user.update');
        Route::delete('/user/{id}/delete', UserDeleteAdminController::class)->name('admin.user.delete');
    });

Route::prefix('client')
    ->middleware([RoleMiddleware::class . ':' . User::USER_ROLE['client']])
    ->group(function () {
        // ダッシュボード
        Route::get('/dashboard', DashboardGetClientController::class)->middleware(['auth', 'verified'])->name('client.dashboard');

        // 買取対象
        Route::get('/purchase_targets', PurchaseTargetGetListClientController::class)->name('client.purchase_target.list');
        Route::get('/purchase_target/{id}/show', PurchaseTargetGetShowClientController::class)->name('client.purchase_target.show');

        // 買取オファー
        Route::get('/purchase_offers',PurchaseOfferGetListClientController::class)->name('client.purchase_offer.list');
        Route::get('/purchase_offer/export_pdf', PurchaseOfferFormGenerateController::class)->name('client.export_pdf');
        Route::get('purchase_offer/{id}/edit', PurchaseOfferGetEditClientController::class)->name('client.purchase_offer.edit');
        Route::post('purchase_offer', PurchaseOfferStoreClientController::class)->name('client.purchase_offer.store');
        Route::put('purchase_offer/{id}/status', PurchaseOfferUpdateStatusClientController::class)->name('client.purchase_offer.update.status');
        Route::delete('purchase_offer/{id}', PurchaseOfferDeleteClientController::class)->name('client.purchase_offer.delete');

        // 買取依頼カート
        Route::get('/my_cart', MyCartGetClientController::class)->name('client.my_cart.list');
        Route::post('/my_cart', MyCartStoreClientController::class)->name('client.cart.store');
        Route::delete('/my_cart/{id}', MyCartDeleteItemClientController::class)->name('client.cart.item.delete');

        // 買取依頼者プロフィール
        Route::get('/user/{id}/edit', UserGetEditClientController::class)->name('client.user.edit');
        Route::put('/user/{id}',UserUpdateClientController::class)->name('client.user.update');
    });

Route::post('/test', UserStoreAdminController::class);

Route::get('/csv_download', CsvDownloadController::class);

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * デバッグ用ルート
 */
Route::prefix('debug')->group(function () {
    Route::get('/logout', function () {
        auth()->logout();
        return redirect('/');
    })->name('debug.logout');
    Route::get('/get_my_cart', function () {
        return dd(session()->get('cart', []));
    })->name('debug.get_my_cart');
    Route::get('/auth', function () {
        return auth()->user();
    });
});

require __DIR__ . '/auth.php';
