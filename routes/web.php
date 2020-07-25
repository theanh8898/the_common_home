<?php

use Illuminate\Support\Facades\Auth;
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

    Route::redirect('/', '/home');

    Route::get('/home', 'HomeController@index')->name(HOME);
    Route::get('/post/{id}', 'PostController@index')->name('POST');

    Route::prefix('categories')->group(function () {
        Route::get('/create', 'CategoriesController@create')->name(CREATE_CATEGORY);
        Route::post('/store', 'CategoriesController@store')->name(STORE_CATEGORY);
        Route::delete('/delete/{id}', 'CategoriesController@destroy')->name(DELETE_CATEGORY);
        Route::get('edit/{id}', 'CategoriesController@edit')->name(EDIT_CATEGORY);
        Route::put('update/{id}', 'CategoriesController@update')->name(UPDATE_CATEGORY);
        Route::get('/', 'CategoriesController@index')->name(LIST_CATEGORY);
        Route::get('/{id}', 'CategoriesController@show')->name(DETAIL_CATEGORY);

    });

    Route::prefix('articles')->group(function () {
        Route::get('/create', 'ArticlesController@create')->name(CREATE_ARTICLE);
        Route::post('/store', 'ArticlesController@store')->name(STORE_ARTICLE);
        Route::delete('/delete/{id}', 'ArticlesController@destroy')->name(DELETE_ARTICLE);
        Route::get('/', 'ArticlesController@index')->name(LIST_ARTICLE);
        Route::get('/{id}', 'ArticlesController@show')->name(DETAIL_ARTICLE);

    });

