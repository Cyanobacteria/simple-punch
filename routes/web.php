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



Auth::routes();

Route::get('/', 'IndexController@index');
Route::get('/home', 'HomeController@index')->name('home');
//員工檢視-月份打卡紀錄
Route::get('/read', 'HomeController@read')->name('read.get');
Route::post('/read', 'HomeController@read')->name('read.post');
//員工打卡
Route::post('/work', 'WokerController@store')->name('Worker.store');


//------------
Route::get('/ok', 'WokerController@index');


//Route::get('/errorwork', 'IndexController@upedwork');
//Route::get('/errorendwork', 'IndexController@endedwork');
