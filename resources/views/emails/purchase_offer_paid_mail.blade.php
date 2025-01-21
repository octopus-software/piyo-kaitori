ぴよ買取をご利用いただきまして誠に有難うございます。<br>
お客様から買取申込された商品のお支払いが完了いたしました。<br>
<br>
振込の場合：お客様ご指定の口座にお振込みを完了致しましたので、ご確認ください。<br>
現金支払の場合：現金をお支払致しました。<br>
<br>
【買取オファーの詳細】<br>
<br>
買取ID： {{ $purchase_offer_id }} <br>
<br>
@foreach($purchase_targets as $purchase_target)
{{ $purchase_target['name'] }} <br>
金額：{{ $purchase_target->pivot['price'] }} <br>
数量：{{ $purchase_target->pivot['quantity'] }} <br>
小計：{{ $purchase_target->pivot['price'] * $purchase_target->pivot['quantity'] }} <br>
@endforeach
<br>
【ご注意事項】<br>
※振込の場合、お客様ご指定の金融機関の営業日・営業時間によっては翌日扱いとなる場合がございますのでご了承下さい。<br>
※支払時間を経過したにも関わらずご入金の確認ができない場合や質問がございましたらご連絡ください。<br>
<br>
この度は買取ルデヤをご利用いただきまして誠に有難うございました。<br>
お客様のまたのご利用を心よりお待ちしております。<br>
<br>
━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br>
【ショップ名】ぴよ買取<br>
【e-mail】{{ config('mail')['from']['address'] }} <br>
━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br>