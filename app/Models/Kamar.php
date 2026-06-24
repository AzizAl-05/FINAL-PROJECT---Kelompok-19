<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Kamar extends Model
{
    protected $primaryKey = 'id_kamar';
    protected $table = 'kamar';

    public $timestamps = false;

    protected static function booted()
    {
        // saat update (ganti foto)
        static::updating(function ($kamar) {
            $fotoLama = $kamar->getOriginal('foto');
            
            // PASTIKAN: foto lama tidak kosong DAN kolom foto emang berubah (dirty)
            if (!empty($fotoLama) && $kamar->isDirty('foto')) {
                Storage::disk('public')->delete($fotoLama);
            }
        });

        // saat hapus data kamar
        static::deleting(function ($kamar) {
            if (!empty($kamar->foto)) {
                Storage::disk('public')->delete($kamar->foto);
            }
        });
    }

    protected $fillable = [
        'no_kamar',
        'tipe',
        'id_tipe',
        'status',
        'foto',
    ];

    public function tipeKamar(): BelongsTo
    {
        return $this->belongsTo(Tipekamar::class, 'tipe', 'id_tipe');
    }

    public function fasilitas()
    {
        return $this->belongsToMany(
            Fasilitas::class,
            'fasilitas_kamar',
            'kamar_id_kamar',
            'fasilitas_id_fasilitas',
        );
    }
}
