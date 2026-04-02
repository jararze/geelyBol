<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vehicle_hero_configs', function (Blueprint $table) {
            $table->string('title_type')->default('image')->after('text_color');
            $table->string('title_color')->nullable()->after('title_type');
            $table->string('subtitle_color')->nullable()->after('title_color');
            $table->string('specs_text_color')->nullable()->after('subtitle_color');
        });
    }

    public function down(): void
    {
        Schema::table('vehicle_hero_configs', function (Blueprint $table) {
            $table->dropColumn(['title_type', 'title_color', 'subtitle_color', 'specs_text_color']);
        });
    }
};
