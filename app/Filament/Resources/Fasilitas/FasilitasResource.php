<?php

namespace App\Filament\Resources\Fasilitas;

use App\Filament\Resources\Fasilitas\Pages\CreateFasilitas;
use App\Filament\Resources\Fasilitas\Pages\EditFasilitas;
use App\Filament\Resources\Fasilitas\Pages\ListFasilitas;
use App\Filament\Resources\Fasilitas\Tables\FasilitasTable;
use App\Models\Fasilitas;
use App\Models\Tipekamar;
use App\Models\Kamar;
use BackedEnum;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Support\Arr;
use UnitEnum;


class FasilitasResource extends Resource
{
    protected static ?string $model = Fasilitas::class;
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Kamar';
    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'nama_fasilitas';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_fasilitas')
                    ->label('Nama Fasilitas')
                    ->required()
                    ->maxLength(255),
                TextInput::make('icon')
                    ->label('Nama Ikon (Material Symbols)')
                    ->placeholder('Contoh: wifi, ac_unit, bed, tv')
                    ->helperText('Cari nama ikon di https://fonts.google.com/icons')
                    ->default('check'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return FasilitasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFasilitas::route('/'),
            'create' => CreateFasilitas::route('/create'),
            'edit' => EditFasilitas::route('/{record}/edit'),
        ];
    }
    
}


