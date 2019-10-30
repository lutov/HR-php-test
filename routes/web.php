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

Route::get('/temperature', 'StaticController@temperature')->name('temperature');

Route::get('/order', 'OrderController@list');
Route::get('/order/{id}', 'OrderController@item');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'StaticController@temperature');
/*Route::get('/', function () {
	return view('welcome');
});*/
