<?php

namespace App\Filament\Resources\RegistrationDocuments\Pages;

use App\Filament\Resources\RegistrationDocuments\RegistrationDocumentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRegistrationDocument extends ViewRecord
{
    protected static string $resource = RegistrationDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
