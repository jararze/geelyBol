<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->string('image_mobile')->nullable()->after('image');
        });

        Schema::table('vehicle_hero_configs', function (Blueprint $table) {
            $table->unique('vehicle_id');
        });
    }

    public function down(): void
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->dropColumn('image_mobile');
        });

        Schema::table('vehicle_hero_configs', function (Blueprint $table) {
            $table->dropUnique(['vehicle_id']);
        });
    }
};
