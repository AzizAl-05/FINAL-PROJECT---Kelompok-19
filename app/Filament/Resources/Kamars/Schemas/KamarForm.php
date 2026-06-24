<?php

namespace App\Filament\Resources\Kamars\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;


class KamarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('no_kamar')
                    ->label('No Kamar'),

                Select::make('tipe') 
                    ->relationship(
                        name: 'tipeKamar',
                        titleAttribute: 'Tipe'
                    ),

                Select::make('status')
                    ->options([
                        0 => 'Kosong',
                        1 => 'Ditempati',
                    ])
                    ->default(0)
                    ->required(),

                CheckboxList::make('fasilitas')
                    ->relationship('fasilitas', 'nama_fasilitas')
                    ->label('Fasilitas Kamar')
                    ->columns(2)
                    ->searchable(),

                FileUpload::make('foto')
                    ->label('Foto Kamar')
                    ->image()
                    ->disk('public')
                    ->directory('kamar')
                    ->nullable()
                    ->imageEditor()
                    ->openable()
                    ->deletable()
                    ->columnSpanFull(),
            ]);
    }
}
