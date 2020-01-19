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

Route::get('/kategori-produk', 'KelolaProdukController@index')->name('kategori-produk');
Route::post('/kategori-produk/store', 'KelolaProdukController@store')->name('kategori-produk.store');
Route::post('/kategori-produk/update', 'KelolaProdukController@update')->name('kategori-produk.update');
Route::get('/edit-kategori/{id}', 'KelolaProdukController@edit')->name('edit-kategori');
Route::get('/hapus-kategori/{id}', 'KelolaProdukController@destroy')->name('hapus-kategori');

Route::get('/mitra-koperasi', 'MitraKoperasiController@mitraKoperasi')->name('mitra-koperasi');
Route::get('/validasi-koperasi/{id}', 'MitraKoperasiController@validasiKoperasi')->name('validasi-koperasi');
Route::post('/tolak-koperasi/update', 'MitraKoperasiController@tolakKoperasi')->name('tolak-koperasi.update');




Route::get('/kelompok-tani', 'MitraKelompokController@kelompokTani')->name('kelompok-tani');
Route::get('/mitra-perorangan', 'MitraPeroranganController@mitraPerorangan')->name('mitra-perorangan');

Route::post('/validasi-petani/koperasi', 'ValidasiPetaniController@koperasi')->name('validasi-petani.koperasi');






