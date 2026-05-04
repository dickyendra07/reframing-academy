<?php

namespace App\Filament\Resources\Certificates\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class CertificateInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Certificate Info')
                    ->schema([
                        TextEntry::make('certificate_number')
                            ->label('Certificate Number')
                            ->copyable()
                            ->weight('bold'),

                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->formatStateUsing(fn (?string $state): string => strtoupper(str_replace('_', ' ', (string) $state)))
                            ->color(fn (?string $state): string => match ($state) {
                                'issued' => 'success',
                                'not_issued' => 'warning',
                                'revoked' => 'danger',
                                default => 'gray',
                            }),

                        TextEntry::make('issued_at')
                            ->label('Issued At')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),

                        TextEntry::make('file_path')
                            ->label('Certificate File')
                            ->formatStateUsing(fn (?string $state): string => $state ? 'Download Certificate PDF' : 'No file uploaded yet')
                            ->url(fn (?string $state): ?string => $state ? Storage::disk('public')->url($state) : null)
                            ->openUrlInNewTab()
                            ->badge()
                            ->color(fn (?string $state): string => $state ? 'success' : 'gray'),
                    ])
                    ->columns(2),

                Section::make('Participant')
                    ->schema([
                        TextEntry::make('registration.registration_number')
                            ->label('Registration Number')
                            ->copyable()
                            ->weight('bold'),

                        TextEntry::make('registration.full_name')
                            ->label('Participant Name')
                            ->weight('bold'),

                        TextEntry::make('registration.email')
                            ->label('Email')
                            ->copyable(),

                        TextEntry::make('registration.phone')
                            ->label('WhatsApp')
                            ->copyable(),

                        TextEntry::make('registration.program.name')
                            ->label('Program'),

                        TextEntry::make('registration.batch.title')
                            ->label('Batch'),
                    ])
                    ->columns(2),
            ]);
    }
}
