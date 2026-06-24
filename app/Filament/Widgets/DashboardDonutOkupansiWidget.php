<?php

namespace App\Filament\Widgets;

use App\Models\Kamar;
use Filament\Widgets\ChartWidget;

class DashboardDonutOkupansiWidget extends ChartWidget
{
    protected ?string $heading = 'Persentase Okupansi';

    protected ?string $maxHeight = '320px';

    protected function getData(): array
    {
        $tersedia = Kamar::where('status', 0)->count();
        $ditempati = Kamar::where('status', 1)->count();

        return [
            'datasets' => [
                [
                    'label' => 'Okupansi',
                    'data' => [$tersedia, $ditempati],
                    'backgroundColor' => [
                        '#22c55e', // hijau
                        '#ef4444', // merah
                    ],
                ],
            ],
            'labels' => [
                'Tersedia',
                'Ditempati',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                ],
            ],
            'cutout' => '65%',
        ];
    }
}