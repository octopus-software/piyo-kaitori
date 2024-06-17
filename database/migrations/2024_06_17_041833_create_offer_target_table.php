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
            $table->unsignedInteger('purchase_offer_id')->references('id')->on('purchase_offers');
            $table->unsignedInteger('purchase_target_id')->references('id')->on('purchase_targets');
            $table->unsignedInteger('price');
            $table->unsignedInteger('amount');
            $table->string('evidence_url',255);
            $table->timestamps();
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
