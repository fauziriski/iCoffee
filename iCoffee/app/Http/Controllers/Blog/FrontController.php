<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Kategori_artikel;
use App\Artikel_blog;

class FrontController extends Controller
{
    public function index()
    {
        $categori = Kategori_artikel::all();
        $artikel = Artikel_blog::latest()->get()->random(2);
        $artikelall = Artikel_blog::latest()->get();
        $artikelterkait = Artikel_blog::latest()->limit(4)->get();

        return view('blog.index', compact('categori', 'artikel', 'artikelall', 'artikelterkait'));
    }

    public function show($artikel)
    {
        $artikel_detail= Artikel_blog::where('slug',$artikel)->first();
        $artikelterkait = Artikel_blog::latest()->get()->random(3);
        $categori = Kategori_artikel::all();

        return view('blog.detail', compact('artikel_detail', 'categori', 'artikelterkait'));
    }

    public function artikel_kategori($kategori)
    {
        $categori = Kategori_artikel::all();
        $artikel = Artikel_blog::latest()->get()->random(2);

        $data = Kategori_artikel::where('slug', $kategori)->first();
        $artikelall = Artikel_blog::where('kategori_artikel_id',$data->id)->get();

        $artikelterkait = Artikel_blog::latest()->limit(4)->get();

        return view('blog.index', compact('categori', 'artikel', 'artikelall', 'artikelterkait'));
    }

    public function about()
    {
        $categori = Kategori_Artikel::all();

        return view('blog.about', compact('categori'));
    }


    public function contact()
    {
        $categori = Kategori_artikel::all();

        return view('blog.contact', compact('categori'));
    }
}
