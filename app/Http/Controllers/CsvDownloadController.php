<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOffer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
        $csvHeader = ['作成日', '買取依頼者名', '買取グループID', '買取商品名', 'JANコード','買取価格','買取個数','買取総額','買取総額内税'];

        //CSV書き込み
        $response = new StreamedResponse(function () use ($csvHeader, $formattedData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $csvHeader);

            foreach ($formattedData as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users.csv"',
        ]);

        //本日を取得
        $today = now()->format('Ymd');

        //ファイル名生成
        $file_name = "買取依頼一覧_".$today;
        
        //ファイル名設定
        $response->headers->set('Content-Disposition', 'attachment; filename='.$file_name.'.csv');
        return $response;
    }
}
