<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AdminPaymentDocumentController extends Controller
{
    public function invoice(Payment $payment): View
    {
        $payment->load(['registration.program', 'registration.batch', 'registration.price']);

        return view('admin.payments.invoice', [
            'payment' => $payment,
            'registration' => $payment->registration,
            'isPdf' => false,
        ]);
    }

    public function receipt(Payment $payment): View
    {
        $payment->load(['registration.program', 'registration.batch', 'registration.price']);

        return view('admin.payments.receipt', [
            'payment' => $payment,
            'registration' => $payment->registration,
            'isPdf' => false,
        ]);
    }

    public function sendInvoice(Payment $payment): RedirectResponse
    {
        $payment->load(['registration.program', 'registration.batch', 'registration.price']);

        $registration = $payment->registration;

        $pdf = Pdf::loadView('admin.payments.invoice', [
            'payment' => $payment,
            'registration' => $registration,
            'isPdf' => true,
        ])->setPaper('a4');

        Mail::send('emails.payments.invoice', [
            'payment' => $payment,
            'registration' => $registration,
        ], function ($message) use ($payment, $registration, $pdf) {
            $message
                ->to($registration->email, $registration->full_name)
                ->subject('Invoice Reframing Academy - ' . $registration->registration_number)
                ->attachData(
                    $pdf->output(),
                    'Invoice-' . $registration->registration_number . '.pdf',
                    ['mime' => 'application/pdf']
                );
        });

        return back()->with('success', 'Invoice berhasil dikirim ke email peserta dengan lampiran PDF.');
    }

    public function sendReceipt(Payment $payment): RedirectResponse
    {
        $payment->load(['registration.program', 'registration.batch', 'registration.price']);

        $registration = $payment->registration;

        $pdf = Pdf::loadView('admin.payments.receipt', [
            'payment' => $payment,
            'registration' => $registration,
            'isPdf' => true,
        ])->setPaper('a4');

        Mail::send('emails.payments.receipt', [
            'payment' => $payment,
            'registration' => $registration,
        ], function ($message) use ($payment, $registration, $pdf) {
            $message
                ->to($registration->email, $registration->full_name)
                ->subject('E-Receipt Reframing Academy - ' . $registration->registration_number)
                ->attachData(
                    $pdf->output(),
                    'E-Receipt-' . $registration->registration_number . '.pdf',
                    ['mime' => 'application/pdf']
                );
        });

        return back()->with('success', 'E-receipt berhasil dikirim ke email peserta dengan lampiran PDF.');
    }
}
