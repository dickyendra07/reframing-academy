<p>Halo {{ $registration->full_name }},</p>

<p>Pembayaran Anda sudah kami terima. Berikut detail e-receipt:</p>

<ul>
    <li>Nomor Registrasi: <strong>{{ $registration->registration_number }}</strong></li>
    <li>Program: <strong>{{ $registration->program->name }}</strong></li>
    <li>Batch: <strong>{{ $registration->batch->title }}</strong></li>
    <li>Jumlah Dibayar: <strong>Rp{{ number_format($payment->amount, 0, ',', '.') }}</strong></li>
    <li>Status: <strong>{{ strtoupper($payment->status) }}</strong></li>
    <li>Tanggal Bayar: <strong>{{ optional($payment->paid_at)->format('d M Y H:i') ?? '-' }}</strong></li>
</ul>

<p>Terima kasih,<br>Reframing Academy</p>
