<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'v1'], function() {
    Route::group(['middleware' => []],function(){
        Route::post('/authentication', 'AuthController@postAuthentication');
    });

// Co header la "Bearer + token" thi duoc vao
    Route::group(['middleware' => 'jwt.auth'],function(){
        Route::get('/authorization', 'AuthController@getAuthorization');

        Route::group(['middleware' => 'user', 'prefix' => 'users'], function () {
            Route::get('/', 'UserController@getReadAll');
            Route::get('/search', 'UserController@getSearchOne');
            Route::get('/{id}', 'UserController@getReadOne');
            Route::post('/', 'UserController@postCreateOne');
            Route::post('/change-password', 'UserController@postChangePassword');
            Route::put('/', 'UserController@putUpdateOne');
            Route::patch('/', 'UserController@patchDeactivateOne');
            Route::delete('/{id}', 'UserController@deleteDeleteOne');
        });

        Route::group(['middleware' => 'product', 'prefix' => 'products'], function () {
            Route::get('/', 'ProductController@getReadAll');
            Route::get('/search', 'ProductController@getSearchOne');
            Route::get('/{id}', 'ProductController@getReadOne');
            Route::post('/', 'ProductController@postCreateOne');
            Route::put('/', 'ProductController@putUpdateOne');
            Route::patch('/', 'ProductController@patchDeactivateOne');
            Route::delete('/{id}', 'ProductController@deleteDeleteOne');
        });

        Route::group(['middleware' => 'unit', 'prefix' => 'units'], function () {
            Route::get('/', 'UnitController@getReadAll');
            Route::get('/search', 'UnitController@getSearchOne');
            Route::get('/{id}', 'UnitController@getReadOne');
            Route::post('/', 'UnitController@postCreateOne');
            Route::put('/', 'UnitController@putUpdateOne');
            Route::patch('/', 'UnitController@patchDeactivateOne');
            Route::delete('/{id}', 'UnitController@deleteDeleteOne');
        });

        Route::group(['middleware' => 'position', 'prefix' => 'positions'], function () {
            Route::get('/', 'PositionController@getReadAll');
            Route::get('/search', 'PositionController@getSearchOne');
            Route::get('/{id}', 'PositionController@getReadOne');
            Route::post('/', 'PositionController@postCreateOne');
            Route::put('/', 'PositionController@putUpdateOne');
            Route::patch('/', 'PositionController@patchDeactivateOne');
            Route::delete('/{id}', 'PositionController@deleteDeleteOne');
        });

        Route::group(['middleware' => 'postage', 'prefix' => 'postages'], function () {
            Route::get('/', 'PostageController@getReadAll');
            Route::get('/search', 'PostageController@getSearchOne');
            Route::get('/{id}', 'PostageController@getReadOne');
            Route::post('/', 'PostageController@postCreateOne');
            Route::put('/', 'PostageController@putUpdateOne');
            Route::patch('/', 'PostageController@patchDeactivateOne');
            Route::delete('/{id}', 'PostageController@deleteDeleteOne');
        });

        Route::group(['middleware' => 'transport', 'prefix' => 'transports'], function () {
            Route::get('/find-formulas', 'TransportController@getReadFormulas');

            Route::get('/', 'TransportController@getReadAll');
            Route::get('/search', 'TransportController@getSearchOne');
            Route::get('/{id}', 'TransportController@getReadOne');
            Route::post('/', 'TransportController@postCreateOne');
            Route::put('/', 'TransportController@putUpdateOne');
            Route::patch('/', 'TransportController@patchDeactivateOne');
            Route::delete('/{id}', 'TransportController@deleteDeleteOne');

        });
    });
});


