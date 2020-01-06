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
	
Route::get('/mantap', function(){
    return view('Jualbeli.index');
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



