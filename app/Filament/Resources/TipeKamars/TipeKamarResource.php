<?php

namespace App\Filament\Resources\TipeKamars;

use App\Filament\Resources\TipeKamars\Pages\CreateTipeKamar;
use App\Filament\Resources\TipeKamars\Pages\EditTipeKamar;
use App\Filament\Resources\TipeKamars\Pages\ListTipeKamars;
use App\Filament\Resources\TipeKamars\Schemas\TipeKamarForm;
use App\Filament\Resources\TipeKamars\Tables\TipeKamarsTable;
use App\Models\TipeKamar;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TipeKamarResource extends Resource
{
    protected static ?string $model = TipeKamar::class;

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Kamar';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Tipe Kamar';



    public static function form(Schema $schema): Schema
    {
        return TipeKamarForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TipeKamarsTable::configure($table);
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
            'index' => ListTipeKamars::route('/'),
            'create' => CreateTipeKamar::route('/create'),
            'edit' => EditTipeKamar::route('/{record}/edit'),
        ];
    }
}
