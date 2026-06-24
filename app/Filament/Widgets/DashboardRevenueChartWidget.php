<?php

namespace App\Filament\Widgets;

use App\Models\TransaksiSewa;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class DashboardRevenueChartWidget extends ChartWidget
{
    protected ?string $heading = 'Chart Pendapatan';

    protected ?string $maxHeight = '320px';

    protected function getData(): array
    {
        $rows = TransaksiSewa::query()
            ->selectRaw("DATE_FORMAT(tanggal_mulai, '%Y-%m') as bulan, SUM(jumlah_bayar) as total")
            ->whereNotNull('tanggal_mulai')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $labels = $rows->pluck('bulan')->map(fn ($v) => (string) $v)->values()->all();
        $totals = $rows->pluck('total')->map(fn ($v) => (float) $v)->values()->all();

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $totals,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'chart' => [
                'toolbar' => [
                    'show' => false,
                ],
            ],
            'stroke' => [
                'curve' => 'smooth',
            ],
            'dataLabels' => [
                'enabled' => false,
            ],
            'yaxis' => [
                'labels' => [
                    'formatter' => "function (val) { return 'Rp ' + val.toLocaleString('id-ID'); }",
                ],
            ],
            'tooltip' => [
                'y' => [
                    'formatter' => "function (val) { return 'Rp ' + val.toLocaleString('id-ID'); }",
                ],
            ],
        ];
    }
}

