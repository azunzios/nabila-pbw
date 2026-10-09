<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    // 1. Menampilkan Tabel Utama
    public function index()
    {
        $publikasi = Publikasi::all();
        return view('publikasi.index', compact('publikasi'));
    }

    // 2. Menampilkan Form Tambah
    public function create()
    {
        return view('publikasi.create');
    }

    // 3. Menyimpan Data Baru + Upload Sampul
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tanggal_rilis' => 'required|date',
            'sampul' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $namaSampul = null;
        if ($request->hasFile('sampul')) {
            $file = $request->file('sampul');
            $namaSampul = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $namaSampul);
        }

        Publikasi::create([
            'judul' => $request->judul,
            'tanggal_rilis' => $request->tanggal_rilis,
            'sampul' => $namaSampul,
        ]);

        return redirect()->route('publikasi.index')->with('success', 'Data publikasi berhasil ditambahkan!');
    }

    // 4. Menampilkan Form Edit
    public function edit($id)
    {
        $publikasi = Publikasi::findOrFail($id);
        return view('publikasi.edit', compact('publikasi'));
    }

    // 5. Memproses Perubahan Data + Upload Sampul Baru (opsional)
    public function update(Request $request, $id)
    {
        $publikasi = Publikasi::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'tanggal_rilis' => 'required|date',
            'sampul' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $namaSampul = $publikasi->sampul; // pakai yang lama dulu

        if ($request->hasFile('sampul')) {
            // hapus file lama kalau ada
            if ($publikasi->sampul && file_exists(public_path('images/' . $publikasi->sampul))) {
                unlink(public_path('images/' . $publikasi->sampul));
            }
            $file = $request->file('sampul');
            $namaSampul = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $namaSampul);
        }

        $publikasi->update([
            'judul' => $request->judul,
            'tanggal_rilis' => $request->tanggal_rilis,
            'sampul' => $namaSampul,
        ]);

        return redirect()->route('publikasi.index')->with('success', 'Data publikasi berhasil diperbarui!');
    }

    // 6. Memproses Hapus Data + Hapus File Gambar
    public function destroy($id)
    {
        $publikasi = Publikasi::findOrFail($id);

        // hapus file gambar di folder kalau ada
        if ($publikasi->sampul && file_exists(public_path('images/' . $publikasi->sampul))) {
            unlink(public_path('images/' . $publikasi->sampul));
        }

        $publikasi->delete();

        return redirect()->route('publikasi.index')->with('success', 'Data publikasi berhasil dihapus!');
    }
}