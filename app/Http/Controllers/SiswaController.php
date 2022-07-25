<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan semua data dari model Siswa
        $siswa = Siswa::all();
        return view('siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $guru = Guru::all();
        return view('siswa.create', compact('guru'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi
        $validated = $request->validate([
            'nama' => 'required',
            'nis' => 'required|unique:siswas|max:255',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'id_guru' => 'required',
        ]);

        $siswa = new Siswa();
        $siswa->nama = $request->nama;
        $siswa->nis = $request->nis;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->agama = $request->agama;
        $siswa->tgl_lahir = $request->tgl_lahir;
        $siswa->alamat = $request->alamat;
        $siswa->id_guru = $request->id_guru;
        $siswa->save();
        return redirect()->route('siswa.index')
            ->with('success', 'Data berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $guru = Guru::all();
        return view('siswa.edit', compact('siswa', 'guru'));

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
        // Validasi
        $validated = $request->validate([
            'nama' => 'required',
            'nis' => 'required|max:255',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'id_guru' => 'required',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->nama = $request->nama;
        $siswa->nis = $request->nis;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->agama = $request->agama;
        $siswa->tgl_lahir = $request->tgl_lahir;
        $siswa->alamat = $request->alamat;
        $siswa->id_guru = $request->id_guru;
        $siswa->save();
        return redirect()->route('siswa.index')
            ->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return redirect()->route('siswa.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
