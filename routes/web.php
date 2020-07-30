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


//Route Guest
Route::get('/', 'IndexController@index')->name('index');
Route::get('/daftar', 'IndexController@daftar')->name('index.daftar');
Route::get('/masjid/{id_masjid}', 'IndexController@detail_masjid')->name('index.detail_masjid');
Route::post('/daftar', 'IndexController@input_masjid')->name('index.input_masjid');
Route::get('/pengumuman/{id_announcement}/detail', 'IndexController@detail_pengumuman')->name('index.detail_pengumuman');
Route::get('/faq', 'IndexController@faq')->name('index.faq');


Route::get('/daftar/pengurus', 'PengurusRegisterController@getRegister')->name('pengurus.register');
Route::post('/daftar/pengurus', 'PengurusRegisterController@postRegister')->name('pengurus.postRegister');
Route::get('/pengurus/isidata/{id}', 'PengurusRegisterController@isidata')->name('pengurus.create')->middleware('pengurus');
Route::post('/pengurus/', 'PengurusRegisterController@store')->name('pengurus.store');
//--------------------------------------------------------------------------------------------------------------------------------
Auth::routes(['verify' => true]);
//--------------------------------------------------------------------------------------------------------------------------------
//Route Pengurus
Route::get('/pengurus/', 'PengurusController@index')->name('pengurus.index')->middleware('pengurus');
Route::get('/pengurus/jamaah/', 'PengurusController@lihatJamaah')->name('pengurus.lihatJamaah');
Route::get('/pengurus/profile/{id}', 'PengurusController@profile')->name('pengurus.profile');
Route::put('/pengurus/{id}', 'PengurusController@updateProfile')->name('pengurus.updateProfile');
Route::get('/pengurus/edit_kata_sandi/', 'PengurusController@edit_kata_sandi')->name('pengurus.edit_kata_sandi');
Route::put('/pengurus/update_kata_sandi/{id_user}', 'PengurusController@update_kata_sandi')->name('pengurus.update_kata_sandi');

//Route Pengurus Jamaah
Route::post('/pengurus/jamaah/', 'PengurusController@input_jamaah')->name('pengurus.input_jamaah');
Route::get('/pengurus/jamaah/{id_jamaah}', 'PengurusController@jamaah_masjid_show')->name('jamaah_masjid.show');
Route::get('/pengurus/jamaah/{id_jamaah}/edit', 'PengurusController@jamaah_masjid_edit')->name('jamaah_masjid.edit');
Route::put('/pengurus/jamaah/{id_jamaah}', 'PengurusController@jamaah_masjid_update')->name('jamaah_masjid.update');
Route::delete('/pengurus/jamaah/{id_jamaah}', 'PengurusController@jamaah_masjid_destroy')->name('jamaah_masjid.destroy');

//Route Infaq Web
Route::get('/pengurus/infaq_web', 'PengurusController@infaq_web_all')->name('pengurus.infaq_web_all');
Route::get('/pengurus/infaq_web/{id_infaq}', 'PengurusController@detail_infaq_web')->name('pengurus.detail_infaq_web');
Route::get('/pengurus/infaq_web/{id_infaq}/edit', 'PengurusController@edit_infaq_web')->name('pengurus.edit_infaq_web');
Route::put('/pengurus/infaq_web/{id_infaq}', 'PengurusController@update_infaq_web')->name('pengurus.update_infaq_web');
Route::put('/pengurus/infaq_web/{id}/validasi', 'PengurusController@validasiInfaq')->name('pengurus.validasiInfaq');
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
Route::put('/pengurus/zakat_masjid/{id_zakat}/update', 'PengurusController@update_zakat_masjid')->name('pengurus.update_zakat_masjid');
Route::delete('/pengurus/zakat_masjid/{id_zakat}', 'PengurusController@delete_zakat_masjid')->name('pengurus.delete_zakat_masjid');

//Route Zakat Web
Route::get('/pengurus/zakat_web/', 'PengurusController@zakat_web_all')->name('pengurus.zakat_web_all');
Route::get('/pengurus/zakat_web/{id_zakat}/bukti', 'PengurusController@bukti_zakat')->name('pengurus.bukti_zakat');
Route::put('/pengurus/zakat_web/{id}/validasi', 'PengurusController@validasi_zakat')->name('pengurus.validasi_zakat');
Route::get('/pengurus/zakat_web/{id_zakat}', 'PengurusController@detail_zakat_web')->name('pengurus.detail_zakat_web');
Route::get('/pengurus/zakat_web/{id_zakat}/edit', 'PengurusController@edit_zakat_web')->name('pengurus.edit_zakat_web');
Route::put('/pengurus/zakat_web/{id_zakat}', 'PengurusController@update_zakat_web')->name('pengurus.update_zakat_web');

//Route Pengeluaran
Route::get('/pengurus/pengeluaran', 'PengurusController@pengeluaran')->name('pengurus.pengeluaran');
Route::post('/pengurus/pengeluaran/', 'PengurusController@input_pengeluaran')->name('pengurus.input_pengeluaran');
Route::get('/pengurus/pengeluaran/{id_pengeluaran}/edit', 'PengurusController@edit_pengeluaran')->name('pengurus.edit_pengeluaran');
Route::delete('/pengurus/pengeluaran/{id_pengeluaran}', 'PengurusController@delete_pengeluaran')->name('pengurus.delete_pengeluaran');
Route::put('/pengurus/pengeluaran/{id_pengeluaran}', 'PengurusController@update_pengeluaran')->name('pengurus.update_pengeluaran');

//Route Ringkasan
Route::get('/pengurus/ringkasan', 'PengurusController@ringkasan')->name('pengurus.ringkasan');

//Route Pengumuman
Route::get('/pengurus/pengumuman/input', 'PengurusController@input_pengumuman')->name('pengurus.input_pengumuman');
Route::post('/pengurus/pengumuman/', 'PengurusController@store_pengumuman')->name('pengurus.store_pengumuman');
Route::get('/pengurus/pengumuman/', 'PengurusController@list_pengumuman')->name('pengurus.list_pengumuman');
Route::get('/pengurus/pengumuman/{id_pengumuman}', 'PengurusController@detail_pengumuman')->name('pengurus.detail_pengumuman');
Route::get('/pengurus/pengumuman/{id_pengumuman}/edit', 'PengurusController@edit_pengumuman')->name('pengurus.edit_pengumuman');
Route::put('/pengurus/pengumuman/{id_pengumuman}/', 'PengurusController@update_pengumuman')->name('pengurus.update_pengumuman');
Route::delete('/pengurus/pengumuman/{id_pengumuman}', 'PengurusController@destroy_pengumuman')->name('pengurus.destroy_pengumuman');

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

Route::get('jamaah_web/masjid/{id_masjid}', 'JamaahWebController@detail_masjid')->name('jamaah_web.detail_masjid');

Route::get('/jamaah_web/pengumuman/{id_pengumuman}', 'JamaahWebController@detail_pengumuman')->name('jamaah_web.detail_pengumuman');

Route::get('/jamaah_web/edit_kata_sandi/', 'JamaahWebController@edit_kata_sandi')->name('jamaah_web.edit_kata_sandi');
Route::put('/jamaah_web/update_kata_sandi/{id_user}', 'JamaahWebController@update_kata_sandi')->name('jamaah_web.update_kata_sandi');
// ------------------------------------------------------------------------------------------------------------------

//Route Admin
Route::get('/admin/', 'AdminController@index')->name('admin.index')->middleware('admin');
Route::get('/admin/user', 'AdminController@list_user')->name('admin.list_user');
Route::get('/admin/masjid/{id_masjid}', 'AdminController@detail_masjid')->name('admin.detail_masjid');

Route::get('/admin/list_admin/', 'AdminController@list_admin')->name('admin.list_admin');
Route::post('/admin/list_admin', 'AdminController@input_admin')->name('admin.input_admin');

Route::get('/admin/pengurus/', 'AdminController@list_pengurus')->name('admin.list_pengurus');
Route::post('/admin/pengurus/', 'AdminController@input_pengurus')->name('admin.input_pengurus');
Route::get('/admin/pengurus/{id_pengurus}', 'AdminController@detail_pengurus')->name('admin.detail_pengurus');

Route::get('/admin/jamaah_web/', 'AdminController@list_jamaah_web')->name('admin.list_jamaah_web');
Route::post('/admin/jamaah_web/', 'AdminController@input_jamaah_web')->name('admin.input_jamaah_web');
Route::get('/admin/jamaah_web/{id_user}', 'AdminController@detail_jamaah_web')->name('admin.detail_jamaah_web');

//Route Pengumuman
Route::get('/admin/pengumuman/', 'AdminController@list_pengumuman')->name('admin.list_pengumuman');
Route::get('/admin/pengumuman/input', 'AdminController@input_pengumuman')->name('admin.input_pengumuman');
Route::post('/admin/pengumuman', 'AdminController@store_pengumuman')->name('admin.store_pengumuman');
Route::get('/admin/pengumuman/{id_announcement}/edit', 'AdminController@edit_pengumuman')->name('admin.edit_pengumuman');
Route::put('/admin/pengumuman/{id_announcement}', 'AdminController@update_pengumuman')->name('admin.update_pengumuman');
Route::get('/admin/pengumuman/{id_announcement}/publish', 'AdminController@publish_pengumuman')->name('admin.publish_pengumuman');
Route::delete('/admin/pengumuman/{id_announcement}', 'AdminController@destroy_pengumuman')->name('admin.destroy_pengumuman');
Route::get('admin/detail_pengumuman/{id_announcement}', 'AdminController@detail_pengumuman')->name('admin.detail_pengumuman');

Route::get('/admin/masjid', 'AdminController@masjid')->name('admin.masjid');
Route::post('/admin/masjid/', 'AdminController@input_masjid')->name('admin.input_masjid');
Route::get('/admin/masjid/{id_masjid}/edit', 'AdminController@edit_masjid')->name('admin.edit_masjid');
Route::put('/admin/masjid/{id_masjid}', 'AdminController@update_masjid')->name('admin.update_masjid');
Route::delete('/admin/masjid/{id_masjid}', 'AdminController@destroy_masjid')->name('admin.destroy_masjid');

Route::get('/admin/infaq_web/', 'AdminController@infaq_web')->name('admin.infaq_web');
Route::get('/admin/infaq_web/bukti/{id_infaq}', 'AdminController@bukti_infaq')->name('admin.bukti_infaq');
Route::get('/admin/infaq_web/{id_infaq}/detail', 'AdminController@detail_infaq_web')->name('admin.detail_infaq_web');
Route::put('/admin/infaq_web/{id_infaq}/validasi', 'AdminController@validasi_infaq')->name('admin.validasi_infaq');
Route::delete('/admin/infaq_web/{id_infaq}/', 'AdminController@destroy_infaq_web')->name('admin.destroy_infaq_web');
Route::get('/admin/infaq_web/{id_infaq}/edit', 'AdminController@edit_infaq_web')->name('admin.edit_infaq_web');
Route::put('/admin/infaq_web/{id_infaq}', 'AdminController@update_infaq_web')->name('admin.update_infaq_web');

Route::get('/admin/infaq_masjid', 'AdminController@infaq_masjid')->name('admin.infaq_masjid');
Route::post('/admin/infaq_masjid', 'AdminController@input_infaq')->name('admin.input_infaq');
Route::get('/admin/infaq_masjid/{id_infaq}', 'AdminController@detail_infaq_masjid')->name('admin.detail_infaq_masjid');
Route::get('/admin/infaq_masjid/{id_infaq}/edit', 'AdminController@edit_infaq_masjid')->name('admin.edit_infaq_masjid');
Route::put('/admin/infaq_masjid/{id_infaq}', 'AdminController@update_infaq_masjid')->name('admin.update_infaq_masjid');
Route::delete('/admin/infaq_masjid/{id_infaq}', 'AdminController@delete_infaq_masjid')->name('admin.delete_infaq_masjid');

Route::get('/admin/zakat_web/', 'AdminController@zakat_web_all')->name('admin.zakat_web');
Route::get('/admin/zakat_web/{id_zakat}', 'AdminController@detail_zakat_web')->name('admin.detail_zakat_web');
Route::get('/admin/zakat_web/{id_zakat}/edit', 'AdminController@edit_zakat_web')->name('admin.edit_zakat_web');
Route::put('/admin/zakat_web/{id_zakat}/validasi', 'AdminController@validasi_zakat')->name('admin.validasi_zakat');
Route::put('/admin/zakat_web/{id_zakat}/update', 'AdminController@update_zakat_web')->name('admin.update_zakat_web');
Route::delete('/admin/zakat_web/{id_zakat}', 'AdminController@delete_zakat_web')->name('admin.delete_zakat_web');

Route::get('/findJamaahName', 'AdminController@findJamaahName');


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

