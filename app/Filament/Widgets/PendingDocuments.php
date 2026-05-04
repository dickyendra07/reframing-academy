<?php

namespace App\Filament\Widgets;

use App\Models\Registration;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class PendingDocuments extends TableWidget
{
    protected static ?string $heading = 'Pending Documents';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 4;

    protected function getTableQuery(): Builder
    {
        return Registration::query()
            ->with(['program', 'batch', 'price'])
            ->whereIn('document_status', ['pending_review', 'need_revision', 'rejected'])
            ->latest('created_at')
            ->limit(8);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns([
                Tables\Columns\TextColumn::make('registration_number')
                    ->label('Registration No.')
                    ->searchable()
                    ->weight('bold')
                    ->copyable(),

                Tables\Columns\TextColumn::make('full_name')
                    ->label('Participant')
                    ->searchable()
                    ->description(fn (Registration $record): string => $record->email ?? '-')
                    ->wrap(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('WhatsApp')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('batch.title')
                    ->label('Batch')
                    ->searchable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('profession')
                    ->label('Profession')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('document_status')
                    ->label('Document Status')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => strtoupper(str_replace('_', ' ', (string) $state)))
                    ->color(fn (?string $state): string => match ($state) {
                        'approved' => 'success',
                        'pending_review' => 'warning',
                        'need_revision' => 'danger',
                        'rejected' => 'danger',
                        'not_submitted' => 'gray',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Payment')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => strtoupper((string) $state))
                    ->color(fn (?string $state): string => match ($state) {
                        'paid' => 'success',
                        'pending', 'pending_review' => 'warning',
                        'unpaid' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Registered At')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('view')
                    ->label('View')
                    ->icon('heroicon-m-eye')
                    ->url(fn (Registration $record): string => route('filament.admin.resources.registrations.view', $record)),

                Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn (Registration $record): string => route('filament.admin.resources.registrations.edit', $record)),

                Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon('heroicon-m-chat-bubble-left-right')
                    ->url(function (Registration $record): string {
                        $phone = preg_replace('/[^0-9]/', '', $record->phone ?? '');

                        if (str_starts_with($phone, '0')) {
                            $phone = '62' . substr($phone, 1);
                        }

                        $message = urlencode(
                            "Hello {$record->full_name}, this is Reframing Academy. " .
                            "Your document status for registration {$record->registration_number} is currently " .
                            strtoupper(str_replace('_', ' ', (string) $record->document_status)) . ". " .
                            "Please contact our admin team if you need assistance."
                        );

                        return "https://api.whatsapp.com/send?phone={$phone}&text={$message}";
                    })
                    ->openUrlInNewTab(),
            ])
            ->emptyStateHeading('No pending documents')
            ->emptyStateDescription('All participant documents are already approved or do not require review.')
            ->paginated(false);
    }
}
