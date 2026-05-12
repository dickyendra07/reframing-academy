<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicPaymentController;
use App\Http\Controllers\PublicProgramController;
use App\Http\Controllers\PublicRegistrationController;
use App\Models\Registration;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AdminRegistrationDocumentController;
use App\Http\Controllers\AdminPaymentDocumentController;
use App\Http\Controllers\ParticipantDocumentController;
use App\Http\Controllers\ParticipantLoaController;

Route::get('/', function () {
    return redirect()->route('public.programs.index');
});

Route::get('/programs', [PublicProgramController::class, 'index'])
    ->name('public.programs.index');

Route::get('/programs/{batch:slug}', [PublicProgramController::class, 'show'])
    ->name('public.programs.show');

Route::get('/register/{batch:slug}', [PublicRegistrationController::class, 'create'])
    ->name('public.registrations.create');

Route::post('/register/{batch:slug}', [PublicRegistrationController::class, 'store'])
    ->name('public.registrations.store');

Route::get('/registration-success/{registration:registration_number}', [PublicRegistrationController::class, 'success'])
    ->name('public.registrations.success');

Route::get('/payment/{registration:registration_number}', [PublicPaymentController::class, 'show'])
    ->name('public.payments.show');

Route::post('/payment/{registration:registration_number}/simulate-success', [PublicPaymentController::class, 'simulateSuccess'])
    ->name('public.payments.simulate-success');

Route::get('/dashboard', function () {
    if (auth()->user()?->role === 'admin') {
        return redirect('/admin');
    }

    $registrations = Registration::query()
        ->with(['program', 'batch', 'price', 'certificate', 'documents'])
        ->where('email', auth()->user()->email)
        ->latest()
        ->get();

    return view('dashboard', [
        'registrations' => $registrations,
    ]);
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::post('/payment/{registration:registration_number}/upload-proof', [PublicPaymentController::class, 'uploadProof'])->name('public.payments.upload-proof');

Route::get('/payment/{registration:registration_number}/success', [PublicPaymentController::class, 'success'])
    ->name('public.payments.success');

Route::post('/dashboard/registrations/{registration}/documents', [ParticipantDocumentController::class, 'store'])->middleware(['auth', 'verified'])->name('participant.documents.store');


Route::get('/dashboard/registrations/{registration}/loa', [ParticipantLoaController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('participant.loa.create');

Route::post('/dashboard/registrations/{registration}/loa', [ParticipantLoaController::class, 'download'])
    ->middleware(['auth', 'verified'])
    ->name('participant.loa.download');



Route::post('/admin/registration-documents/{document}/approve', [AdminRegistrationDocumentController::class, 'approve'])
    ->middleware(['auth'])
    ->name('admin.registration-documents.approve');

Route::post('/admin/registration-documents/{document}/need-revision', [AdminRegistrationDocumentController::class, 'needRevision'])
    ->middleware(['auth'])
    ->name('admin.registration-documents.need-revision');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/payments/{payment}/invoice', [AdminPaymentDocumentController::class, 'invoice'])
        ->name('admin.payments.invoice');

    Route::get('/admin/payments/{payment}/receipt', [AdminPaymentDocumentController::class, 'receipt'])
        ->name('admin.payments.receipt');

    Route::post('/admin/payments/{payment}/send-invoice', [AdminPaymentDocumentController::class, 'sendInvoice'])
        ->name('admin.payments.send-invoice');

    Route::post('/admin/payments/{payment}/send-receipt', [AdminPaymentDocumentController::class, 'sendReceipt'])
        ->name('admin.payments.send-receipt');
});

