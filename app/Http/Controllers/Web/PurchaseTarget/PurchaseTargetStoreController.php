<?php

namespace App\Http\Controllers\Web\PurchaseTarget;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostPurchaseTargetRequest;
use App\Models\PurchaseTarget;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class PurchaseTargetStoreController extends Controller
{
    public function __invoke(PostPurchaseTargetRequest $request): Response
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
            'amount' => $request['amount'],
            'is_active' => 1,
        ]);
        session()->flash('toastMessage', '購入ターゲットが更新されました！');
        return redirect()->route('purchase_target.list');
    }
}
