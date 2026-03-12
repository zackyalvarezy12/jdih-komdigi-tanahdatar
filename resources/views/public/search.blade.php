<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian "{{ $q }}" — JDIH Kominfo Tanah Datar</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{--navy:#0b1f4a;--navy-light:#1a3a8f;--gold:#c8960c;--gold-light:#f0b429;--cream:#f8f7f4;--white:#fff;--gray-50:#f9fafb;--gray-100:#f3f4f6;--gray-200:#e5e7eb;--gray-300:#d1d5db;--gray-500:#6b7280;--text:#111827;--text-soft:#4b5563;--r-sm:8px;--r:14px;--transition:all .22s cubic-bezier(.4,0,.2,1);}
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        html{scroll-behavior:smooth;}
        body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--cream);color:var(--text);line-height:1.6;}
        ::-webkit-scrollbar{width:5px;}::-webkit-scrollbar-thumb{background:var(--navy-light);border-radius:10px;}

        .topbar{background:var(--navy);color:rgba(255,255,255,.5);font-size:.7rem;font-weight:600;letter-spacing:.08em;text-transform:uppercase;padding:7px 0;text-align:center;}
        .navbar-main{background:rgba(255,255,255,.97);backdrop-filter:blur(16px);border-bottom:1px solid var(--gray-200);position:sticky;top:0;z-index:1000;box-shadow:0 2px 20px rgba(11,31,74,.06);}
        .navbar-inner{display:flex;align-items:center;justify-content:space-between;height:64px;gap:16px;}
        .brand{display:flex;align-items:center;gap:12px;text-decoration:none;}
        .brand-logo{width:40px;height:40px;background:linear-gradient(135deg,var(--navy),var(--navy-light));border-radius:11px;overflow:hidden;display:flex;align-items:center;justify-content:center;}
        .brand-logo img{width:100%;height:100%;object-fit:contain;padding:5px;}
        .brand-name{font-size:.92rem;font-weight:700;color:var(--navy);line-height:1.2;}
        .brand-name em{color:var(--gold);font-style:normal;}
        .brand-sub{font-size:.62rem;color:var(--gray-500);}
        .nav-back{display:inline-flex;align-items:center;gap:6px;color:var(--navy);text-decoration:none;font-size:.82rem;font-weight:700;padding:7px 16px;border:1.5px solid rgba(11,31,74,.2);border-radius:var(--r-sm);transition:var(--transition);}
        .nav-back:hover{background:var(--navy);color:var(--white);}

        /* SEARCH BAR */
        .search-wrap{padding:32px 0 24px;background:linear-gradient(135deg,var(--navy) 0%,var(--navy-light) 100%);position:relative;overflow:hidden;}
        .search-wrap::before{content:'';position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,.05) 1px,transparent 1px);background-size:24px 24px;}
        .search-inner{position:relative;z-index:1;}
        .search-title{color:rgba(255,255,255,.6);font-size:.78rem;font-weight:600;margin-bottom:12px;}
        .search-title strong{color:var(--gold-light);}
        .sbox{display:flex;align-items:center;background:rgba(255,255,255,.97);border-radius:var(--r);overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,.18);}
        .sbox i{padding:0 14px 0 18px;color:var(--gray-500);font-size:1rem;}
        .sbox input{flex:1;border:none;background:transparent;padding:14px 8px;font-size:.93rem;font-family:inherit;outline:none;color:var(--text);}
        .sbox button{background:var(--navy);color:var(--white);border:none;padding:14px 26px;font-size:.84rem;font-weight:700;font-family:inherit;cursor:pointer;transition:.2s;white-space:nowrap;}
        .sbox button:hover{background:var(--navy-light);}

        /* RESULTS */
        .results-wrap{padding:32px 0 52px;}
        .results-meta{display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:8px;}
        .results-count{font-size:.82rem;color:var(--gray-500);}
        .results-count strong{color:var(--text);}

        /* RESULT CARD */
        .result-card{display:flex;align-items:flex-start;gap:14px;background:var(--white);border:1.5px solid var(--gray-200);border-radius:var(--r);padding:16px 18px;margin-bottom:10px;text-decoration:none;color:inherit;transition:var(--transition);position:relative;overflow:hidden;}
        .result-card::after{content:'';position:absolute;left:0;top:0;bottom:0;width:3px;background:linear-gradient(180deg,var(--navy),var(--navy-light));transform:scaleY(0);transform-origin:top;transition:transform .3s ease;}
        .result-card:hover{border-color:rgba(11,31,74,.18);box-shadow:0 6px 24px rgba(11,31,74,.1);transform:translateX(3px);color:inherit;}
        .result-card:hover::after{transform:scaleY(1);}
        .result-icon{width:40px;height:40px;border-radius:10px;background:linear-gradient(135deg,var(--navy),var(--navy-light));display:flex;align-items:center;justify-content:center;color:var(--gold-light);font-size:.95rem;flex-shrink:0;}
        .result-body{flex:1;min-width:0;}
        .result-meta{display:flex;align-items:center;gap:6px;margin-bottom:6px;flex-wrap:wrap;}
        .result-title{font-size:.9rem;font-weight:600;color:var(--text);line-height:1.5;margin-bottom:4px;}
        .result-title mark{background:#fef9c3;border-radius:3px;padding:0 2px;}
        .result-info{font-size:.7rem;color:var(--gray-500);display:flex;align-items:center;gap:10px;}
        .result-arrow{color:var(--gray-300);font-size:.85rem;flex-shrink:0;transition:var(--transition);}
        .result-card:hover .result-arrow{color:var(--navy);transform:translateX(3px);}
        .bc{font-size:.6rem;font-weight:700;padding:3px 9px;border-radius:5px;text-transform:uppercase;letter-spacing:.04em;}
        .bc-perda{background:#dbeafe;color:#1e3a8a;}.bc-perbupati{background:#dcfce7;color:#14532d;}
        .bc-kepbupati{background:#fef9c3;color:#713f12;}.bc-insbupati{background:#fee2e2;color:#7f1d1d;}
        .bc-propemda{background:#ede9fe;color:#4c1d95;}.bc-kerjasama{background:#cffafe;color:#164e63;}
        .bc-terjemah{background:#fce7f3;color:#831843;}.bc-ranpuu{background:#ffedd5;color:#7c2d12;}
        .bc-kajian{background:#d1fae5;color:#064e3b;}.bc-naskah{background:#e0e7ff;color:#312e81;}
        .bc-analisis{background:#fff7ed;color:#9a3412;}.bc-risalah{background:#faf5ff;color:#581c87;}
        .bc-relaas{background:#fef2f2;color:#7f1d1d;}.bc-artikel{background:#ecfdf5;color:#064e3b;}
        .bc-buku{background:#f0fdf4;color:#14532d;}.bc-berita{background:#eff6ff;color:#1e40af;}

        .empty-state{text-align:center;padding:72px 20px;}
        .empty-state i{font-size:3rem;color:var(--gray-300);display:block;margin-bottom:14px;}
        .empty-state h5{color:var(--gray-500);font-size:1rem;font-weight:600;margin-bottom:6px;}
        .empty-state p{color:var(--gray-500);font-size:.84rem;margin-bottom:20px;}
        .btn-home{display:inline-flex;align-items:center;gap:6px;background:var(--navy);color:var(--white);text-decoration:none;padding:10px 22px;border-radius:var(--r-sm);font-size:.84rem;font-weight:700;transition:var(--transition);}
        .btn-home:hover{background:var(--navy-light);color:var(--white);}

        footer{background:var(--navy);padding:20px 0;}
        .footer-bottom{display:flex;justify-content:space-between;flex-wrap:wrap;gap:8px;font-size:.71rem;color:rgba(255,255,255,.3);}
        .footer-bottom a{color:rgba(255,255,255,.3);text-decoration:none;}
        .footer-bottom a:hover{color:var(--gold-light);}
    </style>
</head>
<body>

<div class="topbar">
    <i class="bi bi-shield-check"></i> Pemerintah Daerah Kabupaten Tanah Datar
    <span style="color:var(--gold-light);margin:0 10px">·</span>
    Jaringan Dokumentasi &amp; Informasi Hukum
</div>

<nav class="navbar-main">
    <div class="container">
        <div class="navbar-inner">
            <a href="{{ url('/') }}" class="brand">
                <div class="brand-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="JDIH Logo"
                         onerror="this.style.display='none'">
                </div>
                <div>
                    <div class="brand-name">JDIH <em>Kominfo</em> Tanah Datar</div>
                    <div class="brand-sub">Jaringan Dokumentasi &amp; Informasi Hukum</div>
                </div>
            </a>
            <a href="{{ url('/') }}" class="nav-back"><i class="bi bi-arrow-left"></i> Beranda</a>
        </div>
    </div>
</nav>

<div class="search-wrap">
    <div class="container search-inner">
        <div class="search-title">
            Hasil pencarian untuk <strong>"{{ $q }}"</strong>
        </div>
        <form method="GET" action="{{ url('/cari') }}">
            <div class="sbox">
                <i class="bi bi-search"></i>
                <input type="text" name="q" value="{{ $q }}" placeholder="Cari dokumen hukum...">
                <button type="submit"><i class="bi bi-search"></i> Cari</button>
            </div>
        </form>
    </div>
</div>

<div class="results-wrap">
    <div class="container">
        @if($total > 0)
        <div class="results-meta">
            <span class="results-count">Ditemukan <strong>{{ $total }}</strong> hasil untuk "<strong>{{ $q }}</strong>"</span>
        </div>

        @php
        $iconMap = [
            'bc-perda'=>'bi-file-earmark-ruled','bc-perbupati'=>'bi-file-earmark-check',
            'bc-kepbupati'=>'bi-file-earmark-lock','bc-insbupati'=>'bi-file-earmark-arrow-down',
            'bc-propemda'=>'bi-list-task','bc-kerjasama'=>'bi-handshake',
            'bc-terjemah'=>'bi-translate','bc-ranpuu'=>'bi-file-earmark-diff',
            'bc-kajian'=>'bi-journal-bookmark','bc-naskah'=>'bi-file-earmark-text',
            'bc-analisis'=>'bi-clipboard-data','bc-risalah'=>'bi-journal-richtext',
            'bc-relaas'=>'bi-bank','bc-artikel'=>'bi-newspaper',
            'bc-buku'=>'bi-book','bc-berita'=>'bi-newspaper',
        ];
        @endphp

        @foreach($results as $r)
        @php
            $icon = $iconMap[$r['badge']] ?? 'bi-file-earmark';
            // Highlight kata kunci dalam judul
            $highlighted = preg_replace('/('.preg_quote($q,'/').')/iu', '<mark>$1</mark>', e($r['judul']));
        @endphp
        <a href="{{ $r['url'] }}" class="result-card">
            <div class="result-icon"><i class="bi {{ $icon }}"></i></div>
            <div class="result-body">
                <div class="result-meta">
                    <span class="bc {{ $r['badge'] }}">{{ $r['badgeLabel'] }}</span>
                    @if($r['tahun'])<span style="font-size:.65rem;color:var(--gray-500);background:var(--gray-100);padding:2px 7px;border-radius:4px;">{{ $r['tahun'] }}</span>@endif
                </div>
                <div class="result-title">{!! $highlighted !!}</div>
                <div class="result-info">
                    <span><i class="bi bi-collection"></i> {{ $r['label'] }}</span>
                    @if($r['tanggal'])<span><i class="bi bi-calendar3"></i> {{ $r['tanggal'] }}</span>@endif
                </div>
            </div>
            <i class="bi bi-arrow-right result-arrow"></i>
        </a>
        @endforeach

        @else
        <div class="empty-state">
            <i class="bi bi-search"></i>
            <h5>Tidak ada hasil ditemukan</h5>
            <p>Tidak ditemukan dokumen yang cocok dengan <strong>"{{ $q }}"</strong>.<br>Coba kata kunci yang berbeda atau lebih umum.</p>
            <a href="{{ url('/') }}" class="btn-home"><i class="bi bi-house"></i> Kembali ke Beranda</a>
        </div>
        @endif
    </div>
</div>

<footer>
    <div class="container">
        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} JDIH Kominfo Kabupaten Tanah Datar</span>
            <a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>