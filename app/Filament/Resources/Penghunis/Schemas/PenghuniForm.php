<?php

namespace App\Filament\Resources\Penghunis\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload; // Impor FileUpload Filament
use Filament\Forms\Components\Placeholder; // Impor Placeholder jika ingin tampilan read-only
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class PenghuniForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2) // Membuat kontainer dasar form menggunakan layout 2 kolom (Full Width)
            ->components([
                // Posisikan komponen Upload Foto Profil paling atas agar Admin langsung ngeh
                FileUpload::make('foto_profil')
                    ->image()
                    ->avatar() // Mengubah tampilan box menjadi bulat khusus avatar profil
                    ->directory('foto_profil') // Folder penyimpanan di storage/app/public/foto_profil
                    ->visibility('public')
                    ->maxSize(2048)
                    ->label('Foto Profil Penghuni')
                    ->columnSpan(2), // Memaksa area foto menghabiskan 2 kolom penuh agar input nama turun ke bawah

                // Menampilkan ID Penghuni secara otomatis (Disabled / Read-only agar tidak bisa diedit sembarangan)
                TextInput::make('id_penghuni')
                    ->label('ID Penghuni')
                    ->disabled() // Mengunci input agar admin tidak bisa mengubah ID manual
                    ->dehydrated(false) // Memastikan data ID tidak ikut terkirim ulang saat save perubahan
                    ->visible(fn (string $context): bool => $context === 'edit'), // Hanya muncul saat halaman Edit (saat Create disembunyikan karena ID belum digenerate)

                TextInput::make('nama')
                    ->label('Nama Lengkap')
                    ->placeholder('Masukkan nama lengkap')
                    ->required()
                    ->columnSpan(fn (string $context): int => $context === 'edit' ? 1 : 2), // Akal-akalan layout: kalau di halaman edit dia makan 1 kolom (sejajar ID), kalau di halaman create dia makan 2 kolom penuh.

                TextInput::make('no_telp')
                    ->label('No Telp')
                    ->placeholder('Contoh: 0895...')
                    ->tel()
                    ->default(null),

                TextInput::make('email')
                    ->label('Email address')
                    ->placeholder('nama@gmail.com')
                    ->email()
                    ->default(null),

                TextInput::make('jurusan')
                    ->label('Jurusan')
                    ->placeholder('Contoh: Teknik Informatika')
                    ->default(null),

                TextInput::make('kampus')
                    ->label('Kampus')
                    ->placeholder('Contoh: STT-NF')
                    ->default(null),
                
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->placeholder(fn (string $context): string => $context === 'edit' ? 'Kosongkan jika tidak diubah' : 'Masukkan password baru')
                    ->label('Reset Password')
                    ->default(null)
                    ->columnSpan(2), // Membuat input password melebar penuh di baris paling bawah
            ]);
    }
}