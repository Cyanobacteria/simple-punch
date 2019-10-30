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
//Route::get('/errorwork', 'IndexController@upedwork');
//Route::get('/errorendwork', 'IndexController@endedwork');
Route::get('/', 'IndexController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/read', 'HomeController@read')->name('read.get');
Route::post('/read', 'HomeController@read')->name('read.post');
Route::get('/ok', 'WokerController@index');
Route::post('/work', 'WokerController@store')->name('Worker.store');
