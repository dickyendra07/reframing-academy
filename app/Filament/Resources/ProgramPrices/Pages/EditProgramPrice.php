<?php

namespace App\Filament\Resources\ProgramPrices\Pages;

use App\Filament\Resources\ProgramPrices\ProgramPriceResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditProgramPrice extends EditRecord
{
    protected static string $resource = ProgramPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
