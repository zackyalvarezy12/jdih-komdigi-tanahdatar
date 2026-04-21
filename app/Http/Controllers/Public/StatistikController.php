<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class StatistikController extends Controller
{
    public function index()
    {
        // Hitung jumlah data dari masing-masing tabel database dan susun untuk view statistik
        $stats = [
            [
                'label' => 'Perda',
                'icon' => 'bi-bank',
                'total' => DB::table('perdas')->count(),
            ],
            [
                'label' => 'Perbupati',
                'icon' => 'bi-file-earmark-text',
                'total' => DB::table('perbupatis')->count(),
            ],
            [
                'label' => 'Kajian Hukum',
                'icon' => 'bi-journal-text',
                'total' => DB::table('kajian_hukums')->count(),
            ],
            [
                'label' => 'propemda',
                'icon' => 'bi-people',
                'total' => DB::table('propemdas')->count(),
            ],
            [
                'label' => 'Keputusan Bupati',
                'icon' => 'bi-check2-square',
                'total' => DB::table('keputusan_bupatis')->count(),
            ],
            [
                'label' => 'Instruksi Bupati',
                'icon' => 'bi-megaphone',
                'total' => DB::table('instruksi_bupatis')->count(),
            ],
        ];

        $labels = array_column($stats, 'label');
        $counts = array_column($stats, 'total');

        $visitorSummary = [
            'total' => 0,
            'today' => 0,
            'month' => 0,
            'year' => 0,
        ];
        $visitorTrendLabels = [];
        $visitorTrendCounts = [];

        if (Schema::hasTable('page_views')) {
            $visitorSummary['total'] = DB::table('page_views')->count();
            $visitorSummary['today'] = DB::table('page_views')->whereDate('created_at', today())->count();
            $visitorSummary['month'] = DB::table('page_views')->whereYear('created_at', today()->year)->whereMonth('created_at', today()->month)->count();
            $visitorSummary['year'] = DB::table('page_views')->whereYear('created_at', today()->year)->count();

            $visitorTrend = DB::table('page_views')
                ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->where('created_at', '>=', now()->subDays(29)->startOfDay())
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            $visitorTrendLabels = $visitorTrend->map(fn ($row) => Carbon::parse($row->date)->format('d M'))->toArray();
            $visitorTrendCounts = $visitorTrend->pluck('count')->toArray();
        }

        $documentPeriods = [
            'today' => today(),
            'month' => today()->startOfMonth(),
            'year' => today()->startOfYear(),
        ];

        $newDocumentCounts = [
            'today' => 0,
            'month' => 0,
            'year' => 0,
        ];

        $documentTables = [
            'perdas',
            'perbupatis',
            'kajian_hukums',
            'berita',
            'keputusan_bupatis',
            'instruksi_bupatis',
        ];

        foreach ($documentTables as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            $newDocumentCounts['today'] += DB::table($table)->whereDate('created_at', $documentPeriods['today'])->count();
            $newDocumentCounts['month'] += DB::table($table)->where('created_at', '>=', $documentPeriods['month'])->count();
            $newDocumentCounts['year'] += DB::table($table)->where('created_at', '>=', $documentPeriods['year'])->count();
        }

        return view(
            'public.statistik',
            compact(
                'stats',
                'labels',
                'counts',
                'visitorSummary',
                'visitorTrendLabels',
                'visitorTrendCounts',
                'newDocumentCounts'
            )
        );
    }

    private function getIcon($table)
    {
        return match ($table) {
            'perdas' => 'bi-bank',
            'perbupatis' => 'bi-file-earmark-text',
            'kerja_samas' => 'bi-people',
            'keputusan_bupatis' => 'bi-check2-square',
            'instruksi_bupatis' => 'bi-megaphone',
            default => 'bi-folder',
        };
    }
}
