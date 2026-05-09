<?php

namespace App\Filament\Resources\Payments\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

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

                TextColumn::make('registration.email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),

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

                Action::make('download_invoice')
                    ->label('Invoice')
                    ->icon('heroicon-o-document-text')
                    ->url(fn ($record) => route('admin.payments.invoice', $record))
                    ->openUrlInNewTab(),

                Action::make('download_receipt')
                    ->label('Receipt')
                    ->icon('heroicon-o-receipt-refund')
                    ->url(fn ($record) => route('admin.payments.receipt', $record))
                    ->openUrlInNewTab(),

                Action::make('send_invoice')
                    ->label('Send Invoice')
                    ->icon('heroicon-o-paper-airplane')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->load(['registration.program', 'registration.batch', 'registration.price']);

                        $registration = $record->registration;

                        $pdf = Pdf::loadView('admin.payments.invoice', [
                            'payment' => $record,
                            'registration' => $registration,
                            'isPdf' => true,
                        ])->setPaper('a4');

                        Mail::send('emails.payments.invoice', [
                            'payment' => $record,
                            'registration' => $registration,
                        ], function ($message) use ($record, $registration, $pdf) {
                            $message
                                ->to($registration->email, $registration->full_name)
                                ->subject('Invoice Reframing Academy - ' . $registration->registration_number)
                                ->attachData(
                                    $pdf->output(),
                                    'Invoice-' . $registration->registration_number . '.pdf',
                                    ['mime' => 'application/pdf']
                                );
                        });

                        Notification::make()
                            ->title('Invoice sent')
                            ->body('Invoice berhasil dikirim ke email peserta dengan lampiran PDF.')
                            ->success()
                            ->send();
                    }),

                Action::make('send_receipt')
                    ->label('Send Receipt')
                    ->icon('heroicon-o-envelope')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->load(['registration.program', 'registration.batch', 'registration.price']);

                        $registration = $record->registration;

                        $pdf = Pdf::loadView('admin.payments.receipt', [
                            'payment' => $record,
                            'registration' => $registration,
                            'isPdf' => true,
                        ])->setPaper('a4');

                        Mail::send('emails.payments.receipt', [
                            'payment' => $record,
                            'registration' => $registration,
                        ], function ($message) use ($record, $registration, $pdf) {
                            $message
                                ->to($registration->email, $registration->full_name)
                                ->subject('E-Receipt Reframing Academy - ' . $registration->registration_number)
                                ->attachData(
                                    $pdf->output(),
                                    'E-Receipt-' . $registration->registration_number . '.pdf',
                                    ['mime' => 'application/pdf']
                                );
                        });

                        Notification::make()
                            ->title('Receipt sent')
                            ->body('E-receipt berhasil dikirim ke email peserta dengan lampiran PDF.')
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
