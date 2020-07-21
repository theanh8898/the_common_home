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

Route::middleware(['auth'])->group(function () {
    Route::redirect('/', '/home');

    Route::get('/home', 'HomeController@index')->name(HOME);

    Route::prefix('categories')->group(function () {
        Route::get('/', 'CategoriesController@index')->name(LIST_CATEGORY);
        Route::get('/create', 'CategoriesController@create')->name(CREATE_CATEGORY);
        Route::post('/store', 'CategoriesController@store')->name(STORE_CATEGORY);
//        Route::delete('/delete/{id}', 'UserController@destroy')->name(DELETE_USER);
        Route::get('edit/{id}', 'CategoriesController@edit')->name(EDIT_CATEGORY);
        Route::put('update/{id}', 'CategoriesController@update')->name(UPDATE_CATEGORY);
//        Route::get('/change-password', 'UserController@editPassword')->name(EDIT_PASSWORD);
//        Route::patch('/update-password', 'UserController@changePassword')->name(UPDATE_PASSWORD);
//        Route::post('check-password', 'UserController@checkPass')->name(CHECK_PASSWORD);
    });

    Route::resource('articles', 'ArticlesController');

});
