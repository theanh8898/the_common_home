<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api'], static function () {

    Route::prefix('categories')->group(function () {
        Route::get('/', 'CategoriesController@index');
        Route::get('/{id}', 'CategoriesController@show');
    });

    Route::prefix('articles')->group(function () {
        Route::get('/', 'ArticlesController@index');
        Route::get('/{id}', 'ArticlesController@show');
    });

});
