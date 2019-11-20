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


//註冊登入登出
Auth::routes();

Route::get('/', 'IndexController@index');
Route::get('/home', 'HomeController@index')->name('home');
//員工檢視-月份打卡紀錄
Route::get('/read', 'HomeController@read')->name('read.get');
Route::post('/read', 'HomeController@read')->name('read.post');
//員工打卡
Route::post('/work', 'WokerController@store')->name('Worker.store');
//--------------

//[管理者路由群組]
Route::group(['prefix' => 'admin'], function () {
    //管理者打卡 /punch
    Route::get('/punch', 'HomeController@read');
    Route::post('/punch', 'HomeController@read');
    //打卡頁面 ｜ 檢視 - 打卡
    //檢視紀錄   ｜ 檢視-切換月份
    //檢視員工紀錄 ｜ 檢視-切換身份-更動紀錄-幫打請假卡


});



//------------
Route::get('/ok', 'WokerController@index');


//Route::get('/errorwork', 'IndexController@upedwork');
//Route::get('/errorendwork', 'IndexController@endedwork');
