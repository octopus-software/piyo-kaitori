買取オファーが作成されました。<br>
<br>
【買取オファーの詳細】<br>
買取ID：{{ $purchase_offer_id }} <br>
@foreach($purchase_targets as $purchase_target)
<p hidden>{{ $loop->iteration }}</p><br>
{{ $purchase_target['name'] }} <br>
金額：¥{{ number_format($purchase_target->pivot['price']) }} <br>
数量：{{ $purchase_target->pivot['quantity'] }} <br>
小計：{{ number_format($purchase_target->pivot['price'] * $purchase_target->pivot['quantity']) }} <br>
@endforeach