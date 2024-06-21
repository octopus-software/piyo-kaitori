<?php

use App\Models\PurchaseTarget;
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
        Schema::table('purchase_targets', function (Blueprint $table) {
            $table->unsignedTinyInteger("is_active")->default(PurchaseTarget::IS_ACTIVE['active'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchase_targets', function (Blueprint $table) {
            $table->unsignedTinyInteger("is_active")->change();
        });
    }
};
