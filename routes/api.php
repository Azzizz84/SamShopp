<?php

use App\Http\Controllers\Api\AppServiceOrderController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\MarketController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\SubCategoryController;
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


Route::post('get_services',[AppServiceOrderController::class,'get_services']);
Route::get('get_settings',[SettingController::class,'get_settings']);
Route::get('get_cities',[CityController::class,'get_cities']);
Route::post('get_notification',[NotificationController::class,'get_notification']);
Route::post('contact_us',[ContactUsController::class,'contact_us']);
Route::get('get_banners',[BannerController::class,'get_banners']);
Route::post('get_categories',[CategoryController::class,'get_categories']);
Route::post('get_sub_category',[SubCategoryController::class,'get_sub_category']);
Route::post('get_markets',[MarketController::class,'get_markets']);
