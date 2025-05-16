<?php

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Api\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect('https://market.amaraapp.com.sa/');
});


Route::get('terms',[SettingController::class,'terms'])->name('terms_link');
Route::get('privacy',[SettingController::class,'privacy'])->name('privacy_link');
Route::get('about',[SettingController::class,'about'])->name('about_link');
Route::get('return',[SettingController::class,'return'])->name('return_link');

Route::middleware('auth_api')->group(function () {
    Route::get('/payment/{id}/{type}', [PaymentController::class, 'payment'])->name('moyasar.payment');
    Route::get('/paymentServices/{id}/{type}', [PaymentController::class, 'paymentServices'])->name('moyasar.payment');
    Route::get('/moyasar/callback/{total}/{user_id}/{type}', [PaymentController::class, 'handleCallback'])->name('moyasar.callback');
});
