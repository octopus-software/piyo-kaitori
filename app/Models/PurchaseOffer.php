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
        "shipped" => 3,
        "paid" => 4
    ];

    const purchase_method = [
        "direct" => 1,
        "ship" => 2
    ];

    const transaction_method = [
        "yahuoku" => 1,
        "rakuma" => 2,
        "payfuri" => 3
    ];

    const identification_document_type = [
        "residence_record" => 1,
        "family_register" => 2,
        "seal_registration_certificate" => 3,
        "driver_license" => 4,
        "health_insurance_card" => 5,
        "others" => 6
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
