<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiSewa extends Model
{
    protected $table = 'transaksi_sewa';

    protected $primaryKey = 'id_transaksi';

    public $timestamps = false;

    protected $fillable = [
        'tanggal_transaksi',
        'penghuni_id_penghuni',
        'kamar_id_kamar',
        'periode_sewa',
        'tanggal_mulai',
        'jumlah_bayar',
        'status',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'date',
        'tanggal_mulai' => 'date',
        'jumlah_bayar' => 'decimal:2',
    ];

    public function penghuni(): BelongsTo
    {
        return $this->belongsTo(
            Penghuni::class,
            'penghuni_id_penghuni',
            'id_penghuni'
        );
    }

    public function kamar(): BelongsTo
    {
        return $this->belongsTo(
            Kamar::class,
            'kamar_id_kamar',
            'id_kamar'
        );
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            0 => 'Pending',
            1 => 'Aktif',
            2 => 'Selesai',
            default => 'Unknown',
        };
    }
}