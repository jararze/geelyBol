<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lead_form_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_form_id')->constrained('lead_forms')->cascadeOnDelete();
            $table->unsignedInteger('order')->default(0);
            $table->enum('type', [
                'text', 'email', 'tel', 'number', 'url', 'textarea',
                'select', 'multi_select', 'radio', 'checkbox_group', 'checkbox',
                'date', 'datetime', 'file', 'hidden',
                'heading', 'paragraph', 'divider',
            ]);
            $table->string('name');
            $table->string('label');
            $table->string('placeholder')->nullable();
            $table->text('help_text')->nullable();
            $table->boolean('is_required')->default(false);
            $table->json('options')->nullable();
            $table->json('validation_rules')->nullable();
            $table->string('default_value')->nullable();
            $table->json('conditional_logic')->nullable();
            $table->enum('width', ['full', 'half', 'third'])->default('full');
            $table->string('section')->nullable();
            $table->timestamps();

            $table->unique(['lead_form_id', 'name']);
            $table->index(['lead_form_id', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_form_fields');
    }
};
