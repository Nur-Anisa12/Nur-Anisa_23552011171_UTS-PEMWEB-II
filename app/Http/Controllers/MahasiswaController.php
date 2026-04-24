<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Jurusan; // Tambahkan ini untuk list jurusan di form
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    // Menampilkan form tambah
    public function create()
    {
        $jurusan = Jurusan::all();
        return view('mahasiswa.create', compact('jurusan'));
    }

    // Menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'nama' => 'required',
            'id_jurusan' => 'required'
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $jurusan = Jurusan::all(); // Untuk dropdown pilihan jurusan
        return view('mahasiswa.edit', compact('mahasiswa', 'jurusan'));
    }

    // Memproses pembaruan data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim,' . $id,
            'nama' => 'required',
            'id_jurusan' => 'required',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}
