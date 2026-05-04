<?php

namespace App\Filament\Widgets;

use App\Models\Registration;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class PendingPayments extends TableWidget
{
    protected static ?string $heading = 'Pending Payments';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 3;

    protected function getTableQuery(): Builder
    {
        return Registration::query()
            ->with(['program', 'batch', 'price'])
            ->whereIn('payment_status', ['unpaid', 'pending', 'pending_review'])
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

                Tables\Columns\TextColumn::make('price.label')
                    ->label('Price Category')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Amount')
                    ->money('IDR')
                    ->sortable(),

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
                            "Your registration {$record->registration_number} for {$record->batch->title} is still waiting for payment. " .
                            "Please complete your payment to confirm your seat."
                        );

                        return "https://api.whatsapp.com/send?phone={$phone}&text={$message}";
                    })
                    ->openUrlInNewTab(),
            ])
            ->emptyStateHeading('No pending payments')
            ->emptyStateDescription('All current registrations are already paid or do not require payment follow-up.')
            ->paginated(false);
    }
}
