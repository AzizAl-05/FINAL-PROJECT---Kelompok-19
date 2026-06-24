<?php

namespace App\Filament\Widgets;

use App\Models\TransaksiSewa;
use Filament\Widgets\TableWidget;;
use Filament\Tables\Columns\TextColumn;

class DashboardTransaksiTerbaruWidget extends TableWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Transaksi Terbaru';

    public function getTableRecordsPerPage(): int
{
    return 10;
}

    protected function getTableQuery(): 
        \Illuminate\Database\Eloquent\Builder
    {
        return TransaksiSewa::query()
            ->with(['penghuni', 'kamar'])
            ->latest('tanggal_transaksi');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('tanggal_transaksi')
                ->label('Tanggal')
                ->date(),

            TextColumn::make('penghuni.nama')
                ->label('Penghuni')
                ->searchable(),

            TextColumn::make('kamar.no_kamar')
                ->label('Kamar')
                ->searchable(),

            TextColumn::make('jumlah_bayar')
                ->label('Jumlah Bayar')
                ->money('IDR'),

            TextColumn::make('status')
                ->label('Status')
                ->badge()
                ->formatStateUsing(fn($state) => match ((int) $state) {
                    0 => 'Pending',
                    1 => 'Aktif',
                    2 => 'Selesai',
                    default => 'Unknown',
                })
                ->colors([
                    'warning' => 0,
                    'success' => 1,
                    'gray' => 2,
                ]),
        ];
    }
}

