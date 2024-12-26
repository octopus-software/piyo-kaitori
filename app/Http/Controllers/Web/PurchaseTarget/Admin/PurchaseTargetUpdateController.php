<?php

namespace App\Http\Controllers\Web\PurchaseTarget\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseTarget\PurchaseTargetUpdateRequest;
use App\Models\PurchaseTarget;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PurchaseTargetUpdateController extends Controller
{
    /**
     * @param PurchaseTargetUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function __invoke(PurchaseTargetUpdateRequest $request, int $id): RedirectResponse
    {
        // 新しい画像がアップロードされている場合
        if ($request['image_file']) {
            $request->file('image_file')->store('public/purchase_target');
            $path = Storage::disk('local')->putFile('purchase_target', $request['image_file']);
            $image_url = Storage::disk('local')->url($path); // 新しい画像のURL
        } else {
            $image_url = $request['image_url']; // 画像がアップロードされていない場合は元の画像のURLをそのまま使う
        }

        $purchase_target = PurchaseTarget::query()->find($request['id']);
        $purchase_target->update([
            'name'=> $request['name'],
            'jan_code' => $request['jan_code'] ,
            'image_url' => $image_url,
            'max_quantity' => $request['max_quantity'],
            'is_active' => $request['is_active']
        ]);
        return Redirect::route('purchase_target.edit', [
            'id' => $purchase_target['id']
        ]);
    }
}
