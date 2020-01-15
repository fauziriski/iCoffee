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

// Route::get('/jual-beli/produk', function(){
// 	return view('jual-beli.detailproduk');
// });
Route::get('/jual-beli/produk/{id}','ProdukController@detail');

Route::get('/jual-beli/checkout', function(){
	return view('jual-beli.checkout');
});


Route::get('/jual-beli/keranjang', function(){
	return view('jual-beli.keranjang');
});

Route::get('/pasang-jualbeli', 'ProdukController@pasangjualbeli');
Route::post('/pasang-produk/berhasil', 'ProdukController@pasangproduk');


Route::get('/pasang-lelang', 'ProdukLelangController@pasangLelang');
Route::get('/pasang-investasi', 'ProdukInvestasiController@pasangInvestasi');


//lelang
Route::get('/lelang', function () {
	return view('jual-beli.lelang.index');
});

// investasi

Route::get('/investasi', function () {
	return view('investasi.index');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

