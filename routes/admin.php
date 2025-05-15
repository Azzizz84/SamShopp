<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AppServiceOrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MarketController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceOrderController;
use App\Http\Controllers\Admin\ServiceProviderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\UserController;
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

Route::group(['prefix' => 'admin','middleware'=>["web","lang"]], function () {
    Route::controller(AdminController::class)->group(function (){
        Route::get('login','index')->name('login');
        Route::post('send_login','login')->name('send_login');
    });
    Route::group(['middleware' => ['admin','lang']], function () {
        Route::get('change_lang/{lang}',[HomeController::class,'change_lang'])->name('change_lang');
        Route::get('home',[HomeController::class,'index'])->name('home');

        Route::controller(UserController::class)->group(function (){
            Route::get('users','index')->name('users');
            Route::post('user/update_wallet','update_wallet')->name('user.update_wallet');
            Route::post('user/update_block','update_block')->name('user.update_block');
            Route::post('user/user_delete','delete')->name('user.delete');
            Route::get('user/details/{id}','user_details')->name('user.details');
        });
        Route::controller(ServiceProviderController::class)->group(function (){
            Route::get('service_providers','index')->name('service_providers');
            Route::post('service_provider/update_wallet','update_wallet')->name('service_provider.update_wallet');
            Route::post('service_provider/update_block','update_block')->name('service_provider.update_block');
            Route::post('service_provider/service_provider_delete','delete')->name('service_provider.delete');
            Route::get('service_provider/details/{id}','service_provider_details')->name('service_provider.details');
        });



        Route::group(['prefix' => 'categories',"controller"=>CategoryController::class], function () {
            Route::get('/','index')->name('categories');
            Route::get('add_category','add')->name('category.add');
            Route::post('store_category','store')->name('category_store');
            Route::get('edit_category/{id}','edit')->name('category.edit');
            Route::post('update_category','update')->name('category_update');
            Route::post('delete_category','delete')->name('category.delete');
        });
        Route::group(['prefix' => 'services',"controller"=>ServiceController::class], function () {
            Route::get('/','index')->name('services');
            Route::get('/details/{id}','service_details')->name('service.details');
            Route::post('/get_sub_categories','get_sub_categories')->name('admin.sub_categories');
            Route::get('add_service','add')->name('service.add');
            Route::post('store_service','store')->name('service_store');
            Route::get('edit_service/{id}','edit')->name('service.edit');
            Route::post('update_service','update')->name('service_update');
            Route::post('delete_service','delete')->name('service.delete');
        });

        Route::group(['prefix' => 'category/{categoryId}/subcategories',"controller"=>SubCategoryController::class], function () {
            Route::get('/','index')->name('sub_categories');
            Route::get('add_sub_category','add')->name('sub_category.add');
            Route::post('store_sub_category','store')->name('sub_category_store');
            Route::get('edit_sub_category/{id}','edit')->name('sub_category.edit');
            Route::post('update_sub_category','update')->name('sub_category_update');
            Route::post('delete_sub_category','delete')->name('sub_category.delete');
        });

        Route::group(['prefix' => 'cities', "controller" => CityController::class], function () {
            Route::get('/city/change/{id}', 'change')->name('city.change');
            Route::get('/', 'index')->name('cities');
            Route::get('add_city', 'add_city')->name('cities.add');
            Route::post('store_city', 'store')->name('city_store');
            Route::get('edit_city/{id}', 'edit')->name('city.edit');
            Route::post('update_city', 'update')->name('city_update');
            Route::post('delete_city', 'delete')->name('city.delete');
        });

        Route::group(['prefix' => 'banners',"controller"=>BannerController::class], function () {
            Route::get('/','index')->name('banners');
            Route::get('add_banner','add')->name('banner.add');
            Route::post('store_banner','store')->name('banner_store');
            Route::post('delete_banner','delete')->name('banner.delete');
        });

        Route::group(['prefix' => 'markets',"controller"=>MarketController::class], function () {
            Route::get('/','index')->name('markets');
            Route::post('delete_market','delete')->name('markets.delete');
            Route::get('markets/details/{id}','market_details')->name('markets.details');
            Route::post('update_wallet','update_wallet')->name('market.update_wallet');
            Route::post('update_block','update_block')->name('market.update_block');

            Route::get('markets/{id}/verifications','verifications')->name('verifications');
            Route::post('market/update_active','update_active')->name('market.update_active');

        });


        Route::group(['prefix' => 'markets/{marketId}/rates',"controller"=>CommentController::class], function () {
            Route::get('/','index')->name('rates');
            Route::post('delete_rate','delete')->name('rate.delete');
        });


        Route::group(['prefix' => 'markets/{marketId}/sections',"controller"=>SectionController::class], function () {
            Route::get('/','index')->name('sections');
            Route::post('delete_section','delete')->name('section.delete');
        });

        Route::group(['prefix' => 'markets/{marketId}/section/{sectionId}/products',
            "controller"=>ProductController::class], function () {
            Route::get('/','index')->name('products');
            Route::post('delete_product','delete')->name('product.delete');
        });




        Route::group(['prefix' => 'orders',"controller"=>OrderController::class], function () {
            Route::get('/','index')->name('orders');
            Route::get('{type}/{id}','users_orders')->name('orders.users');
            Route::post('delete_order','delete')->name('order.delete');
        });
        Route::group(['prefix' => 'order/{orderId}/order_product',"controller"=>OrderController::class], function () {
            Route::get('/','order_product')->name('order_product');
        });

        Route::group(['prefix' => 'service_orders',"controller"=>ServiceOrderController::class], function () {
            Route::get('/','index')->name('service_orders');
            Route::get('{type}/{id}','users_orders')->name('service_orders.users');
            Route::post('delete_order','delete')->name('service_orders.delete');
            Route::post('update_order','update_order')->name('order.update_status');
        });

        Route::group(['prefix' => 'app_service_orders',"controller"=>AppServiceOrderController::class], function () {
            Route::get('/','index')->name('app_service_orders');
            Route::get('user/{id}','users_orders')->name('app_service_orders.users');
            Route::post('delete_order','delete')->name('app_service_orders.delete');
            Route::post('update_order','update_order')->name('app_service_order.update_status');
        });


        Route::group(['prefix' => 'app_service_order/{serviceOrderId}/images',"controller"=>AppServiceOrderController::class], function () {
            Route::get('images','images')->name('app_service_order.images');
        });


        Route::group(['prefix' => 'service_order/{serviceOrderId}/images',"controller"=>ServiceOrderController::class], function () {
            Route::get('images','images')->name('service_provider.images');
            Route::get('finish_images','finish_images')->name('service_provider.finish_image');
        });


        Route::group(['prefix' => 'contact_us',"controller"=>ContactUsController::class],function (){
            Route::get('/','index')->name('contact_us');
           Route::post('delete_contact_us','delete')->name('contact_us.delete');
        });






        Route::group(['prefix' => 'settings',"controller"=>SettingController::class], function () {
            Route::get('/','index')->name('settings');
            Route::post('update_settings','update')->name('settings.update');
        });

        Route::group(['prefix' => 'permissions',"controller"=>RoleController::class], function () {
            Route::get('/','index')->name('permissions');
            Route::get('add_permission','add')->name('permission.add');
            Route::post('store_permission','store')->name('permission_store');
            Route::get('edit_permission/{id}','edit')->name('permission.edit');
            Route::post('update_permission','update')->name('permission_update');
            Route::post('delete_permission','delete')->name('permission.delete');
        });


        Route::group(['prefix' => 'admins',"controller"=>AdminController::class], function () {
            Route::get('/','admins')->name('admins');
            Route::get('add_admin','add')->name('admin.add');
            Route::post('store_admin','store')->name('admin_store');
            Route::get('edit_admin/{id}','edit')->name('admin.edit');
            Route::post('update_admin','update')->name('admin_update');
            Route::post('delete_admin','delete')->name('admin.delete');
            Route::get('logout','logout')->name('admin.logout');
        });




        Route::group(['prefix' => 'notifications',"controller"=>NotificationController::class], function () {
            Route::get('/','index')->name('notifications');
            Route::get('add_notification','add')->name('notification.add');
            Route::post('store_notification','store')->name('notification_store');
            Route::get('edit_notification/{id}','edit')->name('notification.edit');
            Route::post('update_notification','update')->name('notification_update');
            Route::post('delete_notification','delete')->name('notification.delete');
        });





        Route::get('theme',function (){
            return view('admin.pages.theme.theme');
        })->name('theme');


    });

});
