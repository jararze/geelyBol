<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lead_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('success_message')->nullable();
            $table->string('submit_button_text')->default('Enviar');
            $table->json('notification_emails')->nullable();
            $table->string('email_subject')->nullable();
            $table->string('public_url')->unique()->nullable();
            $table->string('redirect_url')->nullable();
            $table->boolean('send_confirmation_to_user')->default(false);
            $table->string('confirmation_email_field')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('submit_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_forms');
    }
};
