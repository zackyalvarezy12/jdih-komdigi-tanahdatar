<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perda;
use App\Models\Perbupati;
use App\Models\KeputusanBupati;
use App\Models\InstruksiBupati;
use App\Models\Propemda;
use App\Models\KerjaSama;
use App\Models\PeraturanTerjemah;
use App\Models\RancanganPuu;
use App\Models\KajianHukum;
use App\Models\NaskahAkademik;
use App\Models\AnalisisEvaluasi;
use App\Models\RisalahHukum;
use App\Models\Relaas;
use App\Models\Artikel;
use App\Models\Infografis;
use App\Models\Buku;
use App\Models\Berita;

class HomeController extends Controller
{
    // =========================================================================
    // HOMEPAGE
    // =========================================================================
    public function index()
    {
        return view('public.home', [
            'stats' => [
                'perda'     => Perda::where('status', 'BERLAKU')->count(),
                'perbupati' => Perbupati::count(),
                'kajian'    => KajianHukum::count(),
                'berita'    => Berita::where('tampilkan', 'Ya')->count(),
            ],
            'perda'             => Perda::where('status', 'BERLAKU')->latest()->limit(6)->get(),
            'perbupati'         => Perbupati::latest()->limit(6)->get(),
            'keputusanBupati'   => KeputusanBupati::latest()->limit(6)->get(),
            'instruksiBupati'   => InstruksiBupati::latest()->limit(6)->get(),
            'propemda'          => Propemda::latest()->limit(6)->get(),
            'kerjaSama'         => KerjaSama::latest()->limit(6)->get(),
            'peraturanTerjemah' => PeraturanTerjemah::latest()->limit(6)->get(),
            'rancanganPuu'      => RancanganPuu::latest()->limit(6)->get(),
            'kajianHukum'           => KajianHukum::latest()->limit(6)->get(),
            'kajianHukumTotal'      => KajianHukum::count(),
            'naskahAkademik'        => NaskahAkademik::latest()->limit(6)->get(),
            'naskahAkademikTotal'   => NaskahAkademik::count(),
            'analisisEvaluasi'      => AnalisisEvaluasi::latest()->limit(6)->get(),
            'analisisEvaluasiTotal' => AnalisisEvaluasi::count(),
            'risalahHukum'          => RisalahHukum::latest()->limit(6)->get(),
            'risalahHukumTotal'     => RisalahHukum::count(),
            'relaas'                => Relaas::latest()->limit(6)->get(),
            'relaasTotal'           => Relaas::count(),
            'artikel'    => Artikel::latest()->limit(6)->get(),
            'infografis' => Infografis::latest()->limit(8)->get(),
            'buku'       => Buku::latest()->limit(6)->get(),
            'berita'     => Berita::where('tampilkan', 'Ya')->latest()->limit(6)->get(),
        ]);
    }

    // =========================================================================
    // HALAMAN DAFTAR — route: GET /daftar/{kategori}
    // =========================================================================
    public function list(Request $request, string $kategori)
    {
        $cfg = $this->config($kategori);

        if (!$cfg) {
            abort(404);
        }

        $q     = $request->input('q');
        $tahun = $request->input('tahun');

        $query = $cfg['model']::query();

        // Filter status (publish / tampilkan)
        if (isset($cfg['status'])) {
            $query->where($cfg['status']['col'], $cfg['status']['val']);
        }

        // Filter pencarian — dibungkus where() agar tidak bentrok dengan filter status
        if ($q && isset($cfg['search'])) {
            $cols = (array) $cfg['search'];
            $query->where(function ($qb) use ($cols, $q) {
                foreach ($cols as $i => $col) {
                    $i === 0
                        ? $qb->where($col, 'like', "%{$q}%")
                        : $qb->orWhere($col, 'like', "%{$q}%");
                }
            });
        }

        // Filter tahun
        if ($tahun && isset($cfg['tahunCol'])) {
            $query->where($cfg['tahunCol'], $tahun);
        }

        $items = $query->latest()->paginate(12)->withQueryString();

        // Kirim HANYA variabel yang dibutuhkan view — jangan array_merge $cfg
        // karena $cfg juga berisi 'model', 'status', dsb yang tidak diperlukan view
        return view('public.list', [
            'items'      => $items,
            'typeKey'    => $kategori,
            'title'      => $cfg['title'],
            'icon'       => $cfg['icon'],
            'badgeClass' => $cfg['badgeClass'],
            'badgeLabel' => $cfg['badgeLabel'],
            'group'      => $cfg['group'] ?? null,
            'withTahun'  => isset($cfg['tahunCol']),
        ]);
    }

    // =========================================================================
    // CONFIG TIAP KATEGORI
    // =========================================================================
    private function config(string $key): ?array
    {
        $map = [
            'perda' => [
                'title'      => 'Peraturan Daerah',
                'model'      => Perda::class,
                'icon'       => 'bi-file-earmark-ruled',
                'badgeClass' => 'bc-perda',
                'badgeLabel' => 'Perda',
                'status'     => ['col' => 'status', 'val' => 'BERLAKU'],
                'tahunCol'   => 'tahun',
                'search'     => 'judul',
                'group'      => 'Regulasi',
            ],
            'perbupati' => [
                'title'      => 'Peraturan Bupati',
                'model'      => Perbupati::class,
                'icon'       => 'bi-file-earmark-check',
                'badgeClass' => 'bc-perbupati',
                'badgeLabel' => 'Perbupati',
                // tidak ada kolom status di tabel perbupatis
                'tahunCol'   => 'tahun',
                'search'     => 'judul',
                'group'      => 'Regulasi',
            ],
            'kepbupati' => [
                'title'      => 'Keputusan Bupati',
                'model'      => KeputusanBupati::class,
                'icon'       => 'bi-file-earmark-lock',
                'badgeClass' => 'bc-kepbupati',
                'badgeLabel' => 'SK Bupati',
                // tidak ada kolom status di tabel keputusan_bupatis
                'tahunCol'   => 'tahun',
                'search'     => 'judul',
                'group'      => 'Regulasi',
            ],
            'insbupati' => [
                'title'      => 'Instruksi Bupati',
                'model'      => InstruksiBupati::class,
                'icon'       => 'bi-file-earmark-arrow-down',
                'badgeClass' => 'bc-insbupati',
                'badgeLabel' => 'Instruksi',
                // tidak ada kolom status di tabel instruksi_bupatis
                'tahunCol'   => 'tahun',
                'search'     => 'judul',
                'group'      => 'Regulasi',
            ],
            'propemda' => [
                'title'      => 'Propemda',
                'model'      => Propemda::class,
                'icon'       => 'bi-list-task',
                'badgeClass' => 'bc-propemda',
                'badgeLabel' => 'Propemda',
                // tidak ada kolom status di tabel propemdas
                'tahunCol'   => 'tahun',
                'search'     => 'judul',
                'group'      => 'Regulasi',
            ],
            'kerjasama' => [
                'title'      => 'Kerjasama Daerah',
                'model'      => KerjaSama::class,
                'icon'       => 'bi-handshake',
                'badgeClass' => 'bc-kerjasama',
                'badgeLabel' => 'Kerjasama',
                // tidak ada kolom status di tabel kerja_samas
                'tahunCol'   => 'tahun',
                'search'     => 'judul',
                'group'      => 'Regulasi',
            ],
            'perterjemah' => [
                'title'      => 'Peraturan Terjemah',
                'model'      => PeraturanTerjemah::class,
                'icon'       => 'bi-translate',
                'badgeClass' => 'bc-terjemah',
                'badgeLabel' => 'Terjemah',
                'tahunCol'   => 'tahun',
                'search'     => 'judul',
                'group'      => 'Regulasi',
            ],
            'ranpuu' => [
                'title'      => 'Rancangan PUU',
                'model'      => RancanganPuu::class,
                'icon'       => 'bi-file-earmark-diff',
                'badgeClass' => 'bc-ranpuu',
                'badgeLabel' => 'Rancangan',
                'tahunCol'   => 'tahun',
                'search'     => 'judul',
                'group'      => 'Regulasi',
            ],
            'kajian' => [
                'title'      => 'Kajian Hukum',
                'model'      => KajianHukum::class,
                'icon'       => 'bi-journal-bookmark',
                'badgeClass' => 'bc-kajian',
                'badgeLabel' => 'Kajian',
                'tahunCol'   => 'tahun',
                'search'     => 'judul',
                'group'      => 'Dokumen Hukum',
            ],
            'naskah' => [
                'title'      => 'Naskah Akademik',
                'model'      => NaskahAkademik::class,
                'icon'       => 'bi-file-earmark-text',
                'badgeClass' => 'bc-naskah',
                'badgeLabel' => 'Naskah',
                'tahunCol'   => 'tahun',
                'search'     => 'judul',
                'group'      => 'Dokumen Hukum',
            ],
            'analisis' => [
                'title'      => 'Analisis Evaluasi',
                'model'      => AnalisisEvaluasi::class,
                'icon'       => 'bi-clipboard-data',
                'badgeClass' => 'bc-analisis',
                'badgeLabel' => 'Analisis',
                'tahunCol'   => 'tahun',
                'search'     => 'judul',
                'group'      => 'Dokumen Hukum',
            ],
            'risalah' => [
                'title'      => 'Risalah Hukum',
                'model'      => RisalahHukum::class,
                'icon'       => 'bi-journal-richtext',
                'badgeClass' => 'bc-risalah',
                'badgeLabel' => 'Risalah',
                'tahunCol'   => 'tahun',
                'search'     => 'judul',
                'group'      => 'Dokumen Hukum',
            ],
            'relaas' => [
                'title'      => 'Relaas Pengadilan',
                'model'      => Relaas::class,
                'icon'       => 'bi-bank',
                'badgeClass' => 'bc-relaas',
                'badgeLabel' => 'Relaas',
                'search'     => ['pengumuman', 'nomor'],
                'group'      => 'Dokumen Hukum',
            ],
            'artikel' => [
                'title'      => 'Artikel',
                'model'      => Artikel::class,
                'icon'       => 'bi-newspaper',
                'badgeClass' => 'bc-artikel',
                'badgeLabel' => 'Artikel',
                'tahunCol'   => 'tahun',
                'search'     => 'judul',
                'group'      => 'Media',
            ],
            'infografis' => [
                'title'      => 'Infografis',
                'model'      => Infografis::class,
                'icon'       => 'bi-image',
                'badgeClass' => 'bc-infografis',
                'badgeLabel' => 'Infografis',
                'group'      => 'Media',
            ],
            'buku' => [
                'title'      => 'Perpustakaan Buku',
                'model'      => Buku::class,
                'icon'       => 'bi-book',
                'badgeClass' => 'bc-buku',
                'badgeLabel' => 'Buku',
                'tahunCol'   => 'tahun_terbit',
                'search'     => 'judul',
                'group'      => 'Media',
            ],
            'berita' => [
                'title'      => 'Berita Terkini',
                'model'      => Berita::class,
                'icon'       => 'bi-newspaper',
                'badgeClass' => 'bc-berita',
                'badgeLabel' => 'Berita',
                'status'     => ['col' => 'tampilkan', 'val' => 'Ya'],
                'search'     => 'judul',
                'group'      => 'Berita',
            ],
        ];

        return $map[$key] ?? null;
    }

    // =========================================================================
    // SEARCH — GET /cari?q=keyword
    // =========================================================================
    public function search(Request $request)
    {
        $q = trim($request->input('q', ''));
        if (!$q) return redirect()->route('home');

        $like    = "%{$q}%";
        $results = [];

        $sources = [
            ['model' => Perda::class,            'label' => 'Peraturan Daerah',   'badge' => 'bc-perda',      'badgeLabel' => 'Perda',       'route' => 'perda.show',            'col' => ['judul'], 'status' => ['status','BERLAKU']],
            ['model' => Perbupati::class,         'label' => 'Peraturan Bupati',   'badge' => 'bc-perbupati',  'badgeLabel' => 'Perbupati',   'route' => 'perbupati.show',         'col' => ['judul']],
            ['model' => KeputusanBupati::class,   'label' => 'Keputusan Bupati',   'badge' => 'bc-kepbupati',  'badgeLabel' => 'SK Bupati',   'route' => 'kepbupati.show',         'col' => ['judul']],
            ['model' => InstruksiBupati::class,   'label' => 'Instruksi Bupati',   'badge' => 'bc-insbupati',  'badgeLabel' => 'Instruksi',   'route' => 'insbupati.show',         'col' => ['judul']],
            ['model' => Propemda::class,          'label' => 'Propemda',           'badge' => 'bc-propemda',   'badgeLabel' => 'Propemda',    'route' => 'propemda.show',          'col' => ['judul']],
            ['model' => KerjaSama::class,         'label' => 'Kerjasama Daerah',   'badge' => 'bc-kerjasama',  'badgeLabel' => 'Kerjasama',   'route' => 'kerjasama.show',         'col' => ['judul']],
            ['model' => PeraturanTerjemah::class, 'label' => 'Peraturan Terjemah', 'badge' => 'bc-terjemah',   'badgeLabel' => 'Terjemah',    'route' => 'peraturan-terjemah.show','col' => ['judul']],
            ['model' => RancanganPuu::class,      'label' => 'Rancangan PUU',      'badge' => 'bc-ranpuu',     'badgeLabel' => 'Rancangan',   'route' => 'rancangan-puu.show',     'col' => ['judul']],
            ['model' => KajianHukum::class,       'label' => 'Kajian Hukum',       'badge' => 'bc-kajian',     'badgeLabel' => 'Kajian',      'route' => 'kajian-hukum.show',      'col' => ['judul']],
            ['model' => NaskahAkademik::class,    'label' => 'Naskah Akademik',    'badge' => 'bc-naskah',     'badgeLabel' => 'Naskah',      'route' => 'naskah-akademik.show',   'col' => ['judul']],
            ['model' => AnalisisEvaluasi::class,  'label' => 'Analisis Evaluasi',  'badge' => 'bc-analisis',   'badgeLabel' => 'Analisis',    'route' => 'analisis-evaluasi.show', 'col' => ['judul']],
            ['model' => RisalahHukum::class,      'label' => 'Risalah Hukum',      'badge' => 'bc-risalah',    'badgeLabel' => 'Risalah',     'route' => 'risalah-hukum.show',     'col' => ['judul']],
            ['model' => Relaas::class,            'label' => 'Relaas Pengadilan',  'badge' => 'bc-relaas',     'badgeLabel' => 'Relaas',      'route' => 'relaas.show',            'col' => ['pengumuman','nomor']],
            ['model' => Artikel::class,           'label' => 'Artikel',            'badge' => 'bc-artikel',    'badgeLabel' => 'Artikel',     'route' => 'artikel.show',           'col' => ['judul']],
            ['model' => Buku::class,              'label' => 'Buku',               'badge' => 'bc-buku',       'badgeLabel' => 'Buku',        'route' => 'buku.show',              'col' => ['judul']],
            ['model' => Berita::class,            'label' => 'Berita',             'badge' => 'bc-berita',     'badgeLabel' => 'Berita',      'route' => 'berita.show',            'col' => ['judul'], 'status' => ['tampilkan','Ya']],
        ];

        foreach ($sources as $src) {
            $query = $src['model']::query();
            if (isset($src['status'])) {
                $query->where($src['status'][0], $src['status'][1]);
            }
            $cols = $src['col'];
            $query->where(function ($qb) use ($cols, $like) {
                foreach ($cols as $i => $col) {
                    $i === 0 ? $qb->where($col, 'like', $like) : $qb->orWhere($col, 'like', $like);
                }
            });
            foreach ($query->latest()->limit(5)->get() as $item) {
                $judul = $item->judul ?? $item->pengumuman ?? 'Dokumen #'.$item->id;
                try { $url = $item->slug ? route($src['route'], $item->slug) : '#'; }
                catch (\Exception $e) { $url = '#'; }
                $results[] = [
                    'judul'      => $judul,
                    'label'      => $src['label'],
                    'badge'      => $src['badge'],
                    'badgeLabel' => $src['badgeLabel'],
                    'url'        => $url,
                    'tahun'      => $item->tahun ?? $item->tahun_terbit ?? null,
                    'tanggal'    => $item->created_at?->format('d M Y'),
                ];
            }
        }

        return view('public.search', [
            'q'       => $q,
            'results' => $results,
            'total'   => count($results),
        ]);
    }

    // =========================================================================
    // SEARCH SUGGESTIONS (AJAX) — GET /api/search-suggestions?q=keyword
    // =========================================================================
    public function searchSuggestions(Request $request)
    {
        $q = trim($request->input('q', ''));
        if (strlen($q) < 2) return response()->json([]);

        $like    = "%{$q}%";
        $suggest = [];

        $sources = [
            [Perda::class,            'Perda',       'perda.show'],
            [Perbupati::class,        'Perbupati',   'perbupati.show'],
            [KeputusanBupati::class,  'SK Bupati',   'kepbupati.show'],
            [InstruksiBupati::class,  'Instruksi',   'insbupati.show'],
            [Propemda::class,         'Propemda',    'propemda.show'],
            [PeraturanTerjemah::class,'Terjemah',    'peraturan-terjemah.show'],
            [KajianHukum::class,      'Kajian',      'kajian-hukum.show'],
            [NaskahAkademik::class,   'Naskah',      'naskah-akademik.show'],
            [Artikel::class,          'Artikel',     'artikel.show'],
            [Berita::class,           'Berita',      'berita.show'],
            [Buku::class,             'Buku',        'buku.show'],
        ];

        foreach ($sources as [$model, $label, $route]) {
            $items = $model::where('judul', 'like', $like)->latest()->limit(2)->get();
            foreach ($items as $item) {
                if (!$item->slug) continue;
                try { $url = route($route, $item->slug); } catch (\Exception $e) { continue; }
                $suggest[] = ['judul' => $item->judul, 'label' => $label, 'url' => $url];
                if (count($suggest) >= 8) break 2;
            }
        }

        return response()->json($suggest);
    }
}