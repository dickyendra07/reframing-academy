<?php

namespace App\Filament\Resources\RegistrationDocuments\Pages;

use App\Filament\Resources\RegistrationDocuments\RegistrationDocumentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRegistrationDocument extends EditRecord
{
    protected static string $resource = RegistrationDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
