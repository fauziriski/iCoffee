<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|*/



Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/beranda', 'HomeController@index')->name('beranda');

//pelanggan
Route::get('/data-pelanggan', 'KelolaPenggunaController@dataPelanggan')->name('data-pelanggan');
Route::get('/lihat-pelanggan/{id}', 'KelolaPenggunaController@lihatPelanggan')->name('lihat-pelanggan');
Route::get('/edit-pelanggan/{id}', 'KelolaPenggunaController@edit')->name('edit-pelanggan');
Route::post('/pelanggan/store', 'KelolaPenggunaController@store')->name('pelanggan.store');
Route::post('/pelanggan/update', 'KelolaPenggunaController@update')->name('pelanggan.update');
Route::get('/hapus-pelanggan/{id}', 'KelolaPenggunaController@hapusPelanggan')->name('hapus-pelanggan');


//admin
Route::get('/data-admin', 'KelolaAdminController@dataAdmin')->name('data-admin');
Route::get('/lihat-admin/{id}', 'KelolaAdminController@lihat')->name('lihat-admin');
Route::get('/edit-admin/{id}', 'KelolaAdminController@edit')->name('edit-admin');
Route::post('/admin/store', 'KelolaAdminController@store')->name('admin.store');
Route::post('/admin/update', 'KelolaAdminController@update')->name('admin.update');
Route::get('/hapus-admin/{id}', 'KelolaAdminController@hapus')->name('hapus-admin');


//profile_admin
Route::get('/profile-admin', 'KelolaAdminController@adminProfile')->name('profile-admin');
Route::post('/profile/tambah', 'KelolaAdminController@tambahProfile')->name('profile.tambah');
Route::post('/profile/update', 'KelolaAdminController@profileUpdate')->name('profile.update');
Route::post('/profile2/update', 'KelolaAdminController@profile2Update')->name('profile2.update');


