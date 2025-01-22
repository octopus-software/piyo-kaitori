<?php

namespace App\Http\Controllers\Web\PurchaseOffer\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseOffer\Client\PurchaseOfferStoreClientRequest;
use App\Mail\PurchaseOfferUnapprovedMail;
use App\Models\PurchaseOffer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class PurchaseOfferStoreClientController extends Controller
{
    public function __invoke(PurchaseOfferStoreClientRequest $request){
        return DB::transaction(function () use($request) {
            //買取依頼を作成
            $created_offer = PurchaseOffer::create([
                'user_id' => auth()->id(),
                'status'  => PurchaseOffer::STATUS['unapproved'],
                'remark'  => $request['remark']
            ]);

            //カート内容を取得
            $data = $request->session()->get('cart');

            //offer_target,買取対象を登録
            foreach ($data as $item){
                $created_offer->purchase_targets()->attach($item['purchase_target_id'],[
                    'purchase_offer_id' => $created_offer['id'],
                    'purchase_target_id' => $item['purchase_target_id'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'evidence_url' => $item['evidence_url']
                ]);
            }

            //買取依頼IDを取得
            $purchase_offer_id = $created_offer->id;

            //作成した買取依頼を取得
            $purchase_offer = PurchaseOffer::query()
                ->with('purchase_targets')
                ->where('id',$purchase_offer_id)
                ->first();

            //purchase_targetsを取得
            $purchase_targets = $purchase_offer['purchase_targets'];

            //メール送信
            Mail::to(config('mail')['from']['address'])->send(new PurchaseOfferUnapprovedMail($purchase_offer_id,$purchase_targets));

            // // セッションからcartを削除する
            // session()->forget('cart');
            // return Redirect::route('client.purchase_offer.list');
        });
    }
}
