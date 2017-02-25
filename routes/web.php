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
use App\Item;
// Route::get('/', function () {
//     return view('welcome');
// });

Route::bind('task', function($value, $route) {
	return Item::where('id', $value)->first();
});

Route::get('/', 'HomeController@getIndex')->name('home')->middleware('auth');
Route::post('/', 'HomeController@postIndex');

Route::get('/new', 'HomeController@getNew')->name('new')->middleware('auth');
Route::post('/new', 'HomeController@postNew');

Route::get('/delete/{task}', 'HomeController@getDelete')->name('delete')->middleware('auth');

Route::get('/login', 'AuthController@getLogin')->name('login')->middleware('guest');
Route::post('login', 'AuthController@postLogin');