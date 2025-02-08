<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOffer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\View;

class GeneratePurchaseOfferFormController extends Controller
{
    public function exportToPdf(Request $request)
    {
        set_time_limit(120); // 実行時間の制限を解除または延長

        // 必要なデータを取得
        $purchase_offer_id = $request->input('purchase_offer_id');
        $purchase_offer = PurchaseOffer::with(['purchase_targets'])->findOrFail($purchase_offer_id);
        $user = auth()->user();

        // 誕生日の分割
        $carbonDate = Carbon::parse($user->birthday);
        $bd_year = $carbonDate->year;
        $bd_month = $carbonDate->month;
        $bd_day = $carbonDate->day;

        // 合計金額と消費税計算
        $total_price = $purchase_offer->purchase_targets->sum(fn($target) => $target->pivot->price * $target->pivot->quantity);
        $consumption_tax = $total_price / (1 + 0.1) * 0.1;

        // Blade の HTML を取得
        $html = View::make('pdf.purchase_offer_form', [
            'purchase_method' => $request['purchase_method'],
            'transaction_method' => $request['transaction_method'],
            'purchase_offer' => $purchase_offer,
            'purchase_offer_id' => $purchase_offer_id,
            'user' => $user,
            'birthday_year' => $bd_year,
            'birthday_month' => $bd_month,
            'birthday_day' => $bd_day,
            'total_price' => $total_price,
            'consumption_tax' => $consumption_tax
        ])->render();
//        return $html;

        // Mpdf 設定
        $mpdf = new Mpdf([
            'format' => 'A4',
            'tempDir' => storage_path('mpdf'),
            'fontDir' => [storage_path('fonts')],
            'fontdata' => [
                'notosansjp' => [
                    'R' => 'NotoSansJP-Regular.ttf',
                    'B' => 'NotoSansJP-Bold.ttf',
                ],
            ],
            'default_font' => 'notosansjp',
//            'shrink_tables_to_fit' => 1, // ★ 追加（表が崩れないように）
        ]);
        // HTML を PDF に変換
        $mpdf->WriteHTML($html);

        // PDF を保存
        $pdfFilePath = storage_path('app/public/purchase_offer.pdf');
        $mpdf->Output($pdfFilePath, 'F');

        // PDF をダウンロード
        return response()->download($pdfFilePath)->deleteFileAfterSend(true);
    }
}

