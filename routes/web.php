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
    return redirect('/login');
});
Auth::routes();
Route::get('/admin', 'AdminController@index')->name('home');

Auth::routes();

Route::get('/settings', 'SettingController@index')->name('settings');

Route::get('/sites/create', 'SiteController@create');
Route::post('/sites', 'SIteController@store');

Route::get('/collect', 'CollectController@index');

Route::get('/users', 'UserController@index');

