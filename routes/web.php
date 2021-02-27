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
});
