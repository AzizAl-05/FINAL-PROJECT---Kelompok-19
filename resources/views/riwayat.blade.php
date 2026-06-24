@extends('layouts.app')

@section('content')
<main class="bg-slate-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="max-w-3xl mx-auto text-center mb-10">
            <span class="inline-flex items-center rounded-full bg-blue-100 px-4 py-2 text-sm font-semibold text-blue-700">
                RIWAYAT SEWA
            </span>
            <h1 class="mt-4 text-3xl md:text-5xl font-extrabold text-slate-900">
                Riwayat Pemesanan Kamar
            </h1>
            <p class="mt-4 text-slate-600 text-lg">
                Pantau status pengajuan sewa kos Anda di bawah ini secara berkala.
            </p>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            @if($riwayatSewa->isEmpty())
                <div class="p-8 text-center text-slate-500">
                    Anda belum memiliki riwayat pemesanan kos.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-slate-700 text-sm font-semibold">
                                <th class="px-6 py-4">ID Transaksi</th>
                                <th class="px-6 py-4">Kamar</th>
                                <th class="px-6 py-4">Periode</th>
                                <th class="px-6 py-4">Total Bayar</th>
                                <th class="px-6 py-4">Tanggal Transaksi</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @foreach($riwayatSewa as $item)
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="px-6 py-4 font-mono text-xs font-semibold text-slate-600">
                                        #TS-{{ str_pad($item->id_transaksi, 5, '0', STR_PAD_LEFT) }}
                                    </td>
                                    
                                    <td class="px-6 py-4 font-medium text-slate-900">
                                        {{ $item->kamar ? 'Kamar ' . $item->kamar->no_kamar : 'Kamar N/A' }}
                                        <span class="block text-xs text-slate-400 font-normal">
                                            {{ $item->kamar?->tipeKamar?->nama_tipe ?? '' }}
                                        </span>
                                    </td>
                                    
                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $item->periode_sewa }}
                                    </td>
                                    
                                    <td class="px-6 py-4 font-semibold text-slate-900">
                                        Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}
                                    </td>
                                    
                                    <td class="px-6 py-4 text-slate-500">
                                        {{ \Carbon\Carbon::parse($item->tanggal_transaksi)->translatedFormat('d F Y') }}
                                    </td>
                                    
                                   <td class="px-6 py-4">
    @if($item->status == 1)
        <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
            Aktif / Disetujui
        </span>
    @elseif($item->status == 2)
        <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-600/20">
            Selesai
        </span>
    @else
        <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">
            Menunggu
        </span>
    @endif
</td>
                                    
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            // Format nomor WA admin (Ganti dengan nomor WA aslimu/kelompokmu, awali kode negara tanpa +)
                                            $noAdmin = '6285775245377'; 
                                            
                                            // Draft pesan otomatis biar template-nya rapi
                                            $pesanWA = "Halo Admin KosMas, saya ingin mengonfirmasi pesanan sewa kos." . "\n\n" .
                                                       "*ID Transaksi:* #TS-" . str_pad($item->id_transaksi, 5, '0', STR_PAD_LEFT) . "\n" .
                                                       "*Kamar:* " . ($item->kamar ? 'Kamar ' . $item->kamar->no_kamar : '-') . "\n" .
                                                       "*Periode:* " . $item->periode_sewa . "\n" .
                                                       "*Total:* Rp " . number_format($item->jumlah_bayar, 0, ',', '.') . "\n\n" .
                                                       "Mohon bantuannya untuk proses verifikasi. Terima kasih!";
                                                       
                                            $urlWhatsApp = "https://wa.me/" . $noAdmin . "?text=" . urlencode($pesanWA);
                                        @endphp
                                        
                                        <a href="{{ $urlWhatsApp }}" target="_blank"
                                           class="inline-flex items-center gap-1.5 justify-center px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition text-xs font-semibold shadow-sm">
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.003 5.324 5.328 0 11.822 0c3.148.001 6.107 1.227 8.331 3.454 2.224 2.227 3.45 5.188 3.448 8.34-.004 6.5-5.33 11.824-11.822 11.824-2.01-.002-3.998-.517-5.753-1.498L0 24zm6.135-4.263c1.613.957 3.562 1.462 5.561 1.463 5.423.003 9.835-4.409 9.839-9.833.001-2.628-1.023-5.099-2.885-6.963C16.824 2.539 14.357 1.515 11.73 1.515c-5.424 0-9.836 4.412-9.84 9.835-.001 2.056.536 4.062 1.554 5.84l-.999 3.648 3.743-.981zm11.368-6.408c-.3-.149-1.774-.875-2.031-.969-.258-.094-.446-.142-.634.14-.188.281-.727.912-.89 1.092-.163.18-.327.201-.627.052-.3-.149-1.265-.467-2.41-1.487-.893-.797-1.496-1.78-1.672-2.08-.175-.299-.019-.462.13-.61.135-.133.3-.349.45-.523.15-.174.2-.299.3-.499.1-.201.05-.375-.025-.524-.075-.15-.634-1.526-.869-2.09-.23-.553-.465-.478-.634-.486-.164-.007-.353-.009-.542-.009-.189 0-.496.071-.756.352-.26.281-.992.969-.992 2.364s1.019 2.75 1.162 2.94c.143.19 2.006 3.063 4.859 4.289.679.292 1.209.466 1.623.598.682.217 1.3.187 1.79.114.545-.081 1.774-.726 2.023-1.426.249-.7 2.49-3.262 2.417-3.356-.071-.094-.253-.141-.553-.291z"/>
                                            </svg>
                                            Hubungi Petugas
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
</main>
@endsection