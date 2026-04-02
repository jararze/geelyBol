<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_section_id')->constrained()->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('main_image')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->string('video_url')->nullable();
            $table->string('duration')->nullable();
            $table->string('views')->nullable();
            $table->string('channel')->nullable();
            $table->string('background_overlay')->nullable();
            $table->string('text_color')->nullable();
            $table->integer('column_position')->nullable();
            $table->integer('row_span')->default(1);
            $table->string('alt_text')->nullable();
            $table->boolean('overlay')->default(false);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_section_items');
    }
};
