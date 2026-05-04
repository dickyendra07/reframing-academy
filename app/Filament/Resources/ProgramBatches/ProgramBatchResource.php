<?php

namespace App\Filament\Resources\ProgramBatches;

use App\Filament\Resources\ProgramBatches\Pages\CreateProgramBatch;
use App\Filament\Resources\ProgramBatches\Pages\EditProgramBatch;
use App\Filament\Resources\ProgramBatches\Pages\ListProgramBatches;
use App\Filament\Resources\ProgramBatches\Schemas\ProgramBatchForm;
use App\Filament\Resources\ProgramBatches\Tables\ProgramBatchesTable;
use App\Models\ProgramBatch;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProgramBatchResource extends Resource
{
    protected static ?string $model = ProgramBatch::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static string|UnitEnum|null $navigationGroup = 'Program Management';

    protected static ?string $modelLabel = 'Program Batch';

    protected static ?string $pluralModelLabel = 'Program Batches';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return ProgramBatchForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProgramBatchesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProgramBatches::route('/'),
            'create' => CreateProgramBatch::route('/create'),
            'edit' => EditProgramBatch::route('/{record}/edit'),
        ];
    }
}