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
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('log','UserController@index');//后台登录
    Route::post('doLogin','UserController@login');//登录提交
    Route::get('index','IndexController@index');//首页
    Route::get('list','UserController@list');//管理员列表
    Route::get('adduser','UserController@add');

    Route::resource('article', 'ArticleController');//文章管理
    Route::resource('type','TypeController');//添加文章分类

});

Route::get('hello',function(){
    return '这里是测试路由';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

