<?php

namespace App\Http\Controllers\Lelang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Aution_product;
use App\Category;

class HomeController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $products = Auction_product::where('status', 2)->orderBy('created_at','desc')->paginate(12);
    
        $panjang = count($products);
    
        return view('jual-beli.lelang.index', compact('products','panjang', 'category'));
    }
}
