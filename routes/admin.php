<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

Route::group(['namespace'=>'App\Http\Controllers\Admin','middleware'=>'is_admin'], function(){
    Route::get('/admin/home','AdminController@admin')->name('admin.home');
    Route::get('/admin/logout','AdminController@logout')->name('admin.logout');

    //Category Route
    Route::group(['prefix'=>'category'], function(){
        Route::get('/','CategoryController@index')->name('category.index');
        Route::post('/store','CategoryController@store')->name('category.store');
        Route::get('/delete/{id}','CategoryController@destroy')->name('category.delete');
        Route::get('/edit/{id}','CategoryController@edit');
        Route::post('/update','CategoryController@update')->name('category.update');
    });

    //Subcategory Route
    Route::group(['prefix'=>'subcategory'], function(){
        Route::get('/','SubcategoryController@index')->name('subcategory.index');
        Route::post('/store','SubcategoryController@store')->name('subcategory.store');
        Route::get('/delete/{id}','SubcategoryController@destroy')->name('subcategory.delete');
        Route::get('/edit/{id}','SubcategoryController@edit');
        Route::post('/update','SubcategoryController@update')->name('subcategory.update');
    });
});