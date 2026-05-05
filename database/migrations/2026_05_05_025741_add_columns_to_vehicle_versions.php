<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vehicle_versions', function (Blueprint $table) {
            $table->boolean('turbo')->default(false)->after('engine_displacement');
            $table->string('catalog_pdf_url')->nullable()->after('interior_image');
            $table->string('exterior_image')->nullable()->after('interior_image');
        });
    }

    public function down(): void
    {
        Schema::table('vehicle_versions', function (Blueprint $table) {
            $table->dropColumn(['turbo', 'catalog_pdf_url', 'exterior_image']);
        });
    }
};
