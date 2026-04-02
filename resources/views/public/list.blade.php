<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} — JDIH Kominfo Tanah Datar</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-jdih.css') }}">
</head>
<body>

<div class="topbar">
    <i class="bi bi-shield-check"></i>
    Pemerintah Daerah Kabupaten Tanah Datar
    <span class="sep">·</span>
    Jaringan Dokumentasi &amp; Informasi Hukum
</div>

<nav class="navbar-main">
    <div class="container">
        <div class="navbar-inner">
            <a href="{{ url('/') }}" class="brand">
                <div class="brand-logo" style="overflow:hidden;padding:0"><img src="{{ asset('images/logo.png') }}" alt="JDIH Logo" style="width:100%;height:100%;object-fit:contain;padding:5px" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'"><span style="display:none;font-family:'Playfair Display',serif;font-weight:700;font-size:1rem;color:#f0b429;align-items:center;justify-content:center;width:100%;height:100%">JD</span></div>
                <div>
                    <div class="brand-name">JDIH <em>Kominfo</em> Tanah Datar</div>
                    <div class="brand-sub">Jaringan Dokumentasi &amp; Informasi Hukum</div>
                </div>
            </a>
            <a href="{{ url('/') }}" class="nav-back"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
        </div>
    </div>
</nav>

<div class="page-header">
    <div class="container ph-inner">
        <div class="ph-breadcrumb">
            <a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a>
            <span class="sep"><i class="bi bi-chevron-right"></i></span>
            @if(isset($group))<a href="{{ url('/') }}#{{ strtolower(str_replace(' ','',$group)) }}">{{ $group }}</a><span class="sep"><i class="bi bi-chevron-right"></i></span>@endif
            <span class="cur">{{ $title }}</span>
        </div>
        <div class="ph-icon"><i class="bi {{ $icon ?? 'bi-file-earmark' }}"></i></div>
        <h1>{{ $title }}</h1>
        <p>Daftar lengkap {{ strtolower($title) }} Kabupaten Tanah Datar</p>
        <div class="ph-badge">
            <i class="bi bi-collection"></i>
            {{ $items->total() }} Dokumen tersedia
        </div>
    </div>
</div>

<div class="filter-bar">
    <div class="container">
        <form method="GET" action="">
            <div class="filter-inner">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari {{ strtolower($title) }}...">
                </div>
                @if(isset($withTahun) && $withTahun)
                <select name="tahun" class="filter-select">
                    <option value="">Semua Tahun</option>
                    @for($y = date('Y'); $y >= 2000; $y--)
                        <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
                @endif
                <button type="submit" class="btn-search"><i class="bi bi-search"></i> Cari</button>
                @if(request()->hasAny(['q','tahun']))
                <a href="{{ url()->current() }}" class="btn-reset"><i class="bi bi-x-circle"></i> Reset</a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="list-wrap">
    <div class="container">
        @if($items->count())
        <div class="result-bar">
            <span class="result-text">
                @if(request('q'))Hasil untuk <strong>"{{ request('q') }}"</strong> — @endif
                Menampilkan <strong>{{ $items->firstItem() }}–{{ $items->lastItem() }}</strong> dari <strong>{{ $items->total() }}</strong> dokumen
            </span>
            <span class="result-pages">Halaman {{ $items->currentPage() }} / {{ $items->lastPage() }}</span>
        </div>

        @if($typeKey === 'infografis')
        {{-- INFOGRAFIS: GRID 4 KOLOM --}}
        <div class="row g-3">
            @foreach($items as $item)
            <div class="col-6 col-sm-4 col-lg-3">
                <a href="{{ $item->slug ? route('infografis.show',$item->slug) : '#' }}" class="card-infografis">
                    <div class="img-box">
                        @if($item->file_infografis)
                            <img src="{{ asset('storage/'.$item->file_infografis) }}" alt="Infografis" loading="lazy">
                        @else<div class="img-ph"><i class="bi bi-image"></i></div>@endif
                    </div>
                    <div class="inf-lbl"><i class="bi bi-image" style="color:var(--gold)"></i> Infografis #{{ $item->id }}</div>
                </a>
            </div>
            @endforeach
        </div>

        @else
        {{-- SEMUA KATEGORI LAIN: GRID 3 KOLOM --}}
        <div class="row g-3">
            @foreach($items as $item)
            <div class="col-sm-6 col-lg-4">
                @php
                    $routeMap = [
                        'perda'=>'perda.show','perbupati'=>'perbupati.show','kepbupati'=>'kepbupati.show',
                        'insbupati'=>'insbupati.show','propemda'=>'propemda.show','kerjasama'=>'kerjasama.show',
                        'ranpuu'=>'rancangan-puu.show','kajian'=>'kajian-hukum.show','naskah'=>'naskah-akademik.show',
                        'analisis'=>'analisis-evaluasi.show','risalah'=>'risalah-hukum.show','relaas'=>'relaas.show',
                        'artikel'=>'artikel.show','buku'=>'buku.show','berita'=>'berita.show',
                        'perterjemah'=>null,
                    ];
                    $rn = $routeMap[$typeKey] ?? null;
                    $url = $item->slug ? ($rn ? route($rn,$item->slug) : url('/peraturan-terjemah/'.$item->slug)) : '#';
                @endphp
                @if($typeKey === 'buku')
                {{-- BUKU: card horizontal cover kiri + info kanan --}}
                @php $coverImg = $item->cover ?? $item->gambar ?? null; @endphp
                <a href="{{ $url }}" class="card-doc-buku">
                    <div class="card-buku-cover">
                        @if($coverImg)
                            <img src="{{ asset('storage/'.$coverImg) }}" alt="{{ $item->judul }}" loading="lazy"
                                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div class="card-buku-ph" style="display:none">
                                <i class="bi bi-book"></i>
                                <span>{{ Str::limit($item->judul,25) }}</span>
                            </div>
                        @else
                            <div class="card-buku-ph">
                                <i class="bi bi-book"></i>
                                <span>{{ Str::limit($item->judul,25) }}</span>
                            </div>
                        @endif
                        <div class="card-buku-shine"></div>
                    </div>
                    <div class="card-buku-body">
                        <div class="card-meta">
                            <span class="bc {{ $badgeClass }}">{{ $badgeLabel }}</span>
                            @if(!empty($item->tahun_terbit))<span class="meta-tag">{{ $item->tahun_terbit }}</span>@endif
                        </div>
                        @if(!empty($item->penulis) || !empty($item->pengarang))
                        <div class="card-buku-author">
                            <i class="bi bi-person"></i>
                            {{ $item->penulis ?? $item->pengarang }}
                        </div>
                        @endif
                        <div class="card-title">
                            {{ $item->judul ?? 'Buku #'.$item->id }}
                        </div>
                        <div class="card-foot">
                            <span class="card-date"><i class="bi bi-calendar3"></i> {{ $item->created_at->format('d M Y') }}</span>
                            <span class="card-arrow"><i class="bi bi-arrow-right"></i></span>
                        </div>
                    </div>
                </a>
                @else
                <a href="{{ $url }}" class="card-doc">
                    @if(in_array($typeKey,['artikel','berita']))
                    <div class="card-img-wrap">
                        @if(!empty($item->gambar))<img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->judul }}" loading="lazy">
                        @else<div class="card-img-ph"><i class="bi {{ $icon ?? 'bi-file-earmark' }}"></i></div>@endif
                    </div>
                    @endif
                    <div class="card-meta">
                        <span class="bc {{ $badgeClass }}">{{ $badgeLabel }}</span>
                        @if(!empty($item->tahun))<span class="meta-tag">{{ $item->tahun }}</span>@endif
                        @if(!empty($item->tahun_terbit))<span class="meta-tag">{{ $item->tahun_terbit }}</span>@endif
                        @if(!empty($item->nomor))<span class="meta-tag">No. {{ $item->nomor }}</span>@endif
                        @if(!empty($item->type_dokumen))<span class="meta-tag">{{ $item->type_dokumen }}</span>@endif
                    </div>
                    <div class="card-title">
                        {{ $item->judul ?? $item->pengumuman ?? 'Dokumen #'.$item->id }}
                    </div>
                    <div class="card-foot">
                        <span class="card-date"><i class="bi bi-calendar3"></i> {{ $item->created_at->format('d M Y') }}</span>
                        <span class="card-arrow"><i class="bi bi-arrow-right"></i></span>
                    </div>
                </a>
                @endif
            </div>
            @endforeach
        </div>
        @endif

        <div class="pagi-wrap">{{ $items->appends(request()->query())->links() }}</div>

        @else
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <h5>Belum Ada Dokumen</h5>
            <p>
                @if(request('q'))
                    Tidak ditemukan hasil untuk <strong>"{{ request('q') }}"</strong>. Coba kata kunci lain.
                @else
                    Dokumen {{ strtolower($title) }} belum tersedia saat ini.
                @endif
            </p>
            @if(request('q'))<a href="{{ url()->current() }}"><i class="bi bi-arrow-counterclockwise"></i> Lihat Semua</a>@endif
        </div>
        @endif
    </div>
</div>

<footer>
    <div class="container">
        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} JDIH Kominfo Kabupaten Tanah Datar</span>
            <a href="{{ url('/') }}"><i class="bi bi-house"></i> Kembali ke Beranda</a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>