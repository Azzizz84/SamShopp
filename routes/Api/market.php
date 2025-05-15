<?php

use App\Http\Controllers\Api\MarketController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\VerifyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(MarketController::class)->group(function (){
    Route::post('register','register');
    Route::post('login','login');
    Route::post('can_register','can_register');
    Route::post('check_phone','check_phone');
    Route::post('check_code','check_code');
    Route::post('update_password','update_password');
    Route::post('refresh_token','refresh_token');
    Route::post('logout','logout');
});

Route::middleware('auth_api')->group(function (){

    ////////////////       User        /////////////////////
    Route::controller(MarketController::class)->group(function (){
        Route::get('get_profile','get_profile');
        Route::post('update_profile','update_profile');
        Route::post('delete_account','delete_account');
        Route::post('change_status','change_status');
    });

    Route::controller(OrderController::class)->group(function (){
        Route::post('get_market_orders','get_market_orders');
        Route::post('get_market_order','get_market_order');
        Route::post('update_order_status','update_order_status');
    });

    Route::controller(SectionController::class)->group(function (){
        Route::post('get_menu','get_menu');
        Route::post('create_section','create_section');
        Route::post('update_section','update_section');
        Route::post('delete_section','delete_section');
    });
    Route::controller(ProductController::class)->group(function (){
        Route::post('create_product','create_product');
        Route::post('update_product','update_product');
        Route::post('delete_product','delete_product');
    });
    Route::controller(VerifyController::class)->group(function (){
        Route::post('verify_market','verify_market');
        Route::post('pay_verification_wallet','pay_verification_wallet');
        Route::get('pay_verification_online','pay_verification_online');
    });

});
