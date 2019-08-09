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

    return view('layouts.app',array('user' => Auth::user()));
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@update_avatar')->name('home');

Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('posrecords', 'PosrecordsController@index')->name('posrecords');
Route::get('posrecords/create', 'PosrecordsController@create')->name('posrecords.create');
Route::post('posrecords', 'PosrecordsController@store');
Route::get('posrecords/{posrecord}/edit', 'PosrecordsController@edit')->name('posrecords.edit');
Route::patch('posrecords/{posrecord}', 'PosrecordsController@update');
Route::delete('posrecords/{posrecord}', 'PosrecordsController@destroy');

Route::get('/search','PosrecordController@search');

Route::get('customers', 'CustomersController@index')->name('customers');
Route::post('customers', 'CustomersController@store');

Route::get('import', 'ExcelController@create')->name('import');
Route::post('import', 'ExcelController@store');