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
    <style>
        :root{--navy:#0b1f4a;--navy-light:#1a3a8f;--gold:#c8960c;--gold-light:#f0b429;--cream:#f8f7f4;--white:#fff;--gray-50:#f9fafb;--gray-100:#f3f4f6;--gray-200:#e5e7eb;--gray-300:#d1d5db;--gray-500:#6b7280;--text:#111827;--text-soft:#4b5563;--radius-sm:8px;--radius:14px;--shadow:0 4px 16px rgba(11,31,74,.09);--shadow-lg:0 12px 40px rgba(11,31,74,.15);--transition:all .22s cubic-bezier(.4,0,.2,1);}
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        html{scroll-behavior:smooth;}
        body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--cream);color:var(--text);line-height:1.6;}
        ::-webkit-scrollbar{width:5px;}::-webkit-scrollbar-track{background:var(--gray-100);}::-webkit-scrollbar-thumb{background:var(--navy-light);border-radius:10px;}

        .topbar{background:var(--navy);color:rgba(255,255,255,.5);font-size:.7rem;font-weight:600;letter-spacing:.08em;text-transform:uppercase;padding:7px 0;text-align:center;}
        .topbar .sep{color:var(--gold-light);margin:0 10px;}

        .navbar-main{background:rgba(255,255,255,.97);backdrop-filter:blur(16px);border-bottom:1px solid var(--gray-200);position:sticky;top:0;z-index:1000;box-shadow:0 2px 20px rgba(11,31,74,.06);}
        .navbar-inner{display:flex;align-items:center;justify-content:space-between;height:64px;gap:16px;}
        .brand{display:flex;align-items:center;gap:12px;text-decoration:none;flex-shrink:0;}
        .brand-logo{width:40px;height:40px;background:linear-gradient(135deg,var(--navy),var(--navy-light));border-radius:11px;display:flex;align-items:center;justify-content:center;font-family:'Playfair Display',serif;font-weight:700;font-size:1rem;color:var(--gold-light);}
        .brand-name{font-size:.92rem;font-weight:700;color:var(--navy);line-height:1.2;}
        .brand-name em{color:var(--gold);font-style:normal;}
        .brand-sub{font-size:.62rem;color:var(--gray-500);font-weight:500;}
        .nav-back{display:inline-flex;align-items:center;gap:6px;color:var(--navy);text-decoration:none;font-size:.82rem;font-weight:700;padding:7px 16px;border:1.5px solid rgba(11,31,74,.2);border-radius:var(--radius-sm);transition:var(--transition);}
        .nav-back:hover{background:var(--navy);color:var(--white);border-color:var(--navy);}

        /* PAGE HEADER */
        .page-header{background:linear-gradient(135deg,var(--navy) 0%,var(--navy-light) 100%);padding:44px 0 38px;position:relative;overflow:hidden;}
        .page-header::before{content:'';position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,.05) 1px,transparent 1px);background-size:24px 24px;}
        .page-header::after{content:'';position:absolute;top:-80px;right:-60px;width:360px;height:360px;background:radial-gradient(circle,rgba(200,150,12,.13) 0%,transparent 65%);pointer-events:none;}
        .ph-inner{position:relative;z-index:1;}
        .ph-breadcrumb{display:flex;align-items:center;gap:7px;margin-bottom:16px;flex-wrap:wrap;}
        .ph-breadcrumb a{color:rgba(255,255,255,.5);text-decoration:none;font-size:.73rem;font-weight:600;transition:var(--transition);}
        .ph-breadcrumb a:hover{color:var(--gold-light);}
        .ph-breadcrumb .sep{color:rgba(255,255,255,.2);font-size:.65rem;}
        .ph-breadcrumb .cur{color:rgba(255,255,255,.75);font-size:.73rem;font-weight:600;}
        .ph-icon{width:54px;height:54px;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;color:var(--gold-light);margin-bottom:14px;}
        .page-header h1{font-family:'Playfair Display',serif;font-size:clamp(1.6rem,3.5vw,2.4rem);font-weight:700;color:var(--white);margin-bottom:6px;}
        .page-header p{color:rgba(255,255,255,.55);font-size:.86rem;}
        .ph-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:20px;padding:5px 14px;color:var(--gold-light);font-size:.7rem;font-weight:700;margin-top:14px;}

        /* FILTER */
        .filter-bar{background:var(--white);border-bottom:1px solid var(--gray-200);padding:14px 0;box-shadow:0 2px 8px rgba(11,31,74,.04);}
        .filter-inner{display:flex;align-items:center;gap:8px;flex-wrap:wrap;}
        .search-box{flex:1;min-width:200px;display:flex;align-items:center;background:var(--gray-50);border:1.5px solid var(--gray-200);border-radius:var(--radius-sm);overflow:hidden;transition:var(--transition);}
        .search-box:focus-within{border-color:var(--navy-light);background:var(--white);box-shadow:0 0 0 3px rgba(26,58,143,.08);}
        .search-box i{padding:0 10px 0 13px;color:var(--gray-500);flex-shrink:0;}
        .search-box input{flex:1;border:none;background:transparent;padding:9px 8px;font-size:.85rem;font-family:inherit;color:var(--text);outline:none;}
        .search-box input::placeholder{color:var(--gray-500);}
        .filter-select{border:1.5px solid var(--gray-200);border-radius:var(--radius-sm);padding:9px 12px;font-size:.83rem;font-family:inherit;color:var(--text-soft);background:var(--white);outline:none;cursor:pointer;transition:var(--transition);}
        .filter-select:focus{border-color:var(--navy-light);}
        .btn-search{background:var(--navy);color:var(--white);border:none;padding:9px 20px;border-radius:var(--radius-sm);font-size:.83rem;font-weight:700;font-family:inherit;cursor:pointer;display:flex;align-items:center;gap:6px;transition:var(--transition);white-space:nowrap;}
        .btn-search:hover{background:var(--navy-light);}
        .btn-reset{display:inline-flex;align-items:center;gap:5px;color:var(--gray-500);text-decoration:none;font-size:.8rem;font-weight:700;padding:9px 14px;border:1.5px solid var(--gray-200);border-radius:var(--radius-sm);transition:var(--transition);}
        .btn-reset:hover{color:var(--text);border-color:var(--gray-300);}

        /* CONTENT */
        .list-wrap{padding:36px 0 52px;}
        .result-bar{display:flex;align-items:center;justify-content:space-between;margin-bottom:22px;flex-wrap:wrap;gap:8px;}
        .result-text{font-size:.8rem;color:var(--gray-500);}
        .result-text strong{color:var(--text);}
        .result-pages{font-size:.78rem;color:var(--gray-500);background:var(--gray-100);padding:4px 10px;border-radius:6px;}

        /* CARDS */
        .card-doc{background:var(--white);border:1.5px solid var(--gray-200);border-radius:var(--radius);padding:18px;height:100%;display:flex;flex-direction:column;text-decoration:none;color:inherit;transition:var(--transition);position:relative;overflow:hidden;}
        .card-doc::after{content:'';position:absolute;bottom:0;left:0;right:0;height:2.5px;background:linear-gradient(90deg,var(--navy),var(--navy-light));transform:scaleX(0);transform-origin:left;transition:transform .3s ease;}
        .card-doc:hover{border-color:rgba(11,31,74,.18);box-shadow:var(--shadow-lg);transform:translateY(-3px);color:inherit;}
        .card-doc:hover::after{transform:scaleX(1);}
        .card-meta{display:flex;align-items:center;gap:6px;margin-bottom:10px;flex-wrap:wrap;}
        .bc{font-size:.6rem;font-weight:700;padding:3px 9px;border-radius:5px;text-transform:uppercase;letter-spacing:.04em;}
        .bc-perda{background:#dbeafe;color:#1e3a8a;}.bc-perbupati{background:#dcfce7;color:#14532d;}.bc-kepbupati{background:#fef9c3;color:#713f12;}.bc-insbupati{background:#fee2e2;color:#7f1d1d;}.bc-propemda{background:#ede9fe;color:#4c1d95;}.bc-kerjasama{background:#cffafe;color:#164e63;}.bc-terjemah{background:#fce7f3;color:#831843;}.bc-ranpuu{background:#ffedd5;color:#7c2d12;}.bc-kajian{background:#d1fae5;color:#064e3b;}.bc-naskah{background:#e0e7ff;color:#312e81;}.bc-analisis{background:#fff7ed;color:#9a3412;}.bc-risalah{background:#faf5ff;color:#581c87;}.bc-relaas{background:#fef2f2;color:#7f1d1d;}.bc-artikel{background:#ecfdf5;color:#064e3b;}.bc-infografis{background:#fefce8;color:#713f12;}.bc-buku{background:#f0fdf4;color:#14532d;}.bc-berita{background:#eff6ff;color:#1e40af;}
        .meta-tag{font-size:.65rem;color:var(--gray-500);font-weight:500;background:var(--gray-100);padding:2px 7px;border-radius:4px;}
        .card-title{font-size:.88rem;font-weight:600;color:var(--text);line-height:1.55;flex:1;margin-bottom:14px;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;}
        .card-foot{display:flex;align-items:center;justify-content:space-between;padding-top:11px;border-top:1px solid var(--gray-100);margin-top:auto;}
        .card-date{font-size:.68rem;color:var(--gray-500);display:flex;align-items:center;gap:4px;}
        .card-arrow{width:26px;height:26px;background:var(--gray-100);border-radius:7px;display:flex;align-items:center;justify-content:center;color:var(--navy);font-size:.75rem;transition:var(--transition);}
        .card-doc:hover .card-arrow{background:var(--navy);color:var(--white);}

        /* IMAGE CARD */
        .card-img-wrap{height:148px;border-radius:9px;overflow:hidden;margin-bottom:13px;background:var(--gray-100);flex-shrink:0;}
        .card-img-wrap img{width:100%;height:100%;object-fit:cover;transition:transform .45s ease;}
        .card-doc:hover .card-img-wrap img{transform:scale(1.05);}
        .card-img-ph{width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:5px;background:linear-gradient(135deg,var(--gray-100),var(--gray-200));}
        .card-img-ph i{font-size:1.8rem;color:var(--gray-300);}

        /* BUKU COVER — card horizontal: cover kiri, info kanan */
        .card-doc-buku{
            background:var(--white);border:1.5px solid var(--gray-200);
            border-radius:var(--radius);padding:0;height:100%;
            display:flex;flex-direction:row;
            text-decoration:none;color:inherit;
            transition:var(--transition);position:relative;overflow:hidden;
        }
        .card-doc-buku::after{content:'';position:absolute;bottom:0;left:0;right:0;height:2.5px;background:linear-gradient(90deg,var(--navy),var(--navy-light));transform:scaleX(0);transform-origin:left;transition:transform .3s ease;}
        .card-doc-buku:hover{border-color:rgba(11,31,74,.18);box-shadow:var(--shadow-lg);transform:translateY(-3px);color:inherit;}
        .card-doc-buku:hover::after{transform:scaleX(1);}

        .card-buku-cover{
            width:90px;flex-shrink:0;
            border-radius:var(--radius) 0 0 var(--radius);
            overflow:hidden;position:relative;
            background:linear-gradient(155deg,#0b1f4a,#1a3a8f);
            box-shadow:inset -3px 0 8px rgba(0,0,0,.15);
        }
        .card-buku-cover img{
            width:100%;height:100%;object-fit:cover;
            transition:transform .4s ease;
            display:block;
        }
        .card-doc-buku:hover .card-buku-cover img{transform:scale(1.06);}
        .card-buku-ph{
            width:100%;height:100%;min-height:130px;
            display:flex;flex-direction:column;
            align-items:center;justify-content:center;gap:8px;
            padding:12px 8px;text-align:center;
        }
        .card-buku-ph i{font-size:1.8rem;color:rgba(255,255,255,.22);}
        .card-buku-ph span{font-size:.58rem;color:rgba(255,255,255,.4);line-height:1.4;font-weight:600;}
        .card-buku-shine{
            position:absolute;top:0;left:0;width:35%;height:100%;
            background:linear-gradient(90deg,rgba(255,255,255,.1),transparent);
            pointer-events:none;
        }

        .card-buku-body{
            flex:1;min-width:0;
            padding:14px 14px 12px;
            display:flex;flex-direction:column;
        }
        .card-buku-body .card-meta{margin-bottom:8px;}
        .card-buku-body .card-title{
            font-size:.83rem;-webkit-line-clamp:3;
            margin-bottom:0;flex:1;
        }
        .card-buku-body .card-foot{
            padding-top:10px;border-top:1px solid var(--gray-100);margin-top:auto;
        }
        .card-buku-author{
            font-size:.68rem;color:var(--gray-500);
            display:flex;align-items:center;gap:4px;
            margin-bottom:6px;
        }

        /* INFOGRAFIS GRID */
        .card-infografis{background:var(--white);border:1.5px solid var(--gray-200);border-radius:var(--radius);overflow:hidden;text-decoration:none;display:block;transition:var(--transition);}
        .card-infografis:hover{transform:translateY(-3px);box-shadow:var(--shadow-lg);border-color:rgba(11,31,74,.18);}
        .card-infografis .img-box{aspect-ratio:1;overflow:hidden;background:var(--gray-100);}
        .card-infografis .img-box img{width:100%;height:100%;object-fit:cover;transition:transform .4s;}
        .card-infografis:hover .img-box img{transform:scale(1.06);}
        .card-infografis .img-ph{width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:var(--gray-300);font-size:2.5rem;}
        .card-infografis .inf-lbl{padding:10px 12px;font-size:.73rem;font-weight:600;color:var(--text-soft);display:flex;align-items:center;gap:5px;}

        /* EMPTY */
        .empty-state{text-align:center;padding:72px 20px;}
        .empty-state i{font-size:3rem;color:var(--gray-300);display:block;margin-bottom:14px;}
        .empty-state h5{color:var(--gray-500);font-size:1rem;font-weight:600;margin-bottom:6px;}
        .empty-state p{color:var(--gray-500);font-size:.84rem;}
        .empty-state a{display:inline-flex;align-items:center;gap:5px;margin-top:16px;color:var(--navy);font-weight:700;font-size:.84rem;text-decoration:none;padding:8px 18px;border:1.5px solid var(--navy);border-radius:var(--radius-sm);transition:var(--transition);}
        .empty-state a:hover{background:var(--navy);color:var(--white);}

        /* PAGI */
        .pagi-wrap{display:flex;justify-content:center;margin-top:36px;}
        .pagi-wrap .pagination{margin:0;gap:4px;}
        .pagi-wrap .page-link{font-size:.79rem;font-weight:600;color:var(--navy);border:1.5px solid var(--gray-200);border-radius:var(--radius-sm)!important;padding:7px 13px;transition:var(--transition);}
        .pagi-wrap .page-link:hover{background:var(--gray-100);border-color:var(--navy);}
        .pagi-wrap .page-item.active .page-link{background:var(--navy);border-color:var(--navy);color:var(--white);}
        .pagi-wrap .page-link:focus{box-shadow:none;}

        footer{background:var(--navy);color:rgba(255,255,255,.55);padding:24px 0 0;}
        .footer-bottom{padding:16px 0;border-top:1px solid rgba(255,255,255,.07);display:flex;justify-content:space-between;flex-wrap:wrap;gap:8px;font-size:.71rem;color:rgba(255,255,255,.3);}
        .footer-bottom a{color:rgba(255,255,255,.3);text-decoration:none;}
        .footer-bottom a:hover{color:var(--gold-light);}
    </style>
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