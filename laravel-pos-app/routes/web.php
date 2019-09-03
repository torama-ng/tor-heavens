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

    return view('welcome',array('user' => Auth::user()));
});

//Auth::routes(['verify' => true]);
Auth::routes();

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('/profile', 'ProfileController@update_avatar')->name('profile');

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

Route::post('multiuploads', 'MultiuploadsController@store')->name('multiuploads');
Route::get('import', 'ExcelController@create')->name('import');
Route::post('import', 'ExcelController@store');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){



    Route::get('/', [

        'uses' => 'UsersController@index',

        'as' => 'admins'
    ]);

    Route::get('/create', [

        'uses' => 'UsersController@create',

        'as' => 'admins.create'
    ]);

    Route::post('/store', [

        'uses' => 'UsersController@store',

        'as' => 'admins.store'
    ]);

    Route::get('/admin/{id}', [

        'uses' => 'UsersController@admin',

        'as' => 'admins.admin'
    ]);//->middleware('admin');

    Route::get('/not-admin/{id}', [

        'uses' => 'UsersController@not_admin',

        'as' => 'admins.not.admin'
    ]);

    Route::get('/delete/{id}', [

        'uses' => 'UsersController@destroy',

        'as' => 'admins.delete'
    ]);

   

});
