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
        Schema::create('markets', function (Blueprint $table) {
            $table->id();
            $table->enum('lang', ['ar', 'en'])->default('ar');
            $table->string('logo')->nullable();
            $table->string('image')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->double('lat');
            $table->double('lng');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password');
            $table->boolean('block')->default(false);
            $table->boolean('verified')->default(false);
            $table->boolean('paid')->default(false);
            $table->text('address');
            $table->string('work_hours')->nullable();
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->double('delivery_price',)->default(0);
            $table->double('wallet')->default(0);
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expire_at')->nullable();
            $table->double('package_type')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markets');
    }
};
