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

use Illuminate\Support\Facades\Route;

Route::get('/', '\App\Http\Controllers\IndexController@index');

//  用户模块
//  注册页面
Route::get('/register', '\App\Http\Controllers\RegisterController@index');
//  注册行为
Route::post('/register', '\App\Http\Controllers\RegisterController@register');

//  登录页面
Route::get('/login', '\App\Http\Controllers\LoginController@index');
//  登录行为
Route::post('/login', '\App\Http\Controllers\LoginController@login')->name('login');
//  登出行为
Route::get('/logout', '\App\Http\Controllers\LoginController@logout');

//  文章列表
Route::get('/posts', '\App\Http\Controllers\PostController@index');
//  文章详情
Route::get('/posts/{post}', '\App\Http\Controllers\PostController@show')->where('post', '[0-9]+');

// 专题展示
Route::get('/topic/{topic}', '\App\Http\Controllers\TopicController@show');

Route::group(['middleware' => 'auth:web'], function() {

//  创建文章
    Route::get('/posts/create', '\App\Http\Controllers\PostController@create');
    Route::post('/posts', '\App\Http\Controllers\PostController@store');
//  编辑文章
    Route::get('/posts/{post}/edit', '\App\Http\Controllers\PostController@edit');
    Route::put('/posts/{post}', '\App\Http\Controllers\PostController@update');
//  删除文章
    Route::get('/posts/{post}/delete', '\App\Http\Controllers\PostController@delete');
//  上传图片
    Route::post('/posts/img/upload', '\App\Http\Controllers\PostController@imageUpload');
//  提交评论
    Route::post('/posts/{post}/comment', '\App\Http\Controllers\PostController@comment');
//  赞
    Route::get('/posts/{post}/zan', '\App\Http\Controllers\PostController@zan');
    Route::get('/posts/{post}/unzan', '\App\Http\Controllers\PostController@unzan');
// 搜索
    Route::get('/posts/search', '\App\Http\Controllers\PostController@search');

// 个人主页
    Route::get('/user/{user}', '\App\Http\Controllers\UserController@show');
    Route::post('/user/{user}/fan', '\App\Http\Controllers\UserController@fan');
    Route::post('/user/{user}/unfan', '\App\Http\Controllers\UserController@unfan');

// 个人设置
    Route::get('/user/me/setting', '\App\Http\Controllers\UserController@setting');
    Route::post('/user/me/setting', '\App\Http\Controllers\UserController@settingStore');

// 专题
    Route::get('/topic/{topic}/submit', '\App\Http\Controllers\TopicController@submit');

    // 通知
    Route::get('/notices', '\App\Http\Controllers\NoticeController@index');
});

include_once('admin.php');
