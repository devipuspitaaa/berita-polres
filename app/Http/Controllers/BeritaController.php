<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berita = Berita::all();
        return view('back.berita.index', ['berita' => $berita]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('back.berita.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|min:4'

        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul);
        $data['user_id'] = Auth::id();
        $data['views'] = 0;
        $data['gambar'] = $request->file('gambar')->store('berita');

        Berita::create($data);

        return redirect()->route('berita.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $berita = Berita::find($id);
        $kategori = Kategori::all();

        return view('back.berita.edit', ['berita' => $berita, 'kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (empty($request->file('gambar'))) {
            $berita = Berita::find($id);
            $berita->update([
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'body' => $request->body,
                'kategori' => $request->kategori_id,
                'is_active' => $request->is_active,
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('berita.index')->with(['success' => 'Data Berhasil Diupdate']);
        } else {
            $berita = Berita::find($id);
            Storage::delete($berita->gambar);
            $berita->update([
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'body' => $request->body,
                'kategori' => $request->kategori_id,
                'user_id' => Auth::id(),
                'gambar' => $request->file('gambar')->store('berita'),
                'is_active' => $request->is_active,
            ]);
            return redirect()->route('berita.index')->with(['success' => 'Data Berhasil Diupdate']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $berita = Berita::find($id);
        Storage::delete($berita->gambar);
        $berita->delete();

        return redirect()->route('berita.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
