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


Route::post('login', 'LoginController@login');
Route::post('register', 'LoginController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    
    Route::get('logout', 'LoginController@logout');

});