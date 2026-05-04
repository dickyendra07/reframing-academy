<?php

namespace App\Filament\Resources\RegistrationDocuments;

use App\Filament\Resources\RegistrationDocuments\Pages\CreateRegistrationDocument;
use App\Filament\Resources\RegistrationDocuments\Pages\EditRegistrationDocument;
use App\Filament\Resources\RegistrationDocuments\Pages\ListRegistrationDocuments;
use App\Filament\Resources\RegistrationDocuments\Pages\ViewRegistrationDocument;
use App\Filament\Resources\RegistrationDocuments\Schemas\RegistrationDocumentForm;
use App\Filament\Resources\RegistrationDocuments\Schemas\RegistrationDocumentInfolist;
use App\Filament\Resources\RegistrationDocuments\Tables\RegistrationDocumentsTable;
use App\Models\RegistrationDocument;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RegistrationDocumentResource extends Resource
{
    protected static ?string $model = RegistrationDocument::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentCheck;

    protected static ?string $navigationLabel = 'Documents';

    protected static ?string $modelLabel = 'Document';

    protected static ?string $pluralModelLabel = 'Documents';

    protected static string|\UnitEnum|null $navigationGroup = 'Registration Management';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'document_type';

    public static function form(Schema $schema): Schema
    {
        return RegistrationDocumentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RegistrationDocumentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RegistrationDocumentsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRegistrationDocuments::route('/'),
            'create' => CreateRegistrationDocument::route('/create'),
            'view' => ViewRegistrationDocument::route('/{record}'),
            'edit' => EditRegistrationDocument::route('/{record}/edit'),
        ];
    }
}
