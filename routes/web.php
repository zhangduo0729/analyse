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
    // 所有网站 路由
    Route::get('/', 'AdminController@index')->name('adminAdminIndex');

    // 设置相关路由
    Route::group(['prefix'=>'/settings'], function () {
        Route::get('/', 'SettingController@index')->name('adminSettingIndex');

        Route::get('/searchengines/index', 'SearchEngineController@index')->name('adminSearchEngineIndex');
        Route::get('/searchengines/create', 'SearchEngineController@create')->name('adminSearchEngineCreate');
        Route::post('/searchengines/store', 'SearchEngineController@store')->name('adminSearchEngineStore');
        Route::delete('/searchengines/{id}', 'SearchEngineController@destroy')->name('adminSearchEngineDestroy');
        Route::get('/searchengines/{id}/edit', 'SearchEngineController@edit')->name('adminSearchEngineEdit');
        Route::put('/searchengines/{id}', 'SearchEngineController@update')->name('adminSearchEngineUpdate');

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
    });

    // 报表相关路由
    Route::group(['prefix'=>'/report'], function () {
        Route::get('/', 'ReportController@index')->name('adminReportIndex');

        Route::get('/clientanalyse/index', 'ClientAnalyseController@index')->name('adminClientAnalyseIndex');
        Route::get('/clientanalyse/log', 'ClientAnalyseController@log')->name('adminClientLog');
        Route::get('/clientanalyse/device', 'ClientAnalyseController@device')->name('adminClientDevice');
        Route::get('/clientanalyse/software', 'ClientAnalyseController@software')->name('adminClientSoftware');
        Route::get('/clientanalyse/addr', 'ClientAnalyseController@addr')->name('adminClientAddr');

        Route::get('/pageanalyse/index', 'PageAnalyseController@index')->name('adminPageAnalyseIndex');
        Route::get('/pageanalyse/enterpage', 'PageAnalyseController@enterPage')->name('adminPageAnalyseEnterPage');
        Route::get('/pageanalyse/quitpage', 'PageAnalyseController@quitPage')->name('adminPageAnalyseQuitPage');
        Route::get('/pageanalyse/pagetitle', 'PageAnalyseController@pageTitle')->name('adminPageAnalysePageTitle');
        Route::get('/pageanalyse/search', 'PageAnalyseController@search')->name('adminPageAnalyseSearch');
        Route::get('/pageanalyse/leavelink', 'PageAnalyseController@leaveLink')->name('adminPageAnalyseLeaveLink');

        Route::get('/sourceanalyse/index', 'SourceAnalyseController@index')->name('adminSourceAnalyseIndex');
        Route::get('/sourceanalyse/allsources', 'SourceAnalyseController@allSources')->name('adminSourceAnalyseAllSources');
        Route::get('/sourceanalyse/searchengine', 'SourceAnalyseController@searchEngine')->name('adminSourceAnalyseSearchEngine');
    });
});

