<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'api' , 'middleware' => 'cors'], function () {
    Route::post('register', 'UserController@register');// 注册
    Route::post('login', 'UserController@getToken');// 获取token
    Route::group(['middleware' => 'api.jwt.auth'], function () {
        Route::get('me', 'UserController@me');  // 获取用户详情
        Route::get('menu', 'MenuController@me');  // 获取用户详情
        Route::get('menu/parent', 'MenuController@pMenu');  // 获取用户详情
        Route::resource('menu', 'MenuController');
    });
});
