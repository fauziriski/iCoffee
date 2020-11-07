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


Route::get('/404', function() {
    return view('admin.404');
});



Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/beranda', 'HomeController@index')->name('beranda');
Route::post('/beranda/update', 'HomeController@filter')->name('beranda.update');

//profile_admin
Route::get('/profile-admin', 'HomeController@adminProfile')->name('profile-admin');
Route::post('/profile/tambah', 'HomeController@tambahProfile')->name('profile.tambah');
Route::post('/profile/update', 'HomeController@profileUpdate')->name('profile.update');
Route::post('/profile2/update', 'HomeController@profile2Update')->name('profile2.update');

Route::group(['middleware' => ['can:read']], function () {

    Route::get('/administrasi', 'AdministrasiController@dataAdministrasi')->name('administrasi');
    Route::get('/detail-administrasi/{id}', 'AdministrasiController@detailAdministrasi')->name('detail-administrasi');
    Route::get('/setor-petani', 'SetorPetaniController@dataSetorPetani')->name('setor-petani');
    Route::get('/detail-petani/{id}', 'SetorPetaniController@detailPetani')->name('detail-petani');
    Route::get('/setor-lelang', 'SetorPelelangController@dataSetorpelelang')->name('setor-lelang');
    Route::get('/lihat-pelelang/{id}', 'SetorPelelangController@lihatpelelang')->name('lihat-pelelang');
    Route::get('/detail-pelelang/{id}', 'SetorPelelangController@detailpelelang')->name('detail-pelelang');
    Route::get('/dana-masuk-utama', 'DanaMasukJBController@danaMasuk')->name('dana-masuk-jualbeli');
    Route::get('/detail-dana-masuk-jualbeli/{id}', 'DanaMasukJBController@detailDanaMasuk')->name('detail-dana-masuk-jualbeli');
    Route::get('/dana-masuk-investasi', 'DanaMasukInvestasiController@danaMasuk')->name('dana-masuk-investasi');
    Route::get('/detail-dana-masuk-investasi/{id}', 'DanaMasukInvestasiController@detailDanaMasuk')->name('detail-dana-masuk-investasi');
    // Route::get('/dana-masuk-lelang', 'DanaMasukLelangController@danaMasuk')->name('dana-masuk-lelang');
    // Route::get('/detail-dana-masuk-lelang/{id}', 'DanaMasukLelangController@detailDanaMasuk')->name('detail-dana-masuk-lelang');
    Route::get('/dana-masuk-lain', 'DanaMasukLainController@dataDanaMasuk')->name('dana-masuk-lain');
    Route::get('/lihat-dana-masuk-lain/{id}', 'DanaMasukLainController@detailDanaMasuk')->name('lihat-dana-masuk-lain');
    Route::get('/detail-dana-masuk-lain/{id}', 'DanaMasukLainController@detailDanaMasuk')->name('detail-dana-masuk-lain');
    Route::get('/pencairan-dana', 'PencairanDanaController@dataPencairan')->name('pencairan-dana');
    Route::get('/detail-pencairan-dana/{id}', 'PencairanDanaController@detailpencairan')->name('detail-pencairan-dana');
    Route::get('/penarikan-dana', 'PencairanDanaController@dataPenarikan')->name('penarikan-dana');
    Route::get('/lihat-penarikan-dana/{id}', 'PencairanDanaController@lihatPenarikan')->name('lihat-penarikan-dana');
    Route::get('/pencairan-dana-progres', 'PencairanDanaProgresController@dataPencairan')->name('pencairan-dana-progres');
    Route::get('/detail-pencairan-dana-progres/{id}', 'PencairanDanaProgresController@detailpencairan')->name('detail-pencairan-dana-progres');
    Route::get('/penarikan-dana-progres', 'PencairanDanaProgresController@dataPenarikan')->name('penarikan-dana-progres');
    Route::get('/lihat-penarikan-dana-progres/{id}', 'PencairanDanaProgresController@lihatPenarikan')->name('lihat-penarikan-dana-progres');
    Route::get('/pencairan-bagi-hasil', 'PencairanBagiHasilController@dataPencairan')->name('pencairan-bagi-hasil');
    Route::get('/detail-pencairan-bagi-hasil/{id}', 'PencairanBagiHasilController@detailpencairan')->name('detail-pencairan-bagi-hasil');
    Route::get('/penarikan-bagi-hasil', 'PencairanBagiHasilController@dataPenarikan')->name('penarikan-bagi-hasil');
    Route::get('/lihat-penarikan-bagi-hasil/{id}', 'PencairanBagiHasilController@lihatPenarikan')->name('lihat-penarikan-bagi-hasil');

    //laporan keuangan
    Route::get('/format-akun', 'FormatAkunController@dataPelanggan')->name('format-akun');
    Route::get('/arus-kas', 'ArusKasController@lihat')->name('arus-kas');
    Route::post('/update-aruskas', 'ArusKasController@update')->name('update-aruskas');
    // Route::get('/laporan-arus-kas', 'ArusKasController@update')->name('laporan-arus-kas');
    Route::resource('/jurnal', 'JurnalController');
    Route::resource('/neraca', 'NeracaController');
    Route::resource('/tranksaksi-kas', 'TranksaksiKasController');
    
});

Route::group(['middleware' => ['can:created']], function () {
    Route::post('/tambah-administrasi', 'AdministrasiController@tambah')->name('tambah-administrasi');
    Route::post('/tambah-petani', 'SetorPetaniController@tambah')->name('tambah-petani');
    Route::post('/tambah-pelelang', 'SetorPelelangController@tambah')->name('tambah-pelelang');
    Route::post('/tambah-dana-masuk-lain', 'DanaMasukLainController@tambah')->name('tambah-dana-masuk-lain');
    Route::post('/tambah-pencairan-dana', 'PencairanDanaController@tambah')->name('tambah-pencairan-dana');
    Route::post('/tambah-penarikan-dana', 'PencairanDanaController@validasiPenarikan')->name('tambah-penarikan-dana');
    Route::post('/tambah-pencairan-dana-progres', 'PencairanDanaProgresController@tambah')->name('tambah-pencairan-dana-progres');  
    Route::post('/tambah-pencairan-bagi-hasil', 'PencairanBagiHasilController@tambah')->name('tambah-pencairan-bagi-hasil'); 
    Route::post('/tambah-penarikan-dana-progres', 'PencairanDanaProgresController@validasiPenarikan')->name('tambah-penarikan-dana-progres');
    Route::post('/tambah-penarikan-bagi-hasil', 'PencairanBagiHasilController@validasiPenarikan')->name('tambah-penarikan-bagi-hasil');
    
});

Route::group(['middleware' => ['can:update']], function () {
    Route::post('/update-pelelang', 'SetorPelelangController@update')->name('update-pelelang');
    Route::post('/update-petani', 'SetorPetaniController@update')->name('update-petani');
    Route::post('/update-administrasi', 'AdministrasiController@update')->name('update-administrasi');
    Route::post('/update-dana-masuk-lain', 'DanaMasukLainController@update')->name('update-dana-masuk-lain');
});

Route::group(['middleware' => ['can:delete']], function () {
    Route::get('/hapus-administrasi/{id}', 'AdministrasiController@hapus')->name('hapus-administrasi');
    Route::get('/hapus-petani/{id}', 'SetorPetaniController@hapus')->name('hapus-petani');
    Route::get('/hapus-pelelang/{id}', 'SetorPelelangController@hapus')->name('hapus-pelelang');
    Route::get('/hapus-dana-masuk-jualbeli/{id}', 'DanaMasukJBController@hapus')->name('hapus-dana-masuk-jualbeli');
    Route::get('/hapus-dana-masuk-investasi/{id}', 'DanaMasukInvestasiController@hapus')->name('hapus-dana-masuk-investasi');
    // Route::get('/hapus-dana-masuk-lelang/{id}', 'DanaMasukLelangController@hapus')->name('hapus-dana-masuk-lelang');
    Route::get('/hapus-dana-masuk-lain/{id}', 'DanaMasukLainController@hapus')->name('hapus-dana-masuk-lain');
    Route::get('/hapus-pencairan-dana/{id}', 'PencairanDanaController@hapus')->name('hapus-pencairan-dana');
    Route::get('/hapus-pencairan-dana-progres/{id}', 'PencairanDanaProgresController@hapus')->name('hapus-pencairan-dana-progres');
    Route::get('/hapus-pencairan-bagi-hasil/{id}', 'PencairanBagiHasilController@hapus')->name('hapus-pencairan-bagi-hasil');
});


// Route::get('/data-admin', 'KelolaPenggunaController@dataAdmin')->name('data-admin');
// Route::get('/hapus-pengguna/{id}', 'KelolaPenggunaController@hapusPengguna')->name('hapus-pengguna');

//dana keluar investasi/bagi-hasil










