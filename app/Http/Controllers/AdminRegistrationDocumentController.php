<?php

namespace App\Http\Controllers;

use App\Models\RegistrationDocument;
use Illuminate\Http\RedirectResponse;

class AdminRegistrationDocumentController extends Controller
{
    public function approve(RegistrationDocument $document): RedirectResponse
    {
        $document->forceFill([
            'status' => 'approved',
            'admin_note' => 'Approved by admin.',
        ])->save();

        $registration = $document->registration;

        $hasPendingOrRevisionDocuments = $registration->documents()
            ->whereIn('status', ['pending_review', 'need_revision', 'rejected'])
            ->exists();

        if (! $hasPendingOrRevisionDocuments) {
            $registration->forceFill([
                'document_status' => 'approved',
            ])->save();
        } else {
            $registration->forceFill([
                'document_status' => 'pending_review',
            ])->save();
        }

        return back()->with('success', 'Document approved successfully.');
    }

    public function needRevision(RegistrationDocument $document): RedirectResponse
    {
        $document->forceFill([
            'status' => 'need_revision',
            'admin_note' => 'Document needs revision.',
        ])->save();

        $document->registration->forceFill([
            'document_status' => 'need_revision',
        ])->save();

        return back()->with('success', 'Document marked as need revision.');
    }
}
