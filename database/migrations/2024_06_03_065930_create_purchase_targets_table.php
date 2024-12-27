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
        Schema::create('purchase_targets', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("jan_code",255)->unique();
            $table->string("image_url",255)->nullable();
            $table->unsignedInteger("max_quantity");
            $table->unsignedTinyInteger("is_active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_targets');
    }
};
