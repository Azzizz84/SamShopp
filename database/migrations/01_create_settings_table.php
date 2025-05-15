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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('market_code')->default('Amara46Y');
            $table->string('whatsapp')->nullable();
            $table->text('terms_ar');
            $table->text('terms_en');
            $table->text('privacy_ar');
            $table->text('privacy_en');
            $table->text('return_ar');
            $table->text('return_en');
            $table->text('about_ar');
            $table->text('about_en');
            $table->boolean('payment_activated');
            $table->boolean('must_update_user');
            $table->boolean('must_update_user_ios');
            $table->boolean('must_update_service_provider');
            $table->boolean('must_update_service_provider_ios');
            $table->boolean('must_update_market');
            $table->boolean('must_update_market_ios');
            $table->boolean('open_otp');
            $table->integer('user_version');
            $table->integer('user_ios_version');
            $table->integer('service_provider_version');
            $table->integer('service_provider_ios_version');
            $table->integer('market_version');
            $table->integer('market_version_ios');
            $table->double('verification_cost')->default(0);
            $table->double('verification_cost_one_year')->default(999);
            $table->boolean('show_printer')->default(false);
            $table->timestamps();
        });

        \App\Models\Setting::create(
            [
                'phone' => '0123456789',
                'terms_ar' => '',
                'terms_en' => '',
                'privacy_ar' => '',
                'privacy_en' => '',
                'about_ar' => '',
                'about_en' => '',
                'return_ar' => '',
                'return_en' => '',
                'payment_activated' => 0,
                'must_update_user' => 0,
                'must_update_user_ios' => 0,
                'must_update_service_provider' => 0,
                'must_update_service_provider_ios' => 0,
                'must_update_market' => 0,
                'user_version' => 0,
                'user_ios_version' => 0,
                'service_provider_version' => 0,
                'service_provider_ios_version' => 0,
                'market_version' => 0,
                'market_version_ios' => 0,
                'must_update_market_ios' => 0,
                'open_otp' => 1

            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
