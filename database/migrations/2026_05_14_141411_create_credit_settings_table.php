<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credit_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('interest_rate_annual', 5, 2)->default(12);
            $table->decimal('min_initial_percentage', 5, 2)->default(20);
            $table->decimal('max_finance_percentage', 5, 2)->default(80);
            $table->json('available_terms');
            $table->decimal('min_amount', 12, 2)->default(5000);
            $table->decimal('max_amount', 12, 2)->default(80000);
            $table->string('currency', 8)->default('USD');
            $table->text('legal_disclaimer')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credit_settings');
    }
};
