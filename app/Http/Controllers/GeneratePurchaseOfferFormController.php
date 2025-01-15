<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOffer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\IOFactory;

class GeneratePurchaseOfferFormController extends Controller
{
    public function exportToPdf(Request $request)
    {
        // 実行時間の制限を解除または延長
        set_time_limit(120); // 120秒 (2分) に設定

        // ファイルを読み込み
        $filePath = public_path('excel/purchase_offer_form_template.xlsx');
        $spreadsheet = IOFactory::load($filePath);

        // ページ設定の調整
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getPageSetup()->setPrintArea('A1:AJ53'); // 印刷範囲を設定

        //必要なデータを取得
        //$id = auth()->id();
        $purchase_offer_id = $request['purchase_offer_id'];
        $purchase_offer = PurchaseOffer::query()->with(['purchase_targets'])->find($purchase_offer_id);
        $user = auth()->user();

        //誕生日を分割
        $carbonDate = Carbon::parse($user['birthday']);
        $bd_year = $carbonDate->year;
        $bd_month = $carbonDate->month;
        $bd_day = $carbonDate->day;

        // シートを取得してデータを変更
        $sheet = $spreadsheet->getActiveSheet();

        //申込日（年）
        $sheet->setCellValue('W2', now()->format('Y'));
        //申込日（月）
        $sheet->setCellValue('AB2', now()->format('m'));
        //申込日（日）
        $sheet->setCellValue('AF2', now()->format('d'));
        //買取依頼書ID
        $created_uuid = str()->uuid();
        $sheet->setCellValue('N3', "買取依頼書ID：".$created_uuid);
        //買取方法
        $sheet->setCellValue('H4', $request['purchase_method']);
        //取引方法
        $sheet->setCellValue('X4', $request['transaction_method']);
        //確認書類
        $sheet->setCellValue('H5', $request['identification_document_type']);
        //フリガナ
        $sheet->setCellValue('F7', $user['name_kana']);
        //氏名
        $sheet->setCellValue('F8', $user['name']);
        //生年月日（年）
        $sheet->setCellValue('S8', $bd_year);
        //生年月日（月）
        $sheet->setCellValue('X8', $bd_month);
        //生年月日（日）
        $sheet->setCellValue('AA8', $bd_day);
        //性別
        $sheet->setCellValue('AE8', $user['gender']);
        //郵便番号
        $sheet->setCellValue('H9', $user['post_code']);
        //住所
        $sheet->setCellValue('K9', $user['address']);
        //電話番号
        $sheet->setCellValue('F10', $user['tel']);
        //メールアドレス
        $sheet->setCellValue('U10', $user['email']);
        //職種
        $sheet->setCellValue('G11', $user['job']);
        //銀行名
        $sheet->setCellValue('B14', $user['bank_name']);
        //支店名
        $sheet->setCellValue('H14', $user['bank_branch_name']);
        //支店番号
        $sheet->setCellValue('L14', $user['branch_number']);
        //口座種別
        $sheet->setCellValue('P14', $user['account_type']);
        //口座番号
        $sheet->setCellValue('S14', $user['account_number']);
        //口座名義（カタカナ）
        $sheet->setCellValue('Y14', $user['account_name_kana']);
        //適格事業者番号チェック
        $sheet->setCellValue('B43', $user['is_qualified_supplier']);
        //適格事業者番号
        $sheet->setCellValue('U43', $user['invoice_number']);


        $row = 17;
        $total_prices = array();
        foreach ($purchase_offer['purchase_targets'] as $purchase_target){
            //商品名
            $sheet->setCellValue('B'.strval($row), $purchase_target['name']);
            //JANコード
            $sheet->setCellValue('K'.strval($row), $purchase_target['jan_code']);
            //査定金額
            $sheet->setCellValue('R'.strval($row), $purchase_target['pivot']['price']);
            //数量
            $sheet->setCellValue('X'.strval($row), $purchase_target['pivot']['quantity']);

            $total = $purchase_target['pivot']['price'] * $purchase_target['pivot']['quantity'];
            //小計金額
            $sheet->setCellValue('AB'.strval($row), $total);

            $row += 1;
            $total_prices[] = $total;
        }

        //合計金額
        $total_price = array_sum($total_prices);
        $sheet->setCellValue('AB24', $total_price);
        //消費税額
        $consumption_tax = $total_price/(1+0.1)*0.1;
        $sheet->setCellValue('AB25', $consumption_tax);
        //10%対象金額
        $sheet->setCellValue('E24', $total_price - $consumption_tax);

        // HTML出力を作成
        $writer = IOFactory::createWriter($spreadsheet, 'Html');
        $writer->setPreCalculateFormulas(true);  // 数式の事前計算を有効にする
        ob_start();
        $writer->save('php://output');
        $htmlContent = ob_get_clean();

        $mpdf = new Mpdf([
            'format' => 'A4', // 用紙サイズ
            'tempDir' => storage_path('mpdf'), // 一時ファイルディレクトリ
            'fontDir' => [storage_path('fonts')], // フォントディレクトリ
            'fontdata' => [
                'notosansjp' => [
                    'R' => 'NotoSansJP-Regular.ttf', // Regularフォント
                    'B' => 'NotoSansJP-Bold.ttf', // Boldフォント
                ],
            ],
            'default_font' => 'notosansjp', // デフォルトフォントを指定
        ]);

        $htmlContent = '<style>
            body, table, th, td {
                font-family: "NotoSansJP, sans-serif";
            }
            table {
                width: 100%;
                table-layout: fixed;
            }
            th, td {
                width: auto;
                padding: 5px;
                text-align: left;
            }
        </style>' . $htmlContent;

        $mpdf->WriteHTML($htmlContent);

        // PDFを保存
        $pdfFilePath = storage_path('app/public/example.pdf');
        $mpdf->Output($pdfFilePath, 'F');

        // PDFファイルをダウンロードさせる
        return response()->download($pdfFilePath)->deleteFileAfterSend(true);
    }
}

