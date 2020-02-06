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
route::get('/profil/tambahalamat', 'HomeController@tambahalamat');
route::post('/profil/tambah' , 'HomeController@tambah_alamat');
route::get('/profil/edit', 'HomeController@profil');
route::post('/profil/tambah' , 'HomeController@tambah_alamat');
route::post('/profil/edit_profil', 'HomeController@edit_profil');
route::get('/profil/cekalamat/{id}', 'HomeController@cekalamat');
route::post('/profil/alamat/edit', 'HomeController@editalamat');
route::get('profil/carikota/{id}', 'HomeController@carikota');

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
Route::get('/jual-beli/invoice/{invoice}', 'KeranjangjbController@invoice');
Route::get('/jual-beli/invoice_penjual/{invoice}', 'KeranjangjbController@invoice_penjual');
Route::get('/jual-beli/transaksi', 'HomeController@transaksi');
Route::get('/jual-beli/konfirmasi', 'HomeController@pembayaran');
Route::post('/jual-beli/konfirmasi/pembayaran', 'HomeController@konfirmasipembayaran');
Route::post('/jual-beli/pesanan/terima', 'KeranjangjbController@pesananditerima');
Route::post('/jual-beli/pesanan/inputresi', 'KeranjangjbController@inputresi');
Route::post('/jual-beli/pesanan/selesai', 'KeranjangjbController@pesananselesai');
Route::get('/jual-beli/pesanan/{id}/komplain/{invoice}', 'KeranjangjbController@komplain');
Route::post('/jual-beli/pesanan/komplain', 'KeranjangjbController@komplaindiproses');


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
Route::get('/jual-beli/konfirmasi/lelang', 'HomeController@pembayaran');
Route::post('/jual-beli/konfirmasi/pembayaranlelang', 'HomeController@konfirmasipembayaranlelang');
Route::get('/lelang/keranjang', 'KeranjanglelangController@keranjang');
Route::get('/lelang/checkout', 'KeranjanglelangController@checkout');
Route::post('/lelang/checkout-barang', 'KeranjanglelangController@checkoutbarang');


// investasi

Route::get('/investasi', 'ProdukInvestasiController@index');
Route::get('/invest/produk/{id}','ProdukInvestasiController@detail');
Route::get('/jadi-mitra', 'KelompokTani@index');
// Route::get('/produk-investasi', 'ProdukInvestasiController@produkInvestasi')->middleware('auth');
Route::post('/daftar-kelompok/store', 'KelompokTani@store')->middleware('auth');
Route::post('/daftar-koperasi/store', 'MitraKoperasiController@store')->middleware('auth');
Route::post('/daftar-perorangan/store', 'MitraPeroranganController@store')->middleware('auth');
// Route::get('/pasang-investasi', 'ProdukInvestasiController@pasangInvestasi')->middleware('auth');
Route::get('/jadi-investor','InvestorController@formInvestor')->middleware('auth');
Route::post('/jadi-investor','InvestorController@store');

Route::group(['prefix' => 'invest','middleware' => 'auth'], function(){
	Route::get('/profil','InvestorController@profile');
	Route::post('/checkout', 'ProdukInvestasiController@checkout');
	Route::post('/checkout/berhasil', 'ProdukInvestasiController@pay');
	Route::get('/konfirmasi','InvestorController@confirm');
	Route::post('/konfirmasi/store','InvestorController@confirmStore');
	Route::get('/pembiayaan','InvestorController@orderHistory');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'mitra'], function(){
	Route::get('/','MitraController@index')->name('mitra.home');
	Route::get('/login','Mitra\LoginController@showLoginForm')->name('mitra.login');
	Route::post('/login','Mitra\LoginController@login')->name('mitra.login.submit');
	Route::get('/produk-investasi', 'ProdukInvestasiController@produkInvestasi')->name('investasi.mitra.produk')->middleware('auth:mitra');
	Route::get('/pasang-investasi', 'ProdukInvestasiController@pasangInvestasi')->middleware('auth:mitra');
	Route::post('/pasang-investasi','ProdukInvestasiController@store')->middleware('auth:mitra');
	Route::get('/logout','Mitra\LoginController@logout');
});