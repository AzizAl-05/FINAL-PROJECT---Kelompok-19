@extends('layouts.app')

@section('content')
<main class="bg-slate-50 min-h-screen py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6">

        <!-- Header -->
        <div class="text-center mb-8">
            <span class="inline-flex items-center rounded-full bg-blue-100 px-4 py-1.5 text-xs font-semibold text-blue-700 uppercase tracking-wider">
                Pengaturan Akun
            </span>
            <h1 class="mt-3 text-3xl font-extrabold text-slate-900 tracking-tight">
                Profil Penghuni
            </h1>
        </div>

        <!-- Alert Notifikasi -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-2xl flex items-center gap-3 text-sm font-medium">
                <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Utama (Satu Box Panjang Vertikal) -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <form method="POST" action="{{ route('profil.update') }}" enctype="multipart/form-data" class="p-6 md:p-8 space-y-6">
                @csrf
                @method('PUT')

                <!-- Bagian Avatar / Foto Profil -->
                <div class="flex flex-col items-center border-b border-slate-100 pb-6 text-center">
                    <div class="relative group mb-4">
                        @if($penghuni->foto_profil)
                            <img src="{{ asset('storage/' . $penghuni->foto_profil) }}" alt="Foto Profil" class="w-28 h-28 rounded-full object-cover shadow-md border-2 border-white ring-4 ring-blue-50">
                        @else
                            <div class="w-28 h-28 bg-blue-600 text-white text-4xl font-bold rounded-full flex items-center justify-center shadow-md shadow-blue-200 uppercase">
                                {{ substr($penghuni->nama, 0, 2) }}
                            </div>
                        @endif
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">{{ $penghuni->nama }}</h3>
                    <p class="text-xs text-slate-400 font-mono mt-0.5">ID Penghuni: #{{ $penghuni->id_penghuni }}</p>
                </div>

                <!-- Input: Upload Foto -->
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-700">Ganti Foto Profil</label>
                    <input type="file" name="foto_profil" accept="image/*"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition outline-none text-sm file:mr-4 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-slate-400 mt-1.5">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                </div>

                <!-- Input: Nama Lengkap -->
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-700">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $penghuni->nama) }}" required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition outline-none text-sm">
                </div>

                <!-- Informasi Read-Only (Grid Sistem) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-slate-100">
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Email Address</label>
                        <span class="block text-sm font-medium text-slate-700 mt-1 bg-slate-50 border border-slate-200/60 rounded-xl px-4 py-2.5 select-none">{{ $penghuni->email }}</span>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Nomor WhatsApp</label>
                        <span class="block text-sm font-medium text-slate-700 mt-1 bg-slate-50 border border-slate-200/60 rounded-xl px-4 py-2.5 select-none">{{ $penghuni->no_telp }}</span>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Kampus / Jurusan</label>
                        <span class="block text-sm font-medium text-slate-700 mt-1 bg-slate-50 border border-slate-200/60 rounded-xl px-4 py-2.5 select-none">{{ $penghuni->kampus }} - {{ $penghuni->jurusan }}</span>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full rounded-xl bg-blue-600 py-3.5 text-white font-semibold hover:bg-blue-700 shadow-md shadow-blue-200 transition text-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Box Bantuan / Lupa Password (Bawah) -->
        <div class="mt-6 bg-amber-50 border border-amber-200 rounded-3xl p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="space-y-1">
                <h4 class="text-sm font-bold text-amber-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-amber-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m0-6v2m0-6h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Butuh Akses Ganti Password?
                </h4>
                <p class="text-xs text-amber-700 max-w-md leading-relaxed">
                    Pergantian kata sandi akun kosan dikelola penuh oleh Admin demi menjaga keamanan data kamar Anda.
                </p>
            </div>
            <a href="https://wa.me/6285775245377?text=Halo%20Admin%20KosMas,%20saya%20ingin%20meminta%20reset%20password%20untuk%20ID%20%23{{ $penghuni->id_penghuni }}" 
               target="_blank"
               class="inline-flex items-center justify-center gap-2 rounded-xl bg-amber-600 px-4 py-2.5 text-xs font-semibold text-white hover:bg-amber-700 transition whitespace-nowrap shadow-sm shadow-amber-100">
                Hubungi Admin
            </a>
        </div>

    </div>
</main>
@endsection