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

// Route::group(['middleware'=>'redirect'],function (){
// Route::group(['middleware'=>'admin'],function (){
//admin
// 	Route::get('/admin','AdminController@index');
// 	Route::get('/super-admin','SuperAdminController@index');

// //admin jual-beli
// 	Route::get('/validasi-pembeli','AdminController@validasiPembeli');
// 	Route::get('/jenis-produk','AdminController@jenisProduk');
// 	Route::get('/laporan-penjualan','AdminController@laporanPenjualan');

// //admin Lelang
// 	Route::get('/validasi-produk-lelang','AdminController@validasiProdukLelang');
// 	Route::get('/proses-lelang','AdminController@prosesLelang');
// 	Route::get('/laporan-lelang','AdminController@laporanLelang');

// //admin investasi
// 	Route::get('/kelompok-petani','AdminController@kelompokPetani');
// 	Route::get('/produk-investasi','AdminController@produkInvestasi');
// 	Route::get('/progres-investasi','AdminController@progresInvestasi');
// 	Route::get('/pencairan-investasi','AdminController@pencairanInvestasi');
// 	Route::get('/laporan-investasi','AdminController@laporanInvestasi');

// // });
// // });




// jual beli
Route::get('/', function () {
	return view('index');
});


Route::get('/jual-beli', function(){
	return view('jual-beli.index');
});

Route::get('/jual-beli/produk', function(){
	return view('jual-beli.detailproduk');
});

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

