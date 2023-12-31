<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->longText('terms')->nullable();
            $table->longText('about')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('banner_video_url')->nullable();
            $table->text('keywords')->nullable();
            $table->longText('warning_message')->nullable();
            $table->boolean('is_warning_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_settings');
    }
};
