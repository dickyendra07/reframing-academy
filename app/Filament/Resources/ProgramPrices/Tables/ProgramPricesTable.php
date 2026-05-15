<?php

namespace App\Filament\Resources\ProgramPrices\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProgramPricesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('batch.program.code')
                    ->label('Program')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('batch.title')
                    ->label('Batch')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('label')
                    ->label('Label')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('amount')
                    ->label('Amount / Person')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('participant_count')
                    ->label('Participants')
                    ->badge()
                    ->sortable(),

                TextColumn::make('requires_profession')
                    ->label('Profession')
                    ->placeholder('-'),

                IconColumn::make('requires_alumni_number')
                    ->label('Alumni')
                    ->boolean(),

                IconColumn::make('requires_group_name')
                    ->label('Group')
                    ->boolean(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('program_batch_id')
                    ->label('Batch')
                    ->relationship('batch', 'title'),

                SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}