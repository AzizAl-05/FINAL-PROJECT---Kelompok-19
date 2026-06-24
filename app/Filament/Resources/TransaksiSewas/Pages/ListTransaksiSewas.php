<?php

namespace App\Filament\Resources\TransaksiSewas\Pages;

use App\Filament\Resources\TransaksiSewas\TransaksiSewaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTransaksiSewas extends ListRecords
{
    protected static string $resource = TransaksiSewaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
