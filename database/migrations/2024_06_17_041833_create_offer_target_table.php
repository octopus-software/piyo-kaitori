<?php

use App\Models\OfferTarget;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offer_target', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_offer_id');
            $table->unsignedBigInteger('purchase_target_id');
            $table->unsignedInteger('price');
            $table->unsignedInteger('quantity');
            $table->string('evidence_url',255);
            $table->timestamps();

            // 外部キーを作成する
            $table->foreign('purchase_offer_id')->references('id')->on('purchase_offers');
            $table->foreign('purchase_target_id')->references('id')->on('purchase_targets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_target');
    }
};
