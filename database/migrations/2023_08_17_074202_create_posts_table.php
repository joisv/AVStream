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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->uuid('user_id');
            $table->foreignId('category_id');
            $table->string('slug');
            $table->boolean('isVip')->default(false);
            $table->string('status')->nullable();
            $table->string('poster_path');
            $table->string('code');
            $table->bigInteger('views')->default(0);
            $table->longText('overview');
            $table->timestamps();
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
