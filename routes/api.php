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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'applications', 'middleware' => ['auth:api']], function() {
    Route::post('', 'ApplicationController@create')->name('applications-create');
    Route::get('', 'ApplicationController@list')->name('applications-list');
    Route::put('/{id}', 'ApplicationController@update')->name('applications-update');
    Route::get('/{id}', 'ApplicationController@detail')->name('applications-detail');
});

Route::group(['prefix' => 'email-channels', 'middleware' => ['auth:api']], function() {
    Route::get('/{id}/toggle', 'EmailChannelController@toggle')->name('email-channels-toggle');
});

Route::group(['prefix' => 'notifications', 'middleware' => ['auth:api']], function() {
    Route::get('/', 'NotificationController@list')->name('notifications-list');
});

Route::group(['prefix' => 'email-notifications', 'middleware' => ['auth:api']], function() {
    Route::post('', 'EmailNotificationController@send')->name('email-notifications-send');
});