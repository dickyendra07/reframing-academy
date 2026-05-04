<?php

namespace App\Filament\Resources\Payments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('registration.registration_number')
                    ->label('Reg. No')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('registration.full_name')
                    ->label('Participant')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('payment_gateway')
                    ->label('Gateway')
                    ->badge()
                    ->sortable(),

                TextColumn::make('external_reference')
                    ->label('Reference')
                    ->searchable()
                    ->placeholder('-'),

                TextColumn::make('amount')
                    ->label('Amount')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable(),

                TextColumn::make('paid_at')
                    ->label('Paid At')
                    ->dateTime('d M Y H:i')
                    ->placeholder('-')
                    ->sortable(),

                TextColumn::make('expired_at')
                    ->label('Expired At')
                    ->dateTime('d M Y H:i')
                    ->placeholder('-')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('payment_gateway')
                    ->label('Gateway')
                    ->options([
                        'manual' => 'Manual',
                        'midtrans' => 'Midtrans',
                        'xendit' => 'Xendit',
                        'duitku' => 'Duitku',
                    ]),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'expired' => 'Expired',
                        'failed' => 'Failed',
                        'cancelled' => 'Cancelled',
                        'refunded' => 'Refunded',
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