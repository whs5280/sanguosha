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

Route::get('/login', function () {
    return view('auth/login');
});

Route::get('/register', function () {
    return view('auth/register');
});

Route::get('/forget/email', function () {
    return view('auth/passwords/email');
});

Route::get('/forget/reset', function () {
    return view('auth/passwords/reset');
});

Route::get('/testRedis','RedisController@testRedis')->name('testRedis');

/****************************************
 * 互联登录的路由，包括 github, QQ， 微博 登录
 ****************************************/
Auth::routes();

Route::namespace('Auth')->group(function(){

    // 获取验证码
    Route::get('captcha', 'RegisterController@captcha');

    /****************************************
     * 1. 激活账号的路由
     * 2. 重新发送激活链接的路由
     ****************************************/
    Route::get('register/active/{token}', 'UserController@activeAccount');
    // again send active link
    Route::get('register/again/send/{id}', 'UserController@sendActiveMail');

    /****************************************
     * 互联登录的路由，包括 github, QQ， 微博 登录
     ****************************************/
    Route::get('auth/oauth', 'AuthLoginController@redirectToAuth');
    Route::get('auth/oauth/callback', 'AuthLoginController@handleCallback');
    Route::get('/auth/oauth/unbind', 'AuthLoginController@unBind');
});

Route::post('/registerTo', 'Auth\RegisterController@register');
Route::any('/service/validate_phone/send', 'Services\SendController@send');

/*找回密码*/
Route::any( '/password/email', 'Mail\ResetPasswordController@sendEmail');
Route::any( '/password/reset/{token}', 'Mail\ResetPasswordController@resetPassword');