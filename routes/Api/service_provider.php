<?php

use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\ServiceOrderController;
use App\Http\Controllers\Api\ServiceOrderOfferController;
use App\Http\Controllers\Api\ServiceProviderController;
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


Route::controller(ServiceProviderController::class)->group(function (){
    Route::post('register','register');
    Route::post('login','login');
    Route::post('can_register','can_register');
    Route::post('check_phone','check_phone');
    Route::post('check_code','check_code');
    Route::post('update_password','update_password');
    Route::post('logout','logout');
});


Route::middleware('auth_api')->group(function (){

    ////////////////       User        /////////////////////
    Route::controller(ServiceProviderController::class)->group(function (){
        Route::get('get_profile','get_profile');
        Route::post('update_profile','update_profile');

        Route::post('delete_account','delete_account');
        Route::post('change_status','change_status');
    });

    Route::controller(ServiceOrderController::class)->group(function (){
        Route::post('get_service_provider_orders','get_service_provider_orders');
        Route::post('get_service_provider_new_orders','get_service_provider_new_orders');
        Route::post('get_service_provider_order','get_service_provider_order');
        Route::post('update_service_provider_order_status','update_service_provider_order_status');
        Route::post('change_deposit_status','change_deposit_status');
    });
    Route::controller(ServiceOrderOfferController::class)->group(function (){
        Route::post('create_offer','create_offer');
    });

    Route::controller(ChatController::class)->group(function (){
        Route::post('get_service_order_chat','get_service_order_chat');
        Route::post('create_message','create_message');
    });



});
