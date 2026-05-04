<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use App\Models\Program;
use App\Models\ProgramBatch;
use App\Models\Registration;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverview extends StatsOverviewWidget
{
    protected ?string $heading = 'Reframing Academy Overview';

    protected function getStats(): array
    {
        $totalPrograms = Program::query()->count();

        $activeBatches = ProgramBatch::query()
            ->where('status', 'published')
            ->count();

        $totalRegistrations = Registration::query()->count();

        $paidRegistrations = Registration::query()
            ->where('payment_status', 'paid')
            ->count();

        $pendingPayments = Registration::query()
            ->whereIn('payment_status', ['unpaid', 'pending', 'pending_review'])
            ->count();

        $pendingDocuments = Registration::query()
            ->whereIn('document_status', ['pending_review', 'need_revision', 'rejected'])
            ->count();

        $totalRevenue = Payment::query()
            ->where('status', 'paid')
            ->sum('amount');

        return [
            Stat::make('Total Programs', $totalPrograms)
                ->description('Program master data')
                ->color('primary'),

            Stat::make('Active Batches', $activeBatches)
                ->description('Published certification batches')
                ->color('info'),

            Stat::make('Total Registrations', $totalRegistrations)
                ->description('All submitted registrations')
                ->color('gray'),

            Stat::make('Paid Registrations', $paidRegistrations)
                ->description('Registrations with paid status')
                ->color('success'),

            Stat::make('Pending Payments', $pendingPayments)
                ->description('Need payment follow-up')
                ->color($pendingPayments > 0 ? 'warning' : 'success'),

            Stat::make('Pending Documents', $pendingDocuments)
                ->description('Need document review')
                ->color($pendingDocuments > 0 ? 'warning' : 'success'),

            Stat::make('Total Paid Revenue', 'Rp' . number_format($totalRevenue, 0, ',', '.'))
                ->description('From paid payment records')
                ->color('success'),
        ];
    }
}