@extends('layouts.app')

@section('content')

    {{-- HERO --}}
    <section class="hero-gradient w-full">
        <div class="w-full max-w-[1600px] mx-auto px-6 xl:px-10 py-20 lg:py-28 text-center">

            <span
                class="inline-block px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 text-sm font-semibold uppercase tracking-wide">
                Explorasi Kamar
            </span>

            <h1 class="mt-6 text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 leading-tight">
                Temukan Kamar Impianmu
            </h1>

            <p class="mt-5 max-w-2xl mx-auto text-slate-600 text-base md:text-lg lg:text-xl">
                Cari dan temukan pilihan kos terbaik yang nyaman, aman,
                dan dekat dengan kampusmu.
            </p>

        </div>
    </section>

    {{-- DAFTAR KAMAR (tersedia) --}}
    @php
        $kamarTersedia = \App\Models\Kamar::with('tipeKamar')
            ->where('status', 0)
            ->get();
    @endphp

    <section class="w-full max-w-7xl mx-auto px-6 xl:px-10 py-16 lg:py-10">

        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-12">
            <h2 class="text-2xl lg:text-3xl font-bold text-slate-900">Daftar Kamar</h2>

            <a href="{{ url('/daftar-kamar') }}"
                class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 hover:underline transition-all">
                Tampilkan lebih banyak &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            @forelse($kamarTersedia->take(4) as $kamar)
                <div
                    class="bg-white rounded-2xl overflow-hidden card-shadow border border-slate-100 transition hover:-translate-y-1 hover:shadow-lg">
                    <img src="{{ $kamar->foto ? asset('storage/' . $kamar->foto) : 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=800' }}"
                        class="w-full h-48 object-cover" alt="Kamar {{ $kamar->no_kamar }}">
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-indigo-600">Kamar {{ $kamar->no_kamar }}</h3>
                        <div class="mt-3 space-y-1.5 text-sm text-slate-700">
                            <p><strong>Tipe:</strong> {{ $kamar->tipeKamar?->Tipe ?? $kamar->tipe }}</p>
                            <p>
                                <strong>Status:</strong>
                                <span class="text-green-600 font-semibold">Tersedia</span>
                            </p>
                        </div>
                        <a href="{{ url('/detail-kamar/' . $kamar->id_kamar) }}"
                            class="mt-5 block w-full py-2.5 border border-indigo-600 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition text-sm font-medium text-center">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white rounded-2xl border border-slate-200 p-8 text-center text-slate-600">
                    Tidak ada kamar tersedia.
                </div>
            @endforelse

        </div>

    </section>
@endsection