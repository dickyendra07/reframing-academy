<?php

namespace App\Filament\Resources\RegistrationDocuments\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RegistrationDocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Document')
                    ->schema([
                        Select::make('registration_id')
                            ->label('Registration')
                            ->relationship('registration', 'registration_number')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('document_type')
                            ->label('Document Type')
                            ->options([
                                'identity_document' => 'Identity Document / KTP / Passport',
                                'professional_license' => 'Professional License / STR / SIP',
                                'certificate_or_skp' => 'Certificate / SKP / Supporting Certificate',
                                'alumni_or_member_proof' => 'Alumni / Member Proof',
                                'other_document' => 'Other Document',
                            ])
                            ->required(),

                        FileUpload::make('file_path')
                            ->label('File')
                            ->disk('public')
                            ->directory('registration-documents')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'application/pdf'])
                            ->maxSize(5120)
                            ->openable()
                            ->downloadable()
                            ->required(),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending_review' => 'Pending Review',
                                'approved' => 'Approved',
                                'need_revision' => 'Need Revision',
                                'rejected' => 'Rejected',
                            ])
                            ->required()
                            ->default('pending_review'),

                        Textarea::make('admin_note')
                            ->label('Admin Note')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
