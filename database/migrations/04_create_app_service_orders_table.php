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
        Schema::create('app_service_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('address_id')->constrained();
            $table->foreignId('app_service_id')->constrained();
            $table->enum('payment_method', ['visa','cash','wallet','apple_pay'])->default('cash');
            $table->double('price');
            $table->double('deposit')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('deposit_paid',)->default(0);
            $table->timestamp('order_date')->nullable();
            $table->string('video')->nullable();
            $table->string('video_image')->nullable();
            $table->enum('status',['new','in_progress','service_provider_finish','complete','canceled'])->default('new');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_service_orders');
    }
};
