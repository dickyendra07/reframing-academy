<?php

namespace App\Filament\Resources\Certificates\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CertificateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Certificate Info')
                    ->schema([
                        Select::make('registration_id')
                            ->label('Registration')
                            ->relationship('registration', 'registration_number')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('certificate_number')
                            ->label('Certificate Number')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'not_issued' => 'Not Issued',
                                'issued' => 'Issued',
                                'revoked' => 'Revoked',
                            ])
                            ->required()
                            ->default('issued'),

                        DateTimePicker::make('issued_at')
                            ->label('Issued At')
                            ->seconds(false),

                        FileUpload::make('file_path')
                            ->label('Certificate PDF')
                            ->disk('public')
                            ->directory('certificates')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(10240)
                            ->openable()
                            ->downloadable()
                            ->helperText('Upload the final certificate PDF. Maximum file size: 10 MB.')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
