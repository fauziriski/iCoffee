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

Route::group(['middleware'=>'Admin'],function (){
//admin
Route::get('/admin','AdminController@index');
Route::get('/super-admin','SuperAdminController@index');

//admin jual-beli
Route::get('/validasi-pembeli','AdminController@validasiPembeli');
Route::get('/jenis-produk','AdminController@jenisProduk');
Route::get('/laporan-penjualan','AdminController@laporanPenjualan');

//admin Lelang
Route::get('/validasi-produk-lelang','AdminController@validasiProdukLelang');
Route::get('/proses-lelang','AdminController@prosesLelang');
Route::get('/laporan-lelang','AdminController@laporanLelang');

//admin investasi
Route::get('/kelompok-petani','AdminController@kelompokPetani');
Route::get('/produk-investasi','AdminController@produkInvestasi');
Route::get('/progres-investasi','AdminController@progresInvestasi');
Route::get('/pencairan-investasi','AdminController@pencairanInvestasi');
Route::get('/laporan-investasi','AdminController@laporanInvestasi');

});

//admin login
Route::get('/masuk_admin','UserController@adminMasuk');
Route::post('/admin_login','UserController@prosesAdminMasuk');



//login/regis pengguna

Route::get('/masuk','UserController@masuk');
Route::get('/daftar','UserController@daftar');
Route::post('/daftar_user','UserController@prosesDaftar');
Route::post('/user_login','UserController@prosesMasuk');
Route::get('/keluar','UserController@keluar');



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




