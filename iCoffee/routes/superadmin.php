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

//pelanggan
Route::get('/data-pelanggan', 'KelolaPenggunaController@dataPelanggan')->name('data-pelanggan');
Route::get('/lihat-pelanggan/{id}', 'KelolaPenggunaController@lihatPelanggan')->name('lihat-pelanggan');
Route::get('/edit-pelanggan/{id}', 'KelolaPenggunaController@edit')->name('edit-pelanggan');
Route::post('/pelanggan/store', 'KelolaPenggunaController@store')->name('pelanggan.store');
Route::post('/pelanggan/update', 'KelolaPenggunaController@update')->name('pelanggan.update');
Route::get('/hapus-pelanggan/{id}', 'KelolaPenggunaController@hapusPelanggan')->name('hapus-pelanggan');


//admin
Route::get('/data-admin', 'KelolaPenggunaController@dataAdmin')->name('data-admin');


