<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->string('payment_code')->unique()->nullable();
            $table->unsignedBigInteger('plan_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['active', 'cancelled', 'pending', 'expired']);
            $table->decimal('billing_amount', 10,2);
            $table->string('payment_method', 255);
            $table->timestamps();
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
