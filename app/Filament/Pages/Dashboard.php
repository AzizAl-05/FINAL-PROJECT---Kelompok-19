<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\DashboardDonutOkupansiWidget;
use App\Filament\Widgets\DashboardRevenueChartWidget;
use App\Filament\Widgets\DashboardStatCardsWidget;
use App\Filament\Widgets\DashboardTransaksiTerbaruWidget;
use Filament\Pages\Dashboard as FilamentDashboard;

class Dashboard extends FilamentDashboard
{

    protected function getHeaderWidgets(): array
    {
        return [
            DashboardStatCardsWidget::class,
        ];
    }

    public function getWidgets(): array
    {
        return [
            DashboardRevenueChartWidget::class,
            DashboardDonutOkupansiWidget::class,
            DashboardTransaksiTerbaruWidget::class,
        ];
    }
}


