<?php

namespace App\Filament\Resources\Registrations\Tables;

use App\Models\Certificate;
use App\Models\Payment;
use App\Models\Registration;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RegistrationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('registration_number')
                    ->label('Reg. No')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable(),

                TextColumn::make('full_name')
                    ->label('Participant')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Registration $record): string => $record->email ?? '-')
                    ->wrap(),

                TextColumn::make('phone')
                    ->label('WhatsApp')
                    ->searchable()
                    ->copyable()
                    ->toggleable(),

                TextColumn::make('batch.program.code')
                    ->label('Program')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('batch.title')
                    ->label('Batch')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('price.label')
                    ->label('Price Category')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('payment_method')
                    ->label('Method')
                    ->formatStateUsing(fn (?string $state): string => $state ? strtoupper(str_replace('_', ' ', $state)) : '-')
                    ->toggleable(),

                TextColumn::make('payment_proof_path')
                    ->label('Proof')
                    ->formatStateUsing(fn (?string $state): string => $state ? 'Uploaded' : '-')
                    ->badge()
                    ->color(fn (?string $state): string => $state ? 'success' : 'gray')
                    ->toggleable(),

                TextColumn::make('payment_status')
                    ->label('Payment')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => strtoupper(str_replace('_', ' ', (string) $state)))
                    ->color(fn (?string $state): string => match ($state) {
                        'paid' => 'success',
                        'pending', 'pending_review' => 'warning',
                        'unpaid' => 'danger',
                        'expired', 'failed', 'refunded' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('registration_status')
                    ->label('Registration')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => strtoupper(str_replace('_', ' ', (string) $state)))
                    ->color(fn (?string $state): string => match ($state) {
                        'confirmed', 'completed', 'paid' => 'success',
                        'waiting_payment', 'pending' => 'warning',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('document_status')
                    ->label('Document')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => strtoupper(str_replace('_', ' ', (string) $state)))
                    ->color(fn (?string $state): string => match ($state) {
                        'approved' => 'success',
                        'pending_review' => 'warning',
                        'need_revision', 'rejected' => 'danger',
                        'not_required', 'not_submitted' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('certificate.certificate_number')
                    ->label('Certificate')
                    ->formatStateUsing(fn (?string $state): string => $state ?: '-')
                    ->badge()
                    ->color(fn (?string $state): string => $state ? 'success' : 'gray')
                    ->toggleable(),

                TextColumn::make('payment_submitted_at')
                    ->label('Proof Submitted')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Registered At')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('program_id')
                    ->label('Program')
                    ->relationship('program', 'name'),

                SelectFilter::make('program_batch_id')
                    ->label('Batch')
                    ->relationship('batch', 'title'),

                SelectFilter::make('payment_status')
                    ->label('Payment Status')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'pending' => 'Pending',
                        'pending_review' => 'Pending Review',
                        'paid' => 'Paid',
                        'expired' => 'Expired',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ]),

                SelectFilter::make('registration_status')
                    ->label('Registration Status')
                    ->options([
                        'waiting_payment' => 'Waiting Payment',
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                    ]),

                SelectFilter::make('document_status')
                    ->label('Document Status')
                    ->options([
                        'not_required' => 'Not Required',
                        'not_submitted' => 'Not Submitted',
                        'pending_review' => 'Pending Review',
                        'approved' => 'Approved',
                        'need_revision' => 'Need Revision',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),

                EditAction::make(),

                Action::make('view_payment_proof')
                    ->label('View Proof')
                    ->icon('heroicon-m-document-magnifying-glass')
                    ->color('info')
                    ->visible(fn (Registration $record): bool => filled($record->payment_proof_path))
                    ->url(fn (Registration $record): string => Storage::disk('public')->url($record->payment_proof_path))
                    ->openUrlInNewTab(),

                Action::make('approve_payment')
                    ->label('Approve Payment')
                    ->icon('heroicon-m-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approve this payment?')
                    ->modalDescription('This will mark the payment as paid and confirm the registration.')
                    ->visible(fn (Registration $record): bool => in_array($record->payment_status, ['pending_review', 'pending', 'unpaid']))
                    ->action(function (Registration $record): void {
                        $record->forceFill([
                            'payment_status' => 'paid',
                            'registration_status' => 'confirmed',
                        ])->save();

                        Payment::updateOrCreate(
                            [
                                'registration_id' => $record->id,
                            ],
                            [
                                'amount' => $record->total_amount,
                                'method' => $record->payment_method ?? 'manual_transfer',
                                'status' => 'paid',
                                'paid_at' => now(),
                                'notes' => $record->payment_notes,
                            ]
                        );

                        Notification::make()
                            ->title('Payment approved')
                            ->body("Registration {$record->registration_number} has been marked as paid.")
                            ->success()
                            ->send();
                    }),

                Action::make('mark_unpaid')
                    ->label('Mark Unpaid')
                    ->icon('heroicon-m-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Mark this payment as unpaid?')
                    ->modalDescription('Use this if the payment proof is invalid or needs to be resubmitted.')
                    ->visible(fn (Registration $record): bool => $record->payment_status !== 'unpaid')
                    ->action(function (Registration $record): void {
                        $record->forceFill([
                            'payment_status' => 'unpaid',
                            'registration_status' => 'waiting_payment',
                        ])->save();

                        Payment::where('registration_id', $record->id)->update([
                            'status' => 'unpaid',
                            'paid_at' => null,
                        ]);

                        Notification::make()
                            ->title('Payment marked as unpaid')
                            ->body("Registration {$record->registration_number} needs payment follow-up.")
                            ->warning()
                            ->send();
                    }),

                Action::make('issue_certificate')
                    ->label('Issue Certificate')
                    ->icon('heroicon-m-academic-cap')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Issue certificate?')
                    ->modalDescription('This will create a certificate number for this participant.')
                    ->visible(function (Registration $record): bool {
                        return $record->payment_status === 'paid'
                            && $record->registration_status === 'confirmed'
                            && $record->document_status === 'approved'
                            && ! $record->certificate;
                    })
                    ->action(function (Registration $record): void {
                        $programCode = $record->program?->code ?? $record->batch?->program?->code ?? 'RP';
                        $cleanProgramCode = Str::upper(Str::slug($programCode, ''));

                        $certificateNumber = sprintf(
                            'CERT-%s-%s-%04d',
                            $cleanProgramCode,
                            now()->format('Y'),
                            $record->id
                        );

                        Certificate::updateOrCreate(
                            [
                                'registration_id' => $record->id,
                            ],
                            [
                                'certificate_number' => $certificateNumber,
                                'issued_at' => now(),
                                'status' => 'issued',
                                'file_path' => null,
                            ]
                        );

                        Notification::make()
                            ->title('Certificate issued')
                            ->body("Certificate {$certificateNumber} has been issued.")
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
