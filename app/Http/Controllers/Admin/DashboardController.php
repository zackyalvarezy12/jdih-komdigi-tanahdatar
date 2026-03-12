<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Buku;
use App\Models\Infografis;
use App\Models\Kontak;
use App\Models\Activity;
use App\Models\User;
use App\Models\Perda;
use App\Models\Perbupati;
use App\Models\NaskahAkademik;
use App\Models\RancanganPuu;
use App\Models\RisalahHukum;
use App\Models\KajianHukum;
use App\Models\PeraturanTerjemah;
use App\Models\AnalisisEvaluasi;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'countBerita'     => \App\Models\Berita::count(),
            'countInfografis' => \App\Models\Infografis::count(),
            'countKontak'     => \App\Models\Kontak::count(),
            'countAdmin'      => \App\Models\User::count(),
            'countPerda'      => \App\Models\Perda::count(),
            'countPerbupati'  => \App\Models\Perbupati::count(),
            'countNaskah'     => \App\Models\NaskahAkademik::count(),
            'countRancangan'  => \App\Models\RancanganPuu::count(),
            'countRisalah'    => \App\Models\RisalahHukum::count(),
            'countKajian'     => \App\Models\KajianHukum::count(),
            'countTerjemah'   => \App\Models\PeraturanTerjemah::count(),
            'countAnalisis'   => \App\Models\AnalisisEvaluasi::count(),
            'activities'      => \App\Models\Activity::with('user')->latest()->take(10)->get()
        ];

        return view('dashboard', $data);
    }
}