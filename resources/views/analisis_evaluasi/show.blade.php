<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Str::limit($item->judul, 60) }} — JDIH Kominfo Tanah Datar</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy:#0b1f4a; --navy-light:#1a3a8f; --gold:#c8960c; --gold-light:#f0b429;
            --cream:#f8f7f4; --white:#fff; --gray-50:#f9fafb; --gray-100:#f3f4f6;
            --gray-200:#e5e7eb; --gray-300:#d1d5db; --gray-500:#6b7280;
            --text:#111827; --text-soft:#4b5563;
            --accent:#ea580c; --accent-light:#fff7ed; --accent-border:#fed7aa;
            --r-sm:8px; --r:14px; --transition:all .22s cubic-bezier(.4,0,.2,1);
            --shadow:0 4px 16px rgba(11,31,74,.09); --shadow-lg:0 12px 40px rgba(11,31,74,.15);
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--cream);color:var(--text);line-height:1.6;}
        ::-webkit-scrollbar{width:5px;}
        ::-webkit-scrollbar-thumb{background:var(--navy-light);border-radius:10px;}

        /* ── TOPBAR ── */
        .topbar{background:var(--navy);color:rgba(255,255,255,.5);font-size:.68rem;font-weight:600;letter-spacing:.09em;text-transform:uppercase;padding:7px 0;text-align:center;}
        .topbar .sep{color:var(--gold-light);margin:0 10px;opacity:.6;}

        /* ── NAVBAR ── */
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

        /* ── PAGE HEADER ── */
        .page-header{background:linear-gradient(135deg,var(--navy) 0%,#1e3a6e 60%,var(--navy-light) 100%);padding:48px 0 40px;position:relative;overflow:hidden;}
        .page-header::before{content:'';position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,.045) 1px,transparent 1px);background-size:26px 26px;}
        .page-header::after{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,var(--gold-light),transparent);}
        .ph-inner{position:relative;z-index:1;}

        .breadcrumb-wrap{display:flex;align-items:center;gap:7px;margin-bottom:18px;flex-wrap:wrap;}
        .breadcrumb-wrap a{color:rgba(255,255,255,.5);text-decoration:none;font-size:.72rem;font-weight:600;transition:var(--transition);display:flex;align-items:center;gap:4px;}
        .breadcrumb-wrap a:hover{color:var(--gold-light);}
        .breadcrumb-wrap .sep{color:rgba(255,255,255,.2);font-size:.6rem;}
        .breadcrumb-wrap .cur{color:rgba(255,255,255,.7);font-size:.72rem;font-weight:600;}

        .ph-badges{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:16px;}
        .ph-badge{display:inline-flex;align-items:center;gap:5px;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);border-radius:20px;padding:4px 13px;color:var(--gold-light);font-size:.67rem;font-weight:700;letter-spacing:.03em;}
        .ph-badge.accent{background:rgba(234,88,12,.2);border-color:rgba(234,88,12,.35);color:#fdba74;}

        .page-header h1{font-family:'Playfair Display',serif;font-size:clamp(1.45rem,3vw,2.2rem);font-weight:700;color:var(--white);line-height:1.3;margin-bottom:10px;letter-spacing:-.02em;}

        .ph-meta{display:flex;align-items:center;gap:18px;flex-wrap:wrap;margin-top:14px;}
        .ph-meta span{font-size:.74rem;color:rgba(255,255,255,.5);display:flex;align-items:center;gap:5px;}

        /* ── CONTENT ── */
        .content-wrap{padding:36px 0 56px;}

        /* Info card */
        .detail-card{background:var(--white);border:1.5px solid var(--gray-200);border-radius:var(--r);overflow:hidden;margin-bottom:20px;box-shadow:var(--shadow);}
        .detail-card-head{padding:15px 20px;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;gap:9px;background:var(--gray-50);}
        .detail-card-head i{color:var(--accent);font-size:1rem;}
        .detail-card-head span{font-size:.84rem;font-weight:700;color:var(--navy);}

        .detail-table{width:100%;border-collapse:collapse;}
        .detail-table tr{border-bottom:1px solid var(--gray-100);}
        .detail-table tr:last-child{border-bottom:none;}
        .detail-table th{padding:11px 20px;font-size:.73rem;font-weight:700;color:var(--gray-500);background:var(--gray-50);width:170px;vertical-align:top;text-transform:uppercase;letter-spacing:.04em;}
        .detail-table td{padding:11px 20px;font-size:.83rem;color:var(--text);line-height:1.6;}

        /* Accent pill di tabel */
        .td-pill{display:inline-flex;align-items:center;gap:5px;background:var(--accent-light);border:1px solid var(--accent-border);color:var(--accent);font-size:.72rem;font-weight:700;padding:3px 10px;border-radius:6px;}

        /* PDF card */
        .pdf-card{background:var(--white);border:1.5px solid var(--gray-200);border-radius:var(--r);overflow:hidden;box-shadow:var(--shadow);}
        .pdf-head{padding:15px 20px;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;background:var(--gray-50);}
        .pdf-head-left{display:flex;align-items:center;gap:8px;}
        .pdf-head-left i{color:#dc2626;font-size:1.1rem;}
        .pdf-head-left span{font-size:.84rem;font-weight:700;color:var(--navy);}
        .btn-dl{display:inline-flex;align-items:center;gap:6px;background:var(--navy);color:var(--white);text-decoration:none;padding:8px 18px;border-radius:var(--r-sm);font-size:.78rem;font-weight:700;transition:var(--transition);box-shadow:0 3px 10px rgba(11,31,74,.2);}
        .btn-dl:hover{background:var(--navy-light);color:var(--white);transform:translateY(-1px);}
        .pdf-frame{width:100%;height:720px;border:none;display:block;}
        .pdf-embed-wrap{width:100%;height:720px;position:relative;background:#f1f5f9;}
        .pdf-embed-wrap embed,.pdf-embed-wrap object{width:100%;height:100%;border:none;display:block;}
        .pdf-no-support{position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:14px;background:#f8fafc;}
        .pdf-no-support i{font-size:3rem;color:#dc2626;}
        .pdf-no-support p{color:var(--gray-500);font-size:.85rem;text-align:center;max-width:280px;line-height:1.6;}

        /* No PDF placeholder */
        .no-pdf{padding:52px 20px;text-align:center;}
        .no-pdf i{font-size:2.8rem;color:var(--gray-300);display:block;margin-bottom:14px;}
        .no-pdf p{color:var(--gray-500);font-size:.85rem;}

        /* ── FOOTER ── */
        footer{background:var(--navy);padding:22px 0;}
        .footer-bottom{display:flex;justify-content:space-between;flex-wrap:wrap;gap:8px;font-size:.7rem;color:rgba(255,255,255,.3);}
        .footer-bottom a{color:rgba(255,255,255,.3);text-decoration:none;display:inline-flex;align-items:center;gap:5px;}
        .footer-bottom a:hover{color:var(--gold-light);}

        @media(max-width:767px){
            .page-header{padding:36px 0 30px;}
            .page-header h1{font-size:1.35rem;}
        }
    </style>
</head>
<body>

{{-- TOPBAR --}}
<div class="topbar">
    <i class="bi bi-shield-check"></i>
    Pemerintah Daerah Kabupaten Tanah Datar
    <span class="sep">·</span>
    Jaringan Dokumentasi &amp; Informasi Hukum
</div>

{{-- NAVBAR --}}
<nav class="navbar-main">
    <div class="container">
        <div class="navbar-inner">
            <a href="{{ url('/') }}" class="brand">
                <div class="brand-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="JDIH"
                         onerror="this.style.display='none'">
                </div>
                <div>
                    <div class="brand-name">JDIH <em>Kominfo</em> Tanah Datar</div>
                    <div class="brand-sub">Jaringan Dokumentasi &amp; Informasi Hukum</div>
                </div>
            </a>
            <a href="{{ route('publik.list', ['kategori' => 'analisis']) }}" class="nav-back">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </div>
</nav>

{{-- PAGE HEADER --}}
<div class="page-header">
    <div class="container ph-inner">

        {{-- Breadcrumb --}}
        <div class="breadcrumb-wrap">
            <a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a>
            <span class="sep"><i class="bi bi-chevron-right"></i></span>
            <a href="{{ route('publik.list', ['kategori' => 'analisis']) }}">Analisis Evaluasi</a>
            <span class="sep"><i class="bi bi-chevron-right"></i></span>
            <span class="cur">Detail</span>
        </div>

        {{-- Badges --}}
        <div class="ph-badges">
            <span class="ph-badge accent"><i class="bi bi-clipboard-data"></i> Analisis Evaluasi</span>
            @if(!empty($item->type_dokumen))
                <span class="ph-badge"><i class="bi bi-tag"></i> {{ $item->type_dokumen }}</span>
            @endif
            @if(!empty($item->tahun))
                <span class="ph-badge"><i class="bi bi-calendar3"></i> {{ $item->tahun }}</span>
            @endif
        </div>

        {{-- Judul --}}
        <h1>{{ $item->judul }}</h1>

        {{-- Meta --}}
        <div class="ph-meta">
            @if(!empty($item->teu_pengarang))
                <span><i class="bi bi-person"></i> {{ $item->teu_pengarang }}</span>
            @endif
            @if($item->created_at)
                <span><i class="bi bi-clock"></i> {{ $item->created_at->format('d M Y') }}</span>
            @endif
        </div>

    </div>
</div>

{{-- CONTENT --}}
<div class="content-wrap">
    <div class="container">
        <div class="row g-4">

            {{-- KIRI: Informasi Dokumen --}}
            <div class="col-lg-4">
                <div class="detail-card">
                    <div class="detail-card-head">
                        <i class="bi bi-info-circle-fill"></i>
                        <span>Informasi Dokumen</span>
                    </div>
                    <table class="detail-table">
                        <tr>
                            <th>Judul</th>
                            <td>{{ $item->judul }}</td>
                        </tr>
                        @if(!empty($item->type_dokumen))
                        <tr>
                            <th>Jenis</th>
                            <td><span class="td-pill"><i class="bi bi-clipboard-data"></i> {{ $item->type_dokumen }}</span></td>
                        </tr>
                        @endif
                        @if(!empty($item->teu_pengarang))
                        <tr>
                            <th>Pengarang</th>
                            <td>{{ $item->teu_pengarang }}</td>
                        </tr>
                        @endif
                        @if(!empty($item->tahun))
                        <tr>
                            <th>Tahun</th>
                            <td>{{ $item->tahun }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Ditambahkan</th>
                            <td>{{ $item->created_at?->format('d M Y') ?? '-' }}</td>
                        </tr>
                        @if(!empty($item->file_pdf))
                        <tr>
                            <th>Dokumen</th>
                            <td>
                                <a href="{{ asset('storage/' . $item->file_pdf) }}"
                                   target="_blank" download
                                   style="display:inline-flex;align-items:center;gap:5px;color:#dc2626;font-size:.78rem;font-weight:700;text-decoration:none;">
                                    <i class="bi bi-file-earmark-pdf"></i> Unduh PDF
                                </a>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>

            {{-- KANAN: PDF Viewer --}}
            <div class="col-lg-8">
                @if(!empty($item->file_pdf))
                <div class="pdf-card">
                    <div class="pdf-head">
                        <div class="pdf-head-left">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                            <span>Dokumen PDF</span>
                        </div>
                        <a href="{{ asset('storage/' . $item->file_pdf) }}"
                           target="_blank" download class="btn-dl">
                            <i class="bi bi-download"></i> Unduh PDF
                        </a>
                    </div>
                    <div class="pdf-embed-wrap">
                        <iframe
                            src="{{ route('pdf.view', ['path' => base64_encode($item->file_pdf)]) }}"
                            style="width:100%;height:100%;border:none;display:block;"
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
                @else
                <div class="detail-card">
                    <div class="no-pdf">
                        <i class="bi bi-file-earmark-x"></i>
                        <p>File PDF untuk dokumen ini belum tersedia.</p>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>

{{-- FOOTER --}}
<footer>
    <div class="container">
        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} JDIH Kominfo Kabupaten Tanah Datar. Hak cipta dilindungi undang-undang.</span>
            <a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>