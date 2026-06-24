<?php

namespace App\Filament\Resources\TipeKamars\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TipeKamarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('Tipe')
                    ->default(null),
                TextInput::make('Harga')
                    ->required()
                    ->numeric(),
            ]);
    }
}
