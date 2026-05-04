<?php

namespace App\Filament\Resources\ProgramBatches\Pages;

use App\Filament\Resources\ProgramBatches\ProgramBatchResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditProgramBatch extends EditRecord
{
    protected static string $resource = ProgramBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
