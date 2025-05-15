<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('password');
            $table->boolean('super')->default(false);
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->timestamps();
        });
        Admin::create([
            'name'=>env('APP_NAME'),
            "email"=>'admin@admin.com',
            "phone"=>'555555555',
            "super"=>true,
            "role_id"=>0,
            "password"=>Hash::make('123456')
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
