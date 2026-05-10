<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $registration->registration_number }}</title>
    <style>
        body {
            margin: 0;
            background: #f6f9fb;
            color: #123047;
            font-family: Arial, sans-serif;
        }

        .page {
            max-width: 900px;
            margin: 32px auto;
            background: white;
            border-radius: 24px;
            padding: 44px;
            box-shadow: 0 20px 70px rgba(18, 58, 86, 0.10);
        }

        .top {
            display: flex;
            justify-content: space-between;
            gap: 24px;
            border-bottom: 2px solid #e7edf2;
            padding-bottom: 28px;
        }

        .brand {
            display: flex;
            gap: 14px;
            align-items: center;
        }

        .brand img {
            width: 54px;
            height: 54px;
            border-radius: 999px;
            object-fit: cover;
        }

        .brand h1 {
            margin: 0;
            color: #123a56;
            font-size: 26px;
        }

        .brand p,
        .meta p {
            margin: 4px 0 0;
            color: #738292;
            font-size: 13px;
        }

        .doc-title {
            text-align: right;
        }

        .doc-title h2 {
            margin: 0;
            color: #1d6f99;
            font-size: 34px;
            letter-spacing: -1px;
        }

        .section {
            margin-top: 28px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .box {
            border: 1px solid #e7edf2;
            border-radius: 18px;
            padding: 18px;
            background: #f8fbfd;
        }

        .label {
            margin: 0;
            color: #738292;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .value {
            margin: 8px 0 0;
            color: #123a56;
            font-size: 15px;
            font-weight: 800;
            line-height: 1.45;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        th {
            background: #123a56;
            color: white;
            text-align: left;
            padding: 14px;
            font-size: 13px;
        }

        td {
            border-bottom: 1px solid #e7edf2;
            padding: 14px;
            font-size: 14px;
        }

        .total {
            text-align: right;
            margin-top: 22px;
            font-size: 24px;
            color: #123a56;
            font-weight: 900;
        }

        .status {
            display: inline-block;
            border-radius: 999px;
            padding: 8px 12px;
            background: #fff7ed;
            color: #c2410c;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .footer {
            margin-top: 34px;
            border-top: 1px solid #e7edf2;
            padding-top: 18px;
            color: #738292;
            font-size: 13px;
            line-height: 1.7;
        }

        .print-button {
            position: fixed;
            right: 24px;
            bottom: 24px;
            border: 0;
            border-radius: 999px;
            background: #123a56;
            color: white;
            padding: 14px 20px;
            font-weight: 900;
            cursor: pointer;
        }

        @media print {
            body { background: white; }
            .page {
                margin: 0;
                max-width: none;
                box-shadow: none;
                border-radius: 0;
            }
            .print-button { display: none; }
        }
    </style>
</head>
<body>
    <button class="print-button" onclick="window.print()">Print / Save PDF</button>

    <main class="page">
        <section class="top">
            <div class="brand">
                <img src="https://reframingphysio.com/wp-content/uploads/2026/02/cropped-FAVICON.png" alt="Reframing Physio">
                <div>
                    <h1>Reframing Academy</h1>
                    <p>Reframing Physio</p>
                </div>
            </div>

            <div class="doc-title">
                <h2>Invoice</h2>
                <div class="meta">
                    <p>{{ $registration->registration_number }}</p>
                    <p>{{ now()->format('d M Y') }}</p>
                </div>
            </div>
        </section>

        <section class="section grid">
            <div class="box">
                <p class="label">Bill To</p>
                <p class="value">
                    {{ $registration->full_name }}<br>
                    {{ $registration->email }}<br>
                    {{ $registration->phone }}
                </p>
            </div>

            <div class="box">
                <p class="label">Payment Status</p>
                <p class="value">
                    <span class="status">{{ $payment->status }}</span>
                </p>
            </div>
        </section>

        <section class="section">
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Program</th>
                        <th>Batch</th>
                        <th style="text-align: right;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $registration->price->label }}</td>
                        <td>{{ $registration->program->name }}</td>
                        <td>{{ $registration->batch->title }}</td>
                        <td style="text-align: right;">Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="total">
                Total: Rp{{ number_format($payment->amount, 0, ',', '.') }}
            </div>
        </section>

        <section class="footer">
            Invoice ini dibuat otomatis oleh sistem Reframing Academy. Simpan dokumen ini sebagai informasi pembayaran program.
        </section>
    </main>
</body>
</html>
