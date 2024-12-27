<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOffer extends Model
{
    use HasFactory;

    const STATUS = [
        "unapproved" => 1,
        "approved" => 2,
        "send" => 3,
        "paid" => 4
    ];

    // リレーション設定
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // リレーション設定
    public function purchase_targets(): BelongsToMany
    {
        return $this->belongsToMany(PurchaseTarget::class,'offer_target')->withPivot(['price','quantity','evidence_url']);
    }

    protected $guarded = ['id'];

}
