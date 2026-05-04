<?php

namespace App\Filament\Resources\RegistrationDocuments\Pages;

use App\Filament\Resources\RegistrationDocuments\RegistrationDocumentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRegistrationDocuments extends ListRecords
{
    protected static string $resource = RegistrationDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
