<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\RegistrationDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ParticipantDocumentController extends Controller
{
    public function store(Request $request, Registration $registration): RedirectResponse
    {
        abort_unless(Auth::check(), 403);

        abort_unless(
            strtolower($registration->email) === strtolower(Auth::user()->email),
            403
        );

        $validated = $request->validate([
            'document_type' => ['required', 'string', 'max:100'],
            'document_file' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ]);

        $existingDocument = RegistrationDocument::query()
            ->where('registration_id', $registration->id)
            ->where('document_type', $validated['document_type'])
            ->first();

        $path = $request->file('document_file')->store('registration-documents', 'public');

        if ($existingDocument) {
            if ($existingDocument->file_path && Storage::disk('public')->exists($existingDocument->file_path)) {
                Storage::disk('public')->delete($existingDocument->file_path);
            }

            $existingDocument->forceFill([
                'file_path' => $path,
                'status' => 'pending_review',
                'admin_note' => null,
            ])->save();
        } else {
            RegistrationDocument::create([
                'registration_id' => $registration->id,
                'document_type' => $validated['document_type'],
                'file_path' => $path,
                'status' => 'pending_review',
                'admin_note' => null,
            ]);
        }

        $registration->forceFill([
            'document_status' => 'pending_review',
        ])->save();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Document uploaded successfully. Our admin team will review it shortly.');
    }
}
