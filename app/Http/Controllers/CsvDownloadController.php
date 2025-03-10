<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOffer;
use Illuminate\Http\Request;

class CsvDownloadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //全ての買取依頼を関連している買取対象も取得
        $purchase_offers = PurchaseOffer::query()
            ->select('purchase_offers.*', 'users.name')
            ->where('purchase_offers.status', '>=', PurchaseOffer::STATUS['paid'])
            ->when($request['from_date'], function ($query) use ($request) {
                return $query->where('purchase_offers.created_at', '>=', $request['from_date'] . ' 00:00:00');
            })
            ->when($request['to_date'], function ($query) use ($request) {
                return $query->where('purchase_offers.created_at', '<=', $request['to_date'] . ' 23:59:59');
            })
            ->join('users', 'purchase_offers.user_id', '=', 'users.id')
            ->with('purchase_targets')
            ->get();

        //データを整理
        $formattedData = collect($purchase_offers)->flatMap(function ($offer) {
            return collect($offer['purchase_targets'])->map(function ($target) use ($offer) {
                $total_price = $target['pivot']['price'] * $target['pivot']['quantity'];
                $consumption_tax = $total_price * 0.1;

                return [
                    'created_at' => $offer['created_at'], //作成日
                    'user_name' => $offer['name'], //買取依頼者名
                    'offer_id' => $offer['id'], //買取ID
                    'purchase_target_name' => $target['name'], //買取商品名
                    'jan_code' => $target['jan_code'], //JANコード
                    'price' => number_format($target['pivot']['price']), //買取価格
                    'quantity' => number_format($target['pivot']['quantity']), //買取個数
                    'total_price' => number_format($total_price), //買取総額
                    'consumption_tax' => number_format($consumption_tax), //内税額
                ];
            });
        })->values()->all();

        //CSVの項目名を定義
        $csvHeader = ['作成日', '買取依頼者名', '買取グループID', '買取商品名', 'JANコード', '買取価格', '買取個数', '買取総額', '買取総額内税'];

        //本日を取得
        $today = now()->format('YmdHis');

        //ファイル名生成
        $file_name = "買取依頼一覧_" . $today;

        //CSV書き込み
        return response()->streamDownload(function () use ($csvHeader, $formattedData) {
            $handle = fopen('php://output', 'w');

            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF)); // UTF-8 BOM 追加（Excel 文字化け対策）
            fputcsv($handle, $csvHeader);
            foreach ($formattedData as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }, $file_name . '.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $file_name . '.csv"',
        ]);

    }
}
