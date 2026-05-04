<?php

namespace App\Filament\Resources\ProgramBatches\Pages;

use App\Filament\Resources\ProgramBatches\ProgramBatchResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProgramBatch extends ViewRecord
{
    protected static string $resource = ProgramBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
