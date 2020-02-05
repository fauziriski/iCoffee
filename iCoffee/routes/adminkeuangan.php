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
Route::post('/tambah-administrasi', 'AdministrasiController@tambah')->name('tambah-administrasi');
Route::get('/hapus-administrasi/{id}', 'AdministrasiController@hapus')->name('hapus-administrasi');
Route::get('/update-administrasi', 'AdministrasiController@update')->name('update-administrasi');