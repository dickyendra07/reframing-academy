<?php

namespace App\Filament\Resources\Certificates\Tables;

use App\Models\Certificate;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class CertificatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('certificate_number')
                    ->label('Certificate No')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable(),

                TextColumn::make('registration.registration_number')
                    ->label('Reg. No')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                TextColumn::make('registration.full_name')
                    ->label('Participant')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Certificate $record): string => $record->registration?->email ?? '-')
                    ->wrap(),

                TextColumn::make('registration.batch.title')
                    ->label('Batch')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => strtoupper(str_replace('_', ' ', (string) $state)))
                    ->color(fn (?string $state): string => match ($state) {
                        'issued' => 'success',
                        'not_issued' => 'warning',
                        'revoked' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('file_path')
                    ->label('File')
                    ->formatStateUsing(fn (?string $state): string => $state ? 'Uploaded' : '-')
                    ->badge()
                    ->color(fn (?string $state): string => $state ? 'success' : 'gray')
                    ->sortable(),

                TextColumn::make('issued_at')
                    ->label('Issued At')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'not_issued' => 'Not Issued',
                        'issued' => 'Issued',
                        'revoked' => 'Revoked',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),

                EditAction::make(),

                Action::make('download_certificate')
                    ->label('Download')
                    ->icon('heroicon-m-arrow-down-tray')
                    ->color('success')
                    ->visible(fn (Certificate $record): bool => filled($record->file_path))
                    ->url(fn (Certificate $record): string => Storage::disk('public')->url($record->file_path))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
