<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — JDIH Kominfo Tanah Datar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #0a1f4e; --navy-light: #1a3a8f;
            --gold: #c8960c; --gold-light: #f0b429;
            --cream: #fafaf7; --white: #ffffff;
            --gray-100: #f1f3f5; --gray-200: #e9ecef;
            --gray-400: #ced4da; --gray-600: #6c757d;
            --text: #1a202c; --text-soft: #4a5568;
            --radius: 12px; --shadow: 0 4px 20px rgba(10,31,78,.08);
            --shadow-lg: 0 12px 40px rgba(10,31,78,.14);
        }
        * { box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; background: var(--cream); color: var(--text); line-height: 1.6; }

        /* TOPBAR */
        .topbar { background: var(--navy); color: rgba(255,255,255,.65); font-size: .72rem; font-weight: 500; letter-spacing: .07em; text-transform: uppercase; padding: 7px 0; text-align: center; }
        .topbar .dot { color: var(--gold-light); margin: 0 8px; }

        /* NAVBAR */
        .navbar-main { background: var(--white); border-bottom: 1px solid var(--gray-200); position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 12px rgba(10,31,78,.06); }
        .navbar-inner { display: flex; align-items: center; justify-content: space-between; height: 64px; gap: 20px; }
        .brand { display: flex; align-items: center; gap: 12px; text-decoration: none; flex-shrink: 0; }
        .brand-logo { width: 40px; height: 40px; background: var(--navy); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-family: 'Crimson Pro', serif; font-weight: 700; font-size: 1rem; color: var(--gold-light); }
        .brand-name { font-size: .95rem; font-weight: 700; color: var(--navy); line-height: 1.2; }
        .brand-name em { color: var(--gold); font-style: normal; }
        .brand-sub { font-size: .67rem; color: var(--gray-600); }
        .nav-links { display: flex; align-items: center; gap: 2px; }
        .nav-links a { color: var(--text-soft); text-decoration: none; font-size: .84rem; font-weight: 500; padding: 7px 13px; border-radius: 6px; transition: all .2s; display: flex; align-items: center; gap: 5px; }
        .nav-links a:hover { color: var(--navy); background: var(--gray-100); }
        .nav-links .btn-admin { background: var(--navy); color: var(--white) !important; }
        .nav-links .btn-admin:hover { background: var(--navy-light) !important; }

        /* BREADCRUMB */
        .breadcrumb-wrap { background: var(--white); border-bottom: 1px solid var(--gray-200); padding: 12px 0; }
        .breadcrumb { margin: 0; font-size: .82rem; }
        .breadcrumb-item a { color: var(--navy); text-decoration: none; }
        .breadcrumb-item a:hover { text-decoration: underline; }
        .breadcrumb-item.active { color: var(--gray-600); }
        .breadcrumb-item + .breadcrumb-item::before { color: var(--gray-400); }

        /* DETAIL PAGE */
        .detail-wrap { max-width: 860px; margin: 0 auto; padding: 40px 0 60px; }
        .detail-card { background: var(--white); border: 1.5px solid var(--gray-200); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow); }
        .detail-header { background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 100%); padding: 32px 36px; }
        .detail-badge { display: inline-flex; align-items: center; gap: 6px; background: rgba(240,180,41,.2); border: 1px solid rgba(240,180,41,.3); color: var(--gold-light); font-size: .7rem; font-weight: 700; letter-spacing: .07em; text-transform: uppercase; padding: 4px 12px; border-radius: 20px; margin-bottom: 14px; }
        .detail-title { font-family: 'Crimson Pro', serif; font-size: clamp(1.3rem, 3vw, 1.9rem); font-weight: 700; color: var(--white); line-height: 1.3; margin: 0; }
        .detail-body { padding: 32px 36px; }
        .meta-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 16px; margin-bottom: 28px; padding-bottom: 24px; border-bottom: 1px solid var(--gray-200); }
        .meta-item .lbl { font-size: .68rem; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--gray-600); margin-bottom: 4px; }
        .meta-item .val { font-size: .9rem; font-weight: 600; color: var(--text); }
        .meta-item .val.empty { color: var(--gray-400); font-weight: 400; font-style: italic; }
        .section-label { font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--gray-600); margin-bottom: 10px; }
        .content-text { font-size: .95rem; line-height: 1.8; color: var(--text-soft); }

        /* PDF VIEWER */
        .pdf-section { margin-top: 28px; padding-top: 24px; border-top: 1px solid var(--gray-200); }
        .pdf-actions { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 16px; }
        .btn-pdf { display: inline-flex; align-items: center; gap: 7px; padding: 10px 20px; border-radius: 8px; font-size: .88rem; font-weight: 600; text-decoration: none; transition: all .2s; border: none; cursor: pointer; }
        .btn-view { background: var(--navy); color: var(--white); }
        .btn-view:hover { background: var(--navy-light); color: var(--white); }
        .btn-download { background: var(--gray-100); color: var(--navy); border: 1.5px solid var(--gray-200); }
        .btn-download:hover { background: var(--gray-200); color: var(--navy); }
        .pdf-embed { width: 100%; height: 600px; border: 1.5px solid var(--gray-200); border-radius: 8px; display: none; margin-top: 14px; }

        /* VIEWS BADGE */
        .views-badge { display: inline-flex; align-items: center; gap: 5px; background: var(--gray-100); color: var(--gray-600); font-size: .75rem; font-weight: 500; padding: 4px 10px; border-radius: 20px; margin-top: 12px; }

        /* BACK BUTTON */
        .btn-back { display: inline-flex; align-items: center; gap: 6px; color: var(--navy); font-size: .85rem; font-weight: 600; text-decoration: none; padding: 8px 16px; border: 1.5px solid var(--navy); border-radius: 8px; transition: all .2s; margin-bottom: 24px; }
        .btn-back:hover { background: var(--navy); color: var(--white); }

        /* FOOTER */
        footer { background: var(--navy); color: rgba(255,255,255,.5); padding: 20px 0; text-align: center; font-size: .78rem; margin-top: 0; }
        footer a { color: rgba(255,255,255,.5); text-decoration: none; }

        /* BACK TO TOP */
        #btt { position: fixed; bottom: 24px; right: 24px; width: 42px; height: 42px; background: var(--navy); color: var(--white); border: none; border-radius: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: var(--shadow-lg); opacity: 0; pointer-events: none; transition: all .25s; z-index: 999; font-size: 1rem; }
        #btt.show { opacity: 1; pointer-events: all; }
        #btt:hover { background: var(--navy-light); }

        @media(max-width:768px) { .detail-header, .detail-body { padding: 24px 20px; } .meta-grid { grid-template-columns: 1fr 1fr; } }
        @media(max-width:576px) { .meta-grid { grid-template-columns: 1fr; } .pdf-embed { height: 400px; } }
    </style>
    @yield('head')
</head>
<body>
<div class="topbar">
    <i class="bi bi-shield-check"></i>
    Pemerintah Daerah Kabupaten Tanah Datar
    <span class="dot">·</span>
    Jaringan Dokumentasi &amp; Informasi Hukum
</div>
<nav class="navbar-main">
    <div class="container">
        <div class="navbar-inner">
            <a href="{{ url('/') }}" class="brand">
                <div class="brand-logo">JD</div>
                <div>
                    <div class="brand-name">JDIH <em>Kominfo</em> Tanah Datar</div>
                    <div class="brand-sub">Jaringan Dokumentasi &amp; Informasi Hukum</div>
                </div>
            </a>
            <div class="nav-links">
                <a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a>
                <a href="{{ url('/') }}#regulasi"><i class="bi bi-book"></i> Regulasi</a>
                <a href="{{ url('/') }}#dokumen"><i class="bi bi-file-text"></i> Dokumen</a>
                <a href="{{ url('/') }}#media"><i class="bi bi-grid"></i> Media</a>
                <a href="{{ route('login') }}" class="btn-admin"><i class="bi bi-lock"></i> Admin</a>
            </div>
        </div>
    </div>
</nav>

<div class="breadcrumb-wrap">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a></li>
                @yield('breadcrumb')
            </ol>
        </nav>
    </div>
</div>

<div class="container">
    <div class="detail-wrap">
        <a href="{{ url()->previous() == url()->current() ? url('/') : url()->previous() }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        @yield('content')
    </div>
</div>

<footer>
    <div class="container">
        &copy; {{ date('Y') }} JDIH Kominfo Kabupaten Tanah Datar &nbsp;·&nbsp;
        <a href="{{ url('/') }}">Beranda</a>
    </div>
</footer>

<button id="btt" onclick="window.scrollTo({top:0,behavior:'smooth'})"><i class="bi bi-chevron-up"></i></button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.addEventListener('scroll', () => document.getElementById('btt').classList.toggle('show', window.scrollY > 300));
    function togglePdf(url) {
        const embed = document.getElementById('pdfEmbed');
        if (embed.style.display === 'block') { embed.style.display = 'none'; }
        else { embed.src = url; embed.style.display = 'block'; embed.scrollIntoView({behavior:'smooth', block:'start'}); }
    }
</script>
@yield('scripts')
</body>
</html>
