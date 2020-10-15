<?php

namespace App\Http\Controllers\Adminweb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Carbon;
use Validator;
use App\Artikel_blog;
use App\Kategori_artikel;
use Illuminate\Support\Str;
use Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ArtikelController extends Controller
{

	public function dataArtikel(){

        $artikel = Artikel_blog::latest()->get();

        return view('admin.admin-web.artikel-blog', compact('artikel'));
    }
    
    public function create()
    {
        $categori = Kategori_artikel::select('id', 'nama_kategori')->get();

        return view('admin.admin-web.tambah-artikel', compact('categori'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'body' => 'required|min:10',
            'gambar' => 'required|mimes:jpeg,bmp,png|max:2048',
        ]);
        if (empty($request->file('gambar'))) {
            Artikel_blog::create([
                'judul' => $request->judul,
                'slug' => \Str::slug($request->judul),
                'body' => $request->body,
                //'gambar' => $image,
                'kategori_artikel_id' => $request->categoris_id,
            ]);
        } else {
            Artikel_blog::create([
                'judul' => $request->judul,
                'slug' => \Str::slug($request->judul),
                'body' => $request->body,
                'gambar' => $request->file('gambar')->store('Artikel'),
                'kategori_artikel_id' => $request->categoris_id,
            ]);
        }
  
        $artikel = Artikel_blog::latest()->get();

        Alert::success('Berhasil Ditambahkan !');
        return view('admin.admin-web.artikel-blog', compact('artikel'));
    }

    public function edit($id)
    {
        $categori = Kategori_artikel::select('id', 'nama_kategori')->get();
        $artikel = Artikel_blog::find($id);

        return view('admin.admin-web.edit-artikel', compact('categori', 'artikel'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required',
            'body' => 'required|min:10',
            'gambar' => 'mimes:jpeg,bmp,png|max:2048',
        ]);
        if (empty($request->file('gambar'))) {
            $artikel = Artikel_blog::find($id);
            //Storage::delete($artikel->gambar);
            $artikel->update([
                'judul' => $request->judul,
                'slug' => \Str::slug($request->judul),
                'body' => $request->body,
                //'gambar' => $request->file('gambar')->store('Artikel'),
                'kategori_artikel_id' => $request->categoris_id,
            ]);
        } else {
            $artikel = Artikel_blog::find($id);
            Storage::delete($artikel->gambar);
            $artikel->update([
                'judul' => $request->judul,
                'slug' => \Str::slug($request->judul),
                'body' => $request->body,
                'gambar' => $request->file('gambar')->store('artikel'),
                'kategori_artikel_id' => $request->categoris_id,
            ]);
        }

        $artikel = Artikel_blog::latest()->get();

        Alert::success('Berhasil Diubah !');
        return view('admin.admin-web.artikel-blog', compact('artikel'));
    }

    public function destroy($id)
    {
        $artikel = Artikel_blog::find($id);
        if (!$artikel) {
            return redirect()->back();
        }
        Storage::delete($artikel->gambar);

        $artikel->delete();

       

        // Alert::success('Berhasil Dihapus !');
        // return view('admin.admin-web.artikel-blog', compact('artikel'));
        return response()->json();
    }

}
