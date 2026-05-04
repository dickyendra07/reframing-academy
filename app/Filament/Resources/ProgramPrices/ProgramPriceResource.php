<?php

namespace App\Filament\Resources\ProgramPrices;

use App\Filament\Resources\ProgramPrices\Pages\CreateProgramPrice;
use App\Filament\Resources\ProgramPrices\Pages\EditProgramPrice;
use App\Filament\Resources\ProgramPrices\Pages\ListProgramPrices;
use App\Filament\Resources\ProgramPrices\Schemas\ProgramPriceForm;
use App\Filament\Resources\ProgramPrices\Tables\ProgramPricesTable;
use App\Models\ProgramPrice;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProgramPriceResource extends Resource
{
    protected static ?string $model = ProgramPrice::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static string|UnitEnum|null $navigationGroup = 'Program Management';

    protected static ?string $modelLabel = 'Program Price';

    protected static ?string $pluralModelLabel = 'Program Prices';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return ProgramPriceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProgramPricesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProgramPrices::route('/'),
            'create' => CreateProgramPrice::route('/create'),
            'edit' => EditProgramPrice::route('/{record}/edit'),
        ];
    }
}