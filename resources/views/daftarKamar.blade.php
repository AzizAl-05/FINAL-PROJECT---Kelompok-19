
@extends('layouts.app')

@section('content')
    <h1 class="mt-6 text-center text-2xl md:text-4xl font-bold text-slate-900 leading-tight">
        Daftar Kamar Kos
    </h1>

<div class="max-w-7xl mx-auto px-6 xl:px-10 mt-6">
    <div class="flex flex-wrap items-center justify-center gap-3 border-b border-slate-100 pb-5 text-center">
        
        <span class="text-xs font-bold uppercase tracking-wider text-slate-400 mr-2">Filter Tipe:</span>
        
        <a href="{{ route('daftarkamar', ['tipe' => '', 'status' => request('status')]) }}" 
           class="px-4 py-1.5 rounded-full text-sm font-medium transition {{ request('tipe') == '' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            Semua Tipe
        </a>
        
        <a href="{{ route('daftarkamar', ['tipe' => '1', 'status' => request('status')]) }}" 
           class="px-4 py-1.5 rounded-full text-sm font-medium transition {{ request('tipe') == '1' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            Tipe A
        </a>

        <a href="{{ route('daftarkamar', ['tipe' => '2', 'status' => request('status')]) }}" 
           class="px-4 py-1.5 rounded-full text-sm font-medium transition {{ request('tipe') == '2' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            Tipe B
        </a>

        <a href="{{ route('daftarkamar', ['tipe' => '3', 'status' => request('status')]) }}" 
           class="px-4 py-1.5 rounded-full text-sm font-medium transition {{ request('tipe') == '3' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            Tipe C
        </a>

        <div class="h-5 w-px bg-slate-200 mx-2 hidden sm:block"></div>
        <span class="text-xs font-bold uppercase tracking-wider text-slate-400 mr-2">Status:</span>

        <a href="{{ route('daftarkamar', ['tipe' => request('tipe'), 'status' => '0']) }}" 
           class="px-4 py-1.5 rounded-full text-sm font-medium transition {{ request('status', '0') == '0' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            Tersedia
        </a>

        <a href="{{ route('daftarkamar', ['tipe' => request('tipe'), 'status' => '1']) }}" 
           class="px-4 py-1.5 rounded-full text-sm font-medium transition {{ request('status') == '1' ? 'bg-rose-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            Terisi
        </a>
    </div>
</div>

    <section class="w-full max-w-7xl mx-auto px-6 xl:px-10 py-7 lg:py-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($kamarTersedia as $kamar)
                <div class="bg-white rounded-2xl overflow-hidden card-shadow border border-slate-100 transition hover:-translate-y-1 hover:shadow-lg">
                    <img
                        src="{{ $kamar->foto ? asset('storage/' . $kamar->foto) : 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=800' }}"
                        class="w-full h-48 object-cover"
                        alt="Kamar {{ $kamar->no_kamar }}">

                    <div class="p-5">
                        <h3 class="text-lg font-bold text-indigo-600">Kamar {{ $kamar->no_kamar }}</h3>

                        <div class="mt-3 space-y-1.5 text-sm text-slate-700">
                            <p><strong>Tipe:</strong> {{ $kamar->tipeKamar?->nama_tipe ?? $kamar->tipeKamar?->Tipe ?? 'Tipe '.$kamar->tipe }}</p>

                            <p>
                                <strong>Status:</strong>
                                @if($kamar->status == 0)
                                    <span class="text-emerald-600 font-semibold bg-emerald-50 px-2 py-0.5 rounded-md">Tersedia</span>
                                @else
                                    <span class="text-rose-600 font-semibold bg-rose-50 px-2 py-0.5 rounded-md">Terisi</span>
                                @endif
                            </p>
                        </div>

                        <a
                            href="{{ url('/detail-kamar/' . $kamar->id_kamar) }}"
                            class="mt-5 block w-full py-2.5 border border-indigo-600 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition text-sm font-medium text-center">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white rounded-2xl border border-slate-200 p-8 text-center text-slate-600">
                    Tidak ada kamar yang memenuhi kriteria filter tersebut.
                </div>
            @endforelse
        </div>
    </section>
@endsection