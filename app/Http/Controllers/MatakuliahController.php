<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index()
    {
        // Mengambil data dengan pagination (5 data per halaman)
        $matakuliah = Matakuliah::paginate(5);

        return view('matakuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        $jurusan = Jurusan::all();
        return view('matakuliah.create', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_matakuliah' => 'required',
            'sks' => 'required|numeric|min:1|max:6',
            'id_jurusan' => 'required',
        ]);

        Matakuliah::create($request->all());

        return redirect()->route('matakuliah.index')->with('success', 'Mata Kuliah berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $jurusan = Jurusan::all();
        return view('matakuliah.edit', compact('matakuliah', 'jurusan'));
    }

    // Memproses perubahan data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_matakuliah' => 'required',
            'sks' => 'required|numeric|min:1|max:6',
            'id_jurusan' => 'required',
        ]);

        $matakuliah = Matakuliah::findOrFail($id);
        $matakuliah->update($request->all());

        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $matakuliah->delete();

        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil dihapus!');
    }
}
