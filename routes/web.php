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

Route::group(['prefix' => 'applications', 'middleware' => ['auth']], function() {
    Route::get('', 'ApplicationController@list')->name('applications-list');
    Route::get('/new', 'ApplicationController@new')->name('applications-new');
    Route::post('', 'ApplicationController@create')->name('applications-create');
    Route::get('/{id}/edit', 'ApplicationController@edit')->name('applications-edit');
    Route::put('/{id}', 'ApplicationController@update')->name('applications-update');
    Route::get('/{id}', 'ApplicationController@detail')->name('applications-detail');
});

Route::group(['prefix' => 'channels', 'middleware' => ['auth']], function() {
    Route::get('', 'ChannelController@list')->name('channels-list');
});

Route::group(['prefix' => 'email-channels', 'middleware' => ['auth']], function() {
    Route::get('/new', 'EmailChannelController@new')->name('email-channels-new');
    Route::post('', 'EmailChannelController@createOrUpdate')->name('email-channels-create-or-update');
    Route::get('/edit', 'EmailChannelController@edit')->name('email-channels-edit');
    Route::get('/toggle', 'EmailChannelController@toggle')->name('email-channels-toggle');
});

Route::group(['prefix' => 'sms-channels', 'middleware' => ['auth']], function() {
    Route::get('/new', 'SMSChannelController@new')->name('sms-channels-new');
    Route::post('', 'SMSChannelController@create')->name('sms-channels-create');
    Route::get('/{id}/edit', 'SMSChannelController@edit')->name('sms-channels-edit');
    Route::put('/{id}', 'SMSChannelController@update')->name('sms-channels-update');
});

Route::group(['prefix' => 'email-notifications', 'middleware' => ['auth']], function() {
    Route::get('/new', 'EmailNotificationController@new')->name('email-notifications-new');
    Route::post('', 'EmailNotificationController@send')->name('email-notifications-send');
});

Route::group(['prefix' => 'notifications', 'middleware' => ['auth']], function() {
    Route::get('/', 'NotificationController@list')->name('notifications-list');
});

Route::group(['prefix' => 'email-templates', 'middleware' => ['auth']], function() {
    Route::get('', 'EmailTemplateController@list')->name('email-templates-list');
    Route::get('/new', 'EmailTemplateController@new')->name('email-templates-new');
    Route::post('', 'EmailTemplateController@save')->name('email-templates-save');
    Route::get('/{id}', 'EmailTemplateController@detail')->name('email-templates-detail');
    Route::get('/{id}/delete', 'EmailTemplateController@delete')->name('email-templates-delete');
});