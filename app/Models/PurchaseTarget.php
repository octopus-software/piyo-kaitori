<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseTarget extends Model
{
    use HasFactory;

    // リレーション設定
    public function purchase_offers(): HasMany
    {
        return $this->hasMany(PurchaseOffer::class);
    }
}
