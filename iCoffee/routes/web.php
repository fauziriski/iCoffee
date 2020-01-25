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



Route::get('/', function () {
	return view('index');
});

//profil
route::get('/profil/edit', 'HomeController@profil');

// jual beli
Route::get('/pasang-jualbeli', 'HomeController@pasangjualbeli');
Route::post('/pasang-produk/berhasil', 'HomeController@pasangproduk');
Route::get('/jual-beli','ProdukController@index');
Route::get('/jual-beli/produk/{id}','ProdukController@detail');
Route::get('/jual-beli/keranjang','KeranjangjbController@keranjang');
Route::post('/jual-beli/keranjang/tambah-produk','KeranjangjbController@tambahkeranjang');
Route::get('/jual-beli/checkout', 'KeranjangjbController@checkout');
Route::post('/jual-beli/checkout-barang', 'KeranjangjbController@checkoutbarang');
Route::post('/jual-beli/update-keranjang', 'KeranjangjbController@updatekeranjang')->name('jual-beli.editdata');
Route::get('/jual-beli/keranjang/hapus/{id}', 'KeranjangjbController@hapus');
Route::post('/jual-beli/pesanbarang', 'KeranjangjbController@pesanbarang');
Route::get('/jual-beli/checkout/kurir/{kurir}', 'KeranjangjbController@cekongkir');



Route::get('page/getprovince', 'ApiController@getprovince');
Route::get('page/getcity', 'ApiController@getcity');
Route::get('page/cekshipping', 'ApiController@cekshipping');


//lelang
Route::get('/pasang-lelang', 'ProdukLelangController@pasangLelang');
Route::post('/pasang-lelang/berhasil', 'ProdukLelangController@pasangLelangberhasil');
Route::get('/lelang', 'ProdukController@lelang');
Route::get('/lelang/produk/{id}', 'ProdukLelangController@detaillelang');
Route::get('/lelang/produk/data/{id}', 'ProdukLelangController@datalelang');
Route::post('/lelang/produk/tawar', 'ProdukLelangController@tawar');


// investasi

Route::get('/investasi', 'ProdukInvestasiController@index');
Route::get('/invest/produk/{id}','ProdukInvestasiController@detail');
Route::get('/jadi-mitra', 'KelompokTani@index');
Route::get('/produk-investasi', 'ProdukInvestasiController@produkInvestasi')->middleware('auth');
Route::post('/daftar-kelompok/store', 'KelompokTani@store');
Route::post('/daftar-koperasi/store', 'MitraKoperasiController@store');
Route::post('/daftar-perorangan/store', 'MitraPeroranganController@store');
Route::post('/pasang-investasi/store','ProdukInvestasiController@store')->middleware('auth');
Route::get('/pasang-investasi', 'ProdukInvestasiController@pasangInvestasi')->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/mitra','MitraController@index');
Route::get('/mitra/login','MitraController@showLoginForm');
Route::post('/mitra/login','MitraController@login');
