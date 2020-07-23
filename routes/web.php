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

Auth::routes(['verify' => true]);

//Route Pengurus
Route::get('/pengurus/', 'PengurusController@index')->name('pengurus.index')->middleware('pengurus');
Route::get('/pengurus/jamaah/', 'PengurusController@lihatJamaah')->name('pengurus.lihatJamaah');
Route::get('/pengurus/profile/{id}', 'PengurusController@profile')->name('pengurus.profile');
Route::put('/pengurus/{id}', 'PengurusController@updateProfile')->name('pengurus.updateProfile');
//Route Pengurus Jamaah
Route::post('/pengurus/jamaah/', 'PengurusController@input_jamaah')->name('pengurus.input_jamaah');
Route::get('/pengurus/jamaah/{id_jamaah}', 'PengurusController@jamaah_masjid_show')->name('jamaah_masjid.show');
Route::get('/pengurus/jamaah/{id_jamaah}/edit', 'PengurusController@jamaah_masjid_edit')->name('jamaah_masjid.edit');
Route::put('/pengurus/jamaah/{id_jamaah}', 'PengurusController@jamaah_masjid_update')->name('jamaah_masjid.update');
Route::delete('/pengurus/jamaah/{id_jamaah}', 'PengurusController@jamaah_masjid_destroy')->name('jamaah_masjid.destroy');
//Route Infaq Web
Route::get('/pengurus/infaq_web', 'PengurusController@infaq_web_all')->name('pengurus.infaq_web_all');
Route::put('/pengurus/infaq_web/{id}', 'PengurusController@validasiInfaq')->name('pengurus.validasiInfaq');
Route::get('/pengurus/infaq_web/sudah_validasi', 'PengurusController@infaq_web_valid')->name('pengurus.infaq_web_valid');
Route::get('/pengurus/infaq_web/belum_validasi', 'PengurusController@infaq_web_belum_valid')->name('pengurus.infaq_web_belum_valid');
Route::get('/pengurus/infaq_web/{id_infaq}/bukti', 'PengurusController@modal_bukti')->name('pengurus.bukti_infaq');
//Route Infaq Masjid
Route::get('/pengurus/infaq_masjid', 'PengurusController@infaq_masjid')->name('pengurus.infaq_masjid');
Route::post('/pengurus/infaq_masjid/', 'PengurusController@input_infaq')->name('pengurus.input_infaq');
Route::get('/pengurus/infaq_masjid/{id_infaq}', 'PengurusController@detail_infaq_masjid')->name('pengurus.detail_infaq_masjid');
Route::get('/pengurus/infaq_masjid/{id_infaq}/edit', 'PengurusController@edit_infaq_masjid')->name('pengurus.edit_infaq_masjid');
Route::put('/pengurus/infaq_masjid/{id_infaq}', 'PengurusController@update_infaq_masjid')->name('pengurus.update_infaq_masjid');
Route::delete('/pengurus/infaq_masjid/{id_infaq}', 'PengurusController@delete_infaq_masjid')->name('pengurus.delete_infaq_masjid');
//Route Zakat Fitrah Masjid
Route::get('/pengurus/zakat_masjid', 'PengurusController@zakat_masjid')->name('pengurus.zakat_masjid');
Route::post('pengurus/zakat_masjid/', 'PengurusController@input_zakat')->name('pengurus.input_zakat');
Route::post('/pengurus/zakat_masjid/muzakki', 'PengurusController@store_muzakki')->name('pengurus.store_muzakki');
Route::get('/pengurus/zakat_masjid/{id_zakat}', 'PengurusController@detail_zakat_masjid')->name('pengurus.detail_zakat_masjid');
Route::get('/pengurus/zakat_masjid/{id_zakat}/edit', 'PengurusController@edit_zakat_masjid')->name('pengurus.edit_zakat_masjid');
Route::put('/pengurus/zakat_masjid/{id_zakat}', 'PengurusController@update_zakat_masjid')->name('pengurus.update_zakat_masjid');
Route::delete('/pengurus/zakat_masjid/{id_zakat}', 'PengurusController@delete_zakat_masjid')->name('pengurus.delete_zakat_masjid');
//Route Zakat Web
Route::get('/pengurus/zakat_web/', 'PengurusController@zakat_web_all')->name('pengurus.zakat_web_all');
Route::get('/pengurus/zakat_web/{id_zakat}/bukti', 'PengurusController@bukti_zakat')->name('pengurus.bukti_zakat');
Route::put('/pengurus/zakat_web/{id}', 'PengurusController@validasi_zakat')->name('pengurus.validasi_zakat');

//Route Pengeluaran
Route::get('/pengurus/pengeluaran', 'PengurusController@pengeluaran')->name('pengurus.pengeluaran');
Route::post('/pengurus/pengeluaran/', 'PengurusController@input_pengeluaran')->name('pengurus.input_pengeluaran');
Route::get('/pengurus/pengeluaran/{id_pengeluaran}', 'PengurusController@detail_pengeluaran')->name('pengurus.detail_pengeluaran');
Route::delete('/pengurus/pengeluaran/{id_pengeluaran}', 'PengurusController@delete_pengeluaran')->name('pengurus.delete_pengeluaran');
//Route Ringkasan
Route::get('/pengurus/ringkasan', 'PengurusController@ringkasan')->name('pengurus.ringkasan');
//---------------------------------------------------------------------------------------------------
//Route Jamaah
Route::get('/daftar/jamaah_web', 'JamaahWebRegisterController@getRegister')->name('jamaah_web.register');
Route::post('/daftar/jamaah_web', 'JamaahWebRegisterController@postRegister')->name('jamaah_web.postRegister');
Route::get('/jamaah_web/isidata/{id}', 'JamaahWebRegisterController@isidata')->name('jamaah_web.create')->middleware('jamaah_web');
Route::post('/jamaah_web/', 'JamaahWebRegisterController@store')->name('jamaah_web.store');
Route::get('/jamaah_web/', 'JamaahWebController@index')->name('jamaah_web.index')->middleware('jamaah_web');
Route::get('/jamaah_web/profile/{id}', 'JamaahWebController@profile')->name('jamaah_web.profile');
Route::put('/jamaah_web/{id}', 'JamaahWebController@updateProfile')->name('jamaah_web.updateProfile');

//Route Infaq
Route::get('/jamaah_web/infaq/', 'JamaahWebController@lihatInfaq')->name('jamaah_web.lihatInfaq');
Route::post('/jamaah_web/infaq/', 'JamaahWebController@inputInfaq')->name('jamaah_web.inputInfaq');
Route::get('/jamaah_web/infaq/{id}', 'JamaahWebController@detail_infaq')->name('jamaah_web.detail_infaq');
Route::get('/jamaah_web/infaq_valid', 'JamaahWebController@valid_infaq')->name('jamaah_web.valid_infaq');
Route::get('/jamaah_web/infaq_belum_valid', 'JamaahWebController@infaq_belum_valid')->name('jamaah_web.infaq_belum_valid');

//Route Zakat
Route::get('/jamaah_web/zakat/', 'JamaahWebController@zakat')->name('jamaah_web.zakat');
Route::post('/jamaah_web/zakat/', 'JamaahWebController@input_zakat')->name('jamaah_web.input_zakat');
Route::post('/jamaah_web/zakat/muzakki', 'JamaahWebController@store_muzakki')->name('jamaah_web.store_muzakki');
Route::get('/jamaah_web/zakat/{id_zakat}', 'JamaahWebController@detail_zakat')->name('jamaah_web.detail_zakat');

//Route Admin
Route::get('/admin/', 'AdminController@index')->name('admin.index')->middleware('admin');
Route::get('/admin/list_user', 'AdminController@list_user')->name('admin.list_user');
Route::get('/admin/masjid', 'AdminController@masjid')->name('admin.masjid');
Route::get('/admin/masjid/{id_masjid}', 'AdminController@detail_masjid')->name('admin.detail_masjid');
Route::get('/admin/list_jamaah_web/', 'AdminController@list_jamaah_web')->name('admin.list_jamaah_web');
Route::get('/admin/list_jamaah_web/{id_user}', 'AdminController@detail_jamaah_web')->name('admin.detail_jamaah_web');


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


