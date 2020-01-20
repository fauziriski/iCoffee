<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// jual beli
Route::get('/', function () {
	return view('index');
});

Route::get('/jual-beli','ProdukController@index');

Route::get('/jual-beli/produk/{id}','ProdukController@detail');

Route::get('/jual-beli/keranjang','KeranjangjbController@keranjang');

Route::post('/jual-beli/keranjang/tambah-produk','KeranjangjbController@tambahkeranjang');

Route::get('/jual-beli/checkout', 'KeranjangjbController@checkout');

Route::post('/jual-beli/checkout-barang', 'KeranjangjbController@checkoutbarang');

Route::post('/jual-beli/update-keranjang', 'KeranjangjbController@updatekeranjang')->name('jual-beli.editdata');

Route::get('/jual-beli/keranjang/hapus/{id}', 'KeranjangjbController@hapus');

Route::post('/jual-beli/pesanbarang', 'KeranjangjbController@pesanbarang');

Route::get('/pasang-jualbeli', 'ProdukController@pasangjualbeli');
Route::post('/pasang-produk/berhasil', 'ProdukController@pasangproduk');

Route::get('/jual-beli/checkout/kurir/{kurir}', 'KeranjangjbController@cekongkir');


Route::get('/pasang-lelang', 'ProdukLelangController@pasangLelang');
Route::get('/pasang-investasi', 'ProdukInvestasiController@pasangInvestasi');

Route::get('page/getprovince', 'ApiController@getprovince');
Route::get('page/getcity', 'ApiController@getcity');
Route::get('page/cekshipping', 'ApiController@cekshipping');


//lelang
Route::get('/lelang', function () {
	return view('jual-beli.lelang.index');
});

// investasi

Route::get('/investasi', function () {
	return view('investasi.index');
});

Route::get('/jadi-mitra', 'KelompokTani@index');
Route::get('/produk-investasi', 'ProdukInvestasiController@produkInvestasi');
Route::post('/daftar-kelompok/store', 'KelompokTani@store');
Route::post('/daftar-koperasi/store', 'MitraKoperasiController@store');
Route::post('/daftar-perorangan/store', 'MitraPeroranganController@store');
Route::post('/pasang-investasi/store','ProdukInvestasiController@store');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

