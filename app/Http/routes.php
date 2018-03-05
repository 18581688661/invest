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
Route::get('/sms','UserController@sms')->name('sms');//发送短信验证码

Route::get('/signup','UserController@create')->name('signup');//用户注册
Route::get('login', 'SessionsController@create')->name('login');//用户登录
Route::post('login', 'SessionsController@store')->name('login');//用户登录
resource('user', 'UserController');//用户CURD
Route::get('/show','UserController@show')->name('show');//个人中心
Route::get('/mana_show','ManagerController@mana_show')->name('mana_show');//管理中心

Route::get('mana_login', 'SessionsController@mana_create')->name('mana_login');//管理员登录
Route::post('mana_login', 'SessionsController@mana_store')->name('mana_login');//管理员登录

Route::delete('logout', 'SessionsController@destroy')->name('logout');//登出

Route::get('password/reset', 'UserController@getReset')->name('password.reset');//找回密码页
Route::post('password/reset', 'UserController@postRset')->name('password.reset');//找回密码

Route::get('/message','UserController@message')->name('message');//消息中心

Route::get('/certification','UserController@certification')->name('certification');//实名认证页
Route::post('/certificate','UserController@certificate')->name('certificate');//实名认证

Route::get('/risk_appraisal','UserController@risk_appraisal')->name('risk_appraisal');//风险测评页
Route::post('/appraisal','UserController@appraisal')->name('appraisal');//风险测评

Route::get('/security','UserController@security')->name('security');//安全中心页
Route::post('mobile_binding','UserController@mobile_binding')->name('mobile_binding');//绑定手机号
Route::post('contact_binding','UserController@contact_binding')->name('contact_binding');//绑定&更换联系人
Route::post('change_pwd','UserController@change_pwd')->name('change_pwd');//修改密码

Route::get('recharge','UserController@recharge')->name('recharge');//充值页面
Route::get('withdrawals','UserController@withdrawals')->name('withdrawals');//提现页面
Route::get('transaction_record','UserController@transaction_record')->name('transaction_record');//交易记录页面
Route::post('withdrawals1','UserController@withdrawals1')->name('withdrawals1');//提现操作
Route::get('bank_manage','UserController@bank_manage')->name('bank_manage');//管理银行卡页面
Route::post('bank_binding','UserController@bank_binding')->name('bank_binding');//添加银行卡
Route::post('bank_unbinding','UserController@bank_unbinding')->name('bank_unbinding');//解绑银行卡

Route::get('project_manage','ManagerController@project_manage')->name('project_manage');//投资项目管理页面
Route::post('project_add','ManagerController@project_add')->name('project_add');//投资项目新增

Route::post('invest','InvestController@invest')->name('invest');//项目投资
Route::get('project_invested','InvestController@project_invested')->name('project_invested');//所有已投项目
Route::get('project_backing','InvestController@project_backing')->name('project_backing');//回款中项目
Route::get('project_backed','InvestController@project_backed')->name('project_backed');//已回款项目
Route::get('project_transferring','InvestController@project_transferring')->name('project_transferring');//转让中项目
Route::get('project_transferred','InvestController@project_transferred')->name('project_transferred');//已转让项目

Route::get('transferring','InvestController@transferring')->name('transferring');//转让列表
Route::post('transfer','InvestController@transfer')->name('transfer');//转让操作