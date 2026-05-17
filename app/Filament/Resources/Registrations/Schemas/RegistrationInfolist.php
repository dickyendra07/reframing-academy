<?php

namespace App\Filament\Resources\Registrations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class RegistrationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Registration Info')
                    ->schema([
                        TextEntry::make('registration_number')
                            ->label('Registration Number')
                            ->copyable()
                            ->weight('bold'),

                        TextEntry::make('program.name')
                            ->label('Program'),

                        TextEntry::make('batch.title')
                            ->label('Batch'),

                        TextEntry::make('price.label')
                            ->label('Price Category'),
                    ])
                    ->columns(2),

                Section::make('Participant Data')
                    ->schema([
                        TextEntry::make('full_name')
                            ->label('Full Name')
                            ->weight('bold'),

                        TextEntry::make('email')
                            ->label('Email')
                            ->copyable(),

                        TextEntry::make('phone')
                            ->label('WhatsApp')
                            ->copyable(),

                        TextEntry::make('province')
                            ->label('Province')
                            ->placeholder('-'),

                        TextEntry::make('city')
                            ->label('City')
                            ->placeholder('-'),

                        TextEntry::make('institution')
                            ->label('Institution / Workplace')
                            ->placeholder('-'),
                    ])
                    ->columns(2),

                Section::make('Professional Data')
                    ->schema([
                        TextEntry::make('profession')
                            ->label('Profession')
                            ->placeholder('-'),

                        TextEntry::make('education')
                            ->label('Education')
                            ->placeholder('-'),

                        TextEntry::make('nik_number')
                            ->label('NIK Number')
                            ->copyable()
                            ->placeholder('-'),

                        TextEntry::make('str_number')
                            ->label('STR Number')
                            ->copyable()
                            ->placeholder('-'),

                        TextEntry::make('alumni_number')
                            ->label('Alumni Number')
                            ->copyable()
                            ->placeholder('-'),

                        TextEntry::make('group_name')
                            ->label('Group Name')
                            ->placeholder('-'),
                    ])
                    ->columns(2),

                Section::make('Payment Summary')
                    ->schema([
                        TextEntry::make('base_price')
                            ->label('Base Price')
                            ->money('IDR'),

                        TextEntry::make('discount_amount')
                            ->label('Discount')
                            ->money('IDR'),

                        TextEntry::make('total_amount')
                            ->label('Total')
                            ->money('IDR')
                            ->weight('bold'),

                        TextEntry::make('payment_type')
                            ->label('Payment Type')
                            ->formatStateUsing(fn (?string $state): string => $state ? strtoupper(str_replace('_', ' ', $state)) : '-'),

                        TextEntry::make('dp_amount')
                            ->label('DP Amount')
                            ->money('IDR')
                            ->placeholder('-'),
                    ])
                    ->columns(2),

                Section::make('Group Participants')
                    ->description('Additional participants included in this group registration.')
                    ->visible(fn ($record): bool => $record->participants()->exists())
                    ->schema([
                        TextEntry::make('group_participants_list')
                            ->label('Members')
                            ->state(function ($record): HtmlString {
                                $participants = $record->participants()->orderBy('participant_order')->get();

                                if ($participants->isEmpty()) {
                                    return new HtmlString('<span style="color:#6b7280;">No additional group participants.</span>');
                                }

                                $html = '<div style="display:grid; gap:12px;">';

                                foreach ($participants as $participant) {
                                    $html .= '
                                        <div style="border:1px solid #e5e7eb; border-radius:14px; padding:14px; background:#f9fafb;">
                                            <div style="font-weight:900; color:#111827; font-size:15px;">
                                                Participant ' . e($participant->participant_order) . ' - ' . e($participant->full_name) . '
                                            </div>

                                            <div style="margin-top:8px; color:#4b5563; font-size:13px; line-height:1.8;">
                                                <strong>Email:</strong> ' . e($participant->email ?: '-') . '<br>
                                                <strong>WhatsApp:</strong> ' . e($participant->phone ?: '-') . '<br>
                                                <strong>Province / City:</strong> ' . e($participant->province ?: '-') . ' / ' . e($participant->city ?: '-') . '<br>
                                                <strong>Profession:</strong> ' . e($participant->profession ?: '-') . '<br>
                                                <strong>Education:</strong> ' . e($participant->education ?: '-') . '<br>
                                                <strong>NIK:</strong> ' . e($participant->nik_number ?: '-') . '<br>
                                                <strong>STR:</strong> ' . e($participant->str_number ?: '-') . '<br>
                                                <strong>Institution:</strong> ' . e($participant->institution ?: '-') . '<br>
                                                <strong>Shirt Size:</strong> ' . e($participant->shirt_size ?: '-') . '<br>
                                                <strong>Glove Size:</strong> ' . e($participant->glove_size ?: '-') . '
                                            </div>
                                        </div>
                                    ';
                                }

                                $html .= '</div>';

                                return new HtmlString($html);
                            })
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make('Payment Review')
                    ->description('Use this section to review uploaded transfer proof before approving the payment.')
                    ->schema([
                        TextEntry::make('payment_method')
                            ->label('Payment Method')
                            ->formatStateUsing(fn (?string $state): string => $state ? strtoupper(str_replace('_', ' ', $state)) : '-')
                            ->badge()
                            ->color('info'),

                        TextEntry::make('payment_proof_path')
                            ->label('Payment Proof')
                            ->formatStateUsing(fn (?string $state): string => $state ? 'View Uploaded Proof' : 'No proof uploaded')
                            ->url(fn (?string $state): ?string => $state ? Storage::disk('public')->url($state) : null)
                            ->openUrlInNewTab()
                            ->badge()
                            ->color(fn (?string $state): string => $state ? 'success' : 'gray'),

                        TextEntry::make('payment_submitted_at')
                            ->label('Proof Submitted At')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),

                        TextEntry::make('payment_notes')
                            ->label('Payment Notes')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Participant Documents')
                    ->description('Uploaded participant documents for admin review.')
                    ->schema([
                        TextEntry::make('documents_list')
                            ->label('Uploaded Documents')
                            ->state(function ($record): HtmlString {
                                $documents = $record->documents()->latest()->get();

                                if ($documents->isEmpty()) {
                                    return new HtmlString('<span style="color:#6b7280;">No documents uploaded yet.</span>');
                                }

                                $html = '<div style="display:grid; gap:12px;">';

                                foreach ($documents as $document) {
                                    $type = e(strtoupper(str_replace('_', ' ', $document->document_type)));
                                    $status = e(strtoupper(str_replace('_', ' ', $document->status)));
                                    $uploadedAt = $document->created_at ? $document->created_at->format('d M Y H:i') : '-';
                                    $url = e(Storage::disk('public')->url($document->file_path));
                                    $approveUrl = e(route('admin.registration-documents.approve', $document));
                                    $revisionUrl = e(route('admin.registration-documents.need-revision', $document));

                                    $statusStyle = match ($document->status) {
                                        'approved' => 'background:#ecfdf5;color:#15803d;border-color:#bbf7d0;',
                                        'need_revision', 'rejected' => 'background:#fef2f2;color:#b91c1c;border-color:#fecaca;',
                                        default => 'background:#fff7ed;color:#c2410c;border-color:#fed7aa;',
                                    };

                                    $html .= '
                                        <div style="border:1px solid #e5e7eb; border-radius:14px; padding:14px; background:#f9fafb;">
                                            <div style="display:flex; justify-content:space-between; gap:16px; align-items:flex-start; flex-wrap:wrap;">
                                                <div>
                                                    <div style="font-weight:800; color:#111827;">' . $type . '</div>
                                                    <div style="margin-top:6px;">
                                                        <span style="display:inline-flex;border:1px solid;padding:4px 8px;border-radius:999px;font-size:11px;font-weight:800;' . $statusStyle . '">' . $status . '</span>
                                                    </div>
                                                    <div style="margin-top:6px; color:#6b7280; font-size:13px;">
                                                        Uploaded: ' . e($uploadedAt) . '
                                                    </div>
                                                </div>

                                                <div style="display:flex; gap:8px; flex-wrap:wrap; justify-content:flex-end;">
                                                    <a
                                                        href="' . $url . '"
                                                        target="_blank"
                                                        style="display:inline-flex; align-items:center; justify-content:center; border-radius:999px; background:#1d6f99; color:white; padding:8px 14px; font-size:13px; font-weight:800; text-decoration:none;"
                                                    >
                                                        View File
                                                    </a>

                                                    <form method="POST" action="' . $approveUrl . '" style="margin:0;">
                                                        ' . csrf_field() . '
                                                        <button
                                                            type="submit"
                                                            style="border:0; display:inline-flex; align-items:center; justify-content:center; border-radius:999px; background:#15803d; color:white; padding:8px 14px; font-size:13px; font-weight:800; cursor:pointer;"
                                                        >
                                                            Approve
                                                        </button>
                                                    </form>

                                                    <form method="POST" action="' . $revisionUrl . '" style="margin:0;">
                                                        ' . csrf_field() . '
                                                        <button
                                                            type="submit"
                                                            style="border:0; display:inline-flex; align-items:center; justify-content:center; border-radius:999px; background:#c2410c; color:white; padding:8px 14px; font-size:13px; font-weight:800; cursor:pointer;"
                                                        >
                                                            Need Revision
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    ';
                                }

                                $html .= '</div>';

                                return new HtmlString($html);
                            })
                            ->html()
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make('Statuses')
                    ->schema([
                        TextEntry::make('payment_status')
                            ->label('Payment Status')
                            ->badge()
                            ->formatStateUsing(fn (?string $state): string => strtoupper(str_replace('_', ' ', (string) $state)))
                            ->color(fn (?string $state): string => match ($state) {
                                'paid' => 'success',
                                'pending', 'pending_review' => 'warning',
                                'unpaid' => 'danger',
                                'expired', 'failed', 'refunded' => 'danger',
                                default => 'gray',
                            }),

                        TextEntry::make('registration_status')
                            ->label('Registration Status')
                            ->badge()
                            ->formatStateUsing(fn (?string $state): string => strtoupper(str_replace('_', ' ', (string) $state)))
                            ->color(fn (?string $state): string => match ($state) {
                                'confirmed', 'completed', 'paid' => 'success',
                                'waiting_payment', 'pending' => 'warning',
                                'cancelled' => 'danger',
                                default => 'gray',
                            }),

                        TextEntry::make('document_status')
                            ->label('Document Status')
                            ->badge()
                            ->formatStateUsing(fn (?string $state): string => strtoupper(str_replace('_', ' ', (string) $state)))
                            ->color(fn (?string $state): string => match ($state) {
                                'approved' => 'success',
                                'pending_review' => 'warning',
                                'need_revision', 'rejected' => 'danger',
                                'not_required', 'not_submitted' => 'gray',
                                default => 'gray',
                            }),

                        TextEntry::make('paid_at')
                            ->label('Paid At')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),

                        TextEntry::make('confirmed_at')
                            ->label('Confirmed At')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),
                    ])
                    ->columns(2),
            ]);
    }
}
