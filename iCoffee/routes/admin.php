<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|*/

Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/beranda', 'HomeController@index')->name('beranda');

Route::get('/kategori-produk', 'KelolaProdukController@index')->name('kategori-produk');
Route::post('/kategori-produk/store', 'KelolaProdukController@store')->name('kategori-produk.store');
Route::post('/kategori-produk/update', 'KelolaProdukController@update')->name('kategori-produk.update');
Route::get('/edit-kategori/{id}', 'KelolaProdukController@edit')->name('edit-kategori');
Route::get('/hapus-kategori/{id}', 'KelolaProdukController@destroy')->name('hapus-kategori');

Route::get('/mitra-koperasi', 'MitraKoperasiController@mitraKoperasi')->name('mitra-koperasi');
Route::get('/validasi-koperasi/{id}', 'MitraKoperasiController@validasiKoperasi')->name('validasi-koperasi');
Route::post('/tolak-koperasi/update', 'MitraKoperasiController@tolakKoperasi')->name('tolak-koperasi.update');
Route::post('/validasi-petani/koperasi', 'ValidasiPetaniController@koperasi')->name('validasi-petani.koperasi');

Route::get('/mitra-perorangan', 'MitraPeroranganController@mitraPerorangan')->name('mitra-perorangan');
Route::get('/validasi-perorangan/{id}', 'MitraPeroranganController@validasiPerorangan')->name('validasi-perorangan');
Route::post('/tolak-perorangan/update', 'MitraPeroranganController@tolakPerorangan')->name('tolak-perorangan.update');
Route::post('/validasi-petani/perorangan', 'ValidasiPetaniController@perorangan')->name('validasi-petani.perorangan');

Route::get('/kelompok-tani', 'MitraKelompokController@kelompokTani')->name('kelompok-tani');
Route::get('/validasi-kelompok/{id}', 'MitraKelompokController@validasiKelompok')->name('validasi-kelompok');
Route::post('/tolak-kelompok/update', 'MitraKelompokController@tolakKelompok')->name('tolak-kelompok.update');
Route::post('/validasi-petani/kelompok', 'ValidasiPetaniController@kelompok')->name('validasi-petani.kelompok');

Route::get('/jenis-produk', 'JualBeliController@jenisProduk')->name('jenis-produk');
Route::get('/lihat-produk/{id}', 'JualBeliController@lihatProduk')->name('lihat-produk');
Route::get('/hapus-produk/{id}', 'JualBeliController@hapus')->name('hapus-produk');

Route::get('/validasi-produk-lelang', 'ValidasiProdukLelangController@ProdukLelang')->name('validasi-produk-lelang');
Route::get('/lihat-produk-lelang/{id}', 'ValidasiProdukLelangController@lihatProdukLelang')->name('lihat-produk-lelang');
Route::get('/produk-lelang/{id}', 'ValidasiProdukLelangController@dataProdukLelang')->name('produk-lelang');
Route::post('/tolak-produk-lelang/update', 'ValidasiProdukLelangController@TolakProdukLelang')->name('tolak-produk-lelang');
Route::post('/divalidasi-produk-lelang/update', 'ValidasiProdukLelangController@ValidasiProdukLelang')->name('divalidasi-produk-lelang');
Route::post('/proses-produk-lelang/update', 'ValidasiProdukLelangController@ProsesProdukLelang')->name('proses-produk-lelang');

Route::get('/validasi-produk-investasi', 'ValidasiProdukInvestasiController@ProdukInvestasi')->name('validasi-produk-investasi');
Route::get('/lihat-produk-investasi/{id}', 'ValidasiProdukInvestasiController@lihatProdukInvestasi')->name('lihat-produk-investasi');
Route::get('/produk-investasi/{id}', 'ValidasiProdukInvestasiController@dataProdukInvestasi')->name('produk-investasi');
Route::post('/tolak-produk-investasi/update', 'ValidasiProdukInvestasiController@TolakProdukInvestasi')->name('tolak-produk-investasi');
Route::post('/divalidasi-produk-investasi/update', 'ValidasiProdukInvestasiController@ValidasiProdukInvestasi')->name('divalidasi-produk-investasi');
Route::post('/proses-produk-investasi/update', 'ValidasiProdukInvestasiController@ProsesProdukInvestasi')->name('proses-produk-investasi');

Route::get('/validasi-pembeli', 'VerifikasiPembeliController@dataOrder')->name('validasi-pembeli');
Route::get('/lihat-validasi-pembeli/{id}', 'VerifikasiPembeliController@lihatOrder')->name('lihat-validasi-pembeli');
Route::post('/tolak-pembeli/update', 'VerifikasiPembeliController@tolakOrder')->name('tolak-pembeli.update');
Route::post('/validasi-pembeli/update', 'VerifikasiPembeliController@validasiOrder')->name('validasi-pembeli.update');

Route::get('/validasi-pembeli-lelang', 'VerifikasiPembayaranLelangController@dataOrderLelang')->name('validasi-pembeli-lelang');
Route::get('/lihat-validasi-lelang/{id}', 'VerifikasiPembayaranLelangController@lihatOrderLelang')->name('lihat-validasi-lelang');
Route::post('/tolak-lelang/update', 'VerifikasiPembayaranLelangController@tolakOrderLelang')->name('tolak-lelang.update');
Route::post('/validasi-lelang/update', 'VerifikasiPembayaranLelangController@validasiOrderLelang')->name('validasi-lelang.update');

Route::get('/validasi-top-up', 'VerifikasiPembayaranLelangController@dataTopUp')->name('validasi-top-up');
Route::get('/lihat-top-up/{id}', 'VerifikasiPembayaranLelangController@lihatTopUp')->name('lihat-top-up');
Route::post('/tolak-top-up/update', 'VerifikasiPembayaranLelangController@tolakTopUp')->name('tolak-top-up.update');
Route::post('/validasi-top-up/update', 'VerifikasiPembayaranLelangController@validasiTopUp')->name('validasi-top-up.update');

Route::get('/validasi-pembiayaan', 'VerifikasiPembiayaanController@dataPembiayaan')->name('validasi-pembiayaan');
Route::get('/lihat-pembiayaan/{id}', 'VerifikasiPembiayaanController@lihatPembiayaan')->name('lihat-pembiayaan');
Route::post('/tolak-pembiayaan/update', 'VerifikasiPembiayaanController@tolakPembiayaan')->name('tolak-pembiayaan.update');
Route::post('/validasi-pembiayaan/update', 'VerifikasiPembiayaanController@validasiPembiayaan')->name('validasi-pembiayaan.update');

Route::get('/validasi-investor', 'ValidasiInvestorController@dataInvestor')->name('validasi-investor');
Route::get('/data-investor/{id}', 'ValidasiInvestorController@idInvestor')->name('data-investor');
Route::post('/tolak-investor/update', 'ValidasiInvestorController@tolakInvestor')->name('tolak-investor.update');
Route::post('/validasi-investor/update', 'ValidasiInvestorController@validasiInvestor')->name('validasi-investor.update');

Route::get('/proses-lelang', 'ProsesLelangController@prosesLelang')->name('proses-lelang');
Route::get('/data-proses-lelang/{id}', 'ProsesLelangController@dataLelang');
Route::get('/lihat-pemenang/{id}', 'ProsesLelangController@dataPemenang')->name('lihat-pemenang');

Route::get('/validasi-pencairan', 'VerifikasiPencairanController@dataPencairan')->name('validasi-pencairan');
Route::get('/lihat-validasi-pencairan/{id}', 'VerifikasiPencairanController@lihatPencairan')->name('lihat-validasi-pencairan');
Route::post('/tolak-pencairan/update', 'VerifikasiPencairanController@tolakPencairan')->name('tolak-pencairan.update');
Route::post('/validasi-pencairan/update', 'VerifikasiPencairanController@validasiPencairan')->name('validasi-pencairan.update');

//komplain
Route::get('/validasi-komplain', 'ValidasiKomplainController@Komplain')->name('validasi-komplain');
Route::get('/lihat-komplain/{id}', 'ValidasiKomplainController@lihatKomplain')->name('lihat-komplain');
Route::get('/komplain/{id}', 'ValidasiKomplainController@dataKomplain')->name('komplain');
Route::post('/tolak-komplain/update', 'ValidasiKomplainController@TolakKomplain')->name('tolak-komplain');
Route::post('/proses-komplain/update', 'ValidasiKomplainController@ProsesKomplain')->name('proses-komplain');

Route::get('/validasi-komplain-lelang', 'ValidasiKomplainLelangController@KomplainLelang')->name('validasi-komplain-lelang');
Route::get('/lihat-komplain-lelang/{id}', 'ValidasiKomplainLelangController@lihatKomplainLelang')->name('lihat-komplain-lelang');
Route::get('/komplain-lelang/{id}', 'ValidasiKomplainLelangController@dataKomplainLelang')->name('komplain-lelang');
Route::post('/tolak-komplain-lelang/update', 'ValidasiKomplainLelangController@TolakKomplainLelang')->name('tolak-komplain-lelang');
Route::post('/divalidasi-komplain-lelang/update', 'ValidasiKomplainLelangController@ValidasiKomplainLelang')->name('divalidasi-komplain-lelang');
Route::post('/proses-komplain-lelang/update', 'ValidasiKomplainLelangController@ProsesKomplainLelang')->name('proses-komplain-lelang');

//pencairan dana progress petani
Route::get('/validasi-pencairan-petani', 'VerifikasiProgresController@dataPencairanPetani')->name('validasi-pencairan-petani');
Route::get('/lihat-validasi-pencairan-petani/{id}', 'VerifikasiProgresController@lihatPencairanPetani')->name('lihat-validasi-pencairan-petani');
Route::post('/tolak-pencairan-petani/update', 'VerifikasiProgresController@tolakPencairanPetani')->name('tolak-pencairan-petani.update');
Route::post('/validasi-pencairan-petani/update', 'VerifikasiProgresController@validasiPencairanPetani')->name('validasi-pencairan-petani.update');











