<?php

namespace App\Filament\Resources\TipeKamars\Pages;

use App\Filament\Resources\TipeKamars\TipeKamarResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTipeKamars extends ListRecords
{
    protected static string $resource = TipeKamarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
