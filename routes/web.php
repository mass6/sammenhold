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

Route::post('/users', 'UsersController@store');
Route::post('/login', 'LoginController@login');

Route::get('/lifelines/help', 'LifelinesController@help');
Route::get('/lifelines/{lifeline}', 'LifelinesController@show');
Route::get('/lifelines', 'LifelinesController@index');
Route::post('/lifelines', 'LifelinesController@store');
