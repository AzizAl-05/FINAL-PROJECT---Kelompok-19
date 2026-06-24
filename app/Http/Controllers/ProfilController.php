<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $penghuni = Auth::guard('penghuni')->user();
        return view('profil', compact('penghuni'));
    }

    public function update(Request $request)
    {
        $penghuni = Auth::guard('penghuni')->user();

        // Validasi data inputan
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'foto_profil.image' => 'File harus berupa gambar.',
            'foto_profil.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ]);

        $data = ['nama' => $request->nama];

        // Logika upload foto profil jika ada berkas masuk
        if ($request->hasFile('foto_profil')) {
            // Hapus foto profil lama dari storage jika ada
            if ($penghuni->foto_profil) {
                Storage::disk('public')->delete($penghuni->foto_profil);
            }

            // Simpan foto profil baru ke folder public/foto_profil
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
            $data['foto_profil'] = $path;
        }

        // Jalankan perintah update ke Eloquent model
        $penghuni->update($data);

        return back()->with('success', 'Profil Anda berhasil diperbarui!');
    }
}