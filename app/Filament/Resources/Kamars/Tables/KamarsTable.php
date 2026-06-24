<?php

namespace App\Filament\Resources\Kamars\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\ImageColumn;

class KamarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_kamar')
                    ->label('Nomor Kamar')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tipeKamar.Tipe')
                    ->label('Tipe Kamar')
                    ->badge()
                    ->formatStateUsing(fn($state) => match ($state) {
                        'A' => 'Premium',
                        'B' => 'Menengah',
                        'C' => 'Standar',
                        default => $state,
                    }),


                TextColumn::make('fasilitas.nama_fasilitas')
                    ->label('Fasilitas')
                    ->badge() // 
                    ->separator(','),

                TextColumn::make('status')
                    ->formatStateUsing(fn(int $state): string => $state === 1 ? 'Ditempati' : 'Kosong'),

                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->square()
                    ->size(60),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
