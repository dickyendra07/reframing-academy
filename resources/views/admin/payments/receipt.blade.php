<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Receipt {{ $registration->registration_number }}</title>

    <style>
        :root {
            --navy: #123a56;
            --blue: #1d6f99;
            --soft: #f8fbfd;
            --line: #e7edf2;
            --text: #123047;
            --muted: #738292;
            --green: #15803d;
            --green-soft: #ecfdf5;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #eef5f8;
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
        }

        .page {
            max-width: 960px;
            margin: 32px auto;
            background: white;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 24px 80px rgba(18, 58, 86, 0.14);
        }

        .header {
            padding: 38px 44px;
            background:
                radial-gradient(circle at top right, rgba(255, 255, 255, 0.16), transparent 34%),
                linear-gradient(135deg, #15803d, #123a56);
            color: white;
            display: table;
            width: 100%;
        }

        .brand,
        .receipt-heading {
            display: table-cell;
            vertical-align: top;
            width: 50%;
        }

        .brand-wrap {
            display: table;
        }

        .logo,
        .brand-text {
            display: table-cell;
            vertical-align: middle;
        }

        .logo img {
            width: 62px;
            height: 62px;
            border-radius: 999px;
            background: white;
            border: 1px solid rgba(255,255,255,0.25);
            object-fit: cover;
        }

        .brand-text {
            padding-left: 16px;
        }

        .brand-kicker {
            margin: 0;
            color: rgba(255,255,255,0.72);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.7px;
            text-transform: uppercase;
        }

        .brand-title {
            margin: 6px 0 0;
            color: white;
            font-size: 25px;
            font-weight: 900;
            line-height: 1;
        }

        .receipt-heading {
            text-align: right;
        }

        .receipt-heading h1 {
            margin: 0;
            color: white;
            font-size: 42px;
            line-height: 1;
            letter-spacing: -1.4px;
        }

        .receipt-heading p {
            margin: 8px 0 0;
            color: rgba(255,255,255,0.78);
            font-size: 13px;
            font-weight: 700;
        }

        .content {
            padding: 42px 44px 44px;
        }

        .paid-banner {
            margin-bottom: 28px;
            border-radius: 22px;
            background: var(--green-soft);
            border: 1px solid #bbf7d0;
            padding: 20px;
            color: var(--green);
        }

        .paid-banner strong {
            display: block;
            font-size: 18px;
            font-weight: 900;
        }

        .paid-banner span {
            display: block;
            margin-top: 6px;
            font-size: 13px;
            line-height: 1.6;
            color: #166534;
        }

        .top-grid {
            display: table;
            width: 100%;
            table-layout: fixed;
            margin-bottom: 28px;
        }

        .top-cell {
            display: table-cell;
            vertical-align: top;
            padding-right: 14px;
        }

        .top-cell:last-child {
            padding-right: 0;
            padding-left: 14px;
        }

        .box {
            border: 1px solid var(--line);
            border-radius: 20px;
            background: var(--soft);
            padding: 20px;
            min-height: 142px;
        }

        .label {
            margin: 0;
            color: var(--muted);
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .value {
            margin: 10px 0 0;
            color: var(--navy);
            font-size: 15px;
            font-weight: 800;
            line-height: 1.55;
        }

        .status {
            display: inline-block;
            margin-top: 10px;
            border-radius: 999px;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            border: 1px solid #bbf7d0;
            background: var(--green-soft);
            color: var(--green);
        }

        .section-title {
            margin: 30px 0 14px;
            color: var(--navy);
            font-size: 18px;
            font-weight: 900;
            letter-spacing: -0.3px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 18px;
        }

        th {
            background: var(--green);
            color: white;
            text-align: left;
            padding: 15px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.7px;
        }

        th:last-child,
        td:last-child {
            text-align: right;
        }

        td {
            border-bottom: 1px solid var(--line);
            padding: 16px 15px;
            font-size: 14px;
            color: var(--text);
            vertical-align: top;
        }

        tr:last-child td {
            border-bottom: 0;
        }

        .item-title {
            color: var(--navy);
            font-weight: 900;
        }

        .item-desc {
            margin-top: 5px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .summary {
            margin-top: 20px;
            margin-left: auto;
            width: 380px;
            border: 1px solid var(--line);
            border-radius: 20px;
            overflow: hidden;
            background: white;
        }

        .summary-row {
            display: table;
            width: 100%;
            border-bottom: 1px solid var(--line);
        }

        .summary-row:last-child {
            border-bottom: 0;
            background: var(--green-soft);
        }

        .summary-row span,
        .summary-row strong {
            display: table-cell;
            padding: 14px 16px;
            font-size: 14px;
        }

        .summary-row span {
            color: var(--muted);
            font-weight: 800;
        }

        .summary-row strong {
            color: var(--navy);
            text-align: right;
            font-weight: 900;
        }

        .summary-row.total span,
        .summary-row.total strong {
            font-size: 18px;
            color: var(--green);
        }

        .receipt-note {
            margin-top: 28px;
            border-radius: 20px;
            background: #edf7fb;
            border: 1px solid #d9edf6;
            padding: 20px;
            color: #31596f;
            font-size: 13px;
            line-height: 1.75;
        }

        .footer {
            margin-top: 34px;
            padding-top: 18px;
            border-top: 1px solid var(--line);
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
            display: table;
            width: 100%;
        }

        .footer-left,
        .footer-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .footer-right {
            text-align: right;
        }

        .print-button {
            position: fixed;
            right: 24px;
            bottom: 24px;
            border: 0;
            border-radius: 999px;
            background: var(--green);
            color: white;
            padding: 14px 20px;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 14px 34px rgba(21, 128, 61, 0.22);
        }

        @media print {
            body {
                background: white;
            }

            .page {
                margin: 0;
                max-width: none;
                border-radius: 0;
                box-shadow: none;
            }

            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    @php
        $isInstallment = $registration->payment_type === 'installment';
        $dpAmount = $registration->dp_amount ?: (int) ceil($registration->total_amount * 0.5);
        $remainingAmount = max((int) $registration->total_amount - (int) $dpAmount, 0);
        $paidAmount = $payment->amount;
        $paidAt = $payment->paid_at ? $payment->paid_at->format('d M Y H:i') : now()->format('d M Y H:i');
        $dueDate = $registration->batch->start_date->copy()->subDays(30);
    @endphp

    <button class="print-button" onclick="window.print()">Print / Save PDF</button>

    <main class="page">
        <section class="header">
            <div class="brand">
                <div class="brand-wrap">
                    <div class="logo">
                        <img src="https://reframingphysio.com/wp-content/uploads/2026/02/cropped-FAVICON.png" alt="Reframing Physio">
                    </div>

                    <div class="brand-text">
                        <p class="brand-kicker">Reframing Physio</p>
                        <p class="brand-title">Reframing Academy</p>
                    </div>
                </div>
            </div>

            <div class="receipt-heading">
                <h1>E-RECEIPT</h1>
                <p>{{ $registration->registration_number }}</p>
                <p>Paid {{ $paidAt }}</p>
            </div>
        </section>

        <section class="content">
            <div class="paid-banner">
                <strong>Payment Received</strong>
                <span>
                    Pembayaran peserta telah diterima oleh Reframing Academy.
                    E-receipt ini dapat digunakan sebagai bukti pembayaran resmi.
                </span>
            </div>

            <div class="top-grid">
                <div class="top-cell">
                    <div class="box">
                        <p class="label">Received From</p>
                        <p class="value">
                            {{ $registration->full_name }}<br>
                            {{ $registration->email }}<br>
                            {{ $registration->phone }}
                        </p>
                    </div>
                </div>

                <div class="top-cell">
                    <div class="box">
                        <p class="label">Receipt Detail</p>
                        <p class="value">
                            Receipt No: {{ $registration->registration_number }}<br>
                            Payment Method: {{ $isInstallment ? 'Installment' : 'Full Payment' }}<br>
                            Paid At: {{ $paidAt }}
                        </p>
                        <span class="status">{{ strtoupper(str_replace('_', ' ', $payment->status)) }}</span>
                    </div>
                </div>
            </div>

            <h2 class="section-title">Payment Detail</h2>

            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Program</th>
                        <th>Batch</th>
                        <th>Paid Amount</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <div class="item-title">{{ $registration->price->label }}</div>
                            <div class="item-desc">
                                {{ $isInstallment ? 'Down payment received for program registration.' : 'Full payment received for program registration.' }}
                            </div>
                        </td>
                        <td>{{ $registration->program->name }}</td>
                        <td>
                            {{ $registration->batch->title }}<br>
                            <span style="color:#738292; font-size:12px;">
                                {{ $registration->batch->start_date->format('d M Y') }} - {{ $registration->batch->end_date->format('d M Y') }}
                            </span>
                        </td>
                        <td>Rp{{ number_format($paidAmount, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="summary">
                <div class="summary-row">
                    <span>Total Program Fee</span>
                    <strong>Rp{{ number_format($registration->total_amount, 0, ',', '.') }}</strong>
                </div>

                @if ($isInstallment)
                    <div class="summary-row">
                        <span>Down Payment</span>
                        <strong>Rp{{ number_format($dpAmount, 0, ',', '.') }}</strong>
                    </div>

                    <div class="summary-row">
                        <span>Remaining Balance</span>
                        <strong>Rp{{ number_format($remainingAmount, 0, ',', '.') }}</strong>
                    </div>
                @endif

                <div class="summary-row total">
                    <span>Paid Amount</span>
                    <strong>Rp{{ number_format($paidAmount, 0, ',', '.') }}</strong>
                </div>
            </div>

            <div class="receipt-note">
                <strong>Receipt Note</strong><br>
                E-receipt ini diterbitkan sebagai bukti bahwa pembayaran telah diterima oleh Reframing Academy.
                @if ($isInstallment && $remainingAmount > 0)
                    Sisa pembayaran sebesar <strong>Rp{{ number_format($remainingAmount, 0, ',', '.') }}</strong>
                    wajib dilunasi paling lambat <strong>{{ $dueDate->format('d M Y') }}</strong>.
                @endif
            </div>

            <section class="footer">
                <div class="footer-left">
                    E-receipt ini diterbitkan secara otomatis oleh sistem Reframing Academy.
                    Simpan dokumen ini sebagai bukti pembayaran program.
                </div>

                <div class="footer-right">
                    Reframing Academy<br>
                    PT Elevasi Reframing Indonesia
                </div>
            </section>
        </section>
    </main>
</body>
</html>
