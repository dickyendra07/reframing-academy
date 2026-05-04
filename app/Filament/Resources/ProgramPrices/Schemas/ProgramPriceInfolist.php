<?php

namespace App\Filament\Resources\ProgramPrices\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProgramPriceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('program_batch_id')
                    ->numeric(),
                TextEntry::make('label'),
                TextEntry::make('amount')
                    ->numeric(),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                IconEntry::make('requires_alumni_number')
                    ->boolean(),
                IconEntry::make('requires_group_name')
                    ->boolean(),
                TextEntry::make('requires_profession')
                    ->placeholder('-'),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
