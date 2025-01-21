<?php

namespace App\Http\Controllers\Web\PurchaseOffer\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseOffer\Admin\PurchaseOfferUpdateStatusAdminRequest;
use App\Mail\PurchaseOfferApprovedMail;
use App\Models\PurchaseOffer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Concerns\ToArray;

class PurchaseOfferUpdateStatusAdminController extends Controller
{
    public function __invoke(PurchaseOfferUpdateStatusAdminRequest $request, int $id)//: RedirectResponse
    {
        //purchase_offer_idを取得
        $purchase_offer_id = $request['id'];

        //OFFER情報及び商品情報を取得
        $purchase_offer = PurchaseOffer::query()
            ->with('purchase_targets')
            ->where('id',$request['id'])
            ->first();

        //purchase_targetを取得
        $purchase_targets = $purchase_offer['purchase_targets'];

        //USER情報取得
        $user_info = User::query()->find($purchase_offer['user_id']);

        //ステータスを更新
        $purchase_offer->update([
            'status' => $request['status']
        ]);

        //メール送信
        Mail::to($user_info['email'])->send(new PurchaseOfferApprovedMail($purchase_offer_id,$purchase_offer,$purchase_targets));
        return Redirect::route('admin.purchase_offer.list');
    }
}
