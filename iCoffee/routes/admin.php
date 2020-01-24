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
Route::post('/validasi-petani/koperasi', 'ValidasiPetaniController@koperasi')->name('validasi-petani.koperasi');

Route::get('/mitra-perorangan', 'MitraPeroranganController@mitraPerorangan')->name('mitra-perorangan');
Route::get('/validasi-perorangan/{id}', 'MitraPeroranganController@validasiPerorangan')->name('validasi-perorangan');
Route::post('/tolak-perorangan/update', 'MitraPeroranganController@tolakPerorangan')->name('tolak-perorangan.update');
Route::post('/validasi-petani/perorangan', 'ValidasiPetaniController@perorangan')->name('validasi-petani.perorangan');

Route::get('/kelompok-tani', 'MitraKelompokController@kelompokTani')->name('kelompok-tani');
Route::get('/validasi-kelompok/{id}', 'MitraKelompokController@validasiKelompok')->name('validasi-kelompok');
Route::post('/tolak-kelompok/update', 'MitraKelompokController@tolakKelompok')->name('tolak-kelompok.update');
Route::post('/validasi-petani/kelompok', 'ValidasiPetaniController@kelompok')->name('validasi-petani.kelompok');

Route::get('/jenis-produk', 'JualBeliController@jenisProduk')->name('jenis-produk');
Route::get('/lihat-produk/{id}', 'JualBeliController@lihatProduk')->name('lihat-produk');
Route::get('/hapus-produk/{id}', 'JualBeliController@hapus')->name('hapus-produk');

Route::get('/validasi-produk-lelang', 'ValidasiProdukController@ProdukLelang')->name('validasi-produk-lelang');
Route::get('/lihat-produk-lelang/{id}', 'ValidasiProdukController@lihatProdukLelang')->name('lihat-produk-lelang');
Route::get('/produk-lelang/{id}', 'ValidasiProdukController@ValidasiProduk')->name('produk-lelang');
Route::post('/tolak-produk-lelang/update', 'ValidasiProdukController@TolakProdukLelang')->name('tolak-produk-lelang');
Route::post('/divalidasi-produk-lelang/update', 'ValidasiProdukController@ValidasiProdukLelang')->name('divalidasi-produk-lelang');
Route::post('/proses-produk-lelang/update', 'ValidasiProdukController@ProsesProdukLelang')->name('proses-produk-lelang');









