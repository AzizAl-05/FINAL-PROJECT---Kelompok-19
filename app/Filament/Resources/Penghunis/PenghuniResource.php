<?php

namespace App\Filament\Resources\Penghunis;

use App\Filament\Resources\Penghunis\Pages\CreatePenghuni;
use App\Filament\Resources\Penghunis\Pages\EditPenghuni;
use App\Filament\Resources\Penghunis\Pages\ListPenghunis;
use App\Filament\Resources\Penghunis\Schemas\PenghuniForm;
use App\Filament\Resources\Penghunis\Tables\PenghunisTable;
use App\Models\Penghuni;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn; // Ditambahkan tanpa menghapus kode lain
use Filament\Tables\Columns\TextColumn;  // Ditambahkan tanpa menghapus kode lain

class PenghuniResource extends Resource
{
    protected static ?string $model = Penghuni::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Penghuni';

    public static function form(Schema $schema): Schema
    {
        return PenghuniForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // Tetap memanggil PenghunisTable::configure($table) bawaanmu, 
        // lalu kita rincikan kolomnya langsung di sini agar foto dan nama tersinkronisasi sempurna
        return PenghunisTable::configure($table)
            ->columns([
                // 1. Kolom ID Penghuni (Muncul paling kiri sebelum Foto)
                TextColumn::make('id_penghuni')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('foto_profil')
                    ->label('Foto')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(url('https://ui-avatars.com/api/?name=User&color=7F9CF5&background=EBF4FF')),
                
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('no_telp')
                    ->label('No Telp')
                    ->searchable(),
                
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                
                TextColumn::make('jurusan')
                    ->searchable(),
                
                TextColumn::make('kampus')
                    ->searchable(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPenghunis::route('/'),
            'create' => CreatePenghuni::route('/create'),
            'edit' => EditPenghuni::route('/{record}/edit'),
        ];
    }
}