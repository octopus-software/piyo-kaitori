<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>買取依頼書</title>
    <style>
        p {
            font-size: 9px;
        }

        .bg-gray {
            background-color: gray;
            color: white;
        }

        .header {
            overflow: hidden;
            width: 100%;
        }

        #header-item-left {
            float: left;
            width: 70%;
            box-sizing: border-box;
        }

        p#header-item-left {
            font-size: 22px;
        }

        #header-item-right {
            float: right;
            width: 30%;
            box-sizing: border-box;
        }

        p#header-item-right {
            font-size: 10px;
            text-align: right;
        }

        table {
            border-collapse: collapse; /* 二重線を防ぐ */
            table-layout: fixed;
            width: 100%;
        }

        th {
            font-size: 9px;
            border: 1px solid #333;
            text-align: center;
            background-color: gray;
            color: white;
        }

        td {
            font-size: 9px;
            width: 25%;
            border: 1px solid #333;
            padding: 2px 0;
            text-align: center;
        }

        .font-big {
            font-size: 14px;
        }

        .font-small p {
            font-size: 8px;
        }
    </style>
</head>
<body>
<section class="page">

    <div class="header">
        <p id="header-item-left">買取依頼書兼同意書　ひよこの森</p>
        <p id="header-item-right">
            お申込日: {{ (new DateTime())->format('Y年m月d日') }}<br/>
            買取ID: {{ sprintf('%015d', $purchase_offer['id']) }}
        </p>
    </div>

    <div class="frame personal_info">
        {{--        <p class="sub_title">▼買取依頼者情報</p>--}}
        <div>
            <p class="sub_title"><u>▼買取依頼者情報</u></p>
            <table>
                {{-- 1行目 --}}
                <tr class="row">
                    <td class="bg-gray" colspan="1">買取方法</td>
                    <td colspan="1"></td>
                    <td class="bg-gray" colspan="1">取引方法</td>
                    <td colspan="1"></td>
                </tr>
                {{-- 2行目 --}}
                <tr class="row">
                    <td class="bg-gray" colspan="1">本人確認書類</td>
                    <td colspan="3"><b>※サイトに本人確認書類アップロード済み</b></td>
                </tr>
                {{-- 3行目 --}}
                <tr class="row">
                    <td class="bg-gray" colspan="1">
                        <p>（ふりがな）</p>
                        <p>氏名</p>
                    </td>
                    <td colspan="1">
                        <p>{{ $user['name_kana'] }}</p>
                        <p class="font-big">{{ $user['name'] }}</p>
                    </td>
                    <td class="bg-gray" colspan="1">生年月日</td>
                    <td colspan="1">{{ (new DateTime($user['birthday']))->format('Y年m月d日') }}</td>
                </tr>
                {{-- 4行目 --}}
                <tr class="row">
                    <td class="bg-gray">職業</td>
                    <td>{{ $user['job'] }}</td>
                    <td class="bg-gray">性別</td>
                    <td>{{ (int)$user['gender'] === 1 ? '男性' : ((int)$user['gender'] === 2 ? '女性' : 'その他') }}</td>
                </tr>
                {{-- 5行目 --}}
                <tr class="row">
                    <td class="bg-gray" colspan="1">住所</td>
                    <td colspan="3">{{ $user['address'] }}</td>
                </tr>
                {{-- 6行目 --}}
                <tr class="row">
                    <td class="bg-gray">電話番号</td>
                    <td>{{ $user['tel'] }}</td>
                    <td class="bg-gray">メールアドレス</td>
                    <td>{{ $user['email'] }}</td>
                </tr>
            </table>
            <div>
            </div>
            <div>
                <p class="sub_title"><u>▼お振込み先情報</u></p>
                <table>
                    <tr class="row">
                        <th>銀行名</th>
                        <th>支店名</th>
                        <th>口座種別</th>
                        <th>口座番号</th>
                        <th>口座名義（カナ）</th>
                    </tr>
                    <tr>
                        <td>{{ $user['bank_name'] }}</td>
                        <td>{{ $user['bank_branch_name'] }} ({{ $user['bank_branch_code'] }})</td>
                        <td>{{ $user['bank_account_type'] }}</td>
                        <td>{{ $user['bank_account_number'] }}</td>
                        <td>{{ $user['bank_account_name_kana'] }}</td>
                    </tr>
                </table>
            </div>
            <div class="frame">
                <p class="sub_title"><u>▼商品情報</u></p>
                <table class="product_info_table">
                    <tr>
                        <th>商品名</th>
                        <th>JANコード</th>
                        <th>査定金額</th>
                        <th>数量</th>
                        <th>合計金額（税込）</th>
                    </tr>
                    @foreach($purchase_offer['purchase_targets'] as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['jan_code'] }}</td>
                            <td>¥{{ number_format($item['pivot']['price']) }}</td>
                            <td>{{ $item['pivot']['quantity'] }}</td>
                            <td>¥{{ number_format($item['pivot']['price'] * $item['pivot']['quantity']) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2"></td>
                        <th>合計</th>
                        <td><b>{{ $purchase_offer['purchase_targets']->sum('pivot.quantity') }}</b></td>
                        <td><b>¥{{ number_format($total_price) }}</b></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td>10%対象</td>
                        <td>¥{{ number_format($total_price - $consumption_tax) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td>消費税額</td>
                        <td>¥{{ number_format($consumption_tax) }}</td>
                    </tr>
                </table>
            </div>
            <div>
                <p class="sub_title"><u>▼ご確認･免責事項</u></p>
                <div class="font-small">
                    <p>・ご本人確認の為、運転免許証（表・裏）もしくは健康保険証（表・裏）の確認が必要となります。<br/>
                        ・18歳未満の方・高校生・身分証や確認書類ができない方からの買い取りは行っておりません。<br/>
                        ・確認書類は必ず本人のものをご利用ください。偽造したものや第三者のものを利用した事が発覚した場合は法的措置を取る場合がございます。<br/>
                        ・商品の郵送中に生じた故障、破損、紛失につきましては弊社では一切の責任を負いかねます。<br/>
                        ・商品到着時点の状態により買取不可になる場合や減額になることがございます。<br/>
                        ・100,000以上の振り込みの際は無料にてお振込みさせて頂きます。100,000未満の場合は一律で300円ご負担頂きます。<br/>
                        ・弊社宛ての郵送は全て【元払い】、弊社からの返品は【着払い】での郵送となります。<br/>
                        ・書類・商品の不備があった場合、弊社よりご連絡差し上げますが、場合によっては減額・買取不可・返品になる場合がございます。<br/>
                        ・当依頼書にご記入いただいた個人情報は厳重に管理し、古物営業法上の取引記録、本人確認のため、また古物営業法等法令による要請を除き第三者への提供はいたしません。<br/>
                        ・買取成立後のキャンセルは出来かねます。※返送商品の受け取り拒否・長期不在などで当社に返送された場合は弊社にて商品を全て処分いたします。<br/>
                        ・買取代金は即日～3営業日（土日祝を除く）を目安にお支払いします。※諸事情により支払いが遅くなる場合もございます。<br/>
                        ・免税購入した商品、またはその疑いのある商品は買取できません。<br/>
                        ・虚偽の適格請求書発行事業者登録番号の申告、買取同意書に虚偽の事実を記載されたことが発覚した場合は、お支払い完了後でも買取価格の訂正を行い、その差額をご請求いたします。<br/>
                        ・その他、HPよりご確認くださいませ。</p>
                </div>
            </div>
            <div>
                <table>
                    <tr>
                        <th>適格請求書発行事業者ですか？</th>
                        <th>適格請求書発行事業者登録番号</th>
                    </tr>
                    <tr>
                        <td>{{ $user['is_qualified_supplier'] ? 'はい' : 'いいえ' }}</td>
                        <td>T{{ $user['invoice_number'] }}</td>
                    </tr>
                </table>
            </div>
            <div>
                <div>
                    <p style="text-align: center;">上記に全て同意し、買取を依頼します</p>
                </div>
                <div style="border: 1px solid black; width:50%; margin: 0 auto;">
                    <p style="padding-left: 15px;">ご署名欄</p>
                    <p style="text-align: right; padding-right: 15px;">印</p>
                </div>
            </div>
            <div>
                <p><u>▼ヤマト運輸から発送</u></p>
                <p>〒125-0035 東京都葛飾区南水元2-7-29</p>
            </div>
            <div>
                <p class="bg-gray" style="text-align: center;">※誤った送付先へ発送すると、減額もしくは買取不可・着払返品になる可能性がございます。</p>
            </div>
            <div>
                <p style="text-align: center;">古物商　許可番号　東京都公安委員会　第401300000065号</p>
            </div>
        </div>
    </div>
</section>
</body>
</html>
