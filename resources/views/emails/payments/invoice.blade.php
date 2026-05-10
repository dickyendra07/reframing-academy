<p>Halo {{ $registration->full_name }},</p>

<p>Berikut invoice pembayaran untuk program Reframing Academy:</p>

<ul>
    <li>Nomor Registrasi: <strong>{{ $registration->registration_number }}</strong></li>
    <li>Program: <strong>{{ $registration->program->name }}</strong></li>
    <li>Batch: <strong>{{ $registration->batch->title }}</strong></li>
    <li>Total: <strong>Rp{{ number_format($payment->amount, 0, ',', '.') }}</strong></li>
    <li>Status: <strong>{{ strtoupper($payment->status) }}</strong></li>
</ul>

<p>Silakan selesaikan pembayaran sesuai instruksi dari tim Reframing Academy.</p>

<p>Terima kasih,<br>Reframing Academy</p>
