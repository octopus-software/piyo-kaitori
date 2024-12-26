<?php

namespace App\Http\Controllers\Web\PurchaseTarget\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseTarget\Admin\PurchaseTargetStoreAdminRequest;
use App\Models\PurchaseTarget;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class PurchaseTargetStoreAdminController extends Controller
{
    public function __invoke(PurchaseTargetStoreAdminRequest $request): Response
    {
        // 画像がアップロードされている場合
        $image_url = null;
        if ($request['image_file']) {
            $request->file('image_file')->store('public/purchase_target');
            $path = Storage::disk('local')->putFile('purchase_target', $request['image_file']);
            $image_url = Storage::disk('local')->url($path); // 新しい画像のURL
        }
        PurchaseTarget::query()->create([
            'name' => $request['name'],
            'jan_code' => $request['jan_code'],
            'image_url' => $image_url,
            'max_quantity' => $request['max_quantity'],
            'is_active' => 1,
        ]);
        return Redirect::route('admin.purchase_target.list');
    }
}
