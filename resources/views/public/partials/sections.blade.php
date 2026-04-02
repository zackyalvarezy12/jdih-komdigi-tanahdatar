{{--
    ╔══════════════════════════════════════════════════════════╗
    ║  PARTIAL: sections.blade.php                             ║
    ║  Isi: Hero · Search · Berita Swipe · Stats · Tabs        ║
    ║       Produk Terbaru · Regulasi · Dokumen Hukum          ║
    ║       Media · Berita                                     ║
    ╚══════════════════════════════════════════════════════════╝
--}}

{{-- ════════════════════ HERO ════════════════════ --}}
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-grid"></div>
    <div class="hero-shimmer"></div>
    <div class="hero-orb-a"></div>
    <div class="hero-orb-b"></div>
    <div class="hero-topline"></div>
    <div class="container hero-inner">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6">
                <div class="hero-badge">
                    <div class="hero-badge-dot"></div>
                    Portal Resmi Kabupaten Tanah Datar
                </div>
                <h1>Portal Hukum &amp; <em>Regulasi Daerah</em></h1>
                <p class="hero-desc">Temukan peraturan daerah, keputusan bupati, kajian hukum, dan seluruh dokumen resmi Kabupaten Tanah Datar dalam satu portal terpadu yang mudah diakses.</p>
                <div class="hero-cta">
                    <a href="#regulasi" class="btn-primary-hero"><i class="bi bi-book-half"></i> Jelajahi Regulasi</a>
                    <a href="{{ url('/daftar/berita') }}" class="btn-outline-hero"><i class="bi bi-newspaper"></i> Baca Berita</a>
                </div>
                <div class="hero-stats">
                    <div class="hs">
                        <span class="n counter" data-target="{{ $stats['perda'] }}">0</span>
                        <div class="l">Perda</div>
                    </div>
                    <div class="hs">
                        <span class="n counter" data-target="{{ $stats['perbupati'] }}">0</span>
                        <div class="l">Perbupati</div>
                    </div>
                    <div class="hs">
                        <span class="n counter" data-target="{{ $stats['berita'] }}">0</span>
                        <div class="l">Berita</div>
                    </div>
                    <div class="hs">
                        <span class="n counter" data-target="{{ $stats['kajian'] }}">0</span>
                        <div class="l">Kajian</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-flex justify-content-end">
                <div class="hero-panel" style="width:100%;max-width:390px;">
                    <div class="hp-title"><i class="bi bi-grid-3x3-gap"></i> Akses Cepat Dokumen</div>
                    <div class="hcat-grid">
                        <a href="{{ url('/daftar/perda') }}" class="hcat gold"><i class="bi bi-file-earmark-ruled"></i><span>Perda</span></a>
                        <a href="{{ url('/daftar/perbupati') }}" class="hcat"><i class="bi bi-file-earmark-check"></i><span>Perbupati</span></a>
                        <a href="{{ url('/daftar/kepbupati') }}" class="hcat"><i class="bi bi-file-earmark-lock"></i><span>SK Bupati</span></a>
                        <a href="{{ url('/daftar/kajian') }}" class="hcat"><i class="bi bi-journal-bookmark"></i><span>Kajian</span></a>
                        <a href="{{ url('/daftar/naskah') }}" class="hcat"><i class="bi bi-file-earmark-text"></i><span>Naskah</span></a>
                        <a href="{{ url('/daftar/artikel') }}" class="hcat gold"><i class="bi bi-newspaper"></i><span>Artikel</span></a>
                        <a href="{{ url('/daftar/buku') }}" class="hcat"><i class="bi bi-book"></i><span>Buku</span></a>
                        <a href="{{ url('/daftar/perterjemah') }}" class="hcat"><i class="bi bi-translate"></i><span>Terjemah</span></a>
                        <a href="{{ url('/daftar/infografis') }}" class="hcat"><i class="bi bi-image"></i><span>Infografis</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-wave">
        <svg viewBox="0 0 1440 54" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 54L60 46.2C120 38.7 240 23 360 18.4C480 13.8 600 19 720 24.3C840 29.7 960 34.8 1080 33C1200 31.3 1320 22.7 1380 18.4L1440 14V54H1380C1320 54 1200 54 1080 54C960 54 840 54 720 54C600 54 480 54 360 54C240 54 120 54 60 54H0Z" fill="white" fill-opacity="0.04"/>
        </svg>
    </div>
</section>

{{-- ════════════════════ SEARCH ════════════════════ --}}
<div class="search-section">
    <div class="container">
        <div class="search-wrap" id="searchWrap">
            <form method="GET" action="{{ url('/cari') }}" autocomplete="off" onsubmit="closeSuggestions()">
                <div class="search-box">
                    <span class="si"><i class="bi bi-search"></i></span>
                    <input type="text" name="q" id="searchInput"
                           value="{{ request('q') }}"
                           placeholder="Cari peraturan, kajian hukum, berita terkini..."
                           oninput="fetchSuggestions(this.value)"
                           onfocus="fetchSuggestions(this.value)">
                    <button type="submit"><i class="bi bi-search"></i> <span>Cari Sekarang</span></button>
                </div>
            </form>
            <div class="search-suggest" id="searchSuggest" style="display:none"></div>
        </div>
        <div class="search-tags">
            <span class="search-tag-lbl"><i class="bi bi-lightning-charge-fill" style="color:var(--gold)"></i> Populer:</span>
            <a href="{{ url('/cari?q=perda') }}" class="search-tag"><i class="bi bi-file-earmark-ruled"></i> Perda</a>
            <a href="{{ url('/cari?q=peraturan+bupati') }}" class="search-tag"><i class="bi bi-file-earmark-check"></i> Peraturan Bupati</a>
            <a href="{{ url('/cari?q=kajian+hukum') }}" class="search-tag"><i class="bi bi-journal-bookmark"></i> Kajian Hukum</a>
            <a href="{{ url('/cari?q=naskah+akademik') }}" class="search-tag"><i class="bi bi-file-text"></i> Naskah Akademik</a>
            <a href="{{ url('/cari?q=propemda') }}" class="search-tag"><i class="bi bi-list-task"></i> Propemda</a>
        </div>
    </div>
</div>


{{-- ════════════════════ STATS BAR ════════════════════ --}}
<div class="stats-bar">
    <div class="container">
        <div class="sbar-inner">
            <a href="{{ url('/daftar/perda') }}" class="sbar-item">
                <div class="sbar-icon"><i class="bi bi-file-earmark-ruled"></i></div>
                <div class="sbar-info">
                    <div class="sbar-num counter" data-target="{{ $stats['perda'] }}">0</div>
                    <div class="sbar-lbl">Peraturan Daerah</div>
                </div>
            </a>
            <a href="{{ url('/daftar/perbupati') }}" class="sbar-item">
                <div class="sbar-icon"><i class="bi bi-file-earmark-check"></i></div>
                <div class="sbar-info">
                    <div class="sbar-num counter" data-target="{{ $stats['perbupati'] }}">0</div>
                    <div class="sbar-lbl">Peraturan Bupati</div>
                </div>
            </a>
            <a href="{{ url('/daftar/kajian') }}" class="sbar-item">
                <div class="sbar-icon"><i class="bi bi-journal-bookmark"></i></div>
                <div class="sbar-info">
                    <div class="sbar-num counter" data-target="{{ $stats['kajian'] }}">0</div>
                    <div class="sbar-lbl">Kajian Hukum</div>
                </div>
            </a>
            <a href="{{ url('/daftar/berita') }}" class="sbar-item">
                <div class="sbar-icon"><i class="bi bi-newspaper"></i></div>
                <div class="sbar-info">
                    <div class="sbar-num counter" data-target="{{ $stats['berita'] }}">0</div>
                    <div class="sbar-lbl">Berita Terkini</div>
                </div>
            </a>
        </div>
    </div>
</div>

{{-- ════════════════════ CAT TABS ════════════════════ --}}
<div class="cat-tabs">
    {{-- Tidak pakai .container agar full-width scroll di mobile --}}
    <div class="cat-tabs-inner" style="padding:0 12px;">
        <a href="#terbaru" class="cat-tab active"><i class="bi bi-lightning-charge"></i> Produk Terbaru</a>
        <a href="#regulasi" class="cat-tab"><i class="bi bi-book"></i> Regulasi</a>
        <a href="#dokumen" class="cat-tab"><i class="bi bi-file-earmark-text"></i> Dokumen Hukum</a>
        <a href="#media" class="cat-tab"><i class="bi bi-grid-1x2"></i> Konten &amp; Media</a>
        <a href="#berita" class="cat-tab"><i class="bi bi-newspaper"></i> Berita</a>
    </div>
</div>

{{-- ════════════════════ PRODUK TERBARU ════════════════════ --}}
<div id="terbaru"></div>
<section class="sec-terbaru">
    <div class="container">
        <div class="sec-header reveal">
            <div>
                <div class="sec-eyebrow"><i class="bi bi-lightning-charge-fill"></i> Produk Hukum</div>
                <h2 class="sec-title">Produk Hukum <em>Terbaru</em></h2>
                <p class="sec-desc">Peraturan dan produk hukum terbaru yang diterbitkan Pemerintah Kabupaten Tanah Datar.</p>
            </div>
            <div class="pt-tabs">
                <button class="pt-tab active" onclick="switchTab('tb-perda',this)"><i class="bi bi-file-earmark-ruled"></i> Perda</button>
                <button class="pt-tab" onclick="switchTab('tb-perbupati',this)"><i class="bi bi-file-earmark-check"></i> Perbupati</button>
                <button class="pt-tab" onclick="switchTab('tb-kepbupati',this)"><i class="bi bi-file-earmark-lock"></i> SK Bupati</button>
                <button class="pt-tab" onclick="switchTab('tb-insbupati',this)"><i class="bi bi-file-earmark-arrow-down"></i> Instruksi</button>
            </div>
        </div>

        {{-- Panel Perda --}}
        <div class="pt-panel active" id="tb-perda">
            <div class="row g-3">
                @forelse($perda as $idx => $item)
                <div class="col-sm-6 col-lg-4 reveal" style="transition-delay:{{ $idx * 0.07 }}s">
                    <a href="{{ $item->slug ? route('perda.show',$item->slug) : '#' }}" class="doc-card">
                        <div class="doc-card-head">
                            <div class="doc-icon" style="background:#dbeafe"><i class="bi bi-file-earmark-ruled" style="color:#1a3a8f"></i></div>
                            <div class="doc-title">{{ $item->judul }}</div>
                        </div>
                        <div style="display:flex;gap:6px;flex-wrap:wrap;">
                            <span class="badge badge-perda">Perda</span>
                            @if($item->tahun)<span class="badge" style="background:var(--gray-100);color:var(--gray-700)">{{ $item->tahun }}</span>@endif
                            @if($item->nomor)<span class="badge" style="background:var(--gray-100);color:var(--gray-700)">No. {{ $item->nomor }}</span>@endif
                        </div>
                        <div class="doc-foot">
                            <span class="doc-date"><i class="bi bi-calendar3"></i> {{ $item->created_at->format('d M Y') }}</span>
                            <span class="doc-arrow"><i class="bi bi-arrow-right"></i></span>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12"><div class="pt-empty"><i class="bi bi-inbox"></i>Belum ada data Peraturan Daerah</div></div>
                @endforelse
            </div>
            <div class="text-center mt-5">
                <a href="{{ url('/daftar/perda') }}" class="btn-all btn-all-navy">Lihat Semua Perda <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>

        {{-- Panel Perbupati --}}
        <div class="pt-panel" id="tb-perbupati">
            <div class="row g-3">
                @forelse($perbupati as $idx => $item)
                <div class="col-sm-6 col-lg-4 reveal" style="transition-delay:{{ $idx * 0.07 }}s">
                    <a href="{{ $item->slug ? route('perbupati.show',$item->slug) : '#' }}" class="doc-card">
                        <div class="doc-card-head">
                            <div class="doc-icon" style="background:#dcfce7"><i class="bi bi-file-earmark-check" style="color:#059669"></i></div>
                            <div class="doc-title">{{ $item->judul }}</div>
                        </div>
                        <div style="display:flex;gap:6px;flex-wrap:wrap;">
                            <span class="badge badge-perbupati">Perbupati</span>
                            @if($item->tahun)<span class="badge" style="background:var(--gray-100);color:var(--gray-700)">{{ $item->tahun }}</span>@endif
                        </div>
                        <div class="doc-foot">
                            <span class="doc-date"><i class="bi bi-calendar3"></i> {{ $item->created_at->format('d M Y') }}</span>
                            <span class="doc-arrow"><i class="bi bi-arrow-right"></i></span>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12"><div class="pt-empty"><i class="bi bi-inbox"></i>Belum ada data</div></div>
                @endforelse
            </div>
            <div class="text-center mt-5">
                <a href="{{ url('/daftar/perbupati') }}" class="btn-all btn-all-navy">Lihat Semua Perbupati <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>

        {{-- Panel SK Bupati --}}
        <div class="pt-panel" id="tb-kepbupati">
            <div class="row g-3">
                @forelse($keputusanBupati as $idx => $item)
                <div class="col-sm-6 col-lg-4 reveal" style="transition-delay:{{ $idx * 0.07 }}s">
                    <a href="{{ $item->slug ? route('kepbupati.show',$item->slug) : '#' }}" class="doc-card">
                        <div class="doc-card-head">
                            <div class="doc-icon" style="background:#fef9c3"><i class="bi bi-file-earmark-lock" style="color:#d97706"></i></div>
                            <div class="doc-title">{{ $item->judul }}</div>
                        </div>
                        <div style="display:flex;gap:6px;flex-wrap:wrap;">
                            <span class="badge badge-kepbupati">SK Bupati</span>
                            @if($item->tahun)<span class="badge" style="background:var(--gray-100);color:var(--gray-700)">{{ $item->tahun }}</span>@endif
                        </div>
                        <div class="doc-foot">
                            <span class="doc-date"><i class="bi bi-calendar3"></i> {{ $item->created_at->format('d M Y') }}</span>
                            <span class="doc-arrow"><i class="bi bi-arrow-right"></i></span>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12"><div class="pt-empty"><i class="bi bi-inbox"></i>Belum ada data</div></div>
                @endforelse
            </div>
            <div class="text-center mt-5">
                <a href="{{ url('/daftar/kepbupati') }}" class="btn-all btn-all-navy">Lihat Semua SK Bupati <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>

        {{-- Panel Instruksi --}}
        <div class="pt-panel" id="tb-insbupati">
            <div class="row g-3">
                @forelse($instruksiBupati as $idx => $item)
                <div class="col-sm-6 col-lg-4 reveal" style="transition-delay:{{ $idx * 0.07 }}s">
                    <a href="{{ $item->slug ? route('insbupati.show',$item->slug) : '#' }}" class="doc-card">
                        <div class="doc-card-head">
                            <div class="doc-icon" style="background:#fee2e2"><i class="bi bi-file-earmark-arrow-down" style="color:#dc2626"></i></div>
                            <div class="doc-title">{{ $item->judul }}</div>
                        </div>
                        <div style="display:flex;gap:6px;flex-wrap:wrap;">
                            <span class="badge badge-insbupati">Instruksi</span>
                            @if($item->tahun)<span class="badge" style="background:var(--gray-100);color:var(--gray-700)">{{ $item->tahun }}</span>@endif
                        </div>
                        <div class="doc-foot">
                            <span class="doc-date"><i class="bi bi-calendar3"></i> {{ $item->created_at->format('d M Y') }}</span>
                            <span class="doc-arrow"><i class="bi bi-arrow-right"></i></span>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12"><div class="pt-empty"><i class="bi bi-inbox"></i>Belum ada data</div></div>
                @endforelse
            </div>
            <div class="text-center mt-5">
                <a href="{{ url('/daftar/insbupati') }}" class="btn-all btn-all-navy">Lihat Semua Instruksi <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════ REGULASI ════════════════════ --}}
<div id="regulasi"></div>

@php
$regulasiGroups = [
    ['data'=>$perda,            'label'=>'Peraturan Daerah',   'badge'=>'badge-perda',     'badgeLabel'=>'Perda',     'icon'=>'bi-file-earmark-ruled',      'color'=>'#1a3a8f','route'=>'perda.show',        'kategori'=>'perda',       'tahun'=>true,'nomor'=>true],
    ['data'=>$perbupati,        'label'=>'Peraturan Bupati',   'badge'=>'badge-perbupati', 'badgeLabel'=>'Perbupati', 'icon'=>'bi-file-earmark-check',      'color'=>'#059669','route'=>'perbupati.show',     'kategori'=>'perbupati',   'tahun'=>true,'nomor'=>false],
    ['data'=>$keputusanBupati,  'label'=>'Keputusan Bupati',   'badge'=>'badge-kepbupati', 'badgeLabel'=>'SK Bupati', 'icon'=>'bi-file-earmark-lock',       'color'=>'#d97706','route'=>'kepbupati.show',     'kategori'=>'kepbupati',   'tahun'=>true,'nomor'=>false],
    ['data'=>$instruksiBupati,  'label'=>'Instruksi Bupati',   'badge'=>'badge-insbupati', 'badgeLabel'=>'Instruksi', 'icon'=>'bi-file-earmark-arrow-down', 'color'=>'#dc2626','route'=>'insbupati.show',     'kategori'=>'insbupati',   'tahun'=>true,'nomor'=>false],
    ['data'=>$propemda,         'label'=>'Propemda',           'badge'=>'badge-propemda',  'badgeLabel'=>'Propemda',  'icon'=>'bi-list-task',               'color'=>'#7c3aed','route'=>'propemda.show',      'kategori'=>'propemda',    'tahun'=>true,'nomor'=>false],
    ['data'=>$kerjaSama,        'label'=>'Kerjasama Daerah',   'badge'=>'badge-kerjasama', 'badgeLabel'=>'Kerjasama', 'icon'=>'bi-handshake',               'color'=>'#0891b2','route'=>'kerjasama.show',     'kategori'=>'kerjasama',   'tahun'=>true,'nomor'=>false],
    ['data'=>$peraturanTerjemah,'label'=>'Peraturan Terjemah', 'badge'=>'badge-terjemah',  'badgeLabel'=>'Terjemah',  'icon'=>'bi-translate',               'color'=>'#db2777','route'=>null,                 'kategori'=>'perterjemah', 'tahun'=>true,'nomor'=>false,'url'=>true],
    ['data'=>$rancanganPuu,     'label'=>'Rancangan PUU',      'badge'=>'badge-ranpuu',    'badgeLabel'=>'Rancangan', 'icon'=>'bi-file-earmark-diff',       'color'=>'#ea580c','route'=>'rancangan-puu.show', 'kategori'=>'ranpuu',      'tahun'=>true,'nomor'=>false],
];
$activeReg = collect($regulasiGroups)->filter(fn($g) => $g['data']->count() > 0);
@endphp

@if($activeReg->count())
<section class="sec-regulasi">
    <div class="container" style="position:relative;z-index:1;">
        <div class="reg-header reveal">
            <div>
                <div class="reg-eyebrow"><i class="bi bi-book-half"></i> Produk Hukum Resmi</div>
                <h2 class="reg-title">Regulasi Daerah</h2>
                <p style="color:rgba(255,255,255,.42);font-size:.86rem;margin-top:8px;max-width:480px;">Seluruh peraturan, keputusan, dan instruksi resmi Pemerintah Kabupaten Tanah Datar.</p>
            </div>
        </div>
        <div class="reg-nav" id="regNav">
            @foreach($activeReg as $i => $g)
            <button class="reg-btn {{ $i===0?'active':'' }}" onclick="switchReg('rg-{{ $i }}',this)" style="--acc:{{ $g['color'] }}">
                <i class="bi {{ $g['icon'] }}"></i> {{ $g['label'] }}
            </button>
            @endforeach
        </div>
        @foreach($activeReg as $i => $g)
        <div class="reg-panel {{ $i===0?'active':'' }}" id="rg-{{ $i }}">
            <div class="reg-grid">
                @foreach($g['data'] as $item)
                <a href="{{ isset($g['url']) ? ($item->slug ? url('/peraturan-terjemah/'.$item->slug) : '#') : ($g['route'] && $item->slug ? route($g['route'],$item->slug) : '#') }}"
                   class="reg-card" style="--acc:{{ $g['color'] }}">
                    <div class="reg-icon" style="background:{{ $g['color'] }}22"><i class="bi {{ $g['icon'] }}" style="color:{{ $g['color'] }}"></i></div>
                    <div class="reg-body">
                        <div class="reg-badges">
                            <span class="badge {{ $g['badge'] }}">{{ $g['badgeLabel'] }}</span>
                            @if($g['tahun'] && !empty($item->tahun))<span class="badge" style="background:rgba(255,255,255,.1);color:rgba(255,255,255,.6);font-size:.57rem">{{ $item->tahun }}</span>@endif
                            @if($g['nomor'] && !empty($item->nomor))<span class="badge" style="background:rgba(255,255,255,.1);color:rgba(255,255,255,.6);font-size:.57rem">No. {{ $item->nomor }}</span>@endif
                        </div>
                        <div class="reg-card-title">{{ $item->judul }}</div>
                        <div class="reg-date"><i class="bi bi-calendar3"></i> {{ $item->created_at->format('d M Y') }}</div>
                    </div>
                    <div class="reg-arrow"><i class="bi bi-arrow-right"></i></div>
                </a>
                @endforeach
            </div>
            <div class="reg-foot">
                <a href="{{ url('/daftar/'.$g['kategori']) }}" class="btn-all btn-all-ghost">
                    Lihat Semua {{ $g['label'] }} <i class="bi bi-arrow-right"></i>
                </a>
                <span style="font-size:.7rem;color:rgba(255,255,255,.25)">{{ $g['data']->count() }} dokumen ditampilkan</span>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- ════════════════════ DOKUMEN HUKUM ════════════════════ --}}
<div id="dokumen"></div>

@php
$dokGroups = [
    ['data'=>$kajianHukum,      'total'=>$kajianHukumTotal,      'label'=>'Kajian Hukum',      'badge'=>'badge-kajian',   'badgeLabel'=>'Kajian',   'icon'=>'bi-journal-bookmark', 'color'=>'#10b981','route'=>'kajian-hukum.show',       'kategori'=>'kajian'],
    ['data'=>$naskahAkademik,   'total'=>$naskahAkademikTotal,   'label'=>'Naskah Akademik',   'badge'=>'badge-naskah',   'badgeLabel'=>'Naskah',   'icon'=>'bi-file-earmark-text', 'color'=>'#4f46e5','route'=>'naskah-akademik.show',    'kategori'=>'naskah'],
    ['data'=>$analisisEvaluasi, 'total'=>$analisisEvaluasiTotal, 'label'=>'Analisis Evaluasi', 'badge'=>'badge-analisis', 'badgeLabel'=>'Analisis', 'icon'=>'bi-clipboard-data',    'color'=>'#ea580c','route'=>'analisis-evaluasi.show',  'kategori'=>'analisis'],
    ['data'=>$risalahHukum,     'total'=>$risalahHukumTotal,     'label'=>'Risalah Hukum',     'badge'=>'badge-risalah',  'badgeLabel'=>'Risalah',  'icon'=>'bi-journal-richtext',  'color'=>'#7c3aed','route'=>'risalah-hukum.show',      'kategori'=>'risalah'],
    ['data'=>$relaas,           'total'=>$relaasTotal,           'label'=>'Relaas Pengadilan', 'badge'=>'badge-relaas',   'badgeLabel'=>'Relaas',   'icon'=>'bi-bank',              'color'=>'#e11d48','route'=>'relaas.show',             'kategori'=>'relaas','useJudul'=>false],
];
$activeDok = collect($dokGroups)->filter(fn($g) => $g['data']->count() > 0);
@endphp

@if($activeDok->count())
<section class="sec-dokumen">
    <div class="container">
        <div class="dok-header reveal">
            <div class="dok-eyebrow"><i class="bi bi-file-earmark-text"></i> Hukum &amp; Kajian</div>
            <h2 class="dok-title">Dokumen Hukum</h2>
            <p class="dok-sub">Kajian hukum, naskah akademik, analisis evaluasi, risalah, dan dokumen hukum resmi lainnya tersedia untuk publik.</p>
        </div>
        <div class="dok-grid">
            @foreach($activeDok as $gi => $g)
            <div class="dok-col reveal" style="transition-delay:{{ $gi * 0.1 }}s">
                <div class="dok-head">
                    <div class="dok-head-bg" style="--acc:{{ $g['color'] }}"></div>
                    <div class="dok-head-orb"></div>
                    <div class="dok-icon"><i class="bi {{ $g['icon'] }}"></i></div>
                    <div class="dok-info">
                        <div class="dok-label">{{ $g['label'] }}</div>
                        <div class="dok-count">{{ $g['total'] }} dokumen tersedia</div>
                    </div>
                    <a href="{{ url('/daftar/'.$g['kategori']) }}" class="dok-link"><i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="dok-list">
                    @foreach($g['data']->take(4) as $item)
                    <a href="{{ $g['route'] && $item->slug ? route($g['route'],$item->slug) : '#' }}" class="dok-item" style="--acc:{{ $g['color'] }}">
                        <div class="dok-dot"></div>
                        <div class="dok-item-body">
                            <div class="dok-item-title">{{ isset($g['useJudul'])&&!$g['useJudul'] ? ($item->pengumuman ?? 'Relaas') : $item->judul }}</div>
                            <div class="dok-item-meta">
                                <span class="badge {{ $g['badge'] }}" style="font-size:.53rem">{{ $g['badgeLabel'] }}</span>
                                @if(!empty($item->tahun))<span>{{ $item->tahun }}</span>@endif
                                <span>{{ $item->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right dok-item-arr"></i>
                    </a>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ════════════════════ KONTEN & MEDIA ════════════════════ --}}
<div id="media"></div>

@if($artikel->count() || $infografis->count() || $buku->count())
<section class="sec-media">
    <div class="container">
        <div class="sec-header reveal" style="margin-bottom:34px;">
            <div>
                <div class="sec-eyebrow"><i class="bi bi-grid-1x2-fill"></i> Konten</div>
                <h2 class="sec-title">Konten &amp; <em>Media</em></h2>
                <p class="sec-desc">Artikel informatif, infografis menarik, dan koleksi buku dari perpustakaan digital JDIH.</p>
            </div>
            <div style="display:flex;gap:8px;flex-wrap:wrap;">
                @if($artikel->count())<a href="{{ url('/daftar/artikel') }}" class="btn-all btn-all-navy"><i class="bi bi-newspaper"></i> Semua Artikel</a>@endif
                @if($buku->count())<a href="{{ url('/daftar/buku') }}" class="btn-all" style="background:var(--gray-100);color:var(--text)"><i class="bi bi-book"></i> Perpustakaan</a>@endif
            </div>
        </div>
        <div class="media-grid">
            @if($artikel->count())
            <div style="overflow:visible;min-width:0;">
                <div class="blok-head">
                    <span><i class="bi bi-newspaper"></i> Artikel Terkini</span>
                    <button class="sp-trigger" onclick="openPanel('artikel')">Lihat Semua <i class="bi bi-arrow-right"></i></button>
                </div>
                <div class="art-carousel-wrap" id="artCarouselWrap">
                <div class="art-grid" id="artGrid">
                    @foreach($artikel->take(3) as $idx => $item)
                    <a href="{{ $item->slug ? route('artikel.show',$item->slug) : '#' }}" class="art-card {{ $idx===0?'art-featured':'' }}">
                        <div class="art-img">
                            @if(!empty($item->gambar))
                                <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->judul }}" loading="lazy" onerror="this.parentElement.innerHTML='<div class=\'art-ph\'><i class=\'bi bi-newspaper\'></i></div>'">
                            @else
                                <div class="art-ph"><i class="bi bi-newspaper"></i></div>
                            @endif
                            <div class="art-overlay"><span class="badge badge-artikel">Artikel</span></div>
                        </div>
                        <div class="art-body">
                            <div class="art-title">{{ $item->judul }}</div>
                            <div class="art-date"><i class="bi bi-calendar3"></i> {{ $item->created_at->format('d M Y') }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <button class="carousel-mob-nav carousel-mob-prev" id="artPrev" onclick="scrollCarousel('artCarouselWrap',-1)" aria-label="Sebelumnya"><i class="bi bi-chevron-left"></i></button>
                <button class="carousel-mob-nav carousel-mob-next" id="artNext" onclick="scrollCarousel('artCarouselWrap',1)" aria-label="Berikutnya"><i class="bi bi-chevron-right"></i></button>
                </div>{{-- /art-carousel-wrap --}}
            </div>
            @endif

            <div class="blok-side" style="overflow:visible;min-width:0;">
                @if($infografis->count())
                <div>
                    <div class="blok-head">
                        <span><i class="bi bi-image"></i> Infografis</span>
                        <button class="sp-trigger" onclick="openPanel('infografis')">Semua <i class="bi bi-arrow-right"></i></button>
                    </div>
                    <div class="inf-carousel-wrap" id="infCarouselWrap">
                    <div class="inf-grid" id="infGrid">
                        @foreach($infografis->take(4) as $item)
                        <a href="{{ $item->slug ? route('infografis.show',$item->slug) : '#' }}" class="inf-card">
                            <div class="inf-img">
                                @if(!empty($item->file_infografis))
                                    <img src="{{ asset('storage/'.$item->file_infografis) }}" alt="Infografis" loading="lazy" onerror="this.parentElement.innerHTML='<div class=\'inf-ph\'><i class=\'bi bi-image\'></i></div>'">
                                @else
                                    <div class="inf-ph"><i class="bi bi-image"></i></div>
                                @endif
                            </div>
                            <div class="inf-date">{{ $item->created_at->format('d M Y') }}</div>
                        </a>
                        @endforeach
                    </div>
                    <button class="carousel-mob-nav carousel-mob-prev" id="infPrev" onclick="scrollCarousel('infCarouselWrap',-1)" aria-label="Sebelumnya"><i class="bi bi-chevron-left"></i></button>
                    <button class="carousel-mob-nav carousel-mob-next" id="infNext" onclick="scrollCarousel('infCarouselWrap',1)" aria-label="Berikutnya"><i class="bi bi-chevron-right"></i></button>
                    </div>{{-- /inf-carousel-wrap --}}
                </div>
                @endif

                @if($buku->count())
                <div class="buku-section">
                    <div class="blok-head">
                        <span><i class="bi bi-book"></i> Perpustakaan Digital</span>
                        <button class="sp-trigger" onclick="openPanel('buku')">Semua <i class="bi bi-arrow-right"></i></button>
                    </div>
                    <div class="buku-carousel-wrap">
                        <div class="buku-carousel" id="bukuCarousel">
                            @php $coverColors = ['#1a3a8f','#059669','#d97706','#7c3aed','#dc2626','#0891b2','#db2777','#ea580c']; @endphp
                            @foreach($buku->take(12) as $item)
                            <a href="{{ $item->slug ? route('buku.show',$item->slug) : '#' }}" class="buku-card">
                                <div class="buku-cover" style="--cover-color:{{ $coverColors[$loop->index % 8] }}">
                                    @if(!empty($item->cover) || !empty($item->gambar))
                                        <img src="{{ asset('storage/'.($item->cover ?? $item->gambar)) }}"
                                             alt="{{ $item->judul }}" loading="lazy"
                                             onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                        <div class="buku-cover-ph" style="display:none">
                                            <i class="bi bi-book"></i>
                                            <span>{{ Str::limit($item->judul, 40) }}</span>
                                        </div>
                                    @else
                                        <div class="buku-cover-ph">
                                            <i class="bi bi-book"></i>
                                            <span>{{ Str::limit($item->judul, 40) }}</span>
                                        </div>
                                    @endif
                                    <div class="buku-cover-shine"></div>
                                    @if(!empty($item->tahun_terbit))
                                    <div class="buku-year-tag">{{ $item->tahun_terbit }}</div>
                                    @endif
                                </div>
                                <div class="buku-card-body">
                                    <div class="buku-card-title">{{ Str::limit($item->judul, 50) }}</div>
                                    @if(!empty($item->penulis) || !empty($item->pengarang))
                                    <div class="buku-card-author"><i class="bi bi-person"></i> {{ $item->penulis ?? $item->pengarang }}</div>
                                    @endif
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <button class="buku-nav buku-nav-prev" onclick="scrollBuku(-1)" aria-label="Prev">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button class="buku-nav buku-nav-next" onclick="scrollBuku(1)" aria-label="Next">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

{{-- ════════════════════ BERITA ════════════════════ --}}
<div id="berita"></div>

@if($berita->count())
<section class="sec-berita">
    <div class="container" style="position:relative;z-index:1;">
        <div class="berita-header reveal">
            <div>
                <div class="berita-eyebrow"><i class="bi bi-newspaper"></i> Informasi Terkini</div>
                <h2 class="berita-title">Berita &amp; Pengumuman</h2>
            </div>
            <a href="{{ url('/daftar/berita') }}" class="btn-all btn-all-ghost">
                Lihat Semua Berita <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        {{-- ── FEATURED SWIPE SLIDER ── --}}
        @if($berita->count())
        <div class="bfeat-wrap reveal">

            {{-- Tombol navigasi --}}
            <button class="bfeat-nav bfeat-prev" id="bfeatPrev" aria-label="Sebelumnya">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="bfeat-nav bfeat-next" id="bfeatNext" aria-label="Berikutnya">
                <i class="bi bi-chevron-right"></i>
            </button>

            {{-- Track --}}
            <div class="bfeat-track" id="bfeatTrack">
                @foreach($berita->take(7) as $fi)
                <a href="{{ $fi->slug ? route('berita.show',$fi->slug) : '#' }}"
                   class="berita-feat bfeat-slide">
                    <div class="berita-feat-img">
                        @if(!empty($fi->gambar))
                            <img src="{{ asset('storage/'.$fi->gambar) }}" alt="{{ $fi->judul }}" loading="lazy">
                        @else
                            <div class="b-img-ph"><i class="bi bi-newspaper"></i></div>
                        @endif
                        <div class="b-overlay">
                            <span class="b-badge">Berita</span>
                            @if($loop->first)<span class="b-badge b-badge-new">Terbaru</span>@endif
                        </div>
                        <div class="berita-feat-grad"></div>
                        <div class="berita-feat-content">
                            <div class="berita-feat-title">{{ $fi->judul }}</div>
                            <div class="berita-feat-date"><i class="bi bi-calendar3"></i> {{ $fi->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Dots --}}
            <div class="bfeat-dots" id="bfeatDots">
                @foreach($berita->take(7) as $fi)
                <button class="bfeat-dot {{ $loop->first ? 'active' : '' }}" data-idx="{{ $loop->index }}" aria-label="Slide {{ $loop->iteration }}"></button>
                @endforeach
            </div>

            {{-- Progress bar --}}
            <div class="bfeat-progress"><div class="bfeat-progress-bar" id="bfeatBar"></div></div>
        </div>
        @endif

        <script>
        (function(){
            const track   = document.getElementById('bfeatTrack');
            const dotsEl  = document.getElementById('bfeatDots');
            const bar     = document.getElementById('bfeatBar');
            const btnPrev = document.getElementById('bfeatPrev');
            const btnNext = document.getElementById('bfeatNext');
            if(!track) return;

            const slides  = track.querySelectorAll('.bfeat-slide');
            const dots    = dotsEl ? dotsEl.querySelectorAll('.bfeat-dot') : [];
            const total   = slides.length;
            const DELAY   = 4500; // ms per slide
            let cur = 0, timer = null, barTimer = null;
            let dragStartX = 0, dragDiff = 0, isDragging = false;

            function goTo(idx){
                cur = ((idx % total) + total) % total;
                track.style.transform = `translateX(-${cur * 100}%)`;
                dots.forEach((d,i) => d.classList.toggle('active', i === cur));
                startBar();
            }

            function startBar(){
                if(bar){
                    bar.style.transition = 'none';
                    bar.style.width = '0%';
                    requestAnimationFrame(()=>{
                        bar.style.transition = `width ${DELAY}ms linear`;
                        bar.style.width = '100%';
                    });
                }
            }

            function startAuto(){ stopAuto(); timer = setInterval(()=>goTo(cur+1), DELAY); startBar(); }
            function stopAuto(){ clearInterval(timer); if(bar){ bar.style.transition='none'; bar.style.width='0%'; } }

            btnPrev && btnPrev.addEventListener('click',()=>{ goTo(cur-1); stopAuto(); startAuto(); });
            btnNext && btnNext.addEventListener('click',()=>{ goTo(cur+1); stopAuto(); startAuto(); });
            dots.forEach((d,i)=>{ d.addEventListener('click',()=>{ goTo(i); stopAuto(); startAuto(); }); });

            // Touch swipe
            track.addEventListener('touchstart', e=>{ dragStartX=e.changedTouches[0].screenX; stopAuto(); },{passive:true});
            track.addEventListener('touchend',   e=>{ const d=dragStartX-e.changedTouches[0].screenX; if(Math.abs(d)>40) goTo(d>0?cur+1:cur-1); startAuto(); },{passive:true});

            // Mouse drag
            track.addEventListener('mousedown', e=>{ isDragging=true; dragStartX=e.clientX; track.classList.add('dragging'); stopAuto(); e.preventDefault(); });
            document.addEventListener('mousemove', e=>{ if(!isDragging) return; dragDiff=dragStartX-e.clientX; });
            document.addEventListener('mouseup', ()=>{ if(!isDragging) return; isDragging=false; track.classList.remove('dragging'); if(Math.abs(dragDiff)>40) goTo(dragDiff>0?cur+1:cur-1); dragDiff=0; startAuto(); });

            // Pause on hover
            const wrap = document.querySelector('.bfeat-wrap');
            wrap && wrap.addEventListener('mouseenter', stopAuto);
            wrap && wrap.addEventListener('mouseleave', startAuto);

            goTo(0);
            startAuto();
        })();
        </script>

        <div class="berita-ticker-wrap">
            <div class="berita-ticker-label"><i class="bi bi-broadcast"></i> TERKINI</div>
            <div class="berita-ticker-track" id="beritaTicker">
                <div class="berita-ticker-inner" id="beritaTickerInner">
                    @foreach($berita as $item)
                    <a href="{{ $item->slug ? route('berita.show',$item->slug) : '#' }}" class="btick-item">
                        <span class="btick-dot"></span>
                        <span class="btick-title">{{ $item->judul }}</span>
                        <span class="btick-date">{{ $item->created_at->format('d M Y') }}</span>
                    </a>
                    @endforeach
                    @foreach($berita as $item)
                    <a href="{{ $item->slug ? route('berita.show',$item->slug) : '#' }}" class="btick-item" aria-hidden="true">
                        <span class="btick-dot"></span>
                        <span class="btick-title">{{ $item->judul }}</span>
                        <span class="btick-date">{{ $item->created_at->format('d M Y') }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="berita-grid">
            @foreach($berita->skip(1)->take(6) as $item)
            <a href="{{ $item->slug ? route('berita.show',$item->slug) : '#' }}"
               class="berita-grid-card reveal" style="transition-delay:{{ $loop->index * 0.08 }}s">
                <div class="bgc-img">
                    @if(!empty($item->gambar))
                        <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->judul }}"
                             loading="lazy" onerror="this.parentElement.innerHTML='<div class=\'bgc-ph\'><i class=\'bi bi-newspaper\'></i></div>'">
                    @else
                        <div class="bgc-ph"><i class="bi bi-newspaper"></i></div>
                    @endif
                </div>
                <div class="bgc-body">
                    <div class="bgc-title">{{ Str::limit($item->judul, 80) }}</div>
                    <div class="bgc-date"><i class="bi bi-calendar3"></i> {{ $item->created_at->format('d M Y') }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
{{-- ════════════════════ KONTAK ════════════════════ --}}
<section class="sec-kontak">
    <div class="kontak-glow-a"></div>
    <div class="kontak-glow-b"></div>
    <div class="container" style="position:relative;z-index:1;">

        <div class="kontak-header reveal">
            <div class="sec-eyebrow" style="display:inline-flex;margin-bottom:10px;"><i class="bi bi-geo-alt-fill"></i> Hubungi Kami</div>
            <h2 class="sec-title" style="color:var(--white)">Informasi <em>Kontak</em></h2>
            <p class="sec-desc" style="color:rgba(255,255,255,.65);max-width:520px;margin:10px auto 0;">
                Kami siap membantu kebutuhan dokumentasi dan informasi hukum Anda.
            </p>
        </div>

        {{-- Layout: kiri = Alamat+Map (row span 2), kanan = 2x2 grid --}}
        <div class="kontak-layout">

            {{-- Card Alamat + Map — tinggi 2 baris --}}
            <div class="kontak-card kontak-card-alamat reveal">
                <div class="kca-info">
                    <div class="kontak-card-icon" style="--ic:#1a3a8f;--ic2:#0d2255"><i class="bi bi-geo-alt-fill"></i></div>
                    <div class="kontak-card-body">
                        <div class="kontak-card-label">Alamat</div>
                        <div class="kontak-card-val">Lt.1 Gedung Kantor Bupati<br>Jl. Sutan Alam Bagagarsyah<br>Pagaruyung, Batusangkar</div>
                    </div>
                </div>
                <div class="kca-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d123.0!2d100.6242135!3d-0.4745223!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2ad33f8eef8d4b%3A0x5e9d5fd60300ad98!2sDinas+Komunikasi+dan+Informatika+Kabupaten+Tanah+Datar!5e0!3m2!1sid!2sid!4v1741000000001!5m2!1sid!2sid"
                        width="100%" height="100%"
                        style="border:0;display:block;filter:invert(88%) hue-rotate(180deg) saturate(0.85) brightness(0.9);"
                        allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="kontak-card-shine"></div>
            </div>

            {{-- 4 card kanan dalam sub-grid 2x2 --}}
            <div class="kontak-right-grid">

                {{-- Telepon --}}
                <div class="kontak-card reveal">
                    <div class="kontak-card-icon" style="--ic:#065f46;--ic2:#047857"><i class="bi bi-telephone-fill"></i></div>
                    <div class="kontak-card-body">
                        <div class="kontak-card-label">Telepon</div>
                        <div class="kontak-card-val"><a href="tel:075271201" class="kontak-link">0752 71201</a></div>
                    </div>
                    <div class="kontak-card-shine"></div>
                </div>

                {{-- Fax --}}
                <div class="kontak-card reveal">
                    <div class="kontak-card-icon" style="--ic:#7c2d12;--ic2:#9a3412"><i class="bi bi-printer-fill"></i></div>
                    <div class="kontak-card-body">
                        <div class="kontak-card-label">Fax</div>
                        <div class="kontak-card-val">0752 71201</div>
                    </div>
                    <div class="kontak-card-shine"></div>
                </div>

                {{-- Email --}}
                <div class="kontak-card reveal">
                    <div class="kontak-card-icon" style="--ic:#4c1d95;--ic2:#6d28d9"><i class="bi bi-envelope-fill"></i></div>
                    <div class="kontak-card-body">
                        <div class="kontak-card-label">Email</div>
                        <div class="kontak-card-val"><a href="mailto:hukumtanahdatar@gmail.com" class="kontak-link">hukumtanahdatar@gmail.com</a></div>
                    </div>
                    <div class="kontak-card-shine"></div>
                </div>

                {{-- Jam Operasional --}}
                <div class="kontak-card reveal">
                    <div class="kontak-card-icon" style="--ic:#78350f;--ic2:#92400e"><i class="bi bi-clock-fill"></i></div>
                    <div class="kontak-card-body">
                        <div class="kontak-card-label">Jam Operasional</div>
                        <div class="kontak-card-val">Senin – Jumat<br>08.00 – 16.00 WIB</div>
                    </div>
                    <div class="kontak-card-shine"></div>
                </div>

            </div>{{-- .kontak-right-grid --}}

        </div>{{-- .kontak-layout --}}


    </div>
</section>

{{-- ════════════════════ SLIDE PANELS ════════════════════ --}}

{{-- Overlay --}}
<div class="slide-panel-overlay" id="spOverlay" onclick="closePanel()"></div>

{{-- Panel: Artikel --}}
<div class="slide-panel" id="sp-artikel">
    <div class="sp-header">
        <div class="sp-header-left">
            <div class="sp-header-icon"><i class="bi bi-newspaper"></i></div>
            <div>
                <div class="sp-title">Artikel Terkini</div>
                <div class="sp-subtitle">Artikel informatif seputar hukum daerah</div>
            </div>
        </div>
        <button class="sp-close" onclick="closePanel()"><i class="bi bi-x-lg"></i></button>
    </div>
    <div class="sp-body">
        @forelse($artikel as $item)
        <a href="{{ $item->slug ? route('artikel.show',$item->slug) : '#' }}" class="sp-art-card">
            <div class="sp-art-img">
                @if(!empty($item->gambar))
                    <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->judul }}" loading="lazy"
                         onerror="this.parentElement.innerHTML='<div class=\'sp-art-ph\'><i class=\'bi bi-newspaper\'></i></div>'">
                @else
                    <div class="sp-art-ph"><i class="bi bi-newspaper"></i></div>
                @endif
            </div>
            <div class="sp-art-body">
                <div class="sp-art-title">{{ $item->judul }}</div>
                <div class="sp-art-date"><i class="bi bi-calendar3"></i> {{ $item->created_at->format('d M Y') }}</div>
            </div>
        </a>
        @empty
        <p style="text-align:center;color:var(--gray-500);padding:32px 0;font-size:.84rem;">Belum ada artikel</p>
        @endforelse
    </div>
    <div class="sp-footer">
        <a href="{{ url('/daftar/artikel') }}"><i class="bi bi-arrow-right"></i> Lihat Semua Artikel</a>
    </div>
</div>

{{-- Panel: Infografis --}}
<div class="slide-panel" id="sp-infografis">
    <div class="sp-header">
        <div class="sp-header-left">
            <div class="sp-header-icon"><i class="bi bi-image"></i></div>
            <div>
                <div class="sp-title">Infografis</div>
                <div class="sp-subtitle">Visual informasi hukum menarik</div>
            </div>
        </div>
        <button class="sp-close" onclick="closePanel()"><i class="bi bi-x-lg"></i></button>
    </div>
    <div class="sp-body">
        @forelse($infografis as $item)
        <div style="margin-bottom:16px;">
        <a href="{{ $item->slug ? route('infografis.show',$item->slug) : '#' }}" class="sp-inf-card" style="display:block;">
            <div class="sp-inf-img">
                @if(!empty($item->file_infografis))
                    <img src="{{ asset('storage/'.$item->file_infografis) }}" alt="Infografis" loading="lazy"
                         onerror="this.parentElement.innerHTML='<div class=\'sp-inf-ph\'><i class=\'bi bi-image\'></i></div>'">
                @else
                    <div class="sp-inf-ph"><i class="bi bi-image"></i></div>
                @endif
            </div>
            <div class="sp-inf-date">{{ $item->created_at->format('d M Y') }}</div>
        </a>
        </div>
        @empty
        <p style="text-align:center;color:var(--gray-500);padding:32px 0;font-size:.84rem;">Belum ada infografis</p>
        @endforelse
    </div>
    <div class="sp-footer">
        <a href="{{ url('/daftar/infografis') }}"><i class="bi bi-arrow-right"></i> Lihat Semua Infografis</a>
    </div>
</div>

{{-- Panel: Buku --}}
<div class="slide-panel" id="sp-buku">
    <div class="sp-header">
        <div class="sp-header-left">
            <div class="sp-header-icon"><i class="bi bi-book"></i></div>
            <div>
                <div class="sp-title">Perpustakaan Digital</div>
                <div class="sp-subtitle">Koleksi buku hukum daerah</div>
            </div>
        </div>
        <button class="sp-close" onclick="closePanel()"><i class="bi bi-x-lg"></i></button>
    </div>
    <div class="sp-body">
        @php $spCoverColors = ['#1a3a8f','#059669','#d97706','#7c3aed','#dc2626','#0891b2','#db2777','#ea580c']; @endphp
        @forelse($buku as $idx => $item)
        <a href="{{ $item->slug ? route('buku.show',$item->slug) : '#' }}" class="sp-buku-card">
            <div class="sp-buku-cover" style="background:{{ $spCoverColors[$idx % 8] }}">
                @if(!empty($item->cover) || !empty($item->gambar))
                    <img src="{{ asset('storage/'.($item->cover ?? $item->gambar)) }}" alt="{{ $item->judul }}"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                    <i class="bi bi-book" style="display:none"></i>
                @else
                    <i class="bi bi-book"></i>
                @endif
            </div>
            <div class="sp-buku-body">
                <div class="sp-buku-title">{{ $item->judul }}</div>
                <div class="sp-buku-meta">
                    <span class="badge badge-buku" style="font-size:.52rem">Buku</span>
                    @if(!empty($item->tahun_terbit))<span>{{ $item->tahun_terbit }}</span>@endif
                </div>
            </div>
        </a>
        @empty
        <p style="text-align:center;color:var(--gray-500);padding:32px 0;font-size:.84rem;">Belum ada buku</p>
        @endforelse
    </div>
    <div class="sp-footer">
        <a href="{{ url('/daftar/buku') }}"><i class="bi bi-arrow-right"></i> Lihat Semua Buku</a>
    </div>
</div>

<script>
// ════ SCROLL CAROUSEL UNIVERSAL (Artikel & Infografis) ════
function scrollCarousel(wrapId, dir) {
    const wrap = document.getElementById(wrapId);
    if (!wrap) return;
    const card = wrap.querySelector('.art-card, .inf-card');
    const cardW = card ? card.offsetWidth + 12 : 200;
    wrap.scrollBy({ left: dir * cardW, behavior: 'smooth' });
    setTimeout(() => updateCarouselBtns(wrapId), 350);
}

function updateCarouselBtns(wrapId) {
    const wrap = document.getElementById(wrapId);
    if (!wrap) return;
    const prefix = wrapId === 'artCarouselWrap' ? 'art' : 'inf';
    const prev = document.getElementById(prefix + 'Prev');
    const next = document.getElementById(prefix + 'Next');
    if (prev) prev.style.opacity = wrap.scrollLeft <= 4 ? '.35' : '1';
    if (next) next.style.opacity = wrap.scrollLeft >= wrap.scrollWidth - wrap.clientWidth - 4 ? '.35' : '1';
}

['artCarouselWrap', 'infCarouselWrap'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.addEventListener('scroll', () => updateCarouselBtns(id), { passive: true });
});

// ════ SLIDE PANEL ════
let currentPanel = null;

function openPanel(type) {
    closePanel(false);
    const panel = document.getElementById('sp-' + type);
    const overlay = document.getElementById('spOverlay');
    if (!panel) return;
    currentPanel = panel;
    overlay.classList.add('open');
    panel.classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closePanel(restore = true) {
    const overlay = document.getElementById('spOverlay');
    document.querySelectorAll('.slide-panel.open').forEach(p => p.classList.remove('open'));
    overlay.classList.remove('open');
    if (restore) document.body.style.overflow = '';
    currentPanel = null;
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && currentPanel) closePanel();
});
</script>