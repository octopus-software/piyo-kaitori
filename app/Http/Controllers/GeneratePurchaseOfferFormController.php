<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOffer;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class GeneratePurchaseOfferFormController extends Controller
{
    public function exportToPdf(Request $request)
    {
        // 実行時間の制限を解除または延長
        set_time_limit(120); // 120秒 (2分) に設定

        // 日本語フォントを有効にするためのDompdfオプションの設定
        $options = new Options();
        $options->set('isPhpEnabled', true);          // PHP機能を有効にする（必要な場合）
        $options->setFontDir(storage_path('fonts/')); // フォントディレクトリを指定
        $options->setFontCache(storage_path('fonts/cache/')); // キャッシュディレクトリを指定
        $options->set('defaultFont', 'Noto Sans JP');   // デフォルトフォントの指定
        $options->set('isHtml5ParserEnabled', true);  // HTML5パーサーを有効にする
        $options->set('isRemoteEnabled', true);       // 外部リソースを有効化
        $options->set('isFontSubsettingEnabled', true);       // フォントのサブセット化を有効にする

        // Dompdfインスタンスの作成
        $dompdf = new Dompdf($options);
        $dompdf->getOptions()->setFontDir(storage_path('fonts/'));
        $dompdf->getOptions()->setFontCache(storage_path('fonts/cache/'));
        $dompdf->getOptions()->setDefaultFont('Noto Sans JP');

        // ファイルを読み込み
        $filePath = storage_path('app/public/template.xlsx');
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
            'name' => 'RYUSEI'
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
        $sheet->setCellValue('H2', '');
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

        $sheet->getPageMargins()->setTop(1);    // 上マージン
        $sheet->getPageMargins()->setRight(0.75); // 右マージン
        $sheet->getPageMargins()->setLeft(0.75);  // 左マージン
        $sheet->getPageMargins()->setBottom(1); // 下マージン

        // HTML出力を作成
        $writer = IOFactory::createWriter($spreadsheet, 'Html');
        $writer->setPreCalculateFormulas(true);  // 数式の事前計算を有効にする
        ob_start();
        $writer->save('php://output');
        $htmlContent = ob_get_clean();

        //$htmlContent = '<meta charset="UTF-8">' . $htmlContent;

        $htmlContent = '<style>
            body, table, th, td {
                font-family: ”NotoSansJP", sans-serif;
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

        //$htmlContent = mb_convert_encoding($htmlContent, 'SJIS', 'UTF-8');

        // DompdfにHTMLをロード
        $dompdf->loadHtml($htmlContent);

        // 用紙サイズと向きを設定
        $dompdf->setPaper('A4','portrait');

        // PDFのレンダリング
        $dompdf->render();

        // PDFファイルを保存
        $pdfFilePath = storage_path('app/public/example.pdf');
        file_put_contents($pdfFilePath, $dompdf->output());

        // PDFファイルをダウンロードさせる
        return response()
        ->download($pdfFilePath);
        //->deleteFileAfterSend(true);
    }
}

