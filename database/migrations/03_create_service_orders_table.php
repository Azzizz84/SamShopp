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
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->foreignId('sub_category_id')->constrained()->onDelete('cascade');
            $table->timestamp('order_date')->nullable();
            $table->string('video')->nullable();
            $table->string('video_image')->nullable();
            $table->enum('payment_method', ['visa','cash','wallet','apple_pay']);
            $table->foreignId('address_id')->constrained()->onDelete('cascade');
            $table->enum('status',['new','in_progress','service_provider_finish','complete','canceled'])->default('new');
            $table->boolean('deposit_paid')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_orders');
    }
};
