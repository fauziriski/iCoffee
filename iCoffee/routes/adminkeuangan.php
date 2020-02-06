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
Route::get('/format-akun', 'FormatAkunController@dataPelanggan')->name('format-akun');
// Route::get('/data-admin', 'KelolaPenggunaController@dataAdmin')->name('data-admin');
// Route::get('/hapus-pengguna/{id}', 'KelolaPenggunaController@hapusPengguna')->name('hapus-pengguna');


Route::get('/administrasi', 'AdministrasiController@dataAdministrasi')->name('administrasi');
Route::get('/lihat-administrasi/{id}', 'AdministrasiController@lihatAdministrasi')->name('lihat-administrasi');
Route::get('/detail-administrasi/{id}', 'AdministrasiController@detailAdministrasi')->name('detail-administrasi');
Route::post('/tambah-administrasi', 'AdministrasiController@tambah')->name('tambah-administrasi');
Route::get('/hapus-administrasi/{id}', 'AdministrasiController@hapus')->name('hapus-administrasi');
Route::post('/update-administrasi', 'AdministrasiController@update')->name('update-administrasi');


Route::get('/setor-petani', 'SetorPetaniController@dataSetorPetani')->name('setor-petani');
Route::get('/lihat-petani/{id}', 'SetorPetaniController@lihatpetani')->name('lihat-petani');
Route::get('/detail-petani/{id}', 'SetorPetaniController@detailpetani')->name('detail-petani');
Route::post('/tambah-petani', 'SetorPetaniController@tambah')->name('tambah-petani');
Route::get('/hapus-petani/{id}', 'SetorPetaniController@hapus')->name('hapus-petani');
Route::post('/update-petani', 'SetorPetaniController@update')->name('update-petani');

Route::get('/keluar-bagi-hasil', 'KeluarBagiHasilController@dataBagiHasil')->name('keluar-bagi-hasil');
Route::get('/lihat-keluar-bagi-hasil/{id}', 'KeluarBagiHasilController@lihat')->name('lihat-keluar-bagi-hasil');
Route::get('/detail-keluar-bagi-hasil/{id}', 'KeluarBagiHasilController@detail')->name('detail-keluar-bagi-hasil');
Route::post('/tambah-keluar-bagi-hasil', 'KeluarBagiHasilController@tambah')->name('tambah-keluar-bagi-hasil');
Route::get('/hapus-keluar-bagi-hasil/{id}', 'KeluarBagiHasilController@hapus')->name('hapus-keluar-bagi-hasil');
Route::post('/update-keluar-bagi-hasil', 'KeluarBagiHasilController@update')->name('update-keluar-bagi-hasil');

Route::get('/arus-kas', 'ArusKasController@lihat')->name('arus-kas');