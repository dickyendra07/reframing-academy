<?php

namespace App\Http\Controllers;

use App\Models\ProgramBatch;
use Illuminate\View\View;

class PublicProgramController extends Controller
{
    public function index(): View
    {
        $batches = ProgramBatch::query()
            ->with(['program', 'prices'])
            ->where('status', 'published')
            ->orderBy('start_date')
            ->get();

        return view('public.programs.index', [
            'batches' => $batches,
        ]);
    }

    public function show(ProgramBatch $batch): View
    {
        $batch->load(['program', 'prices']);

        return view('public.programs.show', [
            'batch' => $batch,
        ]);
    }
}