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
        Schema::table('users', function (Blueprint $table) {
            $table->string('name_kana')->nullable();
            $table->date('birthday')->nullable();
            $table->unsignedSmallInteger('gender')->nullable();
            $table->string('post_code')->nullable();
            $table->string('address')->nullable();
            $table->string('tel')->nullable();
            $table->string('job')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch_name')->nullable();
            $table->string('bank_branch_code')->nullable();
            $table->string('bank_account_type')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_name_kana')->nullable();
            $table->boolean('is_qualified_supplier')->default(false);
            $table->string('invoice_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'name_kana',
                'birthday',
                'gender',
                'post_code',
                'address',
                'tel',
                'job',
                'bank_name',
                'bank_branch_name',
                'branch_number',
                'account_type',
                'account_number',
                'account_name_kana',
                'is_qualified_supplier',
                'invoice_number'
            ]);
        });
    }
};
