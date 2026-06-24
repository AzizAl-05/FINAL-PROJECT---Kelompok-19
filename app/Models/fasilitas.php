<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fasilitas extends Model
{
    protected $primaryKey = 'id_fasilitas';

    public $timestamps = false;

    protected $fillable = [
        'nama_fasilitas',
        'icon',
    ];

    public function kamar()
    {
        return $this->belongsToMany(
            Kamar::class,
            'fasilitas_kamar',
            'fasilitas_id_fasilitas',
            'kamar_id_kamar',
        );
    }
}