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
//首頁-打卡頁面
Route::get('/home', 'HomeController@index')->name('home');
//月份打卡紀錄 |  檢視-切換月份
Route::get('/read', 'HomeController@read')->name('read.get');
Route::post('/read', 'HomeController@read')->name('read.post');
//打卡
Route::post('/work', 'WokerController@store')->name('Worker.store');
//--------------

//[管理者路由群組]
Route::group(['prefix' => 'admin'], function () {
    //管理者打卡 /punch
    //打卡頁面 ｜ 檢視 - 打卡
    //Route::get('/punch', 'AdminController@home');
    //檢視紀錄   ｜ 檢視-切換月份
    //Route::get('/records', 'AdminController@record');
    //檢視員工紀錄 ｜ 檢視-切換身份-更動紀錄-幫打請假卡
    Route::get('/worker/record', 'AdminController@workerRecord')->name('workerRecord.get');
    Route::post('/worker/record', 'AdminController@workerRecord')->name('workerRecord.post');
    //更新員工打卡結果
    Route::post('/worker/record/update', 'AdminController@updatedRecord')->name('updatedRecord.post');
    //  Route::post('/records', 'AdminController@record');



    //無用-與員工功能重複
    //Route::post('/punch', 'AdminController@punch');

    /*
    
    
    Route::post('//worker/record', 'AdminController@record');
    */
});



//------------
Route::get('/ok', 'WokerController@index');


//Route::get('/errorwork', 'IndexController@upedwork');
//Route::get('/errorendwork', 'IndexController@endedwork');
