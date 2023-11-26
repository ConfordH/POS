<?php

use Illuminate\Http\Request;

Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');

// Require Authentication
Route::middleware('auth:api')->group(function(){
    Route::get('/user-profile', 'API\AuthController@profile');
    //category
    Route::get('/categories', 'Category\CategoryController@index');
    Route::get('/categories/{slug}', 'Category\CategoryController@show');
    Route::post('/categories/{slug}', 'Category\CategoryController@update');
    Route::delete('/categories/{slug}', 'Category\CategoryController@destroy');
    Route::post('/categories', 'Category\CategoryController@store');

    //product
    Route::get('/products', 'Product\ProductController@index');
    Route::get('/products/{slug}', 'Product\ProductController@show');
    Route::put('/products/{slug}', 'Product\ProductController@update');
    Route::delete('/products/{slug}', 'Product\ProductController@destroy');
    Route::post('/products', 'Product\ProductController@store');

    //product
    Route::get('/transactions', 'Transaction\TransactionController@index');
    Route::get('/transactions/{slug}', 'Transaction\TransactionController@show');
    Route::put('/transactions/{slug}', 'Transaction\TransactionController@update');
    Route::delete('/transactions/{slug}', 'Transaction\TransactionController@destroy');
    Route::post('/transactions', 'Transaction\TransactionController@store');
});