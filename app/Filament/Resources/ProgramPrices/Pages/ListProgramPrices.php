<?php

namespace App\Filament\Resources\ProgramPrices\Pages;

use App\Filament\Resources\ProgramPrices\ProgramPriceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProgramPrices extends ListRecords
{
    protected static string $resource = ProgramPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
