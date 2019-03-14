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

Route::namespace('Vehicle')->prefix('vehicles')->group(function () {

    Route::get('/{model_year}/{manufacturer}/{model}', 'VehicleController@getVehicleVariants')
        ->where(['model_year' =>'^(19|20)\d{2}$']);

    Route::post('/', 'VehicleController@postVehicle');

});
