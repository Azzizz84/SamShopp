<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AppServiceOrderController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\MarketController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ServiceOrderController;
use App\Http\Controllers\Api\ServiceOrderOfferController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\UserController;
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

Route::controller(UserController::class)->group(function (){
    Route::post('register','register');
    Route::post('login','login');

    Route::post('can_register','can_register');
    Route::post('check_phone','check_phone');
    Route::post('check_code','check_code');
    Route::post('update_password','update_password');
});


Route::post('logout',[UserController::class,'logout']);
Route::middleware('auth_api')->group(function (){

    ////////////////       User        /////////////////////

    Route::controller(UserController::class)->group(function (){
        Route::get('get_profile','get_profile');
        Route::post('update_profile','update_profile');
        Route::post('charge_wallet','charge_wallet');
        Route::post('charge_wallet_Ser','charge_wallet_Ser');
        Route::post('delete_account','delete_account');

    });



    Route::controller(AddressController::class)->group(function (){
        Route::post('create_address','create_address');
        Route::post('edit_address','edit_address');
        Route::post('delete_address','delete_address');
        Route::post('get_address','get_address');
    });

    Route::controller(ServiceOrderController::class)->group(function (){
        Route::post('create_service_order','create_service_order');
        Route::post('get_user_service_orders','get_user_service_orders');
        Route::post('get_user_service_order','get_user_service_order');
        Route::post('change_deposit_status','change_deposit_status');
        Route::post('update_user_service_order_status','update_user_service_order_status');
    });

    Route::controller(ServiceOrderOfferController::class)->group(function (){
        Route::post('get_service_order_offers','get_service_order_offers');
        Route::post('change_offer_status','change_offer_status');
        Route::post('get_offer_id','get_offer_id');
    });

    Route::controller(MarketController::class)->group(function (){
        Route::post('get_markets','get_markets');
        Route::post('get_market_details','get_market_details');
    });

    Route::controller(CommentController::class)->group(function (){
        Route::post('create_comment','create_comment');
        Route::post('get_comment','get_comment');
    });
    Route::controller(CartController::class)->group(function (){
        Route::post('add_to_cart','add_to_cart');
        Route::post('increase_cart','increase_cart');
        Route::post('decrease_cart','decrease_cart');
        Route::post('delete_cart','delete_cart');
        Route::post('get_cart','get_cart');
    });
    Route::controller(OrderController::class)->group(function (){
        Route::post('create_order','create_order');
        Route::post('get_user_orders','get_user_orders');
        Route::post('get_user_order','get_user_order');
    });
    Route::controller(ChatController::class)->group(function (){
        Route::post('get_service_order_chat','get_service_order_chat');
        Route::post('create_message','create_message');
    });
    Route::controller(AppServiceOrderController::class)->group(function (){
        Route::post('create_app_service_order','create_app_service_order');
        Route::post('get_user_app_service_orders','get_user_app_service_orders');
        Route::post('get_user_app_service_order','get_user_app_service_order');
        Route::post('change_app_service_order_deposit_status','change_app_service_order_deposit_status');
        Route::post('update_user_app_service_order_status','update_user_app_service_order_status');
    });
});



Route::post('login1',[UserController::class,'login']);
Route::post('register1',[UserController::class,'register']);