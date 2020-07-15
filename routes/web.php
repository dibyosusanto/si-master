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


Route::get('/', 'IndexController@index')->name('index');
Route::get('/daftar', 'IndexController@daftar')->name('index.daftar');


Route::get('/daftar/pengurus', 'PengurusRegisterController@getRegister')->name('pengurus.register');
Route::post('/daftar/pengurus', 'PengurusRegisterController@postRegister')->name('pengurus.postRegister');
Route::get('/pengurus/isidata/{id}', 'PengurusRegisterController@isidata')->name('pengurus.create')->middleware('pengurus');
Route::post('/pengurus/', 'PengurusRegisterController@store')->name('pengurus.store');

Auth::routes(['register' => false, 'showLoginForm' => false, 'login'=>false]);

//Route Pengurus
Route::get('/pengurus/', 'PengurusController@index')->name('pengurus.index')->middleware('pengurus');
Route::get('/pengurus/jamaah/', 'PengurusController@lihatJamaah')->name('pengurus.lihatJamaah');
Route::get('/pengurus/profile/{id}', 'PengurusController@profile')->name('pengurus.profile');
Route::put('/pengurus/{id}', 'PengurusController@updateProfile')->name('pengurus.updateProfile');
Route::post('/pengurus/jamaah/', 'PengurusController@input_jamaah')->name('pengurus.input_jamaah');
Route::get('/pengurus/jamaah/{id_jamaah}', 'PengurusController@jamaah_masjid_show')->name('jamaah_masjid.show');
Route::get('/pengurus/jamaah/{id_jamaah}/edit', 'PengurusController@jamaah_masjid_edit')->name('jamaah_masjid.edit');
Route::put('/pengurus/jamaah/{id_jamaah}', 'PengurusController@jamaah_masjid_update')->name('jamaah_masjid.update');
Route::delete('/pengurus/jamaah/{id_jamaah}', 'PengurusController@jamaah_masjid_destroy')->name('jamaah_masjid.destroy');

//Route Jamaah
Route::get('/daftar/jamaah_web', 'JamaahWebRegisterController@getRegister')->name('jamaah_web.register');
Route::post('/daftar/jamaah_web', 'JamaahWebRegisterController@postRegister')->name('jamaah_web.postRegister');
Route::get('/jamaah_web/isidata/{id}', 'JamaahWebRegisterController@isidata')->name('jamaah_web.create')->middleware('jamaah_web');
Route::post('/jamaah_web/', 'JamaahWebRegisterController@store')->name('jamaah_web.store');
Route::get('/jamaah_web/', 'JamaahWebController@index')->name('jamaah_web.index')->middleware('jamaah_web');
Route::get('/jamaah_web/profile/{id}', 'JamaahWebController@profile')->name('jamaah_web.profile');
Route::put('/jamaah_web/{id}', 'JamaahWebController@updateProfile')->name('jamaah_web.updateProfile');
Route::get('/jamaah_web/infaq/', 'JamaahWebController@lihatInfaq')->name('jamaah_web.lihatInfaq');
Route::post('/jamaah_web/infaq/', 'JamaahWebController@inputInfaq')->name('jamaah_web.inputInfaq');


Route::get('/admin/', 'Admin@index')->name('admin')->middleware('admin');

Route::group(['prefix' => 'administrator', 'middleware' => 'auth:web'], function(){
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

