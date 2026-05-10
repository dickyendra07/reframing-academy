@php
    $isInstallment = $registration->payment_type === 'installment';
    $dpAmount = $registration->dp_amount ?: (int) ceil($registration->total_amount * 0.5);
    $remainingAmount = max((int) $registration->total_amount - (int) $dpAmount, 0);
    $invoiceAmount = $isInstallment ? $dpAmount : $payment->amount;
    $dueDate = $registration->batch->start_date->copy()->subDays(30);
@endphp

<div style="margin:0; padding:0; background:#f4f8fb; font-family:Arial, Helvetica, sans-serif; color:#123047;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f4f8fb; padding:28px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="680" cellspacing="0" cellpadding="0" style="width:680px; max-width:680px; background:#ffffff; border-radius:24px; overflow:hidden; border:1px solid #e7edf2;">
                    <tr>
                        <td style="background:#123a56; padding:32px 36px;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>
                                        <div style="color:#d9edf6; font-size:11px; font-weight:800; letter-spacing:1.6px; text-transform:uppercase;">
                                            Reframing Physio
                                        </div>
                                        <div style="margin-top:6px; color:#ffffff; font-size:26px; font-weight:900;">
                                            Reframing Academy
                                        </div>
                                    </td>
                                    <td align="right">
                                        <div style="color:#ffffff; font-size:30px; font-weight:900; letter-spacing:-0.8px;">
                                            INVOICE
                                        </div>
                                        <div style="margin-top:6px; color:#c7dce7; font-size:13px; font-weight:700;">
                                            {{ $registration->registration_number }}
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:34px 36px;">
                            <p style="margin:0; color:#123047; font-size:18px; font-weight:800;">
                                Halo {{ $registration->full_name }},
                            </p>

                            <p style="margin:12px 0 0; color:#5f7283; font-size:14px; line-height:1.7;">
                                Berikut invoice pembayaran untuk program Reframing Academy. Silakan lakukan pembayaran sesuai nominal yang tertera dan konfirmasi melalui halaman pembayaran peserta.
                            </p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-top:24px;">
                                <tr>
                                    <td width="50%" style="padding-right:8px;">
                                        <div style="border:1px solid #e7edf2; background:#f8fbfd; border-radius:18px; padding:18px;">
                                            <div style="color:#738292; font-size:11px; font-weight:900; text-transform:uppercase; letter-spacing:0.8px;">Billed To</div>
                                            <div style="margin-top:8px; color:#123a56; font-size:14px; font-weight:800; line-height:1.55;">
                                                {{ $registration->full_name }}<br>
                                                {{ $registration->email }}<br>
                                                {{ $registration->phone }}
                                            </div>
                                        </div>
                                    </td>

                                    <td width="50%" style="padding-left:8px;">
                                        <div style="border:1px solid #e7edf2; background:#f8fbfd; border-radius:18px; padding:18px;">
                                            <div style="color:#738292; font-size:11px; font-weight:900; text-transform:uppercase; letter-spacing:0.8px;">Payment Detail</div>
                                            <div style="margin-top:8px; color:#123a56; font-size:14px; font-weight:800; line-height:1.55;">
                                                Method: {{ $isInstallment ? 'Installment' : 'Full Payment' }}<br>
                                                Status: {{ strtoupper(str_replace('_', ' ', $payment->status)) }}<br>
                                                Due: {{ $isInstallment ? $dueDate->format('d M Y') : 'Upon receipt' }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-top:24px; border-collapse:collapse; border:1px solid #e7edf2; border-radius:16px; overflow:hidden;">
                                <tr>
                                    <td style="background:#123a56; color:#ffffff; padding:13px 14px; font-size:12px; font-weight:900; text-transform:uppercase;">Program</td>
                                    <td style="background:#123a56; color:#ffffff; padding:13px 14px; font-size:12px; font-weight:900; text-transform:uppercase;">Batch</td>
                                    <td align="right" style="background:#123a56; color:#ffffff; padding:13px 14px; font-size:12px; font-weight:900; text-transform:uppercase;">Amount</td>
                                </tr>

                                <tr>
                                    <td style="padding:15px 14px; border-bottom:1px solid #e7edf2; color:#123047; font-size:14px; font-weight:800;">
                                        {{ $registration->program->name }}<br>
                                        <span style="color:#738292; font-size:12px; font-weight:700;">{{ $registration->price->label }}</span>
                                    </td>
                                    <td style="padding:15px 14px; border-bottom:1px solid #e7edf2; color:#123047; font-size:14px; font-weight:800;">
                                        {{ $registration->batch->title }}
                                    </td>
                                    <td align="right" style="padding:15px 14px; border-bottom:1px solid #e7edf2; color:#123047; font-size:14px; font-weight:900;">
                                        Rp{{ number_format($invoiceAmount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-top:20px;">
                                <tr>
                                    <td align="right">
                                        <table role="presentation" width="360" cellspacing="0" cellpadding="0" style="width:360px; border:1px solid #e7edf2; border-radius:16px; overflow:hidden;">
                                            <tr>
                                                <td style="padding:13px 15px; color:#738292; font-size:13px; font-weight:800;">Total Program Fee</td>
                                                <td align="right" style="padding:13px 15px; color:#123a56; font-size:13px; font-weight:900;">Rp{{ number_format($registration->total_amount, 0, ',', '.') }}</td>
                                            </tr>

                                            @if ($isInstallment)
                                                <tr>
                                                    <td style="padding:13px 15px; color:#738292; font-size:13px; font-weight:800; border-top:1px solid #e7edf2;">Down Payment</td>
                                                    <td align="right" style="padding:13px 15px; color:#123a56; font-size:13px; font-weight:900; border-top:1px solid #e7edf2;">Rp{{ number_format($dpAmount, 0, ',', '.') }}</td>
                                                </tr>

                                                <tr>
                                                    <td style="padding:13px 15px; color:#738292; font-size:13px; font-weight:800; border-top:1px solid #e7edf2;">Remaining Balance</td>
                                                    <td align="right" style="padding:13px 15px; color:#123a56; font-size:13px; font-weight:900; border-top:1px solid #e7edf2;">Rp{{ number_format($remainingAmount, 0, ',', '.') }}</td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <td style="padding:16px 15px; background:#f8fbfd; color:#123a56; font-size:16px; font-weight:900; border-top:1px solid #e7edf2;">Invoice Amount</td>
                                                <td align="right" style="padding:16px 15px; background:#f8fbfd; color:#123a56; font-size:16px; font-weight:900; border-top:1px solid #e7edf2;">Rp{{ number_format($invoiceAmount, 0, ',', '.') }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <div style="margin-top:24px; border:1px solid #d9edf6; background:#edf7fb; border-radius:18px; padding:18px; color:#31596f; font-size:13px; line-height:1.7;">
                                <strong>Catatan Pembayaran</strong><br>
                                Silakan selesaikan pembayaran sesuai instruksi dari tim Reframing Academy.
                                @if ($isInstallment)
                                    Sisa pembayaran wajib dilunasi paling lambat <strong>{{ $dueDate->format('d M Y') }}</strong>.
                                @endif
                            </div>

                            <p style="margin:26px 0 0; color:#5f7283; font-size:14px; line-height:1.7;">
                                Terima kasih,<br>
                                <strong style="color:#123a56;">Reframing Academy</strong>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:20px 36px; background:#f8fbfd; border-top:1px solid #e7edf2; color:#738292; font-size:12px; line-height:1.6;">
                            Email ini dikirim otomatis oleh sistem Reframing Academy. Simpan email dan lampiran invoice sebagai informasi pembayaran.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
