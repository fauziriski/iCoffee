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



// Route::get('/', function () {
// 	return view('index');
// });

route::get('/', 'IndexController@index');

//login sosmed
Auth::routes();
Route::get('/login/{social}','Auth\LoginController@socialLogin')
        ->where('social','twitter|facebook|linkedin|google|github');
Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')
        ->where('social','twitter|facebook|linkedin|google|github');

//profil
route::get('/profile/tambahalamat', 'HomeController@tambahalamat');
route::post('/profile/tambah' , 'HomeController@tambah_alamat');
route::get('/profile/edit', 'HomeController@profile');
Route::get('/profile/subdistrict/{id}', 'HomeController@subdistrict');

route::post('/profile/edit_profile', 'HomeController@edit_profile');
route::post('/profile/edit_password', 'HomeController@update_password');

//address
Route::get('/profile/alamat', 'HomeController@alamat');
route::post('/profile/tambah/cadangan', 'HomeController@tambah_alamat_cadangan');
route::get('/profile/cekalamat/{id}', 'HomeController@cekalamat');
route::get('/profile/carikota/{id}', 'HomeController@carikota');
route::post('/profile/alamat/edit', 'HomeController@editalamat');
route::get('/profile/alamat/hapus/{id}','HomeController@alamathapus');
route::get('/profile/utama/alamat/{id}','HomeController@alamat_utama');


route::post('/profile/top_up/proses', 'HomeController@top_up_diproses');

route::post('/profile/konfirmasi/top_up/berhasil', 'HomeController@konfirmasipembayarantopup');
route::get('/profil/produk','HomeController@produksaya');



route::get('/profile/top_up/history', 'Profile\TopUpController@index');

route::get('/profile/top_up', 'HomeController@top_up');
route::get('/profile/konfirmasi/top_up', 'HomeController@konfirmasi_top_up');

route::get('/profile/invoice/top_up', 'HomeController@invoice_top_up');
route::get('/profile/top_up/detailinvoice/{id}', 'HomeController@invoicetopup_detail');
route::get('/profile/tarik_saldo', 'HomeController@tarik_saldo');
route::post('/profile/saldo/tarik', 'HomeController@tarik_saldo_konfirmasi');


route::get('/profil/tarikdana/{invoice}', 'HomeController@cek_invoice_dana');
route::get('/profil/batal/dana_cair/{invoice}', 'HomeController@batal_tarik_dana');



Route::namespace('JualBeli\Pembelian')->group(function () {
	//Home
	Route::get('/jual-beli','HomeController@index');
	Route::get('/jual-beli/kategori/{slug}', 'HomeController@category');
	Route::get('/jual-beli/produk/{slug}','HomeController@detail');

	//Cart
	Route::get('/jual-beli/keranjang','CartController@index');
	Route::post('/jual-beli/keranjang/tambah-produk','CartController@store');
	route::get('/jual-beli/keranjang/tambah-produk/{slug}','CartController@storeById');
	Route::get('/jual-beli/keranjang/hapus/{id}', 'CartController@destroy');
	Route::get('/jual-beli/update-keranjang/{id}/{index}', 'CartController@update');
	Route::get('/jual-beli/update-cart/{id}/{jumlah}', 'CartController@updateByValue');

	//Checkout
	// Route::get('/jual-beli/checkout', 'KeranjangjbController@checkout');
	Route::post('/jual-beli/checkout', 'CheckoutController@index');
	Route::get('/jual-beli/checkout', 'CheckoutController@checkId');
	Route::post('/jual-beli/pesanbarang', 'CheckoutController@store');

	//Invoice
	Route::get('/jual-beli/invoice/{invoice}', 'InvoiceController@index');
	Route::get('/jual-beli/invoice/batal/{invoice}', 'InvoiceController@cancelOrder');
	Route::post('/jual-beli/pesanan/selesai', 'InvoiceController@acceptedProduct');
	Route::post('/jual-beli/rating', 'InvoiceController@rating');

	//Complaint
	Route::get('/jual-beli/pesanan/{id}/komplain/{invoice}', 'ComplaintController@index');
	Route::post('/jual-beli/pesanan/komplain', 'ComplaintController@update');

	//Confirm Payment
	Route::get('/jual-beli/konfirmasi', 'ConfirmPaymentController@index');
	Route::post('/jual-beli/konfirmasi/pembayaran', 'ConfirmPaymentController@store');

	//Transaction
	// Route::get('/jual-beli/transaksi', 'TransactionController@index');
	Route::get('/jual-beli/transaksi/pembelian', 'TransactionController@indexBuy');

});

Route::namespace('JualBeli\Penjualan')->group(function () {
	//Invoice
	Route::get('/jual-beli/invoice_penjual/{invoice}', 'InvoiceController@index');
	Route::post('/jual-beli/pesanan/terima', 'InvoiceController@ordersAccepted');
	Route::post('/jual-beli/pesanan/inputresi', 'InvoiceController@updateResi');

	//product
	Route::get('/jual-beli/produk-saya','ProdukController@index');
	Route::get('/pasang-jualbeli', 'ProdukController@create');
	Route::post('/pasang-produk/berhasil', 'ProdukController@store');
	Route::get('/jual-beli/produk/edit/{id}', 'ProdukController@edit');
	Route::post('/jual-beli/produk/edit/berhasil', 'ProdukController@update');
	Route::get('/jual-beli/produk/delete/{id}', 'ProdukController@delete');

	//transaction
	Route::get('/jual-beli/transaksi/penjualan', 'TransactionController@indexSell');

	//getwaybill
	Route::get('/waybill/trasaction/{id}', 'InvoiceController@getWayBill');
	
});



// jual beli

Route::get('/jual-beli/province/data', 'KeranjangjbController@province');
Route::get('/jual-beli/url/', 'KeranjangjbController@file_get_content_curl');

// Route::post('/jual-beli/pesanbarang', 'KeranjangjbController@pesanbarang');
Route::get('/jual-beli/checkout/kurir/{kurir}', 'KeranjangjbController@cekongkir');

Route::get('/ceks', function(){ return view('jual-beli.cek'); });

Route::get('page/getprovince', 'ApiController@getprovince');
Route::get('page/getcity', 'ApiController@getcity');
Route::get('page/cekshipping', 'ApiController@cekshipping');

//Lelang

Route::namespace('Lelang\Pembelian')->group(function () {

	//home
	Route::get('/lelang', 'HomeController@index');
	Route::get('/lelang/produk/{id}', 'HomeController@show')->middleware('auth');
	Route::get('/lelang/kategori/{id}', 'HomeController@indexById');
	Route::get('/lelang/produk/data/{id}', 'HomeController@getDataAuction');
	Route::post('/lelang/produk/tawar', 'ProdukLelangController@bid');

	//Cart
	Route::get('/lelang/keranjang', 'CartController@index');

	//Checkout
	Route::post('/lelang/checkout-barang', 'CheckoutController@index');
	Route::get('/lelang/checkout-barang', 'CheckoutController@checkId');
	Route::post('/lelang/pesanbarang', 'CheckoutController@store');

	//Confirm Payment
	Route::get('/lelang/konfirmasi', 'ConfirmPaymentController@pembayaranlelang');
	Route::post('/lelang/konfirmasi/pembayaran', 'ConfirmPaymentController@konfirmasipembayaranlelang');

	//Invoice
	Route::get('/lelang/invoice/{invoice}', 'InvoiceController@invoice');
	Route::post('/lelang/pesanan/selesai', 'InvoiceController@pesananselesai');
	Route::post('/lelang/rating', 'InvoiceController@rating');
	
	//Transaction
	Route::get('/lelang/transaksi/pembelian', 'TransactionController@index');

	//Complain
	Route::get('/lelang/pesanan/{id}/komplain/{invoice}', 'KeranjanglelangController@komplain');
	Route::post('/lelang/pesanan/komplain', 'KeranjanglelangController@komplaindiproses');

	//get data province new
	Route::get('/get-new-province', 'TransactionController@getProvinceData');

	



});

Route::namespace('Lelang\Penjualan')->group(function () {

	//product
	Route::get('/pasang-lelang', 'ProductController@create');
	Route::post('/pasang-lelang/berhasil', 'ProductController@store');
	Route::get('/lelang/produk-saya','ProductController@index');

	//Transaction
	Route::get('/lelang/transaksi/penjualan', 'TransactionController@index');

	//Invoice
	Route::get('/lelang/invoice_penjual/{invoice}', 'InvoiceController@invoice_penjual');
	Route::post('/lelang/pesanan/terima', 'InvoiceController@pesananditerima');
	Route::post('/lelang/pesanan/inputresi', 'InvoiceController@inputresi');


});


//lelang
// Route::get('/lelang/checkout', 'KeranjanglelangController@checkout');
// Route::get('/lelang/transaksi', 'KeranjanglelangController@transaksi');



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

// Route::get('/home', 'HomeController@index')->name('home');

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



//blog
Route::namespace('Blog')->group(function () {
Route::get('/artikel', 'FrontController@index')->name('artikel-blog');
Route::get('/artikel/{artikel}', 'FrontController@show')->name('artikel.detail');
Route::get('/about', 'FrontController@about')->name('about');
Route::get('/contact', 'FrontController@contact')->name('contact');
Route::get('/artikel-kategori/{kategori}', 'FrontController@artikel_kategori')->name('artikel.kategori');
});