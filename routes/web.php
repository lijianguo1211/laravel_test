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
    Route::get('adduser','UserController@add');//添加管理员显示
    Route::post('add_admin','UserController@add_admin');//提交管理员
    Route::get('cardIndex/{user_id}','CardIdController@index')->where('user_id','[0-9]+');//实名认证显示
    Route::post('getIndex','CardIdController@getIndex');//实名认证(数据)处理

    //文件上传接口调用处理
    Route::post('uploadFile','UploadController@uploadFile');
    Route::get('fileUploadFtp','UploadController@fileUploadFtp');

    Route::resource('article', 'ArticleController');//文章管理
    Route::resource('type','TypeController');//添加文章分类
    Route::get('type_del/{id}','TypeController@del')->where('id','[0-9]+');//删除文章分类

    Route::any('map','IndexController@map');//调用百度地图接口
    Route::any('map_api','IndexController@map_api');//调用百度地图接口
    Route::post('city_api','IndexController@city_api');//城市搜素api

    Route::get('email','EmailController@index');//邮件相关
    Route::post('ship','OrderController@ship');//邮件相关

    Route::get('new/index','NewController@index');//搜索新闻
    Route::post('search','NewController@search');//搜索新闻展示

    Route::get('bd/index','BaiduController@index');//百度语音合成
    Route::post('bd/save','BaiduController@save');//提交语音

    Route::get('role_index_list','RoleController@index_list');
    Route::get('role_index_list_ajax','RoleController@index_list_ajax');
    Route::any('role_index','RoleController@role_index');//角色列表
    Route::post('role_index_ajax','RoleController@role_index_ajax');
    Route::any('role_user','RoleController@role_user');

    Route::get('access_index','RoleController@access_index');
    Route::post('access_index_ajax','RoleController@access_index');
    Route::get('accessList','RoleController@accessList');
    Route::get('accessListAjax','RoleController@accessListAjax');

    Route::get('test','TestController@testRedis');
    Route::get('mail','TestController@mail');
    Route::get('mail1','TestController@saveEmail');
    Route::get('test2','TestController@test2');
    Route::get('indexSave','TestController@index');


});

Route::get('hello',function(){
    return '这里是测试路由';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

