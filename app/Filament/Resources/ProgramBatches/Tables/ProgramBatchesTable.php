<?php

namespace App\Filament\Resources\ProgramBatches\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProgramBatchesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('program.code')
                    ->label('Program')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Batch')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('location')
                    ->label('Location')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('start_date')
                    ->label('Start')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label('End')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('quota')
                    ->label('Quota')
                    ->placeholder('Unlimited'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable(),

                TextColumn::make('prices_count')
                    ->label('Prices')
                    ->counts('prices'),
            ])
            ->filters([
                SelectFilter::make('program_id')
                    ->label('Program')
                    ->relationship('program', 'name'),

                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'closed' => 'Closed',
                        'archived' => 'Archived',
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