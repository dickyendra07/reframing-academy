<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>LOA {{ $registration->registration_number }}</title>

    <style>
        @page {
            margin: 38px 44px;
        }

        body {
            margin: 0;
            color: #111827;
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12.5px;
            line-height: 1.65;
        }

        .header {
            border-bottom: 3px solid #123a56;
            padding-bottom: 16px;
            margin-bottom: 28px;
        }

        .brand {
            display: table;
            width: 100%;
        }

        .brand-left,
        .brand-right {
            display: table-cell;
            vertical-align: middle;
        }

        .brand-left {
            width: 72%;
        }

        .brand-right {
            width: 28%;
            text-align: right;
            color: #6b7280;
            font-size: 10px;
            line-height: 1.45;
        }

        .company {
            color: #123a56;
            font-size: 22px;
            font-weight: bold;
            margin: 0;
        }

        .subtitle {
            margin: 4px 0 0;
            color: #1d6f99;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .meta {
            margin-bottom: 22px;
        }

        .meta-row {
            display: table;
            width: 100%;
            margin-bottom: 4px;
        }

        .meta-label,
        .meta-value {
            display: table-cell;
            vertical-align: top;
        }

        .meta-label {
            width: 90px;
        }

        .meta-separator {
            display: table-cell;
            width: 12px;
        }

        .title {
            text-align: center;
            margin: 28px 0 22px;
        }

        .title h1 {
            display: inline-block;
            margin: 0;
            padding-bottom: 4px;
            border-bottom: 1px solid #111827;
            font-size: 16px;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }

        .recipient {
            margin-bottom: 20px;
        }

        .paragraph {
            margin: 0 0 13px;
            text-align: justify;
        }

        .participant-box {
            margin: 18px 0;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 14px 16px;
            background: #f9fafb;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table td {
            vertical-align: top;
            padding: 4px 0;
        }

        .data-label {
            width: 150px;
            color: #4b5563;
        }

        .data-separator {
            width: 12px;
        }

        .program-box {
            margin: 18px 0;
            border-left: 4px solid #1d6f99;
            padding: 12px 16px;
            background: #edf7fb;
        }

        .program-box strong {
            color: #123a56;
        }

        .signature {
            margin-top: 42px;
            width: 100%;
            display: table;
        }

        .signature-left,
        .signature-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .signature-right {
            text-align: left;
            padding-left: 70px;
        }

        .signature-space {
            height: 78px;
        }

        .footer {
            position: fixed;
            left: 0;
            right: 0;
            bottom: -18px;
            border-top: 1px solid #e5e7eb;
            padding-top: 8px;
            color: #6b7280;
            font-size: 9.5px;
            line-height: 1.45;
        }

        .watermark {
            position: fixed;
            top: 44%;
            left: 8%;
            right: 8%;
            text-align: center;
            color: rgba(18, 58, 86, 0.05);
            font-size: 58px;
            font-weight: bold;
            transform: rotate(-18deg);
            z-index: -1;
        }
    </style>
</head>
<body>
    @php
        $signaturePath = public_path('images/loa/signature.png');
        $signatureImage = null;

        if (file_exists($signaturePath)) {
            $signatureImage = 'data:image/png;base64,' . base64_encode(file_get_contents($signaturePath));
        }

        $letterCity = $data['letter_city'] ?: ($registration->city ?: 'Jakarta');
        $recipientName = $data['recipient_name'] ?: 'Bapak/Ibu Pimpinan';
        $recipientPosition = $data['recipient_position'] ?: 'HRD / Pimpinan Instansi';
        $leaveStart = \Carbon\Carbon::parse($data['leave_start_date'])->translatedFormat('d F Y');
        $leaveEnd = \Carbon\Carbon::parse($data['leave_end_date'])->translatedFormat('d F Y');
        $eventStart = $registration->batch->start_date->translatedFormat('d F Y');
        $eventEnd = $registration->batch->end_date->translatedFormat('d F Y');
    @endphp

    <div class="watermark">REFRAMING ACADEMY</div>

    <header class="header">
        <div class="brand">
            <div class="brand-left">
                <p class="company">Reframing Academy</p>
                <p class="subtitle">PT Elevasi Reframing Indonesia</p>
            </div>

            <div class="brand-right">
                Letter generated by system<br>
                {{ now()->format('d M Y H:i') }}<br>
                {{ $registration->registration_number }}
            </div>
        </div>
    </header>

    <section class="meta">
        <div class="meta-row">
            <div class="meta-label">Nomor</div>
            <div class="meta-separator">:</div>
            <div class="meta-value">LOA/{{ $registration->registration_number }}/{{ now()->format('Y') }}</div>
        </div>
        <div class="meta-row">
            <div class="meta-label">Lampiran</div>
            <div class="meta-separator">:</div>
            <div class="meta-value">-</div>
        </div>
        <div class="meta-row">
            <div class="meta-label">Perihal</div>
            <div class="meta-separator">:</div>
            <div class="meta-value">Permohonan Izin Mengikuti Program Pelatihan</div>
        </div>
    </section>

    <section class="recipient">
        Kepada Yth.<br>
        {{ $recipientName }}<br>
        {{ $recipientPosition }}<br>
        {{ $data['company_name'] }}<br>
        di tempat
    </section>

    <section class="title">
        <h1>Letter of Assignment</h1>
    </section>

    <p class="paragraph">
        Dengan hormat,
    </p>

    <p class="paragraph">
        Bersama surat ini, kami dari Reframing Academy menerangkan bahwa peserta berikut telah terdaftar dan pembayaran program telah dikonfirmasi untuk mengikuti kegiatan pelatihan/sertifikasi yang diselenggarakan oleh Reframing Academy.
    </p>

    <section class="participant-box">
        <table class="data-table">
            <tr>
                <td class="data-label">Nama Peserta</td>
                <td class="data-separator">:</td>
                <td><strong>{{ $registration->full_name }}</strong></td>
            </tr>
            <tr>
                <td class="data-label">Nomor Registrasi</td>
                <td class="data-separator">:</td>
                <td>{{ $registration->registration_number }}</td>
            </tr>
            <tr>
                <td class="data-label">Profesi</td>
                <td class="data-separator">:</td>
                <td>{{ $registration->profession ?: '-' }}</td>
            </tr>
            <tr>
                <td class="data-label">Instansi</td>
                <td class="data-separator">:</td>
                <td>{{ $data['company_name'] }}</td>
            </tr>
        </table>
    </section>

    <section class="program-box">
        <strong>Program:</strong> {{ $registration->program->name }}<br>
        <strong>Batch:</strong> {{ $registration->batch->title }}<br>
        <strong>Tanggal Kegiatan:</strong> {{ $eventStart }} - {{ $eventEnd }}<br>
        <strong>Lokasi:</strong> {{ $registration->batch->location }}
    </section>

    <p class="paragraph">
        Sehubungan dengan kegiatan tersebut, peserta mengajukan izin untuk tidak bertugas / meninggalkan aktivitas kerja pada tanggal <strong>{{ $leaveStart }}</strong> sampai dengan <strong>{{ $leaveEnd }}</strong> guna mengikuti rangkaian kegiatan pelatihan.
    </p>

    @if (! empty($data['notes']))
        <p class="paragraph">
            Catatan tambahan: {{ $data['notes'] }}
        </p>
    @endif

    <p class="paragraph">
        Demikian surat ini dibuat untuk dapat digunakan sebagaimana mestinya. Atas perhatian dan kerja samanya, kami ucapkan terima kasih.
    </p>

    <section class="signature">
        <div class="signature-left"></div>

        <div class="signature-right">
            {{ $letterCity }}, {{ now()->translatedFormat('d F Y') }}<br>
            Hormat kami,<br>

            @if ($signatureImage)
                <img src="{{ $signatureImage }}" width="170" style="width:170px; height:auto; display:block; margin:8px 0 2px;" alt="Signature">
            @else
                <div style="height: 100px;"></div>
            @endif

            <strong>Ftr. Egy Haryati, S.Ftr., CDNP</strong><br>
            PT. Elevasi Reframing Indonesia
        </div>
    </section>

    <footer class="footer">
        Dokumen ini dibuat otomatis oleh sistem Reframing Academy dan hanya berlaku untuk peserta dengan status pembayaran PAID.
        Verifikasi dapat dilakukan menggunakan nomor registrasi: {{ $registration->registration_number }}.
    </footer>
</body>
</html>
