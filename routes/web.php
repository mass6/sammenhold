<?php

Route::get('/', function () {
    return view('welcome');
});

Route::post('/users', 'UsersController@store');
Route::post('/login', 'LoginController@login');

Route::get('/lifelines/help', 'LifelinesController@help');
Route::get('/lifelines/{lifeline}', 'LifelinesController@show');
Route::get('/lifelines', 'LifelinesController@index');
Route::post('/lifelines', 'LifelinesController@store');
