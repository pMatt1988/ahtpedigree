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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/store', 'DogController@store');
Route::delete('/dog/{id}', 'DogController@destroy');
Route::get('/dog/{id}', 'DogController@show');
Route::patch('/dog/{id}', 'DogController@update');