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

Route::get('/', 'LinksController@index');
Route::post('/create_short_link', 'LinksController@createShortLink');
Route::get('/statistic/{path}', 'LinksController@statistic');
Route::get('{path}', 'LinksController@tryToRedirect');
