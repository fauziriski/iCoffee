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