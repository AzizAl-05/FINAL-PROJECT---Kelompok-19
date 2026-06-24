<?php

namespace App\Filament\Resources\TipeKamars\Pages;

use App\Filament\Resources\TipeKamars\TipeKamarResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTipeKamar extends EditRecord
{
    protected static string $resource = TipeKamarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
