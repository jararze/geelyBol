<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('feature_title')->nullable()->after('catalog_file_name');
            $table->string('feature_subtitle')->nullable()->after('feature_title');
            $table->string('versions_title')->nullable()->after('feature_subtitle');
            $table->string('versions_subtitle')->nullable()->after('versions_title');
        });

        Schema::table('sales_agents', function (Blueprint $table) {
            $table->json('served_cities')->nullable()->after('branch_id');
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['feature_title', 'feature_subtitle', 'versions_title', 'versions_subtitle']);
        });

        Schema::table('sales_agents', function (Blueprint $table) {
            $table->dropColumn('served_cities');
        });
    }
};
