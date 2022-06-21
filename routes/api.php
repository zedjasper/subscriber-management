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

Route::post('login', 'UserController@authenticate');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('subscribers', 'SubscriberController@getSubscribers');
    Route::post('subscribers/store', 'SubscriberController@store');
    Route::post('subscribers/delete', 'SubscriberController@delete');
});
