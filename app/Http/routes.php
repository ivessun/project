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

Route::get('/', function () {
    return view('welcome');
});

//后台路由规则
Route::get('/admin','AdminController@index');

//用户的添加
Route::get('/user/add','UserController@add');
Route::post('user/insert','UserController@insert');
Route::get('/user/index','UserController@index');