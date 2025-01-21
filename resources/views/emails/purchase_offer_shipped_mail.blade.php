お客様が買取商品を発送しましたのでお知らせいたします。<br>
<br>
【買取オファーの詳細】<br>
買取ID：{{ $purchase_offer_id }} <br>
@foreach($purchase_targets as $purchase_target)
<p hidden>{{ $loop->iteration }}</p><br>
{{ $purchase_target['name'] }} <br>
{{ $purchase_target->pivot['price'] }} <br>
数量：{{ $purchase_target->pivot['quantity'] }} <br>
小計：{{ $purchase_target->pivot['price'] * $purchase_target->pivot['quantity'] }} <br>
@endforeach