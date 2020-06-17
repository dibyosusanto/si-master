<?php

use Illuminate\Support\Facades\Route;

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
//Routing untuk administator
Route::group(['prefix' => 'administrator', 'middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    
    //Routing CRUD Masjid
    Route::get('/masjid', 'MasjidController@index')->name('masjid.index');
    Route::get('/masjid/create', 'MasjidController@create')->name('masjid.create');
    Route::post('/masjid', 'MasjidController@store')->name('masjid.store');
    Route::get('/masjid/{id_masjid}/edit', 'MasjidController@edit')->name('masjid.edit');
    Route::put('/masjid/{id_masjid}', 'MasjidController@update')->name('masjid.update');
    Route::delete('/masjid/{id_masjid}', 'MasjidController@destroy')->name('masjid.destroy');
    Route::get('/masjid/{id_masjid}', 'MasjidController@show')->name('masjid.show');
    
});

