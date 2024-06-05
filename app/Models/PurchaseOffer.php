<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseOffer extends Model
{
    use HasFactory;

    // リレーション設定
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // リレーション設定
    public function purchase_target(): BelongsTo
    {
        return $this->belongsTo(PurchaseTarget::class);
    }

}
