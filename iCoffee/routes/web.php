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
route::get('/profil/carikota/{id}', 'HomeController@carikota');
route::get('/profil/top_up', 'HomeController@top_up');
route::post('/profil/top_up/proses', 'HomeController@top_up_diproses');
route::get('/profil/konfirmasi/top_up', 'HomeController@konfirmasi_top_up');
route::post('/profil/konfirmasi/top_up/berhasil', 'HomeController@konfirmasipembayarantopup');
route::get('/profil/produk','HomeController@produksaya');
route::get('/profil/utama/alamat/{id}','HomeController@alamat_utama');
route::post('/profil/tambah/cadangan', 'HomeController@tambah_alamat_cadangan');
route::get('/profil/alamat/hapus/{id}','HomeController@alamathapus');

route::get('/profile/invoice/top_up', 'HomeController@invoice_top_up');
route::get('/profil/top_up/detailinvoice/{id}', 'HomeController@invoicetopup_detail');
route::get('/profil/tarik_saldo', 'HomeController@tarik_saldo');
route::post('/profil/saldo/tarik', 'HomeController@tarik_saldo_konfirmasi');
route::get('/profil/tarikdana/{invoice}', 'HomeController@cek_invoice_dana');
route::get('/profil/batal/dana_cair/{invoice}', 'HomeController@batal_tarik_dana');



Route::namespace('JualBeli\Pembelian')->group(function () {
	//Home
	Route::get('/jual-beli','HomeController@index');
	Route::get('/jual-beli/kategori/{id}', 'HomeController@category');
	Route::get('/jual-beli/produk/{id}','HomeController@detail');

	//Cart
	Route::get('/jual-beli/keranjang','CartController@index');
	Route::post('/jual-beli/keranjang/tambah-produk','CartController@store');
	route::get('/jual-beli/keranjang/tambah-produk/{id}','CartController@storeById');
	Route::get('/jual-beli/keranjang/hapus/{id}', 'CartController@destroy');
	Route::get('/jual-beli/update-keranjang/{id}/{index}', 'CartController@update');
	Route::get('/jual-beli/update-cart/{id}/{jumlah}', 'CartController@updateByValue');

	//Checout
	// Route::get('/jual-beli/checkout', 'KeranjangjbController@checkout');
	Route::post('/jual-beli/checkout', 'CheckoutController@index');

	//Invoice
	Route::get('/jual-beli/invoice/{invoice}', 'InvoiceController@index');
	Route::get('/jual-beli/invoice/batal/{invoice}', 'InvoiceController@cancelOrder');
	Route::post('/jual-beli/pesanan/selesai', 'InvoiceController@acceptedProduct');
	Route::post('/jual-beli/rating', 'InvoiceController@rating');

	//Complaint
	Route::get('/jual-beli/pesanan/{id}/komplain/{invoice}', 'ComplaintController@index');
	Route::post('/jual-beli/pesanan/komplain', 'ComplaintController@update');

});

Route::namespace('JualBeli\Penjualan')->group(function () {
	//Invoice
	Route::get('/jual-beli/invoice_penjual/{invoice}', 'InvoiceController@index');
	Route::post('/jual-beli/pesanan/terima', 'InvoiceController@ordersAccepted');
	Route::post('/jual-beli/pesanan/inputresi', 'InvoiceController@updateResi');
	
});


// jual beli
route::get('/jual-beli/produk/edit/{id}', 'HomeController@edit_produk');
route::post('/jual-beli/produk/edit/berhasil', 'HomeController@edit_produk_berhasil');
Route::get('/pasang-jualbeli', 'HomeController@pasangjualbeli');
Route::post('/pasang-produk/berhasil', 'HomeController@pasangproduk');

Route::get('/jual-beli/province/data', 'KeranjangjbController@province');
Route::get('/jual-beli/url/', 'KeranjangjbController@file_get_content_curl');


Route::post('/jual-beli/pesanbarang', 'KeranjangjbController@pesanbarang');
Route::get('/jual-beli/checkout/kurir/{kurir}', 'KeranjangjbController@cekongkir');



Route::get('/jual-beli/transaksi', 'HomeController@transaksi');
Route::get('/jual-beli/konfirmasi', 'HomeController@pembayaran');
Route::post('/jual-beli/konfirmasi/pembayaran', 'HomeController@konfirmasipembayaran');








Route::get('page/getprovince', 'ApiController@getprovince');
Route::get('page/getcity', 'ApiController@getcity');
Route::get('page/cekshipping', 'ApiController@cekshipping');


//lelang
Route::get('/pasang-lelang', 'ProdukLelangController@pasangLelang');
Route::post('/pasang-lelang/berhasil', 'ProdukLelangController@pasangLelangberhasil');
Route::get('/lelang', 'ProdukController@lelang');
Route::get('/lelang/kategori/{id}', 'ProdukController@lelangkategori');
Route::get('/lelang/produk/{id}', 'ProdukLelangController@detaillelang');
Route::get('/lelang/produk/data/{id}', 'ProdukLelangController@datalelang');
Route::post('/lelang/produk/tawar', 'ProdukLelangController@tawar');
Route::get('/jual-beli/konfirmasi/lelang', 'HomeController@pembayaranlelang');
Route::post('/jual-beli/konfirmasi/pembayaranlelang', 'HomeController@konfirmasipembayaranlelang');
Route::get('/lelang/keranjang', 'KeranjanglelangController@keranjang');
Route::get('/lelang/checkout', 'KeranjanglelangController@checkout');
Route::post('/lelang/checkout-barang', 'KeranjanglelangController@checkoutbarang');
Route::post('/lelang/pesanbarang', 'KeranjanglelangController@pesanbarang');
Route::get('/lelang/transaksi', 'KeranjanglelangController@transaksi');
Route::get('/lelang/invoice/{invoice}', 'KeranjanglelangController@invoice');
Route::get('/lelang/invoice_penjual/{invoice}', 'KeranjanglelangController@invoice_penjual');

Route::post('/lelang/pesanan/terima', 'KeranjanglelangController@pesananditerima');
Route::post('/lelang/pesanan/inputresi', 'KeranjanglelangController@inputresi');
Route::post('/lelang/pesanan/selesai', 'KeranjanglelangController@pesananselesai');
Route::get('/lelang/pesanan/{id}/komplain/{invoice}', 'KeranjanglelangController@komplain');
Route::post('/lelang/pesanan/komplain', 'KeranjanglelangController@komplaindiproses');
Route::post('/lelang/rating', 'KeranjanglelangController@rating');



// investasi

Route::get('/invest', 'ProdukInvestasiController@index');
Route::get('/invest/produk/{id}','ProdukInvestasiController@detail');
Route::get('/jadi-mitra', 'KelompokTani@index');
// Route::get('/produk-investasi', 'ProdukInvestasiController@produkInvestasi')->middleware('auth');
Route::post('/daftar-kelompok/store', 'KelompokTani@store');
Route::post('/daftar-koperasi/store', 'MitraKoperasiController@store');
Route::post('/daftar-perorangan/store', 'MitraPeroranganController@store');
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
	Route::get('/produk/{kode_produk}','MitraController@produkDetail')->middleware('auth:mitra');
	Route::get('/pengajuan-dana', 'PengajuanDanaController@produkPengajuanDana')->middleware('auth:mitra');
	Route::get('/rekening-mitra','MitraController@rekeningMitra')->name('investasi.mitra.rekening');
	Route::get('/pengajuan-dana/{kode_produk}', 'PengajuanDanaController@pengajuanDana');
	Route::post('/pengajuan-dana-1', 'PengajuanDanaController@pengajuanDana1');
	Route::post('/pengajuan-dana-2', 'PengajuanDanaController@pengajuanDana2');
	Route::post('/pengajuan-dana-3', 'PengajuanDanaController@pengajuanDana3');
	Route::post('/pengajuan-dana-4', 'PengajuanDanaController@pengajuanDana4');
	Route::post('/tambah-bank','MitraController@tambahBank');
	Route::post('/tarik-saldo','MitraController@tarikSaldo');
	Route::get('/logout','Mitra\LoginController@logout');
});
Route::get('/nyoba','MitraController@test');
Route::post('/daftar-mitra-nyoba','MitraController@nyoba');