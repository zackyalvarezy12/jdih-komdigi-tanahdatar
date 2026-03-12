<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KOMINFO | Sistem Informasi JDIH</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --sidebar-w: 260px;

            /* Kominfo Color Palette */
            --kominfo-red:    #cc0000;
            --kominfo-red-d:  #a80000;
            --kominfo-red-l:  #fff0f0;
            --kominfo-blue:   #003580;
            --kominfo-blue-m: #0050c8;
            --kominfo-blue-l: #e8eeff;
            --kominfo-gold:   #f5a623;

            /* Neutrals */
            --bg:        #f4f6fb;
            --sidebar-bg:#ffffff;
            --border:    #e8ecf3;
            --text:      #0f1d38;
            --text-muted:#6b7a99;
            --white:     #ffffff;

            /* Sidebar gradient */
            --sidebar-grad: linear-gradient(175deg, #003580 0%, #001f4f 60%, #0a0a1a 100%);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
        }

        /* ─── SCROLLBAR ────────────────────────────────────────────────────── */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #c5cfe0; border-radius: 99px; }

        /* ─── SIDEBAR ──────────────────────────────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            height: 100vh;
            position: fixed;
            left: 0; top: 0;
            background: var(--sidebar-grad);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            overflow: hidden;
        }

        /* Subtle noise texture overlay */
        .sidebar::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            opacity: 0.4;
            pointer-events: none;
        }

        /* Red top accent bar */
        .sidebar::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--kominfo-red), var(--kominfo-gold), var(--kominfo-red));
        }

        /* ─── BRAND ────────────────────────────────────────────────────────── */
        .sidebar-brand {
            padding: 28px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            position: relative;
            flex-shrink: 0;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--kominfo-red);
            color: white;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .brand-title {
            font-size: 18px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.2;
            letter-spacing: -0.3px;
        }

        .brand-title span {
            color: var(--kominfo-gold);
        }

        .brand-sub {
            font-size: 10.5px;
            color: rgba(255,255,255,0.45);
            margin-top: 3px;
            font-weight: 500;
            letter-spacing: 0.2px;
        }

        /* ─── NAV SCROLL ───────────────────────────────────────────────────── */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 16px 12px 20px;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,0.1) transparent;
        }

        /* ─── NAV SECTION LABEL ────────────────────────────────────────────── */
        .nav-section-label {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            padding: 14px 10px 6px;
        }

        /* ─── NAV ITEM ─────────────────────────────────────────────────────── */
        .nav-list { list-style: none; }

        .nav-item { margin-bottom: 2px; }

        .nav-link-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            color: rgba(255,255,255,0.6);
            text-decoration: none !important;
            font-size: 13.5px;
            font-weight: 600;
            transition: all 0.2s ease;
            position: relative;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
        }

        .nav-link-item:hover {
            background: rgba(255,255,255,0.07);
            color: rgba(255,255,255,0.95);
        }

        .nav-link-item.active {
            background: linear-gradient(90deg, rgba(204,0,0,0.85), rgba(168,0,0,0.6));
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(204,0,0,0.35);
        }

        .nav-link-item.active .nav-icon {
            color: #ffffff;
        }

        /* Active left border indicator */
        .nav-link-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 20%; bottom: 20%;
            width: 3px;
            background: var(--kominfo-gold);
            border-radius: 0 3px 3px 0;
        }

        .nav-icon {
            width: 20px;
            text-align: center;
            font-size: 14px;
            color: rgba(255,255,255,0.45);
            flex-shrink: 0;
            transition: color 0.2s;
        }

        .nav-link-item:hover .nav-icon {
            color: rgba(255,255,255,0.8);
        }

        .nav-label { flex: 1; }

        .nav-arrow {
            font-size: 10px;
            color: rgba(255,255,255,0.3);
            transition: transform 0.25s ease;
        }

        /* ─── SUBMENU ──────────────────────────────────────────────────────── */
        .sub-nav {
            list-style: none;
            margin: 4px 0 4px 32px;
            border-left: 1px solid rgba(255,255,255,0.1);
            padding-left: 14px;
            display: none;
            overflow: hidden;
        }

        .sub-nav.open { display: block; }

        .sub-nav li { margin: 2px 0; }

        .sub-nav-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 7px 10px;
            border-radius: 8px;
            color: rgba(255,255,255,0.5);
            text-decoration: none !important;
            font-size: 12.5px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .sub-nav-link:hover {
            color: rgba(255,255,255,0.9);
            background: rgba(255,255,255,0.05);
        }

        .sub-nav-link.active-sub {
            color: var(--kominfo-gold);
            font-weight: 700;
        }

        .sub-dot {
            width: 5px; height: 5px;
            border-radius: 50%;
            background: rgba(255,255,255,0.25);
            flex-shrink: 0;
            transition: background 0.2s;
        }

        .sub-nav-link.active-sub .sub-dot {
            background: var(--kominfo-gold);
        }

        /* ─── SIDEBAR FOOTER ───────────────────────────────────────────────── */
        .sidebar-footer {
            padding: 14px 16px;
            border-top: 1px solid rgba(255,255,255,0.07);
            flex-shrink: 0;
        }

        .sidebar-footer-info {
            font-size: 10px;
            color: rgba(255,255,255,0.25);
            text-align: center;
            font-family: 'DM Mono', monospace;
            letter-spacing: 0.5px;
        }

        /* ─── MAIN CONTENT ─────────────────────────────────────────────────── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ─── TOP NAVBAR ───────────────────────────────────────────────────── */
        .top-navbar {
            height: 64px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 32px;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        /* Breadcrumb area */
        .navbar-left {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .page-title-bar {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .page-title-bar .sep { color: #d0d7e5; }

        /* System status pill */
        .system-status {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            padding: 5px 12px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 700;
            color: #166534;
        }

        .status-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: #22c55e;
            animation: pulse-green 2s infinite;
        }

        @keyframes pulse-green {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        /* Navbar right area */
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        /* Notification bell */
        .notif-btn {
            width: 38px; height: 38px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-muted);
            font-size: 15px;
            transition: all 0.2s;
            position: relative;
            text-decoration: none;
        }

        .notif-btn:hover {
            background: var(--kominfo-blue-l);
            border-color: var(--kominfo-blue-m);
            color: var(--kominfo-blue-m);
        }

        /* ─── PROFILE DROPDOWN ─────────────────────────────────────────────── */
        .user-profile-wrapper { position: relative; }

        .user-profile-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            padding: 6px 14px 6px 6px;
            border-radius: 99px;
            border: 1px solid var(--border);
            cursor: pointer;
            transition: all 0.2s;
            user-select: none;
        }

        .user-profile-btn:hover {
            border-color: var(--kominfo-red);
            box-shadow: 0 0 0 3px rgba(204,0,0,0.07);
        }

        .user-avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--kominfo-red);
        }

        .user-info { line-height: 1.2; }

        .user-name {
            font-size: 12.5px;
            font-weight: 700;
            color: var(--text);
        }

        .user-role {
            font-size: 10px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .profile-dropdown-menu {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 210px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.12), 0 0 0 1px var(--border);
            display: none;
            z-index: 1001;
            overflow: hidden;
            animation: slideDown 0.18s ease-out;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .dropdown-header {
            padding: 14px 16px;
            background: linear-gradient(135deg, #003580, #001f4f);
            position: relative;
            overflow: hidden;
        }

        .dropdown-header::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: var(--kominfo-red);
        }

        .dropdown-header-label {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            margin-bottom: 4px;
        }

        .dropdown-header-name {
            font-size: 13px;
            font-weight: 700;
            color: white;
        }

        .dropdown-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 16px;
            color: #475569;
            text-decoration: none !important;
            font-size: 13px;
            font-weight: 600;
            transition: 0.15s;
            border-bottom: 1px solid #f8fafc;
        }

        .dropdown-link:hover {
            background: var(--kominfo-blue-l);
            color: var(--kominfo-blue);
        }

        .dropdown-link .di {
            width: 28px; height: 28px;
            border-radius: 8px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #64748b;
            transition: 0.15s;
        }

        .dropdown-link:hover .di {
            background: var(--kominfo-blue-l);
            color: var(--kominfo-blue);
        }

        .logout-btn {
            width: 100%;
            border: none;
            background: none;
            cursor: pointer;
            color: #dc2626;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 16px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 13px;
            transition: 0.15s;
        }

        .logout-btn:hover { background: #fff1f2; }

        .logout-btn .di {
            width: 28px; height: 28px;
            border-radius: 8px;
            background: #fee2e2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #dc2626;
        }

        /* ─── CONTENT BODY ─────────────────────────────────────────────────── */
        .content-body {
            flex: 1;
            padding: 0;
        }

        /* ─── GOVERNMENT EMBLEM watermark in sidebar ──────────────────────── */
        .sidebar-emblem {
            position: absolute;
            bottom: 60px;
            right: -20px;
            width: 120px;
            height: 120px;
            opacity: 0.035;
            pointer-events: none;
        }
    </style>
</head>
<body>

    <!-- ═══════════════════════════════════════════════════════ SIDEBAR -->
    <aside class="sidebar">

        <!-- Brand -->
        <div class="sidebar-brand">
            <div class="brand-badge">
                <i class="fa-solid fa-circle" style="font-size: 6px;"></i>
                Pemerintah Daerah
            </div>
            <div class="brand-title">
                JDIH <span>Kominfo Tanah Datar</span>
            </div>
            <div class="brand-sub">Jaringan Dokumentasi & Informasi Hukum</div>
        </div>

        <!-- Nav -->
        <nav class="sidebar-nav">

            <!-- ─ UTAMA ─ -->
            <div class="nav-section-label">Utama</div>
            <ul class="nav-list">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link-item {{ request()->is('*dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-gauge-high nav-icon"></i>
                        <span class="nav-label">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('berita.index') }}"
                       class="nav-link-item {{ request()->is('*berita*') ? 'active' : '' }}">
                        <i class="fa-solid fa-newspaper nav-icon"></i>
                        <span class="nav-label">Manajemen Berita</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('buku.index') }}"
                       class="nav-link-item {{ request()->is('*buku*') ? 'active' : '' }}">
                        <i class="fa-solid fa-book-open nav-icon"></i>
                        <span class="nav-label">Perpustakaan</span>
                    </a>
                </li>

            </ul>

            <!-- ─ REGULASI ─ -->
            <div class="nav-section-label">Regulasi</div>
            <ul class="nav-list">

                <!-- Jenis Peraturan (dropdown) -->
                <li class="nav-item">
                    <button class="nav-link-item {{ request()->is('*perda*') || request()->is('*perbupati*') || request()->is('*kepbupati*') || request()->is('*insbupati*') || request()->is('*propemda*') || request()->is('*kerjasama*') ? 'active' : '' }}"
                            id="btnPeraturan" onclick="toggleSubMenu('subMenuPeraturan', 'arrowPeraturan', this)">
                        <i class="fa-solid fa-scale-balanced nav-icon"></i>
                        <span class="nav-label">Jenis Peraturan</span>
                        <i class="fa-solid fa-chevron-down nav-arrow" id="arrowPeraturan"></i>
                    </button>
                    <ul class="sub-nav {{ request()->is('*perda*') || request()->is('*perbupati*') || request()->is('*kepbupati*') || request()->is('*insbupati*') || request()->is('*propemda*') || request()->is('*kerjasama*') ? 'open' : '' }}"
                        id="subMenuPeraturan">
                        <li>
                            <a href="{{ route('perda.index') }}" class="sub-nav-link {{ request()->is('*perda*') ? 'active-sub' : '' }}">
                                <span class="sub-dot"></span> Peraturan Daerah
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('perbupati.index') }}" class="sub-nav-link {{ request()->is('*perbupati*') ? 'active-sub' : '' }}">
                                <span class="sub-dot"></span> Peraturan Bupati
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kepbupati.index') }}" class="sub-nav-link {{ request()->is('*kepbupati*') ? 'active-sub' : '' }}">
                                <span class="sub-dot"></span> Keputusan Bupati
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('insbupati.index') }}" class="sub-nav-link {{ request()->is('*insbupati*') ? 'active-sub' : '' }}">
                                <span class="sub-dot"></span> Instruksi Bupati
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('propemda.index') }}" class="sub-nav-link {{ request()->is('*propemda*') ? 'active-sub' : '' }}">
                                <span class="sub-dot"></span> Propemperda
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kerjasama.index') }}" class="sub-nav-link {{ request()->is('*kerjasama*') ? 'active-sub' : '' }}">
                                <span class="sub-dot"></span> Kerjasama Daerah
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('peraturan-terjemah.index') }}"
                       class="nav-link-item {{ Request::is('admin/peraturan-terjemah*') ? 'active' : '' }}">
                        <i class="fa-solid fa-language nav-icon"></i>
                        <span class="nav-label">Peraturan Terjemah</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('rancangan-puu.index') }}"
                       class="nav-link-item {{ Request::is('admin/rancangan-puu*') ? 'active' : '' }}">
                        <i class="fa-solid fa-file-shield nav-icon"></i>
                        <span class="nav-label">Rancangan PUU</span>
                    </a>
                </li>

            </ul>

            <!-- ─ DOKUMEN HUKUM ─ -->
            <div class="nav-section-label">Dokumen Hukum</div>
            <ul class="nav-list">

                <li class="nav-item">
                    <a href="{{ route('kajian-hukum.index') }}"
                       class="nav-link-item {{ Request::is('admin/kajian-hukum*') ? 'active' : '' }}">
                        <i class="fa-solid fa-file-contract nav-icon"></i>
                        <span class="nav-label">Kajian Hukum</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('naskah-akademik.index') }}"
                       class="nav-link-item {{ Request::is('admin/naskah-akademik*') ? 'active' : '' }}">
                        <i class="fa-solid fa-book-bookmark nav-icon"></i>
                        <span class="nav-label">Naskah Akademik</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('analisis-evaluasi.index') }}"
                       class="nav-link-item {{ request()->is('*analisis-evaluasi*') ? 'active' : '' }}">
                        <i class="fa-solid fa-magnifying-glass-chart nav-icon"></i>
                        <span class="nav-label">Analisis Evaluasi</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('risalah-hukum.index') }}"
                       class="nav-link-item {{ request()->is('*risalah-hukum*') ? 'active' : '' }}">
                        <i class="fa-solid fa-scroll nav-icon"></i>
                        <span class="nav-label">Risalah Hukum</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('relaas.index') }}"
                       class="nav-link-item {{ request()->is('*relaas*') ? 'active' : '' }}">
                        <i class="fa-solid fa-gavel nav-icon"></i>
                        <span class="nav-label">Relaas Pengadilan</span>
                    </a>
                </li>

            </ul>

            <!-- ─ KONTEN & MEDIA ─ -->
            <div class="nav-section-label">Konten & Media</div>
            <ul class="nav-list">

                <li class="nav-item">
                    <a href="{{ route('artikel.index') }}"
                       class="nav-link-item {{ request()->is('*artikel*') ? 'active' : '' }}">
                        <i class="fa-solid fa-pen-nib nav-icon"></i>
                        <span class="nav-label">Kelola Artikel</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('infografis.index') }}"
                       class="nav-link-item {{ Request::is('admin/infografis*') ? 'active' : '' }}">
                        <i class="fa-solid fa-image nav-icon"></i>
                        <span class="nav-label">Infografis</span>
                    </a>
                </li>

            </ul>

            <!-- ─ PENGATURAN ─ -->
            <div class="nav-section-label">Pengaturan</div>
            <ul class="nav-list">

                <li class="nav-item">
                    <a href="{{ route('kontak.index') }}"
                       class="nav-link-item {{ Request::is('admin/kontak*') ? 'active' : '' }}">
                        <i class="fa-solid fa-address-book nav-icon"></i>
                        <span class="nav-label">Kontak</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}"
                       class="nav-link-item {{ request()->is('*profile*') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-gear nav-icon"></i>
                        <span class="nav-label">Profil Akun</span>
                    </a>
                </li>

            </ul>

        </nav>

        <!-- Footer -->
        <div class="sidebar-footer">
            <div class="sidebar-footer-info">
                v1.0.0 · JDIH Kominfo · {{ date('Y') }}
            </div>
        </div>

    </aside>

    <!-- ═══════════════════════════════════════════════════════ MAIN -->
    <main class="main-wrapper">

        <!-- Top Navbar -->
        <header class="top-navbar">
            <div class="navbar-left">
                <div class="page-title-bar">
                    <i class="fa-solid fa-house" style="color: var(--kominfo-red); font-size: 12px;"></i>
                    <span class="sep">/</span>
                    <span style="color: var(--text);">
                        @php
                            $segments = request()->segments();
                            $last = end($segments);
                            $labels = [
                                'dashboard'         => 'Dashboard',
                                'berita'            => 'Manajemen Berita',
                                'buku'              => 'Perpustakaan',
                                'perda'             => 'Peraturan Daerah',
                                'perbupati'         => 'Peraturan Bupati',
                                'kepbupati'         => 'Keputusan Bupati',
                                'insbupati'         => 'Instruksi Bupati',
                                'propemda'          => 'Propemperda',
                                'kerjasama'         => 'Kerjasama Daerah',
                                'artikel'           => 'Kelola Artikel',
                                'relaas'            => 'Relaas Pengadilan',
                                'analisis-evaluasi' => 'Analisis Evaluasi',
                                'risalah-hukum'     => 'Risalah Hukum',
                                'kajian-hukum'      => 'Kajian Hukum',
                                'peraturan-terjemah'=> 'Peraturan Terjemah',
                                'rancangan-puu'     => 'Rancangan PUU',
                                'naskah-akademik'   => 'Naskah Akademik',
                                'infografis'        => 'Infografis',
                                'kontak'            => 'Kontak',
                                'profile'           => 'Profil Akun',
                                'create'            => 'Tambah Data',
                                'edit'              => 'Edit Data',
                            ];
                            echo $labels[$last] ?? ucwords(str_replace('-', ' ', $last));
                        @endphp
                    </span>
                </div>
            </div>

            <div class="navbar-right">

                <!-- System status -->
                <div class="system-status">
                    <div class="status-dot"></div>
                    Sistem Aktif
                </div>

                <!-- Profile Dropdown -->
                <div class="user-profile-wrapper">
                    <div id="profileDropdownBtn" class="user-profile-btn">
                        <img class="user-avatar"
                             src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=cc0000&color=fff&bold=true&size=64' }}"
                             alt="avatar">
                        <div class="user-info">
                            <div class="user-name">{{ Str::limit(Auth::user()->name ?? 'Admin', 18) }}</div>
                            <div class="user-role">Administrator</div>
                        </div>
                        <i class="fa-solid fa-chevron-down" style="font-size: 10px; color: var(--text-muted); margin-left: 2px;"></i>
                    </div>

                    <div id="profileMenu" class="profile-dropdown-menu">
                        <div class="dropdown-header">
                            <div class="dropdown-header-label">Akun Anda</div>
                            <div class="dropdown-header-name">{{ Auth::user()->name ?? 'Administrator' }}</div>
                        </div>

                        <a href="{{ route('profile.edit') }}" class="dropdown-link">
                            <span class="di"><i class="fa-regular fa-user"></i></span>
                            Lihat Profil
                        </a>

                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <span class="di"><i class="fa-solid fa-power-off"></i></span>
                                Keluar dari Sistem
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </header>

        <!-- Page Content -->
        <div class="content-body">
            @yield('content')
        </div>

    </main>

    <!-- ─── SCRIPTS ──────────────────────────────────────────────── -->
    <script>
        // Profile dropdown toggle
        document.addEventListener('DOMContentLoaded', function () {
            const btn  = document.getElementById('profileDropdownBtn');
            const menu = document.getElementById('profileMenu');

            if (btn && menu) {
                btn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const open = menu.style.display === 'block';
                    menu.style.display = open ? 'none' : 'block';
                });
                document.addEventListener('click', function () {
                    menu.style.display = 'none';
                });
                menu.addEventListener('click', function (e) { e.stopPropagation(); });
            }

            // Auto-open peraturan submenu if active
            const subPeraturan = document.getElementById('subMenuPeraturan');
            if (subPeraturan && subPeraturan.classList.contains('open')) {
                const arrow = document.getElementById('arrowPeraturan');
                if (arrow) arrow.style.transform = 'rotate(180deg)';
            }
        });

        // Submenu toggle
        function toggleSubMenu(menuId, arrowId, btn) {
            const menu  = document.getElementById(menuId);
            const arrow = document.getElementById(arrowId);
            const isOpen = menu.classList.contains('open');

            if (isOpen) {
                menu.classList.remove('open');
                arrow.style.transform = 'rotate(0deg)';
            } else {
                menu.classList.add('open');
                arrow.style.transform = 'rotate(180deg)';
            }
        }
    </script>

</body>
</html>