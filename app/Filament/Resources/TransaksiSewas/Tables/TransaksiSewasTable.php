<?php

namespace App\Filament\Resources\TransaksiSewas\Tables;

use Filament\Tables\Table; // Wajib ditambahkan agar tidak error type mismatch
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Support\Colors\Color;

class TransaksiSewasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_transaksi')
                    ->sortable(),

                TextColumn::make('penghuni.nama')
                    ->searchable(),

                TextColumn::make('kamar.no_kamar')
                    ->searchable(),

                TextColumn::make('tanggal_mulai')
                    ->date(),

                TextColumn::make('jumlah_bayar')
                    ->money('IDR'),

                // Perbaikan: Gunakan TextColumn dengan badge(), bukan BadgeColumn
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn($state) => match ((int) $state) {
                        0 => 'Pending',
                        1 => 'Aktif',
                        2 => 'Selesai',
                        default => 'Unknown'
                    })

                    ->colors([
                        'warning' => 0,
                        'success' => 1,
                        'gray' => 2,
                    ]),

            ])
            ->actions([

                Action::make('terima')
                    ->label('Terima')
                    ->icon('heroicon-o-check-circle')
                    ->color('warning')
                    ->button()
                    ->visible(fn($record) => $record->status == 0)
                    ->requiresConfirmation()
                    ->modalHeading('Terima Pesanan')
                    ->modalDescription('Pesanan akan diaktifkan dan kamar menjadi terisi.')
                    ->successNotificationTitle('Pesanan berhasil diterima')
                    ->action(function ($record) {

                        $record->update([
                            'status' => 1,
                        ]);

                        $record->kamar()->update([
                            'status' => 1,
                        ]);
                    }),

                Action::make('selesai')
                    ->label('Selesaikan')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->button()
                    ->visible(fn($record) => $record->status == 1)
                    ->requiresConfirmation()
                    ->modalHeading('Selesaikan Sewa')
                    ->modalDescription('Transaksi akan diselesaikan dan kamar kembali tersedia.')
                    ->successNotificationTitle('Transaksi berhasil diselesaikan')
                    ->action(function ($record) {

                        $record->update([
                            'status' => 2,
                        ]);

                        $record->kamar()->update([
                            'status' => 0,
                        ]);
                    }),
            ])
            ->bulkActions([
                // Perbaikan: Gunakan bulkActions, bukan toolbarActions
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
