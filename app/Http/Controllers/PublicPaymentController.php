<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicPaymentController extends Controller
{
    public function show(Registration $registration): View
    {
        $registration->load(['program', 'batch', 'price']);

        return view('public.payments.show', [
            'registration' => $registration,
        ]);
    }

    public function success(Registration $registration): View
    {
        $registration->load(['program', 'batch', 'price']);

        return view('public.payments.success', [
            'registration' => $registration,
        ]);
    }

    public function uploadProof(Request $request, Registration $registration): RedirectResponse
    {
        $validated = $request->validate([
            'payment_method' => ['required', 'string', 'max:100'],
            'payment_proof' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'payment_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $path = $request->file('payment_proof')->store('payment-proofs', 'public');

        $registration->forceFill([
            'payment_method' => $validated['payment_method'],
            'payment_proof_path' => $path,
            'payment_submitted_at' => now(),
            'payment_notes' => $validated['payment_notes'] ?? null,
            'payment_status' => 'pending_review',
            'registration_status' => 'pending',
        ])->save();

        Payment::updateOrCreate(
            [
                'registration_id' => $registration->id,
            ],
            [
                'amount' => $registration->total_amount,
                'method' => $validated['payment_method'],
                'status' => 'pending_review',
                'paid_at' => null,
                'notes' => $validated['payment_notes'] ?? null,
            ]
        );

        return redirect()
            ->route('public.payments.success', $registration->registration_number)
            ->with('success', 'Payment confirmation submitted successfully.');
    }

    public function simulate(Registration $registration): RedirectResponse
    {
        $registration->forceFill([
            'payment_status' => 'paid',
            'registration_status' => 'confirmed',
        ])->save();

        Payment::updateOrCreate(
            [
                'registration_id' => $registration->id,
            ],
            [
                'amount' => $registration->total_amount,
                'method' => $registration->payment_method ?? 'simulation',
                'status' => 'paid',
                'paid_at' => now(),
                'notes' => 'Payment simulated locally.',
            ]
        );

        return redirect()
            ->route('public.payments.show', $registration->registration_number)
            ->with('success', 'Payment has been simulated successfully.');
    }
}
