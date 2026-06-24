<?php

namespace App\Filament\Widgets;

use App\Models\Kamar;
use App\Models\TransaksiSewa;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatCardsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalKamar = Kamar::query()->count();
        $kamarTersedia = Kamar::query()->where('status', 0)->count();
        $kamarTerisi = Kamar::query()->where('status', 1)->count();

        $penghuniAktif = TransaksiSewa::query()
            ->where('status', 1)
            ->distinct('penghuni_id_penghuni')
            ->count('penghuni_id_penghuni');

        return [
            Stat::make('Total kamar', (string) $totalKamar)
                ->description('Jumlah total kamar')
                ->color('primary'),

            Stat::make('Kamar tersedia', (string) $kamarTersedia)
                ->description('Kamar kosong/siap dihuni')
                ->color('success'),

            Stat::make('Kamar terisi', (string) $kamarTerisi)
                ->description('Kamar ditempati')
                ->color('warning'),

            Stat::make('Total penghuni aktif', (string) $penghuniAktif)
                ->description('Penghuni dengan status transaksi aktif')
                ->color('gray'),
        ];
    }
}

