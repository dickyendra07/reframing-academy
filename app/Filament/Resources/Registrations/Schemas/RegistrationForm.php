<?php

namespace App\Filament\Resources\Registrations\Schemas;

use App\Models\Program;
use App\Models\ProgramBatch;
use App\Models\ProgramPrice;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Registration Info')
                    ->schema([
                        TextInput::make('registration_number')
                            ->label('Registration Number')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Select::make('program_id')
                            ->label('Program')
                            ->options(Program::query()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),

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

                        Select::make('program_price_id')
                            ->label('Price Category')
                            ->options(
                                ProgramPrice::query()
                                    ->with('batch.program')
                                    ->get()
                                    ->mapWithKeys(function (ProgramPrice $price) {
                                        return [
                                            $price->id => $price->batch->program->code . ' - ' . $price->batch->title . ' - ' . $price->label,
                                        ];
                                    })
                            )
                            ->searchable()
                            ->required(),
                    ])
                    ->columns(2),

                Section::make('Participant Data')
                    ->schema([
                        TextInput::make('full_name')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->label('WhatsApp Number')
                            ->required()
                            ->maxLength(50),

                        TextInput::make('province')
                            ->label('Province')
                            ->maxLength(255),

                        TextInput::make('city')
                            ->label('City')
                            ->maxLength(255),

                        TextInput::make('institution')
                            ->label('Institution / Workplace')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Professional Data')
                    ->schema([
                        Select::make('profession')
                            ->label('Profession')
                            ->options([
                                'Dokter' => 'Dokter',
                                'Fisioterapis' => 'Fisioterapis',
                                'Lainnya' => 'Lainnya',
                            ]),

                        TextInput::make('education')
                            ->label('Education')
                            ->maxLength(255),

                        TextInput::make('nik_number')
                            ->label('NIK Number')
                            ->maxLength(255),

                        TextInput::make('str_number')
                            ->label('STR Number')
                            ->maxLength(255),

                        TextInput::make('alumni_number')
                            ->label('Alumni Number')
                            ->maxLength(255),

                        TextInput::make('group_name')
                            ->label('Group Name')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Price & Payment')
                    ->schema([
                        TextInput::make('base_price')
                            ->label('Base Price')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),

                        TextInput::make('discount_amount')
                            ->label('Discount Amount')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0)
                            ->required(),

                        TextInput::make('total_amount')
                            ->label('Total Amount')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),

                        Select::make('payment_type')
                            ->label('Payment Type')
                            ->options([
                                'full_payment' => 'Full Payment',
                                'down_payment' => 'Down Payment / Installment',
                            ])
                            ->default('full_payment')
                            ->required(),

                        TextInput::make('dp_amount')
                            ->label('DP Amount')
                            ->numeric()
                            ->prefix('Rp'),
                    ])
                    ->columns(2),

                Section::make('Statuses')
                    ->schema([
                        Select::make('registration_status')
                            ->label('Registration Status')
                            ->options([
                                'waiting_payment' => 'Waiting Payment',
                                'paid' => 'Paid',
                                'confirmed' => 'Confirmed',
                                'cancelled' => 'Cancelled',
                                'completed' => 'Completed',
                            ])
                            ->default('waiting_payment')
                            ->required(),

                        Select::make('payment_status')
                            ->label('Payment Status')
                            ->options([
                                'unpaid' => 'Unpaid',
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'expired' => 'Expired',
                                'failed' => 'Failed',
                                'refunded' => 'Refunded',
                            ])
                            ->default('unpaid')
                            ->required(),

                        Select::make('document_status')
                            ->label('Document Status')
                            ->options([
                                'not_required' => 'Not Required',
                                'pending_review' => 'Pending Review',
                                'approved' => 'Approved',
                                'need_revision' => 'Need Revision',
                            ])
                            ->default('pending_review')
                            ->required(),

                        DateTimePicker::make('paid_at')
                            ->label('Paid At'),

                        DateTimePicker::make('confirmed_at')
                            ->label('Confirmed At'),
                    ])
                    ->columns(2),
            ]);
    }
}