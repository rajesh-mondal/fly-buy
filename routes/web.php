<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

//Login
Route::get('/login', function(){
    return redirect()->to('/');
})->name('login');
//Register
Route::get('/register', function(){
    return redirect()->to('/');
})->name('register');
Route::get( '/home', [App\Http\Controllers\HomeController::class, 'index'] )->name( 'home' );
Route::get( '/customer/logout', [App\Http\Controllers\HomeController::class, 'logout'] )->name( 'customer.logout' );

//Frontend All Routes
Route::group(['namespace'=>'App\Http\Controllers\Front'], function(){
    Route::get('/','IndexController@index');
    Route::get('/product-details/{slug}','IndexController@productDetails')->name('product.details');

    //review
    Route::post('/store/review','ReviewController@store')->name('store.review');
});

