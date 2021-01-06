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

Route::get('/', function () {
    return view('welcome');
});

// 跳转路由
Route::resource('/link','Page\LinkController');

// 验证邮箱
Route::resource('/checkemail','Page\Auth\CheckEmailController');

// 来宾路由
Route::group(['middleware'=>'guest'],function() {

    // 认证相关
    Route::group(['prefix'=>'auth'],function() {
        Route::resource('login','Page\Auth\LoginController');    
        Route::resource('register','Page\Auth\RegisterController');
        Route::resource('password_reset','Page\Auth\PasswordResetController');
    });
    
});

// 认证路由
Route::group(['middleware'=>'auth'],function() {

    // 登出
    Route::resource('auth/logout','Page\Auth\LogoutController');

    // 仪表盘等后台路由
    Route::group(['prefix'=>'dashboard','middleware'=>'CheckUserStatus'],function() {
        
        // 各项菜单
        Route::resource('home','Page\Dashboard\HomeController');
        Route::resource('links','Page\Dashboard\LinksController');
        Route::resource('export','Page\Dashboard\ExportController');
        // 个人信息修改
        Route::resource('people','Page\Dashboard\PeopleController')->parameters(['people'=>'user']);
        // 开发者
        Route::resource('developer','Page\Dashboard\DeveloperController');
    });
});