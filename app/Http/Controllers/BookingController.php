<?php

namespace App\Http\Controllers;

use App\Models\TransaksiSewa; 
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function index(Request $request)
    {
        $tipeSelected = $request->query('tipe');
        $statusSelected = $request->query('status');

        // Jika statusSelected kosong/tidak ada di URL, pasang default 0 (Tersedia)
        $status = (isset($statusSelected) && $statusSelected !== '') ? (int)$statusSelected : 0;

        $kamarTersedia = Kamar::with('tipeKamar')
            // Filter Tipe: Langsung cocokkan angka (1, 2, atau 3) ke kolom 'tipe'
            ->when($tipeSelected, function ($query, $tipe) {
                return $query->where('tipe', (int)$tipe);
            })
            // Filter Status: Langsung cocokkan angka (0 atau 1) ke kolom 'status'
            ->where('status', $status)
            ->get();

        // Pastikan baris dd() di bawah ini sudah DI-HAPUS atau DI-COMMENT agar halaman web muncul
        // dd($kamarTersedia->toArray()); 

        return view('daftarKamar', compact('kamarTersedia', 'tipeSelected', 'statusSelected'));
    }

    

    public function riwayat()
    {
        // 1. Ambil ID penghuni yang sedang login
        $id_penghuni = Auth::guard('penghuni')->id();

        // 2. Sesuaikan nama kolom dengan isi database di phpMyAdmin
        $riwayatSewa = TransaksiSewa::with('kamar.tipeKamar') 
            ->where('penghuni_id_penghuni', $id_penghuni) // <-- Kolom asli di DB
            ->orderBy('tanggal_transaksi', 'desc')        // <-- Kolom tanggal asli di DB
            ->get();

        // 3. Lempar data ke file view riwayat
        return view('riwayat', compact('riwayatSewa'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'kamar_id' => 'required',
            'periode_sewa' => 'required|in:3 Bulan,6 Bulan,12 Bulan',
            'tanggal_mulai' => 'required|date',
        ]);

        
        $penghuni = auth('penghuni')->user();

        
        $kamar = Kamar::with('tipeKamar')->findOrFail($request->kamar_id);

        
        $bulan = match ($request->periode_sewa) {
            '3 Bulan' => 3,
            '6 Bulan' => 6,
            '12 Bulan' => 12,
        };

        
        $harga_per_bulan = $kamar->tipeKamar->Harga ?? $kamar->tipeKamar->harga ?? 0;
        $total_bayar = $harga_per_bulan * $bulan;

        
        transaksiSewa::create([
            'tanggal_transaksi' => now(),
            'penghuni_id_penghuni' => auth('penghuni')->id(), 
            'kamar_id_kamar' => $request->kamar_id,
            'periode_sewa' => $request->periode_sewa,
            'tanggal_mulai' => $request->tanggal_mulai,
            'jumlah_bayar' => $total_bayar,
        ]);


        $nomor_admin = '6285775245377';

        $pesan = "*KONFIRMASI PEMESANAN KOS*\n";
        $pesan .= "----------------------------------\n";
        $pesan .= "Nama Penyewa: " . $penghuni->nama . "\n";
        $pesan .= "No. WhatsApp: " . $penghuni->no_telp . "\n";
        $pesan .= "Kamar Pilihan: Kamar " . $kamar->no_kamar . "\n";
        $pesan .= "Durasi Sewa: " . $request->periode_sewa . "\n";
        $pesan .= "Tanggal Mulai: " . date('d-m-Y', strtotime($request->tanggal_mulai)) . "\n";
        $pesan .= "Total Bayar: Rp " . number_format($total_bayar, 0, ',', '.') . "\n";
        $pesan .= "----------------------------------\n";
        $pesan .= "Halo Admin, saya sudah mengisi form pemesanan. Mohon instruksi pembayaran selanjutnya.";

        $url_whatsapp = "https://api.whatsapp.com/send?phone=" . $nomor_admin . "&text=" . urlencode($pesan);

        
        return redirect()->away($url_whatsapp);
    }
}