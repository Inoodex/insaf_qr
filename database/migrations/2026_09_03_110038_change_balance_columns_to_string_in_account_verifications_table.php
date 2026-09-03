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
        Schema::table('account_verifications', function (Blueprint $table) {
            $table->string('certificate_balance')->change();
            $table->string('opening_balance')->change();
            $table->string('closing_balance')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('account_verifications', function (Blueprint $table) {
            $table->decimal('certificate_balance', 15, 2)->change();
            $table->decimal('opening_balance', 15, 2)->change();
            $table->decimal('closing_balance', 15, 2)->change();
        });
    }
};
