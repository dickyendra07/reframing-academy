<?php

namespace App\Filament\Resources\ProgramPrices\Pages;

use App\Filament\Resources\ProgramPrices\ProgramPriceResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProgramPrice extends ViewRecord
{
    protected static string $resource = ProgramPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
