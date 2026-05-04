<?php

namespace App\Filament\Resources\ProgramBatches\Pages;

use App\Filament\Resources\ProgramBatches\ProgramBatchResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProgramBatches extends ListRecords
{
    protected static string $resource = ProgramBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
