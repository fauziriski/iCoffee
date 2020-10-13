<?php


Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/beranda', 'HomeController@index')->name('beranda');

//kategori artikel
Route::get('/kategori-artikel', 'KategoriController@index')->name('kategori-artikel');
Route::post('/kategori-artikel/store', 'KategoriController@store')->name('kategori-artikel.store');
Route::post('/kategori-artikel/update', 'KategoriController@update')->name('kategori-artikel.update');
Route::get('/edit-kategori/{id}', 'KategoriController@edit')->name('edit-kategori');
Route::get('/hapus-kategori/{id}', 'KategoriController@destroy')->name('hapus-kategori');

//artikel blog
Route::get('/artikel-blog', 'ArtikelController@dataArtikel')->name('artikel-blog');
Route::get('/tambah-artikel', 'ArtikelController@create')->name('tambah-artikel'); 
Route::get('/hapus-artikel/{id}', 'ArtikelController@destroy')->name('hapus-artikel');
Route::resource('artikel', 'ArtikelController');

Route::get('/slug-artikel', 'SeoController@slugArtikel')->name('slug-artikel');
Route::get('/slug-produk', 'SeoController@slugProduk')->name('slug-produk');
