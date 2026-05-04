<?php

namespace App\Filament\Resources\RegistrationDocuments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class RegistrationDocumentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Document Info')
                    ->schema([
                        TextEntry::make('document_type')
                            ->label('Document Type')
                            ->formatStateUsing(fn (?string $state): string => strtoupper(str_replace('_', ' ', (string) $state)))
                            ->badge()
                            ->color('info'),

                        TextEntry::make('status')
                            ->label('Status')
                            ->formatStateUsing(fn (?string $state): string => strtoupper(str_replace('_', ' ', (string) $state)))
                            ->badge()
                            ->color(fn (?string $state): string => match ($state) {
                                'approved' => 'success',
                                'pending_review' => 'warning',
                                'need_revision', 'rejected' => 'danger',
                                default => 'gray',
                            }),

                        TextEntry::make('file_path')
                            ->label('Uploaded File')
                            ->formatStateUsing(fn (?string $state): string => $state ? 'View File' : '-')
                            ->url(fn (?string $state): ?string => $state ? Storage::disk('public')->url($state) : null)
                            ->openUrlInNewTab()
                            ->badge()
                            ->color(fn (?string $state): string => $state ? 'success' : 'gray'),

                        TextEntry::make('admin_note')
                            ->label('Admin Note')
                            ->placeholder('-'),

                        TextEntry::make('created_at')
                            ->label('Uploaded At')
                            ->dateTime('d M Y H:i'),

                        TextEntry::make('updated_at')
                            ->label('Updated At')
                            ->dateTime('d M Y H:i'),
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

                        TextEntry::make('registration.batch.title')
                            ->label('Batch'),

                        TextEntry::make('registration.price.label')
                            ->label('Price Category'),
                    ])
                    ->columns(2),
            ]);
    }
}
