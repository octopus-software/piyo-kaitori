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
        Schema::table('offer_target', function (Blueprint $table) {
            // evidence_urlのカラム名を変更する
            $table->renameColumn('evidence_url', 'remarks');
            $table->string('remarks', 255)->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offer_target', function (Blueprint $table) {
            $table->string('remarks', 255)->nullable(false)->change();
            $table->renameColumn('remarks', 'evidence_url');
        });
    }
};
