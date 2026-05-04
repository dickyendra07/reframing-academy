<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaymentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Registration')
                    ->schema([
                        TextEntry::make('registration.registration_number')
                            ->label('Registration Number'),

                        TextEntry::make('registration.full_name')
                            ->label('Participant'),

                        TextEntry::make('registration.email')
                            ->label('Email'),

                        TextEntry::make('registration.phone')
                            ->label('WhatsApp'),
                    ])
                    ->columns(2),

                Section::make('Payment Info')
                    ->schema([
                        TextEntry::make('payment_gateway')
                            ->label('Payment Gateway')
                            ->badge()
                            ->placeholder('-'),

                        TextEntry::make('external_reference')
                            ->label('External Reference')
                            ->placeholder('-'),

                        TextEntry::make('amount')
                            ->label('Amount')
                            ->money('IDR'),

                        TextEntry::make('status')
                            ->label('Status')
                            ->badge(),

                        TextEntry::make('payment_url')
                            ->label('Payment URL')
                            ->placeholder('-')
                            ->columnSpanFull(),

                        TextEntry::make('paid_at')
                            ->label('Paid At')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),

                        TextEntry::make('expired_at')
                            ->label('Expired At')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),
                    ])
                    ->columns(2),
            ]);
    }
}