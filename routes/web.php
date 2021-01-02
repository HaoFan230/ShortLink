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

Route::resource('/link','Page\LinkController');

// 验证邮箱
Route::resource('/checkemail','Page\Auth\CheckEmailController');

// 这里分组的路由都跟用户认证有关
Route::group(['prefix'=>'auth'],function() {
    Route::resource('register','Page\Auth\RegisterController')->middleware('guest');
    Route::resource('login','Page\Auth\LoginController')->middleware('guest');
    Route::resource('logout','Page\Auth\LogoutController')->middleware('auth');
});

// 仪表盘等后台路由
Route::group(['prefix'=>'dashboard','middleware'=>['auth','CheckUserStatus']],function() {
    Route::resource('home','Page\Dashboard\HomeController');
    Route::resource('links','Page\Dashboard\LinksController');
});