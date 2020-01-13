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
Route::get('/data-pelanggan', 'KelolaPenggunaController@dataPelanggan')->name('data-pelanggan');
// Route::post('/update-pelanggan', 'KelolaPengguna@updatePelanggan')->name('pelanggan.update');
Route::get('/hapus-pelanggan/{id}', 'KelolaPenggunaController@hapusPelanggan');


