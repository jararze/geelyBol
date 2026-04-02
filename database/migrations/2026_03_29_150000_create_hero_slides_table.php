<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('gradient_from')->nullable();
            $table->string('gradient_to')->nullable();
            $table->string('media_src')->nullable();
            $table->string('media_src_mobile')->nullable();
            $table->enum('media_type', ['image', 'video'])->default('image');
            $table->string('button_text')->nullable();
            $table->string('button_action')->nullable();
            $table->string('button_url')->nullable();
            $table->string('text_color')->default('#ffffff');
            $table->decimal('overlay_opacity', 3, 2)->default(0.00);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};
