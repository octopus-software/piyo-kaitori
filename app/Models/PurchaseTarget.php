<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseTarget extends Model
{
    use HasFactory;

    const IS_ACTIVE = [
        'active' => 1,
        'inactive' => 0
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'jan_code',
        'image_url',
        'max_quantity',
        'is_active'
    ];

    // リレーション設定
    public function purchase_offers(): BelongsToMany
    {
        return $this->belongsToMany(PurchaseOffer::class,'offer_target')->withPivot(['price','quantity','evidence_url']);
    }
}
