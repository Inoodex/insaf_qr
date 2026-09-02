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
        Schema::create('account_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_uuid', 255)->unique();
            $table->string('statement_uuid', 255)->unique();
            $table->string('account_no')->unique();
            $table->string('account_name');
            $table->decimal('certificate_balance', 15, 2);
            $table->decimal('opening_balance', 15, 2);
            $table->decimal('closing_balance', 15, 2);
            $table->date('report_generation_date');
            $table->string('currency', 10)->default('BDT');
            $table->string('bank_name')->default('Dutch-Bangla Bank PLC.');
            $table->string('branch_name')->nullable();
            $table->string('account_type')->nullable()->default('Savings Account');
            $table->string('status', 20)->default('valid'); // valid, revoked, expired
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_verifications');
    }
};
