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
    return redirect()->route('adminAdminIndex');
});

Auth::routes();

Route::get('/collect', 'CollectController@index')->name('adminCollectIndex');

// 后台路由
Route::group(['prefix'=> '/admin','middleware'=>['auth']], function () {
    Route::get('/', 'AdminController@index')->name('adminAdminIndex');

    Route::get('/settings', 'SettingController@index')->name('adminSettingIndex');

    Route::get('/report', 'ReportController@index')->name('adminReportIndex');

    Route::get('/sites/create', 'SiteController@create')->name('adminSiteCreate');
    Route::post('/sites', 'SiteController@store')->name('adminSiteStore');
    Route::get('/sites', 'SiteController@index')->name('adminSiteIndex');
    Route::get('/sites/{id}/script', 'SiteController@script')->name('adminSiteScript');
    Route::get('/sites/{id}/edit', 'SiteController@edit')->name('adminSiteEdit');
    Route::put('/sites/{id}/update', 'SiteController@update')->name('adminSiteUpdate');
    Route::delete('/sites/{id}', 'SiteController@destroy')->name('adminSiteDestroy');

    Route::get('/users', 'UserController@index')->name('adminUserIndex');
    Route::delete('/users/{id}', 'UserController@destroy')->name('adminUserDestroy');
    Route::get('/users/create', 'UserController@create')->name('adminUserCreate');
    Route::post('/users', 'UserController@store')->name('adminUserStore');
    Route::delete('/users/{id}', 'UserController@destroy')->name('adminUserDestroy');
    Route::get('/users/{id}/editrole', 'UserController@editRole')->name('adminUserEditRole');
    Route::post('/users/{id}/updaterole', 'UserController@updateRole')->name('adminUserUpdateRole');

    Route::get('/roles', 'RoleController@index')->name('adminRoleIndex');
    Route::get('/roles/create', 'RoleController@create')->name('adminRoleCreate');
    Route::post('/roles', 'RoleController@store')->name('adminRoleStore');
    Route::delete('/roles/{id}', 'RoleController@destroy')->name('adminRoleDestroy');
    Route::get('/roles/{id}/editpermission', 'RoleController@editPermission')->name('adminRoleEditPermission');
    Route::post('/roles/{id}/updatepermission', 'RoleController@updatePermission')->name('adminRoleUpdatePermission');

    Route::get('/report/clientanalyse/index', 'ClientAnalyseController@index')->name('adminClientAnalyseIndex');
    Route::get('/report/clientanalyse/log', 'ClientAnalyseController@log')->name('adminClientLog');
});

