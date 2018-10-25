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
Route::get('/', 'ScheduleController@index');
Route::resource('schedule', 'ScheduleController')->only(['index', 'store']);
Route::resource('partner', 'partnerController')->only(['index', 'show']);
