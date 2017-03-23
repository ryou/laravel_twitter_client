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

Route::get('/', 'StatusesController@homeTimeline')->name('statuses.home_timeline');

Route::get('/lists', 'ListsController@index')->name('lists.index');
Route::get('/lists/statuses/{id}', 'ListsController@statuses')->name('lists.statuses');

Route::get('/auth', 'AuthController@index')->name('auth.index');
Route::get('/auth/login', 'AuthController@login')->name('auth.login');
Route::get('/auth/logout', 'AuthController@logout')->name('auth.logout');
Route::get('/auth/callback', 'AuthController@callback')->name('auth.callback');

Route::post('/statuses/update', 'StatusesController@update')->name('statuses.update');
Route::post('/statuses/retweet/{id}', 'StatusesController@retweet')->name('statuses.retweet');
Route::post('/statuses/unretweet/{id}', 'StatusesController@unretweet')->name('statuses.unretweet');

Route::post('/favorites/create/{id}', 'FavoritesController@create')->name('favorites.create');
Route::post('/favorites/destroy/{id}', 'FavoritesController@destroy')->name('favorites.destroy');
