<?php

namespace App\Filament\Resources\TransaksiSewas\Schemas;

use Filament\Schemas\Schema; // Gunakan Schema, bukan Form
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;

class TransaksiSewaForm
{
    // Samakan parameter dan return type-nya dengan Resource (yaitu Schema)
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([ // Di Filament terbaru, methodnya components() atau schema()
                Select::make('penghuni_id_penghuni')
                    ->label('Penghuni')
                    ->relationship('penghuni', 'nama')
                    ->required(),

                Select::make('kamar_id_kamar')
                    ->label('Kamar')
                    ->relationship('kamar', 'no_kamar')
                    ->required(),

                DatePicker::make('tanggal_transaksi')
                    ->default(now())
                    ->required(),

                DatePicker::make('tanggal_mulai')
                    ->required(),

                TextInput::make('periode_sewa')
                    ->required(),

                TextInput::make('jumlah_bayar')
                    ->numeric()
                    ->required(),

                Select::make('status')
                    ->options([
                        0 => 'Pending',
                        1 => 'Aktif',
                        2 => 'Selesai',
                    ])
                    ->default(0)
                    ->required(),
            ]);
    }
}