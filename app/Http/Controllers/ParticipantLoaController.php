<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ParticipantLoaController extends Controller
{
    private function authorizeRegistration(Registration $registration): void
    {
        abort_unless(Auth::check(), 403);

        abort_unless(
            strtolower($registration->email) === strtolower(Auth::user()->email),
            403
        );

        abort_unless($registration->payment_status === 'paid', 403);
    }

    public function create(Registration $registration): View
    {
        $this->authorizeRegistration($registration);

        $registration->load(['program', 'batch', 'price']);

        return view('public.loa.create', [
            'registration' => $registration,
        ]);
    }

    public function download(Request $request, Registration $registration): Response
    {
        $this->authorizeRegistration($registration);

        $registration->load(['program', 'batch', 'price']);

        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'recipient_name' => ['nullable', 'string', 'max:255'],
            'recipient_position' => ['nullable', 'string', 'max:255'],
            'leave_start_date' => ['required', 'date'],
            'leave_end_date' => ['required', 'date', 'after_or_equal:leave_start_date'],
            'letter_city' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $pdf = Pdf::loadView('public.loa.pdf', [
            'registration' => $registration,
            'data' => $validated,
        ])->setPaper('a4', 'portrait');

        $filename = 'LOA-Reframing-' . $registration->registration_number . '.pdf';

        return $pdf->download($filename);
    }
}
