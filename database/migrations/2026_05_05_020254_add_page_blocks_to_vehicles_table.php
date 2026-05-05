<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->json('page_blocks')->nullable()->after('versions_subtitle');
            $table->json('specs')->nullable()->after('page_blocks');
            $table->boolean('is_published')->default(false)->after('specs');
            $table->string('seo_title')->nullable()->after('is_published');
            $table->text('seo_description')->nullable()->after('seo_title');
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['page_blocks', 'specs', 'is_published', 'seo_title', 'seo_description']);
        });
    }
};
