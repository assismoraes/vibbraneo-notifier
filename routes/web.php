<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/redirect', 'SocialAuthGoogleController@redirect');
Route::get('/google/callback', 'SocialAuthGoogleController@callback');

Route::group(['prefix' => 'applications'], function() {
    Route::get('', 'ApplicationController@list')->name('applications-list');
    Route::get('/new', 'ApplicationController@new')->name('applications-new');
    Route::post('', 'ApplicationController@create')->name('applications-create');
    Route::get('/{id}/edit', 'ApplicationController@edit')->name('applications-edit');
    Route::put('/{id}', 'ApplicationController@update')->name('applications-update');
    Route::get('/{id}', 'ApplicationController@detail')->name('applications-detail');
});

Route::group(['prefix' => 'channels'], function() {
    Route::get('', 'ChannelController@list')->name('channels-list');
});

Route::group(['prefix' => 'email-channels'], function() {
    Route::get('/new', 'EmailChannelController@new')->name('email-channels-new');
    Route::post('', 'EmailChannelController@create')->name('email-channels-create');
    Route::get('/{id}/edit', 'EmailChannelController@edit')->name('email-channels-edit');
    Route::put('/{id}', 'EmailChannelController@update')->name('email-channels-update');
});

Route::group(['prefix' => 'sms-channels'], function() {
    Route::get('/new', 'SMSChannelController@new')->name('sms-channels-new');
    Route::post('', 'SMSChannelController@create')->name('sms-channels-create');
    Route::get('/{id}/edit', 'SMSChannelController@edit')->name('sms-channels-edit');
    Route::put('/{id}', 'SMSChannelController@update')->name('sms-channels-update');
});
