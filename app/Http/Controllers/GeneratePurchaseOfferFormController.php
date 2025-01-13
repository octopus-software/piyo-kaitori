<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOffer;
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
        $purchase_offer = PurchaseOffer::query()->with(['purchase_targets'])->find(34);
        //$user = auth()->user();
        $user = array(
            'id' => 1,
            'name' => '山田太郎',
        );

        // シートを取得してデータを変更
        $sheet = $spreadsheet->getActiveSheet();

        //申込日（年）
        $sheet->setCellValue('W2', now()->format('Y'));
        //申込日（月）
        $sheet->setCellValue('AB2', now()->format('m'));
        //申込日（日）
        $sheet->setCellValue('AF2', now()->format('d'));
        //買取方法
        //$sheet->setCellValue('H4', $request['purchase_method']);
        //取引方法
        $sheet->setCellValue('X2', '');
        //確認書類
        $sheet->setCellValue('H5', '');
        //フリガナ
        $sheet->setCellValue('F2', '');
        //氏名
        $sheet->setCellValue('F8', $user['name']);
        //生年月日（年）
        $sheet->setCellValue('S8', '');
        //生年月日（月）
        $sheet->setCellValue('X8', '');
        //生年月日（日）
        $sheet->setCellValue('AA8', '');
        //性別
        $sheet->setCellValue('AE8', '');
        //生年月日（年）
        $sheet->setCellValue('S8', '');

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

