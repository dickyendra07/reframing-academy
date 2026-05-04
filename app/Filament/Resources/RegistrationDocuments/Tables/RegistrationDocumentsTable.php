<?php

namespace App\Filament\Resources\RegistrationDocuments\Tables;

use App\Filament\Resources\Registrations\RegistrationResource;
use App\Models\RegistrationDocument;
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

class RegistrationDocumentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('registration.registration_number')
                    ->label('Reg. No')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable(),

                TextColumn::make('registration.full_name')
                    ->label('Participant')
                    ->searchable()
                    ->sortable()
                    ->description(fn (RegistrationDocument $record): string => $record->registration?->email ?? '-')
                    ->wrap(),

                TextColumn::make('registration.batch.title')
                    ->label('Batch')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('document_type')
                    ->label('Document Type')
                    ->formatStateUsing(fn (?string $state): string => strtoupper(str_replace('_', ' ', (string) $state)))
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (?string $state): string => strtoupper(str_replace('_', ' ', (string) $state)))
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'approved' => 'success',
                        'pending_review' => 'warning',
                        'need_revision', 'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('admin_note')
                    ->label('Admin Note')
                    ->placeholder('-')
                    ->limit(40)
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Uploaded At')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending_review' => 'Pending Review',
                        'approved' => 'Approved',
                        'need_revision' => 'Need Revision',
                        'rejected' => 'Rejected',
                    ]),

                SelectFilter::make('document_type')
                    ->label('Document Type')
                    ->options([
                        'identity_document' => 'Identity Document / KTP / Passport',
                        'professional_license' => 'Professional License / STR / SIP',
                        'certificate_or_skp' => 'Certificate / SKP / Supporting Certificate',
                        'alumni_or_member_proof' => 'Alumni / Member Proof',
                        'other_document' => 'Other Document',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),

                EditAction::make(),

                Action::make('view_file')
                    ->label('View File')
                    ->icon('heroicon-m-document-magnifying-glass')
                    ->color('info')
                    ->url(fn (RegistrationDocument $record): string => Storage::disk('public')->url($record->file_path))
                    ->openUrlInNewTab(),

                Action::make('view_registration')
                    ->label('View Registration')
                    ->icon('heroicon-m-user-circle')
                    ->color('gray')
                    ->url(fn (RegistrationDocument $record): string => RegistrationResource::getUrl('view', ['record' => $record->registration_id])),

                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-m-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (RegistrationDocument $record): bool => $record->status !== 'approved')
                    ->action(function (RegistrationDocument $record): void {
                        $record->forceFill([
                            'status' => 'approved',
                            'admin_note' => 'Approved by admin.',
                        ])->save();

                        $registration = $record->registration;

                        $hasPendingOrRevisionDocuments = $registration->documents()
                            ->whereIn('status', ['pending_review', 'need_revision', 'rejected'])
                            ->exists();

                        $registration->forceFill([
                            'document_status' => $hasPendingOrRevisionDocuments ? 'pending_review' : 'approved',
                        ])->save();

                        Notification::make()
                            ->title('Document approved')
                            ->body('The document has been approved successfully.')
                            ->success()
                            ->send();
                    }),

                Action::make('need_revision')
                    ->label('Need Revision')
                    ->icon('heroicon-m-exclamation-triangle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (RegistrationDocument $record): bool => $record->status !== 'need_revision')
                    ->action(function (RegistrationDocument $record): void {
                        $record->forceFill([
                            'status' => 'need_revision',
                            'admin_note' => 'Document needs revision.',
                        ])->save();

                        $record->registration->forceFill([
                            'document_status' => 'need_revision',
                        ])->save();

                        Notification::make()
                            ->title('Document marked as need revision')
                            ->body('The participant needs to upload a revised document.')
                            ->warning()
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
