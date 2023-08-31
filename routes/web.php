<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HttpRequestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PromotionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::match(['GET','POST'],'action',[HttpRequestController::class,'HttpRequest'])->name('http-request');

Route::middleware(['guest:web'])->group(function () {

    Route::get('login',[HomeController::class,'login'])->name('login');
    Route::get('forgot-password',[HomeController::class,'forgotPassword'])->name('forgot-password');
    Route::get('become-member',[HomeController::class,'becomeMember'])->name('become-member');
    Route::match(['GET','POST'],'reset-password/{any}',[HomeController::class,'resetPassword'])->name('reset-password');
});

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('about',[HomeController::class,'about'])->name('about');
Route::get('brands',[HomeController::class,'participatingBusinesses'])->name('participating-businesses');
Route::get('brands/map',[HomeController::class,'brandsMap'])->name('brands-map');
Route::get('brand/detail/{name}',[HomeController::class,'participatingBusinessDetail'])->name('business-detail');
Route::get('deal/detail/{name}',[HomeController::class,'recipeDetail'])->name('recipe-detail');
Route::get('subscription',[HomeController::class,'subscription'])->name('subscription');
Route::get('contact',[HomeController::class,'contact'])->name('contact');

Route::middleware(['custom_auth:web'])->group(function () {

    Route::middleware('verify_payment')->group(function(){
        Route::get('user/welcome',[HomeController::class,'welcome'])->name('welcome');
        Route::get('memberships',[HomeController::class,'membership'])->name('membership');
        Route::get('my-account',[HomeController::class,'myAccount'])->name('my-account');
        Route::get('user/logout',[HomeController::class,'logout'])->name('logout');
        //promotions routes
        Route::prefix('promotions')->name('promotions.')->controller(PromotionController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'promotionDetails')->name('detail');
            Route::post('rating', 'rating')->name('rating');
            Route::post('reply', 'reply')->name('reply');
        });
    });
    Route::get('payment', [PaymentController::class, 'showForm'])->name('payments.showForm');
    Route::post('/payment', [PaymentController::class, 'getPayment'])->name('payments.getPayment');
});

Route::get('user/verify/{name}',[UserController::class,'verifyEmail'])->name('verifyEmail');
Route::match(['get','post'],'user/reset-password/{any}',[UserController::class,'resetPassword'])->name('reset-password');
Route::get( 'encrypt-data', function(){
    return view('encrypt-data');
});
