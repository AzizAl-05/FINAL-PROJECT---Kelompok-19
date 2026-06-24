@php
    /** @var \Illuminate\Support\Collection|\App\Models\Kamar|null $kamar */
    $kamar = \App\Models\Kamar::with(['tipeKamar', 'fasilitas'])
        ->where('id_kamar', $id_kamar)
        ->firstOrFail();
@endphp

@extends('layouts.app')

@section('content')
    <main class="bg-slate-50 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center gap-2 mb-6">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <span class="text-sm uppercase text-slate-500">Back to Results</span>
            </div>

            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-slate-900">
                    Kamar {{ $kamar->no_kamar }}
                </h1>

                <p class="mt-3 text-sm font-medium text-slate-500">
                    Tipe Kamar
                </p>

                <div class="mt-2 flex items-end gap-2">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-indigo-600">
                        {{ $kamar->tipeKamar?->Tipe ?? $kamar->tipe }}
                    </h2>
                </div>
            </div>

            <div class="overflow-hidden rounded-3xl shadow-lg mb-8">
                <img
                    src="{{ $kamar->foto ? asset('storage/' . $kamar->foto) : 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=1200' }}"
                    class="w-full h-64 md:h-96 object-cover"
                    alt="Kamar {{ $kamar->no_kamar }}">
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2">

                    <section class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 md:p-8">
                        <div class="mb-8">
                            <h2 class="text-2xl md:text-3xl font-bold text-slate-900">Fasilitas Kamar</h2>
                            <p class="mt-2 text-slate-500">Nikmati berbagai fasilitas yang menunjang kenyamanan selama tinggal.</p>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
                            @forelse($kamar->fasilitas as $fasilitas)
                                <div
                                    class="group rounded-2xl bg-slate-50 border border-slate-200 p-5 text-center hover:border-indigo-300 hover:bg-indigo-50 transition-all duration-300 hover:-translate-y-1">
                                    <div
                                        class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-white shadow-sm flex items-center justify-center">
                                        <span class="material-symbols-outlined text-indigo-600 text-4xl">{{ $fasilitas->icon ?? 'check' }}</span>
                                    </div>
                                    <h3 class="font-semibold text-slate-800">{{ $fasilitas->nama_fasilitas }}</h3>
                                </div>
                            @empty
                                <div class="col-span-full text-slate-500 text-center">
                                    Belum ada fasilitas.
                                </div>
                            @endforelse
                        </div>
                    </section>

                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-24 bg-white rounded-3xl border border-indigo-100 p-6 shadow-xl">

                        <h3 class="text-2xl font-bold text-slate-900 mb-2">Pesan Kamar</h3>
                        <p class="text-slate-500 mb-6">Mulai proses pemesanan kamar impianmu sekarang.</p>

                        <div class="rounded-2xl bg-slate-50 border border-slate-200 p-5 mb-6">
                            <p class="text-sm text-slate-500">Harga Sewa</p>

                            <div class="flex items-end gap-2 mt-2">
                                <span class="text-2xl font-bold text-indigo-600">
                                    {{-- Harga dari tipe_kamar (kolom Harga / kemungkinan huruf besar-kecil) --}}
                                    {{ number_format((int) ($kamar->tipeKamar->Harga ?? $kamar->tipeKamar->harga ?? 0), 0, ',', '.') }}
                                </span>
                                <span class="text-slate-500 text-sm">/bulan</span>
                            </div>
                        </div>

                        {{-- PERBAIKAN LOGIKA: Cek apakah status kamar sudah 'Terisi' --}}
                        {{-- PERBAIKAN: Mengecek nilai status angka 1 (Terisi) --}}
                        @if($kamar->status == 1)
                            <div class="w-full flex items-center justify-center gap-3 rounded-2xl bg-red-500 px-6 py-4 text-white font-semibold cursor-not-allowed shadow-md select-none">
                                <span class="material-symbols-outlined">block</span>
                                Maaf, kamar ini sudah terisi
                            </div>
                            <p class="mt-4 text-center text-sm text-red-500 font-medium">Kamar ini tidak lagi tersedia untuk dipesan</p>
                        @else
                            <a
                                href="{{ url('/form-pesanan/' . $kamar->id_kamar) }}"
                                class="w-full flex items-center justify-center gap-3 rounded-2xl bg-indigo-600 px-6 py-4 text-white font-semibold hover:bg-indigo-700 transition">
                                <span class="material-symbols-outlined">bolt</span>
                                Pesan Sekarang
                            </a>
                            <p class="mt-4 text-center text-sm text-slate-500">Klik untuk mengisi formulir pemesanan</p>
                        @endif

                        <div class="mt-6 border-t border-slate-200 pt-6">
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <span class="material-symbols-outlined text-green-600">verified</span>
                                Verifikasi admin dalam 1×24 jam
                            </div>
                            <div class="flex items-center gap-3 text-sm text-slate-600 mt-3">
                                <span class="material-symbols-outlined text-green-600">payments</span>
                                Pembayaran aman & terpercaya
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection