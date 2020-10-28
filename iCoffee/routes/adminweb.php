<?php


Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/beranda', 'HomeController@index')->name('beranda');

//profile_admin
Route::get('/profile-admin', 'HomeController@adminProfile')->name('profile-admin');
Route::post('/profile/tambah', 'HomeController@tambahProfile')->name('profile.tambah');
Route::post('/profile/update', 'HomeController@profileUpdate')->name('profile.update');
Route::post('/profile2/update', 'HomeController@profile2Update')->name('profile2.update');

Route::group(['middleware' => ['can:read|create|update|delete']], function () {
Route::resource('artikel', 'ArtikelController');
});


Route::group(['middleware' => ['can:read']], function () {
    Route::get('/kategori-artikel', 'KategoriController@index')->name('kategori-artikel');
    Route::get('/artikel-blog', 'ArtikelController@dataArtikel')->name('artikel-blog');
    Route::get('/slug-artikel', 'SeoController@slugArtikel')->name('slug-artikel');
    Route::get('/slug-produk', 'SeoController@slugProduk')->name('slug-produk');
});

Route::group(['middleware' => ['can:created']], function () {
    Route::post('/kategori-artikel/store', 'KategoriController@store')->name('kategori-artikel.store');
    Route::get('/tambah-artikel', 'ArtikelController@create')->name('tambah-artikel'); 
});

Route::group(['middleware' => ['can:update']], function () {
    Route::post('/kategori-artikel/update', 'KategoriController@update')->name('kategori-artikel.update');
    Route::get('/edit-kategori/{id}', 'KategoriController@edit')->name('edit-kategori');
});

Route::group(['middleware' => ['can:delete']], function () {
    Route::get('/hapus-kategori/{id}', 'KategoriController@destroy')->name('hapus-kategori');
    Route::get('/hapus-artikel/{id}', 'ArtikelController@destroy')->name('hapus-artikel');
});