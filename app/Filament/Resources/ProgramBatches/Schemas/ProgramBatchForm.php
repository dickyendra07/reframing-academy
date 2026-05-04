<?php

namespace App\Filament\Resources\ProgramBatches\Schemas;

use App\Models\Program;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProgramBatchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Program Information')
                    ->schema([
                        Select::make('program_id')
                            ->label('Program')
                            ->options(Program::query()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),

                        TextInput::make('batch_number')
                            ->label('Batch Number')
                            ->placeholder('10')
                            ->maxLength(50),

                        TextInput::make('title')
                            ->label('Batch Title')
                            ->placeholder('CDNP Batch 10 Pontianak')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                    ])
                    ->columns(2),

                Section::make('Location & Schedule')
                    ->schema([
                        TextInput::make('location')
                            ->label('Location')
                            ->placeholder('Pontianak')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('venue')
                            ->label('Venue')
                            ->placeholder('Hotel / Clinic / Venue name')
                            ->maxLength(255),

                        DatePicker::make('start_date')
                            ->label('Start Date')
                            ->required(),

                        DatePicker::make('end_date')
                            ->label('End Date')
                            ->required(),

                        TextInput::make('quota')
                            ->label('Quota')
                            ->numeric()
                            ->minValue(0)
                            ->placeholder('Leave empty if unlimited'),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'closed' => 'Closed',
                                'archived' => 'Archived',
                            ])
                            ->default('draft')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}