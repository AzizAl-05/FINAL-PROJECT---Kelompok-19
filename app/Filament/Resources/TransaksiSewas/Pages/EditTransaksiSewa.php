<?php

namespace App\Filament\Resources\TransaksiSewas\Pages;

use App\Filament\Resources\TransaksiSewas\TransaksiSewaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTransaksiSewa extends EditRecord
{
    protected static string $resource = TransaksiSewaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
