<?php

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

Route::get('login', 'UserController@login')->name('login');
Route::post('authenticate', 'UserController@authenticate');

Route::group(['middleware' => 'auth'], function(){
    Route::get('users/logout', 'UserController@logout');

    Route::get('/', 'SubscriberController@index');
    Route::get('subscribers/ajax', 'SubscriberController@subscribersAjax');
    Route::get('subscribers/create', 'SubscriberController@create');
    Route::post('subscribers/store', 'SubscriberController@store');
    Route::any('subscribers/delete', 'SubscriberController@delete');
});