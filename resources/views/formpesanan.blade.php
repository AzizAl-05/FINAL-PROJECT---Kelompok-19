@php
    $kamar = null;
    if (!empty($id_kamar)) {
        $kamar = \App\Models\Kamar::with(['tipeKamar'])->where('id_kamar', $id_kamar)->first();
    }

    $penghuni = auth()->user();
@endphp

@extends('layouts.app')

@section('content')
    <main class="bg-slate-50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="max-w-3xl mx-auto text-center mb-10">

                <span
                    class="inline-flex items-center rounded-full bg-indigo-100 px-4 py-2 text-sm font-semibold text-indigo-700">
                    FORM PESANAN
                </span>

                <h1 class="mt-4 text-3xl md:text-5xl font-extrabold text-slate-900">
                    Lengkapi Data Sewa Kamar Kos
                </h1>

                <p class="mt-4 text-slate-600 text-lg">
                    Silakan isi formulir di bawah ini untuk memesan kamar pilihan Anda.
                    Setelah selesai Anda akan diarahkan ke WhatsApp Admin untuk pembayaran.
                </p>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <!-- Form -->
                <div class="lg:col-span-8 order-2 lg:order-1">

                    <form method="POST" action="{{ route('booking.store') }}"
                        class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 md:p-8">
                        @csrf
                        @if($kamar)
                            <input type="hidden" name="kamar_id" value="{{ $kamar->id_kamar }}">
                        @else
                            {{-- fallback (route tanpa param) --}}
                            <input type="hidden" name="kamar_id" value="">
                        @endif

                        <!-- Section 1 -->
                        <div class="mb-8">

                            <div class="flex items-center gap-3 mb-6">
                                <span
                                    class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold">
                                    1
                                </span>

                                <h2 class="text-2xl font-bold text-slate-900">
                                    Identitas Penyewa
                                </h2>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-slate-700">
                                        Nama Lengkap
                                    </label>

                                    <input type="text" value="{{ $penghuni->nama }}" readonly
                                        class="w-full rounded-xl bg-slate-100 border border-slate-300 px-4 py-3 text-slate-700">
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-slate-700">
                                        Nomor WhatsApp
                                    </label>

                                    <input type="text" value="{{ $penghuni->no_telp }}" readonly
                                        class="w-full rounded-xl bg-slate-100 border border-slate-300 px-4 py-3 text-slate-700">
                                </div>

                            </div>

                        </div>

                        <div class="border-t border-slate-200 my-8"></div>

                        <!-- Section 2 -->
                        <div>

                            <div class="flex items-center gap-3 mb-6">
                                <span
                                    class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold">
                                    2
                                </span>

                                <h2 class="text-2xl font-bold text-slate-900">Rincian Pemesanan</h2>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-slate-700">Durasi Sewa</label>
                                    <select name="periode_sewa" required
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3">
                                        <option value="">Pilih Durasi</option>
                                        <option value="3 Bulan">3 Bulan</option>
                                        <option value="6 Bulan">6 Bulan</option>
                                        <option value="12 Bulan">12 Bulan</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-slate-700">Tanggal Mulai</label>
                                    <input type="date" name="tanggal_mulai"
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none">
                                </div>

                            </div>

                        </div>

                        <!-- Submit -->
                        <div class="mt-8">

                            <div class="flex gap-3 p-4 rounded-2xl bg-green-50 border border-green-200 mb-6">

                                <span class="material-symbols-outlined text-green-600">verified_user</span>
                                <p class="text-sm text-green-800">Setelah dikirim Anda akan diarahkan ke WhatsApp Admin.</p>

                            </div>

                            <button type="submit"
                                class="w-full rounded-2xl bg-indigo-600 py-4 text-white font-semibold hover:bg-indigo-700 transition">
                                Konfirmasi via WhatsApp
                            </button>

                        </div>

                    </form>

                </div>

                <!-- Room Summary -->
                <div class="lg:col-span-4 order-1 lg:order-2">

                    <div class="sticky top-24 bg-white rounded-3xl border border-slate-200 shadow-sm p-6">

                        <img src="{{ $kamar?->foto ? asset('storage/' . $kamar->foto) : 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=800' }}"
                            class="w-full h-70 object-cover rounded-2xl" alt="Room">

                        <h3 class="mt-5 text-xl font-bold text-slate-900">
                            {{ $kamar ? ('Kamar ' . $kamar->no_kamar) : 'Kamar' }}
                        </h3>

                        <div class="border-t border-slate-200 mt-5 pt-5 space-y-3">

                            <div class="flex justify-between">
                                <span class="text-slate-500">Harga Bulanan</span>
                                <span class="font-semibold">
                                    @php
                                        $harga = (int) ($kamar?->tipeKamar?->Harga ?? $kamar?->tipeKamar?->harga ?? 0);
                                    @endphp
                                    {{ $harga ? ('Rp ' . number_format($harga, 0, ',', '.')) : '-' }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-slate-500">Biaya Admin</span>
                                <span class="text-green-600 font-semibold">Gratis</span>
                            </div>

                        </div>

                        <div class="mt-5 rounded-2xl bg-indigo-50 border border-indigo-100 p-4">

                            <p class="text-sm text-indigo-700">
                                Data yang Anda masukkan akan digunakan untuk proses verifikasi dan pembuatan kontrak sewa.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </main>
@endsection