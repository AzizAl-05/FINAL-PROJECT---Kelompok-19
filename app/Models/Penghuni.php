<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Penghuni extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'penghuni';
    protected $primaryKey = 'id_penghuni';

    protected $fillable = [
        'nama',
        'no_telp',
        'email',
        'jurusan',
        'kampus',
        'password',
        'foto_profil',
    ];
    protected $hidden = ['password'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed', // otomatis hash saat disimpan
        ];
    }

    public function transaksi()
    {
        return $this->hasMany(TransaksiSewa::class, 'penghuni_id_penghuni', 'id_penghuni');
    }
}
