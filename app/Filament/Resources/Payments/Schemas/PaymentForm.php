<?php

namespace App\Filament\Resources\Payments\Schemas;

use App\Models\Registration;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Registration')
                    ->schema([
                        Select::make('registration_id')
                            ->label('Registration')
                            ->options(
                                Registration::query()
                                    ->latest()
                                    ->get()
                                    ->mapWithKeys(function (Registration $registration) {
                                        return [
                                            $registration->id => $registration->registration_number . ' - ' . $registration->full_name,
                                        ];
                                    })
                            )
                            ->searchable()
                            ->required(),
                    ]),

                Section::make('Payment Info')
                    ->schema([
                        Select::make('payment_gateway')
                            ->label('Payment Gateway')
                            ->options([
                                'manual' => 'Manual',
                                'midtrans' => 'Midtrans',
                                'xendit' => 'Xendit',
                                'duitku' => 'Duitku',
                            ])
                            ->default('manual'),

                        TextInput::make('external_reference')
                            ->label('External Reference')
                            ->placeholder('PAY-RP-CDNP10-0001')
                            ->maxLength(255),

                        TextInput::make('amount')
                            ->label('Amount')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'expired' => 'Expired',
                                'failed' => 'Failed',
                                'cancelled' => 'Cancelled',
                                'refunded' => 'Refunded',
                            ])
                            ->default('pending')
                            ->required(),

                        Textarea::make('payment_url')
                            ->label('Payment URL')
                            ->rows(2)
                            ->columnSpanFull(),

                        DateTimePicker::make('paid_at')
                            ->label('Paid At'),

                        DateTimePicker::make('expired_at')
                            ->label('Expired At'),
                    ])
                    ->columns(2),

                Section::make('Raw Response')
                    ->description('Untuk nanti saat integrasi payment gateway. Saat ini boleh dikosongkan.')
                    ->schema([
                        KeyValue::make('raw_response')
                            ->label('Raw Response')
                            ->keyLabel('Key')
                            ->valueLabel('Value')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}