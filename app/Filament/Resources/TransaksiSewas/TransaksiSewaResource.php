<?php

namespace App\Filament\Resources\TransaksiSewas;

use App\Filament\Resources\TransaksiSewas\Pages\CreateTransaksiSewa;
use App\Filament\Resources\TransaksiSewas\Pages\EditTransaksiSewa;
use App\Filament\Resources\TransaksiSewas\Pages\ListTransaksiSewas;
use App\Filament\Resources\TransaksiSewas\Schemas\TransaksiSewaForm;
use App\Filament\Resources\TransaksiSewas\Tables\TransaksiSewasTable;
use App\Models\TransaksiSewa;
use Filament\Resources\Resource;
use Filament\Schemas\Schema; 
use Filament\Tables\Table;
use BackedEnum;

class TransaksiSewaResource extends Resource
{
    protected static ?string $model = TransaksiSewa::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Transaksi Sewa';

    public static function form(Schema $schema): Schema
    {
        // Meneruskan Schema ke class TransaksiSewaForm
        return TransaksiSewaForm::form($schema);
    }

    public static function table(Table $table): Table
    {
        // Meneruskan Table ke class TransaksiSewasTable
        return TransaksiSewasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTransaksiSewas::route('/'),
            'create' => CreateTransaksiSewa::route('/create'),
            'edit' => EditTransaksiSewa::route('/{record}/edit'),
        ];
    }
}