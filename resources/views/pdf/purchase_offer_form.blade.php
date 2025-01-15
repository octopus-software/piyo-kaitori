<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>買取依頼書</title>
    <style>
    /* A4縦用のベース設定 */
    @page {
        size: A4 portrait; /* 横の場合はlandscape */
        margin: 0mm;
    }

    /* 各要素の余白リセット */
    *{
        margin: 0mm;
        padding: 0mm;
    }

    /* 印刷時の調子を整える */
    body {
        width: 210mm; /* 用紙の横幅を改めて指定 Chrome用 */
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
        line-height: 1.5em;
    }

    /* 印刷1ページ用のコンテンツはここで定義 */
    .page {
        width: 210mm; /* 用紙の横幅を改めて指定 */
        height: 296.5mm;/* 高さには0.5mm余裕をもたせる */
        page-break-after: always;

        box-sizing: border-box;
        padding: 20mm 15mm;/* 用紙の余白 */
        font-size: 11pt;
    }

    /* プレビュー用のスタイル */
    @media screen {
        body {
            background: #eee;
        }
        .page {
            background: white; /* 背景を白く */
            box-shadow: 0 .5mm 2mm rgba(0,0,0,.3); /* ドロップシャドウ */
            margin: 5mm;
        }
    }

    .header {
        display:flex;
        justify-content: space-between;
        align-items: flex-end;
    }
    .title {
        font-size: x-large;
    }
    .header div {
        display:flex;
    }

    .frame {
        width: 100%;
        display: flex;
        flex-direction:column;
        margin-top: 10px;
    }

    .sub_title {
        font-size: large;
        text-decoration:underline;
    }

    .row {
        display: flex;
        width: 100%;
        height: auto;
    }
    .inner {
        display: flex;
        height: auto;
    }
    dl {
        display: flex;
        width: 100%;
    }
    table, th, td {
        border-collapse: collapse;
        border:1px solid #333;
    }
    .col_head,th {
        height: 100%;
        text-align: center;
        background-color: gray;
        color: #eee;
        font-weight: bold;
        border:1px solid #333;
    }
    .col_describe {
        height: 100%;
        border:1px solid #333;
    }
    .transfer_info_table,.product_info_table {
        text-align: center;
    }
    .important_points {
        font-size: 6pt;
    }
    .important_points p {
        height: 8pt;
    }
    .qualified_supplier_info_table {
        text-align: center;
    }
    .qualified_supplier_info_table th:nth-child(2){
        width: 40px;
        background-color: #fff;
    }
    .agreement_signature_field{
        display: flex;
        justify-content:center;
        margin-top: 15px;
    }
    .agreement_field{
        display: flex;
        justify-content: flex-end;
        padding-right: 20px;
    }
    .signature_field {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid;
    }
    .text_center{
        text-align: center;
    }
    .txt_xxsmall{
        font-size: xx-small;
    }
    .txt_right {
        text-align: right;
    }
    .width12_5 {
        width: 12.5%;
    }
    .width20 {
        width: 20%;
    }
    .width25 {
        width: 25%;
    }
    .width30 {
        width: 30%;
    }
    .width37_5 {
        width: 37.5%;
    }
    .width50 {
        width: 50%;
    }
    .width75 {
        width: 75%;
    }
    .width80 {
        width: 80%;
    }
    .width87_5 {
        width: 87.5%;
    }
    span {
        color: red;
        font-size: x-small;
    }
    .bg_gray {
        background-color: #EEEEEE;
    }
    </style>
</head>
<body>
    <section class="page">
        <div class="header">
            <p class="title">買取依頼書兼同意書　ひよこの森</p>
            <div>
                <p>お申込日</p>
                <p>2025</p>
                <p>年</p>
                <p>01</p>
                <p>月</p>
                <p>14</p>
                <p>日</p>
            </div>
        </div>
        <div class="frame personal_info">
            <p class="sub_title">▼買取依頼者情報</p>
            <div class="frame">
                <div class="row">
                    <dl>
                        <dt class="col_head width25">買取方法</dt>
                        <dd class="col_describe width25 text_center">持ち込み</dd>
                        <dt class="col_head width25">取引方法</dt>
                        <dd class="col_describe width25 text_center">ラクマ</dd>
                    </dl>
                </div>
                <div class="row">
                    <dl>
                        <dt class="col_head width25">【必須】確認書類</dt>
                        <dd class="col_describe width75">保険証コピー(表裏)<br><span>※写しは発行より３カ月以内のみ有効　※郵送時、運転免許証は２回目以降のお客様に限る</span></dd>
                    </dl>
                </div>
                <div class="row">
                    <div class="inner width50">
                        <dt class="col_head width25">フリガナ</dt>
                        <dd class="col_describe width75 text_center">サイトウ　リュウセイ</dd>
                    </div>
                    <div class="inner width50">
                        <p class="col_head width80">生年月日</p>
                        <p class="col_head width20">性別</p>
                    </div>
                </div>
                <div class="row">
                    <div class="inner width50">
                            <dt class="col_head width25">名前</dt>
                            <dd class="col_describe width75 text_center">齋藤　龍星</dd>
                    </div>
                    <div class="inner width50">
                        <p class="col_describe width80 text_center">西暦　1995年3月21日</p>
                        <p class="col_describe width20 text_center">男</p>
                    </div>
                </div>
                <div class="row">
                    <p class="col_head width12_5">住所</p>
                    <div class="inner col_describe width87_5">
                        <p>　〒　</p>
                        <p>270-1132　</p>
                        <p>千葉県我孫子市湖北台3-3-10</p>  
                    </div>
                </div>
                <div class="row">
                    <dl class="text_center">
                        <dt class="col_head width12_5">電話番号</dt>
                        <dd class="col_describe width37_5">090-6712-5542</dd>
                        <dt class="col_head width20">メールアドレス</dt>
                        <dd class="col_describe width30">bassist.ryu@gmail.com</dd>
                    </dl>
                </div>
                <div class="row">
                    <dl>
                        <dt class="col_head width12_5">職業</dt>
                        <dd class="col_describe width87_5">ココナッツマスター</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="frame">
            <p class="sub_title">▼お振込み先情報</p>
            <table class="transfer_info_table">
                <tr>
                    <th>銀行名</th>
                    <th>支店名</th>
                    <th>支店番号</th>
                    <th>口座種別</th>
                    <th>口座番号</th>
                    <th>口座名義（カナ）</th>
                </tr>
                <tr>
                    <td>スイス銀行</td>
                    <td>謎</td>
                    <td>989999</td>
                    <td>普通</td>
                    <td>123456</td>
                    <td>サイトウ　リュウセイ</td>
                </tr>
            </table>
        </div>
        <div class="frame">
            <p class="sub_title">▼商品情報</p>
            <table class="product_info_table">
                <tr>
                    <th>商品名</th>
                    <th>色・サイズ・固有番号等</th>
                    <th>査定金額</th>
                    <th>数量</th>
                    <th>合計金額（税込）</th>
                </tr>
                <tr>
                    <td>商品A</td>
                    <td>赤</td>
                    <td>¥50000</td>
                    <td>5</td>
                    <td>¥250000</td>
                </tr>
                <tr>
                    <td>商品B</td>
                    <td>白</td>
                    <td>¥6000</td>
                    <td>7</td>
                    <td>¥42000</td>
                </tr>
                <tr>
                    <td>商品C</td>
                    <td>青</td>
                    <td>¥8000</td>
                    <td>2</td>
                    <td>¥16000</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <th>合計</th>
                    <td>14</td>
                    <td>100万</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>10%対象</td>
                    <td>¥100000</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>消費税額</td>
                    <td>¥10000</td>
                </tr>
            </table>
        </div>
        <div class="frame">
            <p class="sub_title">▼ご確認･免責事項</p>
            <div class="important_points">
                <p>・ご本人確認の為、運転免許証（表・裏）もしくは健康保険証（表・裏）の確認が必要となります。</p>
                <p>・18歳未満の方・高校生・身分証や確認書類ができない方からの買い取りは行っておりません。</p>
                <p>・確認書類は必ず本人のものをご利用ください。偽造したものや第三者のものを利用した事が発覚した場合は法的措置を取る場合がございます。</p>
                <p>・商品の郵送中に生じた故障、破損、紛失につきましては弊社では一切の責任を負いかねます。</p>
                <p>・商品到着時点の状態により買取不可になる場合や減額になることがございます。</p>
                <p>・100,000以上の振り込みの際は無料にてお振込みさせて頂きます。100,000未満の場合は一律で300円ご負担頂きます。</p>
                <p>・弊社宛ての郵送は全て【元払い】、弊社からの返品は【着払い】での郵送となります。</p>
                <p>・書類・商品の不備があった場合、弊社よりご連絡差し上げますが、場合によっては減額・買取不可・返品になる場合がございます。</p>
                <p>・当依頼書にご記入いただいた個人情報は厳重に管理し、古物営業法上の取引記録、本人確認のため、また古物営業法等法令による要請を除き第三者への提供はいたしません。</p>
                <p>・買取成立後のキャンセルは出来かねます。※返送商品の受け取り拒否・長期不在などで当社に返送された場合は弊社にて商品を全て処分いたします。</p>
                <p>・買取代金は即日～3営業日（土日祝を除く）を目安にお支払いします。※諸事情により支払いが遅くなる場合もございます。</p>
                <p>・免税購入した商品、またはその疑いのある商品は買取できません。</p>
                <p>・虚偽の適格請求書発行事業者登録番号の申告、買取同意書に虚偽の事実を記載されたことが発覚した場合は、お支払い完了後でも買取価格の訂正を行い、その差額をご請求いたします。</p>
                <p>・その他、HPよりご確認くださいませ。</p>
            </div>
        </div>
        <div class="frame">
            <table class="qualified_supplier_info_table">
                <tr>
                    <th>適格請求書発行事業者ですか？</th>
                    <th></th>
                    <th>適格請求書発行事業者登録番号</th>
                </tr>
                <tr>
                    <td>はい</td>
                    <td></td>
                    <td>T1234567890123</td>
                </tr>
            </table>
        </div>
        <div class="agreement_signature_field">
            <div class="inner width50 agreement_field">
                <p>上記に全て同意し、買取を依頼します</p>
            </div>
            <div class="inner width50 signature_field">
                <p>ご署名欄</p>
                <p>印</p>
            </div>
        </div>
        <div class="frame">
            <p class="sub_title bg_gray">▼ヤマト運輸から発送</p>
            <p>〒125-0035 東京都葛飾区南水元2-7-29</p>
        </div>
        <div class="frame">
            <p class="txt_xxsmall bg_gray text_center">※誤った送付先へ発送すると、減額もしくは買取不可・着払返品になる可能性がございます。</p>
        </div>
        <div class="frame text_center">
            <p>古物商　許可番号　東京都公安委員会　第401300000065号</p>
        </div>
    </section>
</body>
</html>