<?php

namespace App\Filament\Resources\ProgramPrices\Schemas;

use App\Models\ProgramBatch;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProgramPriceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Price Information')
                    ->schema([
                        Select::make('program_batch_id')
                            ->label('Program Batch')
                            ->options(
                                ProgramBatch::query()
                                    ->with('program')
                                    ->get()
                                    ->mapWithKeys(function (ProgramBatch $batch) {
                                        return [
                                            $batch->id => $batch->program->code . ' - ' . $batch->title,
                                        ];
                                    })
                            )
                            ->searchable()
                            ->required(),

                        TextInput::make('label')
                            ->label('Price Label')
                            ->placeholder('Publish Rate')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('amount')
                            ->label('Amount')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->minValue(0),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->default('active')
                            ->required(),

                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Requirements')
                    ->description('Gunakan bagian ini kalau harga hanya berlaku untuk kategori peserta tertentu.')
                    ->schema([
                        Select::make('requires_profession')
                            ->label('Required Profession')
                            ->options([
                                'Dokter' => 'Dokter',
                                'Fisioterapis' => 'Fisioterapis',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->placeholder('Tidak wajib profesi tertentu'),

                        Toggle::make('requires_alumni_number')
                            ->label('Requires Alumni Number'),

                        Toggle::make('requires_group_name')
                            ->label('Requires Group Name'),
                    ])
                    ->columns(3),
            ]);
    }
}