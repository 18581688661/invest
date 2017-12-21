<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'StaticPagesController@index')->name('index');//首页

Route::get('/email','UserController@email')->name('email');//发送邮箱验证码

Route::get('/signup','UserController@create')->name('signup');//用户注册
Route::get('login', 'SessionsController@create')->name('login');//用户登录
Route::post('login', 'SessionsController@store')->name('login');//用户登录
resource('user', 'UserController');//用户CURD
Route::get('/show','UserController@show')->name('show');//用户注册

Route::get('mana_login', 'SessionsController@mana_create')->name('mana_login');//管理员登录
Route::post('mana_login', 'SessionsController@mana_store')->name('mana_login');//管理员登录

Route::delete('logout', 'SessionsController@destroy')->name('logout');//登出

Route::get('password/reset', 'UserController@getReset')->name('password.reset');//找回密码
Route::post('password/reset', 'UserController@postRset')->name('password.reset');//找回密码

Route::get('/message','UserController@message')->name('message');//消息中心
Route::get('/test','UserController@test')->name('test');//消息中心