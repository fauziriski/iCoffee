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

