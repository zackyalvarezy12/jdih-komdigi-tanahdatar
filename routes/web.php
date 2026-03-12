<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\PerdaController;
use App\Http\Controllers\Admin\PerbupatiController;
use App\Http\Controllers\Admin\KeputusanBupatiController;
use App\Http\Controllers\Admin\InstruksiBupatiController;
use App\Http\Controllers\Admin\PropemdaController;
use App\Http\Controllers\Admin\KerjaSamaController;
use App\Http\Controllers\Admin\RelaasController;
use App\Http\Controllers\Admin\KajianHukumController;
use App\Http\Controllers\Admin\PeraturanTerjemahController;
use App\Http\Controllers\Admin\NaskahAkademikController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\AnalisisEvaluasiController;
use App\Http\Controllers\Admin\RisalahHukumController;
use App\Http\Controllers\Admin\RancanganPuuController;
use App\Http\Controllers\Admin\InfografisController;
use App\Http\Controllers\HomeController;

// =============================================================================
// PUBLIK: Homepage & Daftar
// =============================================================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/daftar/{kategori}', [HomeController::class, 'list'])->name('publik.list');

// Publik: Peraturan Terjemah detail
Route::get('/peraturan-terjemah/{slug}', [App\Http\Controllers\Admin\PeraturanTerjemahController::class, 'show'])->name('peraturan-terjemah.show');

// Publik: Search
Route::get('/cari', [HomeController::class, 'search'])->name('publik.search');
Route::get('/api/search-suggestions', [HomeController::class, 'searchSuggestions'])->name('publik.search.suggestions');


Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // ─── BERITA ──────────────────────────────────────────────────────────────
    Route::get('/berita',                         [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/create',                  [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita/store',                  [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/edit/{encryptedId}',      [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/update/{encryptedId}',    [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/delete/{encryptedId}', [BeritaController::class, 'destroy'])->name('berita.destroy');

    // ─── BUKU ─────────────────────────────────────────────────────────────────
    Route::get('/buku',                          [BukuController::class, 'index'])->name('buku.index');
    Route::get('/buku/create',                   [BukuController::class, 'create'])->name('buku.create');
    Route::post('/buku',                         [BukuController::class, 'store'])->name('buku.store');
    Route::get('/buku/edit/{encryptedId}',       [BukuController::class, 'edit'])->name('buku.edit');
    Route::put('/buku/update/{encryptedId}',     [BukuController::class, 'update'])->name('buku.update');
    Route::delete('/buku/delete/{encryptedId}',  [BukuController::class, 'destroy'])->name('buku.destroy');

    // ─── PERDA ────────────────────────────────────────────────────────────────
    Route::get('/perda',                          [PerdaController::class, 'index'])->name('perda.index');
    Route::get('/perda/create',                   [PerdaController::class, 'create'])->name('perda.create');
    Route::post('/perda',                         [PerdaController::class, 'store'])->name('perda.store');
    Route::get('/perda/edit/{encryptedId}',       [PerdaController::class, 'edit'])->name('perda.edit');
    Route::put('/perda/update/{encryptedId}',     [PerdaController::class, 'update'])->name('perda.update');
    Route::delete('/perda/delete/{encryptedId}',  [PerdaController::class, 'destroy'])->name('perda.destroy');

    // ─── PERBUPATI ────────────────────────────────────────────────────────────
    Route::get('/perbupati',                          [PerbupatiController::class, 'index'])->name('perbupati.index');
    Route::get('/perbupati/create',                   [PerbupatiController::class, 'create'])->name('perbupati.create');
    Route::post('/perbupati',                         [PerbupatiController::class, 'store'])->name('perbupati.store');
    Route::get('/perbupati/edit/{encryptedId}',       [PerbupatiController::class, 'edit'])->name('perbupati.edit');
    Route::put('/perbupati/update/{encryptedId}',     [PerbupatiController::class, 'update'])->name('perbupati.update');
    Route::delete('/perbupati/delete/{encryptedId}',  [PerbupatiController::class, 'destroy'])->name('perbupati.destroy');

    // ─── KEPBUPATI ────────────────────────────────────────────────────────────
    Route::get('/kepbupati',                          [KeputusanBupatiController::class, 'index'])->name('kepbupati.index');
    Route::get('/kepbupati/create',                   [KeputusanBupatiController::class, 'create'])->name('kepbupati.create');
    Route::post('/kepbupati',                         [KeputusanBupatiController::class, 'store'])->name('kepbupati.store');
    Route::get('/kepbupati/edit/{encryptedId}',       [KeputusanBupatiController::class, 'edit'])->name('kepbupati.edit');
    Route::put('/kepbupati/update/{encryptedId}',     [KeputusanBupatiController::class, 'update'])->name('kepbupati.update');
    Route::delete('/kepbupati/delete/{encryptedId}',  [KeputusanBupatiController::class, 'destroy'])->name('kepbupati.destroy');

    // ─── INSBUPATI ────────────────────────────────────────────────────────────
    Route::get('/insbupati',                          [InstruksiBupatiController::class, 'index'])->name('insbupati.index');
    Route::get('/insbupati/create',                   [InstruksiBupatiController::class, 'create'])->name('insbupati.create');
    Route::post('/insbupati',                         [InstruksiBupatiController::class, 'store'])->name('insbupati.store');
    Route::get('/insbupati/edit/{encryptedId}',       [InstruksiBupatiController::class, 'edit'])->name('insbupati.edit');
    Route::put('/insbupati/update/{encryptedId}',     [InstruksiBupatiController::class, 'update'])->name('insbupati.update');
    Route::delete('/insbupati/delete/{encryptedId}',  [InstruksiBupatiController::class, 'destroy'])->name('insbupati.destroy');

    // ─── PROPEMDA ─────────────────────────────────────────────────────────────
    Route::get('/propemda',                          [PropemdaController::class, 'index'])->name('propemda.index');
    Route::get('/propemda/create',                   [PropemdaController::class, 'create'])->name('propemda.create');
    Route::post('/propemda',                         [PropemdaController::class, 'store'])->name('propemda.store');
    Route::get('/propemda/edit/{encryptedId}',       [PropemdaController::class, 'edit'])->name('propemda.edit');
    Route::put('/propemda/update/{encryptedId}',     [PropemdaController::class, 'update'])->name('propemda.update');
    Route::delete('/propemda/delete/{encryptedId}',  [PropemdaController::class, 'destroy'])->name('propemda.destroy');

    // ─── KERJASAMA ────────────────────────────────────────────────────────────
    Route::get('/kerjasama',                          [KerjaSamaController::class, 'index'])->name('kerjasama.index');
    Route::get('/kerjasama/create',                   [KerjaSamaController::class, 'create'])->name('kerjasama.create');
    Route::post('/kerjasama',                         [KerjaSamaController::class, 'store'])->name('kerjasama.store');
    Route::get('/kerjasama/edit/{encryptedId}',       [KerjaSamaController::class, 'edit'])->name('kerjasama.edit');
    Route::put('/kerjasama/update/{encryptedId}',     [KerjaSamaController::class, 'update'])->name('kerjasama.update');
    Route::delete('/kerjasama/delete/{encryptedId}',  [KerjaSamaController::class, 'destroy'])->name('kerjasama.destroy');

    // ─── ARTIKEL ──────────────────────────────────────────────────────────────
    Route::get('/artikel',                          [ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('/artikel/create',                   [ArtikelController::class, 'create'])->name('artikel.create');
    Route::post('/artikel',                         [ArtikelController::class, 'store'])->name('artikel.store');
    Route::get('/artikel/edit/{encryptedId}',       [ArtikelController::class, 'edit'])->name('artikel.edit');
    Route::put('/artikel/update/{encryptedId}',     [ArtikelController::class, 'update'])->name('artikel.update');
    Route::delete('/artikel/delete/{encryptedId}',  [ArtikelController::class, 'destroy'])->name('artikel.destroy');

    // ─── RELAAS ───────────────────────────────────────────────────────────────
    Route::get('/relaas',                          [RelaasController::class, 'index'])->name('relaas.index');
    Route::get('/relaas/create',                   [RelaasController::class, 'create'])->name('relaas.create');
    Route::post('/relaas',                         [RelaasController::class, 'store'])->name('relaas.store');
    Route::get('/relaas/edit/{encryptedId}',       [RelaasController::class, 'edit'])->name('relaas.edit');
    Route::put('/relaas/update/{encryptedId}',     [RelaasController::class, 'update'])->name('relaas.update');
    Route::delete('/relaas/delete/{encryptedId}',  [RelaasController::class, 'destroy'])->name('relaas.destroy');

    // ─── ANALISIS EVALUASI ────────────────────────────────────────────────────
    Route::get('/analisis-evaluasi',                          [AnalisisEvaluasiController::class, 'index'])->name('analisis-evaluasi.index');
    Route::get('/analisis-evaluasi/create',                   [AnalisisEvaluasiController::class, 'create'])->name('analisis-evaluasi.create');
    Route::post('/analisis-evaluasi',                         [AnalisisEvaluasiController::class, 'store'])->name('analisis-evaluasi.store');
    Route::get('/analisis-evaluasi/edit/{encryptedId}',       [AnalisisEvaluasiController::class, 'edit'])->name('analisis-evaluasi.edit');
    Route::put('/analisis-evaluasi/update/{encryptedId}',     [AnalisisEvaluasiController::class, 'update'])->name('analisis-evaluasi.update');
    Route::delete('/analisis-evaluasi/delete/{encryptedId}',  [AnalisisEvaluasiController::class, 'destroy'])->name('analisis-evaluasi.destroy');

    // ─── RISALAH HUKUM ────────────────────────────────────────────────────────
    Route::get('/risalah-hukum',                          [RisalahHukumController::class, 'index'])->name('risalah-hukum.index');
    Route::get('/risalah-hukum/create',                   [RisalahHukumController::class, 'create'])->name('risalah-hukum.create');
    Route::post('/risalah-hukum',                         [RisalahHukumController::class, 'store'])->name('risalah-hukum.store');
    Route::get('/risalah-hukum/edit/{encryptedId}',       [RisalahHukumController::class, 'edit'])->name('risalah-hukum.edit');
    Route::put('/risalah-hukum/update/{encryptedId}',     [RisalahHukumController::class, 'update'])->name('risalah-hukum.update');
    Route::delete('/risalah-hukum/delete/{encryptedId}',  [RisalahHukumController::class, 'destroy'])->name('risalah-hukum.destroy');

    // ─── KAJIAN HUKUM ─────────────────────────────────────────────────────────
    Route::get('/kajian-hukum',                          [KajianHukumController::class, 'index'])->name('kajian-hukum.index');
    Route::get('/kajian-hukum/create',                   [KajianHukumController::class, 'create'])->name('kajian-hukum.create');
    Route::post('/kajian-hukum',                         [KajianHukumController::class, 'store'])->name('kajian-hukum.store');
    Route::get('/kajian-hukum/edit/{encryptedId}',       [KajianHukumController::class, 'edit'])->name('kajian-hukum.edit');
    Route::put('/kajian-hukum/update/{encryptedId}',     [KajianHukumController::class, 'update'])->name('kajian-hukum.update');
    Route::delete('/kajian-hukum/delete/{encryptedId}',  [KajianHukumController::class, 'destroy'])->name('kajian-hukum.destroy');

    // ─── RANCANGAN PUU ────────────────────────────────────────────────────────
    Route::get('/rancangan-puu',                          [RancanganPuuController::class, 'index'])->name('rancangan-puu.index');
    Route::get('/rancangan-puu/create',                   [RancanganPuuController::class, 'create'])->name('rancangan-puu.create');
    Route::post('/rancangan-puu',                         [RancanganPuuController::class, 'store'])->name('rancangan-puu.store');
    Route::get('/rancangan-puu/edit/{encryptedId}',       [RancanganPuuController::class, 'edit'])->name('rancangan-puu.edit');
    Route::put('/rancangan-puu/update/{encryptedId}',     [RancanganPuuController::class, 'update'])->name('rancangan-puu.update');
    Route::delete('/rancangan-puu/delete/{encryptedId}',  [RancanganPuuController::class, 'destroy'])->name('rancangan-puu.destroy');

    // ─── NASKAH AKADEMIK ──────────────────────────────────────────────────────
    Route::get('/naskah-akademik',                          [NaskahAkademikController::class, 'index'])->name('naskah-akademik.index');
    Route::get('/naskah-akademik/create',                   [NaskahAkademikController::class, 'create'])->name('naskah-akademik.create');
    Route::post('/naskah-akademik',                         [NaskahAkademikController::class, 'store'])->name('naskah-akademik.store');
    Route::get('/naskah-akademik/edit/{encryptedId}',       [NaskahAkademikController::class, 'edit'])->name('naskah-akademik.edit');
    Route::put('/naskah-akademik/update/{encryptedId}',     [NaskahAkademikController::class, 'update'])->name('naskah-akademik.update');
    Route::delete('/naskah-akademik/delete/{encryptedId}',  [NaskahAkademikController::class, 'destroy'])->name('naskah-akademik.destroy');

    // ─── PERATURAN TERJEMAH ───────────────────────────────────────────────────
    Route::resource('peraturan-terjemah', PeraturanTerjemahController::class);

    // ─── INFOGRAFIS ───────────────────────────────────────────────────────────
    Route::get('/infografis',                          [InfografisController::class, 'index'])->name('infografis.index');
    Route::get('/infografis/create',                   [InfografisController::class, 'create'])->name('infografis.create');
    Route::post('/infografis',                         [InfografisController::class, 'store'])->name('infografis.store');
    Route::get('/infografis/edit/{encryptedId}',       [InfografisController::class, 'edit'])->name('infografis.edit');
    Route::put('/infografis/update/{encryptedId}',     [InfografisController::class, 'update'])->name('infografis.update');
    Route::delete('/infografis/delete/{encryptedId}',  [InfografisController::class, 'destroy'])->name('infografis.destroy');

    // ─── KONTAK ───────────────────────────────────────────────────────────────
    Route::resource('admin/kontak', App\Http\Controllers\Admin\KontakController::class);
});

// =============================================================================
// PUBLIK: Route detail menggunakan SLUG
// =============================================================================
Route::get('/berita/{slug}',             [BeritaController::class,           'show'])->name('berita.show');
Route::get('/buku/{slug}',               [BukuController::class,             'show'])->name('buku.show');
Route::get('/perda/{slug}',              [PerdaController::class,            'show'])->name('perda.show');
Route::get('/perbupati/{slug}',          [PerbupatiController::class,        'show'])->name('perbupati.show');
Route::get('/kepbupati/{slug}',          [KeputusanBupatiController::class,  'show'])->name('kepbupati.show');
Route::get('/insbupati/{slug}',          [InstruksiBupatiController::class,  'show'])->name('insbupati.show');
Route::get('/propemda/{slug}',           [PropemdaController::class,         'show'])->name('propemda.show');
Route::get('/kerjasama/{slug}',          [KerjaSamaController::class,        'show'])->name('kerjasama.show');
Route::get('/relaas/{slug}',             [RelaasController::class,           'show'])->name('relaas.show');
Route::get('/artikel/{slug}',            [ArtikelController::class,          'show'])->name('artikel.show');
Route::get('/analisis-evaluasi/{slug}',  [AnalisisEvaluasiController::class, 'show'])->name('analisis-evaluasi.show');
Route::get('/risalah-hukum/{slug}',      [RisalahHukumController::class,     'show'])->name('risalah-hukum.show');
Route::get('/kajian-hukum/{slug}',       [KajianHukumController::class,      'show'])->name('kajian-hukum.show');
Route::get('/rancangan-puu/{slug}',      [RancanganPuuController::class,     'show'])->name('rancangan-puu.show');
Route::get('/naskah-akademik/{slug}',    [NaskahAkademikController::class,   'show'])->name('naskah-akademik.show');
Route::get('/infografis/{slug}',         [InfografisController::class,       'show'])->name('infografis.show');

// =============================================================================
// PROFILE
// =============================================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/pdf/view/{path}', function ($path) {
    $decoded = base64_decode($path);

    $fullPath = storage_path('app/public/' . $decoded);

    if (!file_exists($fullPath) || !str_starts_with(realpath($fullPath), realpath(storage_path('app/public')))) {
        abort(404);
    }

    return response()->file($fullPath, [
        'Content-Type'        => 'application/pdf',
        'Content-Disposition' => 'inline; filename="' . basename($fullPath) . '"',
        'X-Frame-Options'     => 'SAMEORIGIN',
        'Cache-Control'       => 'public, max-age=3600',
    ]);
})->name('pdf.view')->where('path', '.*');

require __DIR__.'/auth.php';