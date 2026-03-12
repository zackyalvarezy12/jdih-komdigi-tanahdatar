<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item->judul }} — JDIH Kominfo Tanah Datar</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{--navy:#0b1f4a;--navy-light:#1a3a8f;--gold:#c8960c;--gold-light:#f0b429;--cream:#f8f7f4;--white:#fff;--gray-50:#f9fafb;--gray-100:#f3f4f6;--gray-200:#e5e7eb;--gray-300:#d1d5db;--gray-500:#6b7280;--text:#111827;--r-sm:8px;--r:14px;--transition:all .22s cubic-bezier(.4,0,.2,1);}
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--cream);color:var(--text);line-height:1.6;}
        ::-webkit-scrollbar{width:5px;}::-webkit-scrollbar-thumb{background:var(--navy-light);border-radius:10px;}
        .topbar{background:var(--navy);color:rgba(255,255,255,.5);font-size:.7rem;font-weight:600;letter-spacing:.08em;text-transform:uppercase;padding:7px 0;text-align:center;}
        .navbar-main{background:rgba(255,255,255,.97);backdrop-filter:blur(16px);border-bottom:1px solid var(--gray-200);position:sticky;top:0;z-index:1000;box-shadow:0 2px 20px rgba(11,31,74,.06);}
        .navbar-inner{display:flex;align-items:center;justify-content:space-between;height:64px;}
        .brand{display:flex;align-items:center;gap:12px;text-decoration:none;}
        .brand-logo{width:40px;height:40px;background:linear-gradient(135deg,var(--navy),var(--navy-light));border-radius:11px;overflow:hidden;display:flex;align-items:center;justify-content:center;}
        .brand-logo img{width:100%;height:100%;object-fit:contain;padding:5px;}
        .brand-name{font-size:.92rem;font-weight:700;color:var(--navy);line-height:1.2;}
        .brand-name em{color:var(--gold);font-style:normal;}
        .brand-sub{font-size:.62rem;color:var(--gray-500);}
        .nav-back{display:inline-flex;align-items:center;gap:6px;color:var(--navy);text-decoration:none;font-size:.82rem;font-weight:700;padding:7px 16px;border:1.5px solid rgba(11,31,74,.2);border-radius:var(--r-sm);transition:var(--transition);}
        .nav-back:hover{background:var(--navy);color:var(--white);}
        .page-header{background:linear-gradient(135deg,var(--navy) 0%,var(--navy-light) 100%);padding:44px 0 38px;position:relative;overflow:hidden;}
        .page-header::before{content:'';position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,.05) 1px,transparent 1px);background-size:24px 24px;}
        .ph-inner{position:relative;z-index:1;}
        .breadcrumb-wrap{display:flex;align-items:center;gap:7px;margin-bottom:16px;flex-wrap:wrap;}
        .breadcrumb-wrap a{color:rgba(255,255,255,.5);text-decoration:none;font-size:.73rem;font-weight:600;}
        .breadcrumb-wrap a:hover{color:var(--gold-light);}
        .breadcrumb-wrap .sep{color:rgba(255,255,255,.25);font-size:.65rem;}
        .breadcrumb-wrap .cur{color:rgba(255,255,255,.75);font-size:.73rem;font-weight:600;}
        .ph-badge-wrap{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:14px;}
        .ph-badge{display:inline-flex;align-items:center;gap:5px;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);border-radius:20px;padding:4px 12px;color:var(--gold-light);font-size:.68rem;font-weight:700;}
        .page-header h1{font-family:'Playfair Display',serif;font-size:clamp(1.4rem,3vw,2.1rem);font-weight:700;color:var(--white);line-height:1.35;margin-bottom:8px;}
        .ph-meta{display:flex;align-items:center;gap:16px;flex-wrap:wrap;margin-top:14px;}
        .ph-meta span{font-size:.75rem;color:rgba(255,255,255,.5);display:flex;align-items:center;gap:5px;}
        .content-wrap{padding:36px 0 52px;}
        .detail-card{background:var(--white);border:1.5px solid var(--gray-200);border-radius:var(--r);overflow:hidden;margin-bottom:20px;}
        .detail-card-head{padding:16px 20px;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;gap:10px;}
        .detail-card-head i{color:var(--navy);font-size:1rem;}
        .detail-card-head span{font-size:.84rem;font-weight:700;color:var(--navy);}
        .detail-table{width:100%;border-collapse:collapse;}
        .detail-table tr{border-bottom:1px solid var(--gray-100);}
        .detail-table tr:last-child{border-bottom:none;}
        .detail-table th{padding:11px 20px;font-size:.75rem;font-weight:600;color:var(--gray-500);background:var(--gray-50);width:180px;vertical-align:top;}
        .detail-table td{padding:11px 20px;font-size:.82rem;color:var(--text);}
        .pdf-card{background:var(--white);border:1.5px solid var(--gray-200);border-radius:var(--r);overflow:hidden;}
        .pdf-head{padding:16px 20px;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;}
        .pdf-head-left{display:flex;align-items:center;gap:8px;}
        .pdf-head-left span{font-size:.84rem;font-weight:700;color:var(--navy);}
        .btn-dl{display:inline-flex;align-items:center;gap:6px;background:var(--navy);color:var(--white);text-decoration:none;padding:8px 18px;border-radius:var(--r-sm);font-size:.78rem;font-weight:700;transition:var(--transition);}
        .btn-dl:hover{background:var(--navy-light);color:var(--white);}
        .pdf-frame{width:100%;height:700px;border:none;display:block;}
        .pdf-fallback{padding:40px 20px;text-align:center;}
        .pdf-fallback i{font-size:2.5rem;color:var(--gray-300);display:block;margin-bottom:12px;}
        .pdf-fallback p{color:var(--gray-500);font-size:.84rem;margin-bottom:16px;}
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
                <div class="brand-logo"><img src="{{ asset('images/logo.png') }}" alt="JDIH Logo" onerror="this.style.display='none'"></div>
                <div>
                    <div class="brand-name">JDIH <em>Kominfo</em> Tanah Datar</div>
                    <div class="brand-sub">Jaringan Dokumentasi &amp; Informasi Hukum</div>
                </div>
            </a>
            <a href="{{ url('/daftar/perterjemah') }}" class="nav-back"><i class="bi bi-arrow-left"></i> Kembali ke Daftar</a>
        </div>
    </div>
</nav>
<div class="page-header">
    <div class="container ph-inner">
        <div class="breadcrumb-wrap">
            <a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a>
            <span class="sep"><i class="bi bi-chevron-right"></i></span>
            <a href="{{ url('/daftar/perterjemah') }}">Peraturan Terjemah</a>
            <span class="sep"><i class="bi bi-chevron-right"></i></span>
            <span class="cur">Detail</span>
        </div>
        <div class="ph-badge-wrap">
            <span class="ph-badge"><i class="bi bi-translate"></i> Peraturan Terjemah</span>
            @if(!empty($item->type_dokumen))<span class="ph-badge"><i class="bi bi-tag"></i> {{ $item->type_dokumen }}</span>@endif
            @if(!empty($item->tahun))<span class="ph-badge"><i class="bi bi-calendar3"></i> {{ $item->tahun }}</span>@endif
        </div>
        <h1>{{ $item->judul }}</h1>
        <div class="ph-meta">
            @if(!empty($item->teu_pengarang))<span><i class="bi bi-person"></i> {{ $item->teu_pengarang }}</span>@endif
            @if($item->created_at)<span><i class="bi bi-clock"></i> {{ $item->created_at->format('d M Y') }}</span>@endif
        </div>
    </div>
</div>
<div class="content-wrap">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="detail-card">
                    <div class="detail-card-head"><i class="bi bi-info-circle"></i><span>Informasi Dokumen</span></div>
                    <table class="detail-table">
                        @if(!empty($item->judul))<tr><th>Judul</th><td>{{ $item->judul }}</td></tr>@endif
                        @if(!empty($item->type_dokumen))<tr><th>Jenis Dokumen</th><td>{{ $item->type_dokumen }}</td></tr>@endif
                        @if(!empty($item->teu_pengarang))<tr><th>Pengarang</th><td>{{ $item->teu_pengarang }}</td></tr>@endif
                        @if(!empty($item->tahun))<tr><th>Tahun</th><td>{{ $item->tahun }}</td></tr>@endif
                        @if(!empty($item->bahasa))<tr><th>Bahasa</th><td>{{ $item->bahasa }}</td></tr>@endif
                        @if(!empty($item->subjek))<tr><th>Subjek</th><td>{{ $item->subjek }}</td></tr>@endif
                        @if(!empty($item->sumber))<tr><th>Sumber</th><td>{{ $item->sumber }}</td></tr>@endif
                        <tr><th>Ditambahkan</th><td>{{ $item->created_at?->format('d M Y') ?? '-' }}</td></tr>
                    </table>
                </div>
            </div>
            <div class="col-lg-8">
                @if(!empty($item->file_pdf))
                <div class="pdf-card">
                    <div class="pdf-head">
                        <div class="pdf-head-left">
                            <i class="bi bi-file-earmark-pdf fs-5" style="color:#dc2626"></i>
                            <span>Dokumen PDF</span>
                        </div>
                        <div style="display:flex;gap:8px;flex-wrap:wrap;">
                            <a href="{{ asset('storage/' . $item->file_pdf) }}" target="_blank" download class="btn-dl">
                                <i class="bi bi-download"></i> Unduh PDF
                            </a>
                            <a href="{{ asset('storage/' . $item->file_pdf) }}" target="_blank" class="btn-dl" style="background:#f1f5f9;color:#334155;border:1.5px solid #e2e8f0;">
                                <i class="bi bi-box-arrow-up-right"></i> Buka di Tab Baru
                            </a>
                        </div>
                    </div>
                    <iframe
                        src="{{ route('pdf.view', ['path' => base64_encode($item->file_pdf)]) }}"
                        class="pdf-frame"
                        title="{{ $item->judul }}"
                        loading="lazy">
                    </iframe>
                </div>
                @else
                <div class="detail-card">
                    <div class="pdf-fallback">
                        <i class="bi bi-file-earmark-x"></i>
                        <p>File PDF untuk dokumen ini belum tersedia.</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
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