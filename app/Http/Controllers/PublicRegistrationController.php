<?php

namespace App\Http\Controllers;

use App\Models\ProgramBatch;
use App\Models\ProgramPrice;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PublicRegistrationController extends Controller
{
    public function create(ProgramBatch $batch): View
    {
        $batch->load(['program', 'prices']);

        return view('public.registrations.create', [
            'batch' => $batch,
        ]);
    }

    public function store(Request $request, ProgramBatch $batch): RedirectResponse
    {
        $batch->load(['program', 'prices']);

        $validated = $request->validate([
            'program_price_id' => ['required', 'exists:program_prices,id'],

            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'province' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'institution' => ['nullable', 'string', 'max:255'],

            'profession' => ['nullable', 'string', 'max:255'],
            'education' => ['nullable', 'string', 'max:255'],
            'nik_number' => ['nullable', 'string', 'max:255'],
            'str_number' => ['nullable', 'string', 'max:255'],

            'alumni_number' => ['nullable', 'string', 'max:255'],
            'group_name' => ['nullable', 'string', 'max:255'],
            'shirt_size' => ['nullable', 'string', 'max:50'],
            'glove_size' => ['nullable', 'string', 'max:50'],

            'terms_accepted' => ['accepted'],
            'data_confirmation_accepted' => ['accepted'],
        ]);

        $price = ProgramPrice::query()
            ->where('id', $validated['program_price_id'])
            ->where('program_batch_id', $batch->id)
            ->where('status', 'active')
            ->firstOrFail();

        if ($price->requires_alumni_number && empty($validated['alumni_number'])) {
            return back()
                ->withErrors(['alumni_number' => 'Nomor alumni wajib diisi untuk kategori harga ini.'])
                ->withInput();
        }

        if ($price->requires_group_name && empty($validated['group_name'])) {
            return back()
                ->withErrors(['group_name' => 'Nama group wajib diisi untuk kategori harga ini.'])
                ->withInput();
        }

        if ($price->requires_profession && ($validated['profession'] ?? null) !== $price->requires_profession) {
            return back()
                ->withErrors(['profession' => 'Kategori harga ini hanya berlaku untuk profesi ' . $price->requires_profession . '.'])
                ->withInput();
        }

        $registrationNumber = $this->generateRegistrationNumber($batch);

        $registration = Registration::create([
            'registration_number' => $registrationNumber,

            'program_id' => $batch->program_id,
            'program_batch_id' => $batch->id,
            'program_price_id' => $price->id,

            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'province' => $validated['province'] ?? null,
            'city' => $validated['city'] ?? null,
            'institution' => $validated['institution'] ?? null,

            'profession' => $validated['profession'] ?? null,
            'education' => $validated['education'] ?? null,
            'nik_number' => $validated['nik_number'] ?? null,
            'str_number' => $validated['str_number'] ?? null,

            'alumni_number' => $validated['alumni_number'] ?? null,
            'group_name' => $validated['group_name'] ?? null,
            'shirt_size' => $validated['shirt_size'] ?? null,
            'glove_size' => $validated['glove_size'] ?? null,

            'base_price' => $price->amount,
            'discount_amount' => 0,
            'total_amount' => $price->amount,

            'payment_type' => 'full_payment',

            'registration_status' => 'waiting_payment',
            'payment_status' => 'unpaid',
            'document_status' => 'pending_review',

            'terms_accepted_at' => now(),
            'data_confirmation_accepted_at' => now(),
        ]);

        return redirect()
            ->route('public.registrations.success', $registration)
            ->with('success', 'Registrasi berhasil dibuat.');
    }

    public function success(Registration $registration): View
    {
        $registration->load(['program', 'batch', 'price']);

        return view('public.registrations.success', [
            'registration' => $registration,
        ]);
    }

    private function generateRegistrationNumber(ProgramBatch $batch): string
    {
        $prefix = 'RP-' . $batch->program->code . $batch->batch_number;

        $count = Registration::query()
            ->where('program_batch_id', $batch->id)
            ->count() + 1;

        return $prefix . '-' . str_pad((string) $count, 4, '0', STR_PAD_LEFT);
    }
}