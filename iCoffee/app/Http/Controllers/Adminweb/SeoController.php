<?php

namespace App\Http\Controllers\Adminweb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Artikel_blog;
use App\Shop_product;

class SeoController extends Controller
{
	public function slugArtikel(){

        $artikel = Artikel_blog::latest()->get();

        return view('admin.admin-web.slug-artikel', compact('artikel'));
    }

    public function slugProduk(){

        $produk = Shop_product::latest()->get();

        return view('admin.admin-web.slug-produk', compact('produk'));
    }
    
}
