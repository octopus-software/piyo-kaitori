<?php

use App\Models\PurchaseOffer;
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
        Schema::table('purchase_offers', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('amount');
            $table->dropColumn('evidence_url');
            $table->dropForeign('purchase_offers_purchase_target_id_foreign');
            $table->dropColumn('purchase_target_id');
            $table->unsignedInteger('status')->default(PurchaseOffer::STATUS['unapproved'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchase_offers', function (Blueprint $table) {
            $table->unsignedInteger('price');
            $table->unsignedInteger('amount');
            $table->string('evidence_url',255);
            $table->unsignedBigInteger('purchase_target_id');
            $table->foreign('purchase_target_id')->references('id')->on('purchase_targets');
            $table->unsignedInteger('status')->change();
        });
    }
};
