<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipekamar extends Model
{
    protected $primaryKey = 'id_tipe'; 
    protected $table = 'tipe_kamar';
    protected $fillable = [
        'Tipe',
        'Harga',
    ];

    public function kamars()
    {
        return $this->hasMany(
            Kamar::class,
            'tipe',
            'id_tipe'
        );
    }
}
