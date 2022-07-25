<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        // memanggil data Wali bersama dengan data siswa
        // yang dibuat dari method 'siswa' di model 'Wali'
        $guru = Guru::all();
        // dd($guru);
        // return $guru;
        return view('guru.index', compact('guru'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:gurus',
            'foto' => 'required|image|max:2048',
        ]);

        $guru = new Guru();
        $guru->nama = $request->nama;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/guru/', $name);
            $guru->foto = $name;
        }
        $guru->nip = $request->nip;
        $guru->save();
        return redirect()->route('guru.index')
            ->with('success', 'Data berhasil dibuat!');
    }

    public function show($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.show', compact('guru'));
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'foto' => 'image|max:2048',
        ]);

        $guru = Guru::findOrFail($id);
        $guru->nama = $request->nama;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/guru/', $name);
            $guru->foto = $name;
        }
        $guru->nip = $request->nip;
        $guru->save();
        return redirect()->route('guru.index')
            ->with('success', 'Data berhasil diedit!');

    }

    public function destroy($id)
    {
        $guru = guru::find($id);
        $foto = $guru->foto;

        if (!guru::destroy($id)) {
            return redirect()->back();
        }
        if ($foto) {
            $guru->deleteImage();
        }
        return redirect()->route('guru.index')
            ->with('success', 'Data berhasil dihapus!');

    }
}
