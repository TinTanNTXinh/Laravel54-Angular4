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

Route::group(['prefix' => 'v1'], function () {
    Route::group(['middleware' => []], function () {
        Route::post('/authentication', 'AuthController@postAuthentication');
    });

    // Co header la "Bearer + token" thi duoc vao
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('/authorization', 'AuthController@getAuthorization');

        /** MAIN **/
        Route::group(['middleware' => 'position', 'prefix' => 'positions'], function () {
            Route::get('/', 'PositionController@getReadAll');
            Route::get('/search', 'PositionController@getSearchOne');
            Route::get('/{id}', 'PositionController@getReadOne');
            Route::post('/', 'PositionController@postCreateOne');
            Route::put('/', 'PositionController@putUpdateOne');
            Route::patch('/', 'PositionController@patchDeactivateOne');
            Route::delete('/{id}', 'PositionController@deleteDeleteOne');
        });

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

        Route::group(['middleware' => 'customer', 'prefix' => 'customers'], function () {
            Route::get('/', 'CustomerController@getReadAll');
            Route::get('/search', 'CustomerController@getSearchOne');
            Route::get('/{id}', 'CustomerController@getReadOne');
            Route::post('/', 'CustomerController@postCreateOne');
            Route::put('/', 'CustomerController@putUpdateOne');
            Route::patch('/', 'CustomerController@patchDeactivateOne');
            Route::delete('/{id}', 'CustomerController@deleteDeleteOne');
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
            Route::get('/find-postage', 'TransportController@getReadPostage');

            Route::get('/', 'TransportController@getReadAll');
            Route::get('/search', 'TransportController@getSearchOne');
            Route::get('/{id}', 'TransportController@getReadOne');
            Route::post('/', 'TransportController@postCreateOne');
            Route::put('/', 'TransportController@putUpdateOne');
            Route::patch('/', 'TransportController@patchDeactivateOne');
            Route::delete('/{id}', 'TransportController@deleteDeleteOne');
        });

        Route::group(['middleware' => 'garage', 'prefix' => 'garages'], function () {
            Route::get('/', 'GarageController@getReadAll');
            Route::get('/search', 'GarageController@getSearchOne');
            Route::get('/{id}', 'GarageController@getReadOne');
            Route::post('/', 'GarageController@postCreateOne');
            Route::put('/', 'GarageController@putUpdateOne');
            Route::patch('/', 'GarageController@patchDeactivateOne');
            Route::delete('/{id}', 'GarageController@deleteDeleteOne');
        });

        Route::group(['middleware' => 'truck', 'prefix' => 'trucks'], function () {
            Route::get('/', 'TruckController@getReadAll');
            Route::get('/search', 'TruckController@getSearchOne');
            Route::get('/{id}', 'TruckController@getReadOne');
            Route::post('/', 'TruckController@postCreateOne');
            Route::put('/', 'TruckController@putUpdateOne');
            Route::patch('/', 'TruckController@patchDeactivateOne');
            Route::delete('/{id}', 'TruckController@deleteDeleteOne');
        });

        Route::group(['middleware' => 'driver', 'prefix' => 'drivers'], function () {
            Route::get('/', 'DriverController@getReadAll');
            Route::get('/search', 'DriverController@getSearchOne');
            Route::get('/{id}', 'DriverController@getReadOne');
            Route::post('/', 'DriverController@postCreateOne');
            Route::put('/', 'DriverController@putUpdateOne');
            Route::patch('/', 'DriverController@patchDeactivateOne');
            Route::delete('/{id}', 'DriverController@deleteDeleteOne');
        });

        Route::group(['middleware' => 'oil', 'prefix' => 'oils'], function () {
            Route::get('/', 'OilController@getReadAll');
            Route::get('/search', 'OilController@getSearchOne');
            Route::get('/{id}', 'OilController@getReadOne');
            Route::post('/', 'OilController@postCreateOne');
            Route::put('/', 'OilController@putUpdateOne');
            Route::patch('/', 'OilController@patchDeactivateOne');
            Route::delete('/{id}', 'OilController@deleteDeleteOne');
        });

        Route::group(['middleware' => 'lube', 'prefix' => 'lubes'], function () {
            Route::get('/', 'LubeController@getReadAll');
            Route::get('/search', 'LubeController@getSearchOne');
            Route::get('/{id}', 'LubeController@getReadOne');
            Route::post('/', 'LubeController@postCreateOne');
            Route::put('/', 'LubeController@putUpdateOne');
            Route::patch('/', 'LubeController@patchDeactivateOne');
            Route::delete('/{id}', 'LubeController@deleteDeleteOne');
        });

        Route::group(['middleware' => 'cost-oil', 'prefix' => 'cost-oils'], function () {
            Route::get('/', 'CostOilController@getReadAll');
            Route::get('/search', 'CostOilController@getSearchOne');
            Route::get('/{id}', 'CostOilController@getReadOne');
            Route::post('/', 'CostOilController@postCreateOne');
            Route::put('/', 'CostOilController@putUpdateOne');
            Route::patch('/', 'CostOilController@patchDeactivateOne');
            Route::delete('/{id}', 'CostOilController@deleteDeleteOne');
        });

        Route::group(['middleware' => 'cost-lube', 'prefix' => 'cost-lubes'], function () {
            Route::get('/', 'CostLubeController@getReadAll');
            Route::get('/search', 'CostLubeController@getSearchOne');
            Route::get('/{id}', 'CostLubeController@getReadOne');
            Route::post('/', 'CostLubeController@postCreateOne');
            Route::put('/', 'CostLubeController@putUpdateOne');
            Route::patch('/', 'CostLubeController@patchDeactivateOne');
            Route::delete('/{id}', 'CostLubeController@deleteDeleteOne');
        });

        Route::group(['middleware' => 'cost-park', 'prefix' => 'cost-parks'], function () {
            Route::get('/', 'CostParkController@getReadAll');
            Route::get('/search', 'CostParkController@getSearchOne');
            Route::get('/{id}', 'CostParkController@getReadOne');
            Route::post('/', 'CostParkController@postCreateOne');
            Route::put('/', 'CostParkController@putUpdateOne');
            Route::patch('/', 'CostParkController@patchDeactivateOne');
            Route::delete('/{id}', 'CostParkController@deleteDeleteOne');
        });

        Route::group(['middleware' => 'cost-other', 'prefix' => 'cost-others'], function () {
            Route::get('/', 'CostOtherController@getReadAll');
            Route::get('/search', 'CostOtherController@getSearchOne');
            Route::get('/{id}', 'CostOtherController@getReadOne');
            Route::post('/', 'CostOtherController@postCreateOne');
            Route::put('/', 'CostOtherController@putUpdateOne');
            Route::patch('/', 'CostOtherController@patchDeactivateOne');
            Route::delete('/{id}', 'CostOtherController@deleteDeleteOne');
        });

        Route::group(['middleware' => 'invoice-customer', 'prefix' => 'invoice-customers'], function () {
            Route::get('/', 'InvoiceCustomerController@getReadAll');
            Route::get('/search', 'InvoiceCustomerController@getSearchOne');
            Route::get('/{id}', 'InvoiceCustomerController@getReadOne');
            Route::post('/', 'InvoiceCustomerController@postCreateOne');
            Route::put('/', 'InvoiceCustomerController@putUpdateOne');
            Route::patch('/', 'InvoiceCustomerController@patchDeactivateOne');
            Route::delete('/{id}', 'InvoiceCustomerController@deleteDeleteOne');
        });

        Route::group(['middleware' => 'invoice-garage', 'prefix' => 'invoice-garages'], function () {
            Route::get('/', 'InvoiceGarageController@getReadAll');
            Route::get('/search', 'InvoiceGarageController@getSearchOne');
            Route::get('/{id}', 'InvoiceGarageController@getReadOne');
            Route::post('/', 'InvoiceGarageController@postCreateOne');
            Route::put('/', 'InvoiceGarageController@putUpdateOne');
            Route::patch('/', 'InvoiceGarageController@patchDeactivateOne');
            Route::delete('/{id}', 'InvoiceGarageController@deleteDeleteOne');
        });

        Route::group(['middleware' => 'staff-customer', 'prefix' => 'staff-customers'], function () {
            Route::get('/', 'StaffCustomerController@getReadAll');
            Route::get('/search', 'StaffCustomerController@getSearchOne');
            Route::get('/{id}', 'StaffCustomerController@getReadOne');
            Route::post('/', 'StaffCustomerController@postCreateOne');
            Route::put('/', 'StaffCustomerController@putUpdateOne');
            Route::patch('/', 'StaffCustomerController@patchDeactivateOne');
            Route::delete('/{id}', 'StaffCustomerController@deleteDeleteOne');
        });

        //
        Route::group(['middleware' => []], function () {
            // Voucher
            Route::group(['prefix' => 'vouchers'], function () {
                Route::get('/', 'VoucherController@getReadAll');
                Route::get('/search', 'VoucherController@getSearchOne');
                Route::get('/{id}', 'VoucherController@getReadOne');
                Route::post('/', 'VoucherController@postCreateOne');
                Route::put('/', 'VoucherController@putUpdateOne');
                Route::patch('/', 'VoucherController@patchDeactivateOne');
                Route::delete('/{id}', 'VoucherController@deleteDeleteOne');
            });

            // TruckType

            // DriverTruck

            // UnitPricePark

            // Unit

            // Product, ProductCode

        });

    });
});


