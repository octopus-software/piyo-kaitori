<?php

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
            $table->renameColumn('send_date', 'shipped_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchase_offers', function (Blueprint $table) {
            $table->renameColumn('shipped_date', 'send_date');
        });
    }
};
