{{--
    ╔══════════════════════════════════════════════╗
    ║  PARTIAL: head.blade.php  (v3 — improved)    ║
    ║  Isi: <head>, favicon SVG, semua CSS         ║
    ╚══════════════════════════════════════════════╝
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JDIH — Kabupaten Tanah Datar</title>
    <meta name="description" content="Portal Hukum & Regulasi resmi Kabupaten Tanah Datar. Temukan peraturan daerah, kajian hukum, dan produk hukum lainnya.">

    {{-- ── FAVICON: gunakan logo asli jika ada, fallback ke SVG inline ── --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logoku.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logoku.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/logoku.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logoku.png') }}">

    {{-- Fallback: SVG favicon inline via data URI jika logo.png gagal --}}
    <script>
    (function(){
        var img = new Image();
        img.onerror = function(){
            var svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"><rect width="64" height="64" rx="14" fill="#0b1f4a"/><rect x="4" y="4" width="56" height="56" rx="11" fill="url(%23g)"/><defs><linearGradient id="g" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="%230d2255"/><stop offset="1" stop-color="%231a3a8f"/></linearGradient></defs><text x="50%" y="54%" dominant-baseline="middle" text-anchor="middle" font-family="Georgia,serif" font-weight="700" font-size="26" fill="%23f0b429">JD</text></svg>';
            var link = document.querySelector("link[rel~=\'icon\']");
            if(link) link.href = "data:image/svg+xml," + svg;
        };
        img.src = "{{ asset('images/logoku.png') }}";
    })();
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ════════════════════════════════════════════
           CSS VARIABLES & RESET
        ════════════════════════════════════════════ */
        :root {
            --navy:#0b1f4a; --navy-mid:#132860; --navy-light:#1a3a8f; --navy-deep:#060f23;
            --gold:#c8960c; --gold-light:#f0b429; --gold-pale:#fef9e7;
            --cream:#f5f4f0; --white:#fff;
            --gray-50:#f9fafb; --gray-100:#f3f4f6; --gray-200:#e5e7eb;
            --gray-300:#d1d5db; --gray-400:#9ca3af; --gray-500:#6b7280; --gray-700:#374151;
            --text:#0c1628; --text-soft:#4b5563;
            --r-sm:10px; --r:16px; --r-lg:22px; --r-xl:32px;
            --sh-sm:0 2px 10px rgba(11,31,74,.07);
            --sh:0 6px 24px rgba(11,31,74,.10);
            --sh-lg:0 16px 52px rgba(11,31,74,.15);
            --sh-xl:0 28px 80px rgba(11,31,74,.22);
            --ease:cubic-bezier(.4,0,.2,1);
            --spring:cubic-bezier(.34,1.56,.64,1);
            --slow:cubic-bezier(.22,1,.36,1);
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        html{scroll-behavior:smooth;}
        body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--cream);color:var(--text);line-height:1.6;}
        html{overflow-x:hidden;}
        body{overflow-x:clip;max-width:100vw;}
        ::selection{background:rgba(240,180,41,.25);color:var(--navy);}
        ::-webkit-scrollbar{width:5px;}
        ::-webkit-scrollbar-track{background:var(--gray-100);}
        ::-webkit-scrollbar-thumb{background:linear-gradient(180deg,var(--navy-light),var(--gold));border-radius:10px;}

        /* ════════════════════════════════════════════
           WELCOME SPLASH
        ════════════════════════════════════════════ */
        #welcomeSplash{
            position:fixed;inset:0;z-index:9999;
            display:flex;align-items:center;justify-content:center;
            pointer-events:all;
            transition:opacity .7s cubic-bezier(.4,0,.2,1), visibility .7s;
        }
        #welcomeSplash.ws-hide{
            opacity:0;visibility:hidden;pointer-events:none;
        }
        .ws-bg{
            position:absolute;inset:0;
            background:linear-gradient(145deg,#040c1e 0%,#0b1f4a 45%,#0d2a6e 100%);
        }
        .ws-bg::before{
            content:'';position:absolute;inset:0;
            background-image:radial-gradient(rgba(240,180,41,.07) 1px,transparent 1px);
            background-size:28px 28px;
        }
        .ws-bg::after{
            content:'';position:absolute;
            width:600px;height:600px;border-radius:50%;
            background:radial-gradient(circle,rgba(200,150,12,.12),transparent 65%);
            top:-150px;right:-100px;pointer-events:none;
            animation:ws-orb 6s ease-in-out infinite;
        }
        @keyframes ws-orb{0%,100%{transform:translateY(0) scale(1);}50%{transform:translateY(-20px) scale(1.05);}}
        .ws-inner{
            position:relative;z-index:1;
            display:flex;flex-direction:column;align-items:center;
            gap:28px;text-align:center;
            animation:ws-in .7s cubic-bezier(.34,1.56,.64,1) both;
        }
        @keyframes ws-in{from{opacity:0;transform:translateY(32px) scale(.92);}to{opacity:1;transform:none;}}
        .ws-logo{
            width:120px;height:120px;border-radius:50%;
            background:#fff;
            border:4px solid rgba(200,150,12,.5);
            box-shadow:0 0 0 8px rgba(200,150,12,.1),0 20px 60px rgba(0,0,0,.4);
            overflow:hidden;
            animation:ws-logo-in .8s cubic-bezier(.34,1.56,.64,1) .15s both;
        }
        @keyframes ws-logo-in{from{opacity:0;transform:scale(.5) rotate(-15deg);}to{opacity:1;transform:scale(1) rotate(0);}}
        .ws-logo img{width:100%;height:100%;object-fit:cover;border-radius:50%;}
        .ws-text{display:flex;flex-direction:column;align-items:center;gap:6px;}
        .ws-selamat{
            font-size:.72rem;font-weight:700;letter-spacing:.25em;text-transform:uppercase;
            color:rgba(255,255,255,.4);
            animation:ws-fadeup .6s ease .3s both;opacity:0;
        }
        @keyframes ws-fadeup{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:none;}}
        .ws-title{
            font-family:'Playfair Display',serif;
            font-size:clamp(2rem,6vw,3.2rem);
            font-weight:700;color:#fff;
            letter-spacing:-.03em;line-height:1.1;
            animation:ws-fadeup .6s ease .42s both;opacity:0;
        }
        .ws-title em{
            color:var(--gold-light);font-style:italic;
            background:linear-gradient(135deg,var(--gold),var(--gold-light),#ffe17a);
            -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
        }
        .ws-sub{
            font-size:1rem;font-weight:600;color:rgba(255,255,255,.7);
            animation:ws-fadeup .6s ease .54s both;opacity:0;
        }
        .ws-tagline{
            margin-top:4px;
            font-size:.68rem;font-weight:600;letter-spacing:.12em;text-transform:uppercase;
            color:rgba(255,255,255,.28);
            animation:ws-fadeup .6s ease .66s both;opacity:0;
        }
        .ws-divider{
            width:60px;height:2px;border-radius:2px;
            background:linear-gradient(90deg,transparent,var(--gold),transparent);
            animation:ws-fadeup .6s ease .6s both;opacity:0;
        }

        /* ════════════════════════════════════════════
           TOPBAR + NAVBAR
        ════════════════════════════════════════════ */
        .site-header{position:sticky;top:0;z-index:1000;transition:box-shadow .4s var(--ease);}
        .site-header.scrolled{box-shadow:0 6px 40px rgba(11,31,74,.18);}
        .topbar{background:linear-gradient(90deg,var(--navy-deep) 0%,#0d2255 50%,var(--navy-deep) 100%);color:rgba(255,255,255,.38);font-size:.63rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;padding:7px 0;position:relative;overflow:hidden;}
        .topbar::after{content:'';position:absolute;bottom:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,rgba(240,180,41,.3),transparent);}
        .topbar-marquee{display:inline-flex;gap:0;animation:marquee 30s linear infinite;}
        .topbar-item{display:inline-flex;align-items:center;gap:8px;padding:0 26px;white-space:nowrap;}
        .topbar-item i{color:var(--gold-light);font-size:.7rem;}
        .topbar-dot{color:rgba(240,180,41,.28);margin:0 4px;}
        @keyframes marquee{from{transform:translateX(0);}to{transform:translateX(-50%);}}

        .navbar-main{background:rgba(255,255,255,.98);backdrop-filter:blur(28px);-webkit-backdrop-filter:blur(28px);border-bottom:1px solid rgba(11,31,74,.07);}
        .navbar-inner{display:flex;align-items:center;justify-content:space-between;height:68px;gap:16px;}
        .brand{display:flex;align-items:center;gap:13px;text-decoration:none;flex-shrink:0;}
        .brand-logo{width:54px;height:54px;border-radius:50%;overflow:hidden;background:#fff;border:2.5px solid rgba(200,150,12,.4);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 18px rgba(11,31,74,.22),0 0 0 4px rgba(200,150,12,.1);position:relative;flex-shrink:0;transition:.3s var(--spring);}
        .brand-logo img{width:100%;height:100%;object-fit:cover;border-radius:50%;}
        .brand-logo-fallback{font-family:'Playfair Display',serif;font-weight:700;font-size:1rem;color:var(--gold-light);}
        .brand:hover .brand-logo{transform:scale(1.08);box-shadow:0 8px 28px rgba(11,31,74,.32),0 0 0 6px rgba(200,150,12,.18);}
        .brand-name{font-size:.9rem;font-weight:800;color:var(--navy);line-height:1.2;letter-spacing:-.01em;}
        .brand-name em{color:var(--gold);font-style:normal;}
        .brand-sub{font-size:.58rem;color:var(--gray-500);font-weight:500;margin-top:2px;letter-spacing:.01em;}
        .nav-links{display:flex;align-items:center;gap:2px;}
        .nav-links > a,.nav-dd > .nav-btn{color:var(--text-soft);text-decoration:none;font-size:.77rem;font-weight:700;padding:7px 11px;border-radius:var(--r-sm);transition:all .2s var(--ease);display:flex;align-items:center;gap:5px;white-space:nowrap;border:none;background:none;cursor:pointer;letter-spacing:-.01em;font-family:inherit;}
        .nav-links > a:hover,.nav-links > a.active,.nav-dd:hover > .nav-btn{color:var(--navy);background:rgba(11,31,74,.06);}
        .nav-dd{position:relative;}
        .nav-dd-menu{position:absolute;top:100%;left:0;min-width:230px;background:var(--white);border:1px solid var(--gray-200);border-radius:var(--r);box-shadow:var(--sh-xl);padding:8px;padding-top:14px;z-index:999;opacity:0;pointer-events:none;transform:translateY(-6px) scale(.97);transform-origin:top left;transition:opacity .22s var(--ease),transform .22s var(--ease);}
        .nav-dd-menu::before{content:'';position:absolute;top:-12px;left:0;right:0;height:12px;}
        .nav-dd:hover .nav-dd-menu{opacity:1;pointer-events:all;transform:translateY(0) scale(1);}
        .nav-dd-menu a{display:flex;align-items:center;gap:10px;padding:9px 12px;color:var(--text-soft);text-decoration:none;font-size:.77rem;font-weight:600;border-radius:var(--r-sm);transition:.18s;}
        .nav-dd-menu a:hover{background:var(--gray-50);color:var(--navy);transform:translateX(3px);}
        .nav-dd-menu a i{width:16px;text-align:center;color:var(--gray-500);transition:.18s;}
        .nav-dd-menu a:hover i{color:var(--navy);}
        .dd-div{height:1px;background:var(--gray-100);margin:5px 0;}
        .dd-lbl{font-size:.58rem;font-weight:800;color:var(--gray-400);text-transform:uppercase;letter-spacing:.1em;padding:7px 12px 3px;}
        .btn-adm{background:var(--navy)!important;color:var(--white)!important;border-radius:var(--r-sm)!important;margin-left:6px;box-shadow:0 2px 12px rgba(11,31,74,.28);}
        .btn-adm:hover{background:var(--navy-light)!important;transform:translateY(-2px);box-shadow:0 5px 20px rgba(11,31,74,.35)!important;}
        .ham{display:none;background:none;border:1.5px solid var(--gray-200);border-radius:9px;padding:6px 10px;cursor:pointer;color:var(--navy);font-size:1.1rem;transition:.2s;}
        .ham:hover{background:var(--gray-100);}
        .mob-menu{display:none;padding:8px 0 16px;border-top:1px solid var(--gray-100);}
        .mob-menu a{display:flex;align-items:center;gap:9px;padding:10px 4px;color:var(--text-soft);text-decoration:none;font-size:.85rem;font-weight:600;border-bottom:1px solid var(--gray-100);transition:.15s;}
        .mob-menu a:hover{color:var(--navy);}
        .mob-lbl{font-size:.6rem;font-weight:800;color:var(--gray-500);text-transform:uppercase;letter-spacing:.1em;padding:12px 4px 4px;border-bottom:none!important;}
        .mob-menu a.sub{padding-left:24px;font-size:.8rem;}

        /* ════════════════════════════════════════════
           HERO — lebih tinggi, lebih berisi
        ════════════════════════════════════════════ */
        .hero{background:var(--navy-deep);position:relative;overflow:hidden;min-height:680px;display:flex;align-items:center;}
        .hero-bg{position:absolute;inset:0;background:radial-gradient(ellipse 75% 80% at 88% 25%,rgba(26,58,143,.7),transparent),radial-gradient(ellipse 50% 70% at 5% 80%,rgba(200,150,12,.09),transparent),linear-gradient(158deg,#040c1e 0%,#0b1f4a 48%,#102266 100%);}
        .hero-grid{position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.022) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.022) 1px,transparent 1px);background-size:52px 52px;}
        .hero-shimmer{position:absolute;top:0;left:-100%;width:60%;height:100%;background:linear-gradient(105deg,transparent,rgba(240,180,41,.04),transparent);animation:shimmer-hero 9s ease-in-out infinite 2s;}
        @keyframes shimmer-hero{0%,100%{left:-100%;}50%{left:150%;}}
        .hero-orb-a{position:absolute;width:600px;height:600px;border-radius:50%;background:radial-gradient(circle,rgba(200,150,12,.09),transparent 65%);top:-180px;right:2%;animation:orb 11s ease-in-out infinite;pointer-events:none;}
        .hero-orb-b{position:absolute;width:380px;height:380px;border-radius:50%;background:radial-gradient(circle,rgba(26,58,143,.5),transparent 70%);bottom:-120px;left:-2%;animation:orb 8s ease-in-out infinite reverse;pointer-events:none;}
        @keyframes orb{0%,100%{transform:translateY(0);}50%{transform:translateY(-20px);}}
        .hero-topline{position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent 10%,rgba(240,180,41,.5) 50%,transparent 90%);}
        .hero-inner{position:relative;z-index:2;padding:96px 0 88px;width:100%;}
        .hero-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(240,180,41,.1);border:1px solid rgba(240,180,41,.3);color:var(--gold-light);font-size:.66rem;font-weight:800;letter-spacing:.13em;text-transform:uppercase;padding:6px 18px;border-radius:30px;margin-bottom:24px;animation:fadeUp .6s var(--slow) both;}
        .hero-badge-dot{width:6px;height:6px;border-radius:50%;background:var(--gold-light);animation:pulse-dot 2s ease-in-out infinite;}
        @keyframes pulse-dot{0%,100%{opacity:1;transform:scale(1);}50%{opacity:.4;transform:scale(.7);}}
        .hero h1{font-family:'Playfair Display',serif;font-size:clamp(2.1rem,5.2vw,3.8rem);font-weight:700;color:var(--white);line-height:1.15;margin-bottom:20px;letter-spacing:-.03em;animation:fadeUp .7s var(--slow) .12s both;}
        .hero h1 em{color:var(--gold-light);font-style:italic;background:linear-gradient(135deg,var(--gold),var(--gold-light),#ffe17a);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
        .hero-desc{font-size:.97rem;color:rgba(255,255,255,.6);line-height:1.82;max-width:490px;margin-bottom:32px;animation:fadeUp .7s var(--slow) .22s both;}
        .hero-cta{display:flex;gap:12px;flex-wrap:wrap;margin-bottom:40px;animation:fadeUp .7s var(--slow) .32s both;}
        .btn-primary-hero{display:inline-flex;align-items:center;gap:9px;background:linear-gradient(135deg,var(--gold),var(--gold-light));color:var(--navy);font-size:.85rem;font-weight:800;padding:13px 26px;border-radius:var(--r-sm);text-decoration:none;transition:all .35s var(--spring);box-shadow:0 8px 32px rgba(200,150,12,.38);}
        .btn-primary-hero:hover{transform:translateY(-4px) scale(1.03);box-shadow:0 16px 48px rgba(200,150,12,.48);color:var(--navy);}
        .btn-outline-hero{display:inline-flex;align-items:center;gap:9px;background:rgba(255,255,255,.08);color:var(--white);font-size:.85rem;font-weight:700;padding:13px 26px;border-radius:var(--r-sm);text-decoration:none;border:1px solid rgba(255,255,255,.18);backdrop-filter:blur(10px);transition:all .35s var(--spring);}
        .btn-outline-hero:hover{background:rgba(255,255,255,.15);transform:translateY(-4px);border-color:rgba(255,255,255,.35);color:var(--white);}
        .hero-stats{display:flex;gap:0;animation:fadeUp .7s var(--slow) .44s both;border:1px solid rgba(255,255,255,.1);border-radius:var(--r);background:rgba(255,255,255,.04);backdrop-filter:blur(12px);overflow:hidden;width:fit-content;}
        .hs{padding:16px 24px;text-align:center;position:relative;}
        .hs + .hs::before{content:'';position:absolute;left:0;top:25%;height:50%;width:1px;background:rgba(255,255,255,.1);}
        .hs .n{display:block;font-family:'Playfair Display',serif;font-size:1.75rem;font-weight:700;color:var(--gold-light);line-height:1;}
        .hs .l{font-size:.6rem;color:rgba(255,255,255,.38);text-transform:uppercase;letter-spacing:.1em;margin-top:4px;}

        /* Hero panel (kanan) */
        .hero-panel{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-radius:var(--r-lg);padding:26px;backdrop-filter:blur(20px);animation:fadeUp .8s var(--slow) .18s both;}
        .hp-title{font-size:.72rem;font-weight:800;color:rgba(255,255,255,.42);text-transform:uppercase;letter-spacing:.12em;margin-bottom:18px;display:flex;align-items:center;gap:8px;}
        .hp-title i{color:var(--gold-light);}
        .hcat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;}
        .hcat{display:flex;flex-direction:column;align-items:center;gap:9px;padding:16px 10px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:var(--r);text-decoration:none;color:rgba(255,255,255,.7);font-size:.68rem;font-weight:700;text-align:center;transition:all .35s var(--spring);}
        .hcat i{font-size:1.4rem;color:rgba(255,255,255,.45);transition:.35s;}
        .hcat:hover{background:rgba(255,255,255,.13);border-color:rgba(255,255,255,.25);color:var(--white);transform:translateY(-5px);}
        .hcat:hover i{color:var(--gold-light);transform:scale(1.15);}
        .hcat.gold{background:rgba(240,180,41,.12);border-color:rgba(240,180,41,.3);}
        .hcat.gold i{color:var(--gold-light);}
        .hcat.gold:hover{background:rgba(240,180,41,.22);}

        /* ── Tambahan: Hero bottom-wave pemisah ── */
        .hero-wave{position:absolute;bottom:-1px;left:0;right:0;line-height:0;}
        .hero-wave svg{width:100%;height:54px;display:block;}

        /* ════════════════════════════════════════════
           SEARCH BAR — lebih premium
        ════════════════════════════════════════════ */
        .search-section{background:var(--white);padding:28px 0;border-bottom:1px solid var(--gray-100);box-shadow:0 4px 24px rgba(11,31,74,.06);}
        .search-wrap{position:relative;}
        .search-box{display:flex;align-items:center;background:var(--gray-50);border:2px solid var(--gray-200);border-radius:var(--r);overflow:hidden;transition:all .3s var(--ease);box-shadow:var(--sh-sm);}
        .search-box:focus-within{border-color:var(--navy-light);background:var(--white);box-shadow:0 0 0 4px rgba(26,58,143,.1),var(--sh);}
        .search-box .si{padding:0 14px 0 18px;color:var(--gray-400);font-size:1.05rem;flex-shrink:0;}
        .search-box input{flex:1;border:none;background:transparent;padding:15px 8px;font-size:.95rem;font-family:inherit;color:var(--text);outline:none;}
        .search-box input::placeholder{color:var(--gray-400);}
        .search-box button{background:var(--navy);color:var(--white);border:none;padding:14px 28px;font-size:.85rem;font-weight:800;font-family:inherit;cursor:pointer;display:flex;align-items:center;gap:8px;transition:.25s;white-space:nowrap;letter-spacing:.02em;}
        .search-box button:hover{background:var(--navy-light);}
        /* ── SUGGESTIONS DROPDOWN ── */
        .search-suggest{position:absolute;top:calc(100% + 6px);left:0;right:0;background:var(--white);border:1.5px solid var(--gray-200);border-radius:var(--r);box-shadow:0 12px 40px rgba(11,31,74,.14);z-index:999;overflow:hidden;animation:suggestIn .18s ease;}
        @keyframes suggestIn{from{opacity:0;transform:translateY(-6px)}to{opacity:1;transform:translateY(0)}}
        .suggest-item{display:flex;align-items:center;gap:10px;padding:11px 16px;text-decoration:none;color:var(--text);transition:.15s;border-bottom:1px solid var(--gray-100);}
        .suggest-item:last-child{border-bottom:none;}
        .suggest-item:hover{background:var(--gray-50);}
        .suggest-icon{width:30px;height:30px;border-radius:8px;background:var(--navy);display:flex;align-items:center;justify-content:center;color:var(--gold-light);font-size:.75rem;flex-shrink:0;}
        .suggest-text{flex:1;min-width:0;}
        .suggest-judul{font-size:.82rem;font-weight:600;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
        .suggest-label{font-size:.65rem;color:var(--gray-500);margin-top:1px;}
        .suggest-footer{padding:9px 16px;background:var(--gray-50);border-top:1px solid var(--gray-100);font-size:.72rem;color:var(--navy);font-weight:600;text-align:center;cursor:pointer;}
        .suggest-footer:hover{background:var(--gray-100);}
        /* Search tags */
        .search-tags{display:flex;align-items:center;gap:8px;margin-top:14px;flex-wrap:wrap;}
        .search-tag-lbl{font-size:.68rem;color:var(--gray-500);font-weight:600;}
        .search-tag{display:inline-flex;align-items:center;gap:5px;background:var(--gray-100);border:1px solid var(--gray-200);color:var(--text-soft);font-size:.7rem;font-weight:600;padding:4px 12px;border-radius:20px;text-decoration:none;transition:.2s;}
        .search-tag:hover{background:var(--navy);color:var(--white);border-color:var(--navy);}

        /* ════════════════════════════════════════════
           STATS BAR — lebih berisi
        ════════════════════════════════════════════ */
        .stats-bar{background:var(--navy);padding:0;}
        .sbar-inner{display:grid;grid-template-columns:repeat(4,1fr);}
        .sbar-item{display:flex;align-items:center;gap:15px;padding:22px 28px;text-decoration:none;color:inherit;border-right:1px solid rgba(255,255,255,.07);transition:background .25s;}
        .sbar-item:last-child{border-right:none;}
        .sbar-item:hover{background:rgba(255,255,255,.06);}
        .sbar-icon{width:46px;height:46px;background:rgba(255,255,255,.1);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:var(--gold-light);flex-shrink:0;transition:.35s var(--spring);}
        .sbar-item:hover .sbar-icon{background:var(--gold);color:var(--navy);transform:scale(1.1) rotate(-5deg);}
        .sbar-num{font-family:'Playfair Display',serif;font-size:1.7rem;font-weight:700;color:var(--white);line-height:1;}
        .sbar-lbl{font-size:.65rem;color:rgba(255,255,255,.42);text-transform:uppercase;letter-spacing:.08em;font-weight:600;margin-top:3px;}
        .sbar-info{display:flex;flex-direction:column;}

        /* ════════════════════════════════════════════
           CAT TABS — sticky scroll nav
        ════════════════════════════════════════════ */
        .cat-tabs{background:var(--white);border-bottom:2px solid var(--gray-100);position:sticky;top:var(--header-h,104px);z-index:800;}
        .cat-tabs-inner{display:flex;gap:0;overflow-x:auto;scrollbar-width:none;}
        .cat-tabs-inner::-webkit-scrollbar{display:none;}
        .cat-tab{display:flex;align-items:center;gap:7px;padding:14px 20px;color:var(--text-soft);font-size:.78rem;font-weight:700;text-decoration:none;white-space:nowrap;border-bottom:3px solid transparent;transition:all .22s var(--ease);margin-bottom:-2px;}
        .cat-tab:hover{color:var(--navy);background:rgba(11,31,74,.03);}
        .cat-tab.active{color:var(--navy);border-bottom-color:var(--gold);}

        /* ════════════════════════════════════════════
           SECTION HEADERS (shared)
        ════════════════════════════════════════════ */
        .sec-eyebrow{font-size:.62rem;font-weight:800;color:var(--gold);text-transform:uppercase;letter-spacing:.14em;margin-bottom:10px;display:inline-flex;align-items:center;gap:7px;}
        .sec-title{font-family:'Playfair Display',serif;font-size:2.15rem;font-weight:700;color:var(--text);margin-bottom:11px;letter-spacing:-.03em;line-height:1.22;}
        .sec-title em{color:var(--navy-light);font-style:italic;}
        .sec-desc{font-size:.88rem;color:var(--text-soft);line-height:1.8;max-width:480px;}
        .sec-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:36px;gap:20px;flex-wrap:wrap;}
        .btn-all{display:inline-flex;align-items:center;gap:8px;font-size:.78rem;font-weight:700;padding:10px 20px;border-radius:var(--r-sm);text-decoration:none;transition:all .3s var(--spring);white-space:nowrap;}
        .btn-all-navy{background:var(--navy);color:var(--white);box-shadow:0 4px 16px rgba(11,31,74,.25);}
        .btn-all-navy:hover{background:var(--navy-light);transform:translateY(-3px);box-shadow:0 8px 28px rgba(11,31,74,.35);color:var(--white);}
        .btn-all-ghost{background:rgba(255,255,255,.08);color:rgba(255,255,255,.7);border:1px solid rgba(255,255,255,.18);}
        .btn-all-ghost:hover{background:rgba(255,255,255,.15);color:var(--white);transform:translateY(-2px);}

        /* badge shared */
        .badge{font-size:.6rem;font-weight:800;padding:3px 9px;border-radius:5px;text-transform:uppercase;letter-spacing:.04em;}
        .badge-perda{background:#dbeafe;color:#1e3a8a;}
        .badge-perbupati{background:#dcfce7;color:#14532d;}
        .badge-kepbupati{background:#fef9c3;color:#713f12;}
        .badge-insbupati{background:#fee2e2;color:#7f1d1d;}
        .badge-kajian{background:#d1fae5;color:#064e3b;}
        .badge-naskah{background:#e0e7ff;color:#312e81;}
        .badge-analisis{background:#fff7ed;color:#9a3412;}
        .badge-risalah{background:#faf5ff;color:#581c87;}
        .badge-relaas{background:#fef2f2;color:#7f1d1d;}
        .badge-artikel{background:#ecfdf5;color:#064e3b;}
        .badge-buku{background:#f0fdf4;color:#14532d;}

        /* ════════════════════════════════════════════
           PRODUK TERBARU
        ════════════════════════════════════════════ */
        .sec-terbaru{padding:80px 0;background:var(--cream);}
        .pt-tabs{display:flex;gap:6px;flex-wrap:wrap;}
        .pt-tab{display:flex;align-items:center;gap:6px;padding:8px 16px;border-radius:var(--r-sm);font-size:.76rem;font-weight:700;font-family:inherit;border:1.5px solid var(--gray-200);background:var(--white);color:var(--text-soft);cursor:pointer;transition:all .22s var(--ease);}
        .pt-tab:hover{border-color:var(--navy);color:var(--navy);}
        .pt-tab.active{background:var(--navy);color:var(--white);border-color:var(--navy);box-shadow:0 4px 16px rgba(11,31,74,.25);}
        .pt-panel{display:none;}
        .pt-panel.active{display:block;animation:ptFadeIn .3s ease;}
        @keyframes ptFadeIn{from{opacity:0;transform:translateY(8px);}to{opacity:1;transform:translateY(0);}}
        .pt-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px;}

        /* Doc card */
        .doc-card{background:var(--white);border:1.5px solid var(--gray-200);border-radius:var(--r);padding:20px;display:flex;flex-direction:column;gap:12px;text-decoration:none;color:inherit;transition:all .4s var(--spring);position:relative;overflow:hidden;}
        .doc-card::after{content:'';position:absolute;bottom:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--navy),var(--navy-light));transform:scaleX(0);transform-origin:left;transition:transform .3s ease;}
        .doc-card:hover{transform:translateY(-5px);box-shadow:var(--sh-lg);border-color:rgba(11,31,74,.15);color:inherit;}
        .doc-card:hover::after{transform:scaleX(1);}
        .doc-card-head{display:flex;align-items:center;gap:10px;}
        .doc-icon{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:.95rem;flex-shrink:0;}
        .doc-title{font-size:.84rem;font-weight:600;color:var(--text);line-height:1.52;flex:1;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;transition:.18s;}
        .doc-card:hover .doc-title{color:var(--navy);}
        .doc-foot{display:flex;align-items:center;justify-content:space-between;padding-top:12px;border-top:1px solid var(--gray-100);margin-top:auto;}
        .doc-date{font-size:.67rem;color:var(--gray-500);display:flex;align-items:center;gap:4px;}
        .doc-arrow{width:28px;height:28px;background:var(--gray-100);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--navy);font-size:.78rem;transition:all .3s var(--spring);}
        .doc-card:hover .doc-arrow{background:var(--navy);color:var(--white);transform:scale(1.1);}
        .pt-empty{text-align:center;padding:52px 20px;color:var(--gray-400);}
        .pt-empty i{font-size:2.5rem;margin-bottom:12px;display:block;opacity:.35;}

        /* ════════════════════════════════════════════
           REGULASI
        ════════════════════════════════════════════ */
        .sec-regulasi{padding:80px 0;background:var(--navy-deep);position:relative;overflow:hidden;}
        .sec-regulasi::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 100% 50%,rgba(26,58,143,.5),transparent),radial-gradient(ellipse 50% 55% at 0% 0%,rgba(200,150,12,.06),transparent);}
        .sec-regulasi::after{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.018) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.018) 1px,transparent 1px);background-size:52px 52px;pointer-events:none;}
        .reg-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:32px;position:relative;z-index:1;flex-wrap:wrap;gap:16px;}
        .reg-eyebrow{font-size:.62rem;font-weight:800;color:var(--gold-light);text-transform:uppercase;letter-spacing:.14em;margin-bottom:8px;display:flex;align-items:center;gap:7px;}
        .reg-title{font-family:'Playfair Display',serif;font-size:2.2rem;font-weight:700;color:var(--white);letter-spacing:-.03em;}
        .reg-nav{display:flex;gap:7px;flex-wrap:wrap;margin-bottom:24px;position:relative;z-index:1;}
        .reg-btn{display:flex;align-items:center;gap:7px;padding:9px 18px;border-radius:var(--r-sm);font-size:.76rem;font-weight:700;font-family:inherit;border:1.5px solid rgba(255,255,255,.12);background:rgba(255,255,255,.06);color:rgba(255,255,255,.55);cursor:pointer;transition:all .22s var(--ease);}
        .reg-btn:hover{border-color:rgba(255,255,255,.28);color:var(--white);background:rgba(255,255,255,.1);}
        .reg-btn.active{background:var(--gold);color:var(--navy);border-color:var(--gold);box-shadow:0 4px 20px rgba(200,150,12,.4);}
        .reg-panel{display:none;position:relative;z-index:1;}
        .reg-panel.active{display:block;}
        .reg-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:14px;}
        .reg-card{display:flex;align-items:center;gap:14px;padding:17px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:var(--r);text-decoration:none;color:inherit;transition:all .4s var(--spring);position:relative;overflow:hidden;}
        .reg-card::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(255,255,255,.04),transparent);opacity:0;transition:.35s;}
        .reg-card:hover{background:rgba(255,255,255,.1);border-color:rgba(255,255,255,.22);transform:translateY(-4px);box-shadow:0 12px 40px rgba(0,0,0,.3);color:inherit;}
        .reg-card:hover::before{opacity:1;}
        .reg-icon{width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0;transition:.35s var(--spring);}
        .reg-card:hover .reg-icon{transform:scale(1.12) rotate(-5deg);}
        .reg-body{flex:1;min-width:0;}
        .reg-badges{display:flex;gap:4px;flex-wrap:wrap;margin-bottom:8px;}
        .reg-card-title{font-size:.82rem;font-weight:600;color:rgba(255,255,255,.88);line-height:1.52;margin-bottom:8px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
        .reg-date{font-size:.63rem;color:rgba(255,255,255,.3);display:flex;align-items:center;gap:4px;}
        .reg-arrow{width:28px;height:28px;background:rgba(255,255,255,.08);border-radius:8px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.42);font-size:.78rem;flex-shrink:0;transition:.35s var(--spring);align-self:flex-end;}
        .reg-card:hover .reg-arrow{background:rgba(255,255,255,.2);color:var(--white);transform:translateX(4px);}
        .reg-foot{display:flex;align-items:center;justify-content:space-between;margin-top:24px;padding-top:20px;border-top:1px solid rgba(255,255,255,.07);position:relative;z-index:1;}
        .reg-empty{text-align:center;padding:44px;color:rgba(255,255,255,.2);}

        /* ════════════════════════════════════════════
           DOKUMEN HUKUM
        ════════════════════════════════════════════ */
        .sec-dokumen{padding:80px 0;background:var(--gray-50);}
        .dok-header{text-align:center;margin-bottom:50px;}
        .dok-eyebrow{font-size:.62rem;font-weight:800;color:var(--navy);text-transform:uppercase;letter-spacing:.13em;margin-bottom:10px;display:inline-flex;align-items:center;gap:7px;background:var(--gray-100);padding:5px 18px;border-radius:24px;}
        .dok-title{font-family:'Playfair Display',serif;font-size:2.1rem;font-weight:700;color:var(--text);margin-bottom:11px;letter-spacing:-.03em;}
        .dok-sub{font-size:.86rem;color:var(--text-soft);max-width:500px;margin:0 auto;line-height:1.8;}
        .dok-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:22px;}
        .dok-col{background:var(--white);border:1.5px solid var(--gray-200);border-radius:var(--r);overflow:hidden;transition:all .4s var(--spring);}
        .dok-col:hover{box-shadow:var(--sh-lg);transform:translateY(-6px);}
        .dok-head{display:flex;align-items:center;gap:13px;padding:20px;position:relative;overflow:hidden;}
        .dok-head-bg{position:absolute;inset:0;background:linear-gradient(135deg,var(--acc,var(--navy)),color-mix(in srgb,var(--acc,var(--navy)) 55%,black));}
        .dok-head-bg::after{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(255,255,255,.14),transparent 55%);}
        .dok-head-orb{position:absolute;right:-20px;top:-20px;width:90px;height:90px;border-radius:50%;background:rgba(255,255,255,.06);}
        .dok-icon{width:40px;height:40px;background:rgba(255,255,255,.22);border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:1rem;color:var(--white);flex-shrink:0;position:relative;z-index:1;transition:.4s var(--spring);}
        .dok-col:hover .dok-icon{transform:scale(1.1) rotate(-6deg);}
        .dok-info{position:relative;z-index:1;flex:1;min-width:0;}
        .dok-label{font-size:.83rem;font-weight:700;color:var(--white);}
        .dok-count{font-size:.62rem;color:rgba(255,255,255,.56);margin-top:2px;}
        .dok-link{margin-left:auto;width:32px;height:32px;background:rgba(255,255,255,.18);border-radius:9px;display:flex;align-items:center;justify-content:center;color:var(--white);text-decoration:none;font-size:.85rem;transition:.35s var(--spring);z-index:1;position:relative;flex-shrink:0;}
        .dok-link:hover{background:rgba(255,255,255,.35);transform:scale(1.1);}
        .dok-list{padding:6px 0;}
        .dok-item{display:flex;align-items:center;gap:12px;padding:12px 20px;text-decoration:none;transition:background .18s;border-bottom:1px solid var(--gray-50);}
        .dok-item:last-child{border-bottom:none;}
        .dok-item:hover{background:var(--gray-50);}
        .dok-dot{width:7px;height:7px;border-radius:50%;background:var(--acc,var(--navy));flex-shrink:0;transition:.25s var(--spring);}
        .dok-item:hover .dok-dot{transform:scale(1.7);}
        .dok-item-body{flex:1;min-width:0;}
        .dok-item-title{font-size:.79rem;font-weight:600;color:var(--text);line-height:1.44;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;margin-bottom:4px;transition:.18s;}
        .dok-item:hover .dok-item-title{color:var(--navy);}
        .dok-item-meta{display:flex;align-items:center;gap:6px;font-size:.61rem;color:var(--gray-500);}
        .dok-item-arr{color:var(--gray-300);font-size:.72rem;transition:.25s var(--spring);flex-shrink:0;}
        .dok-item:hover .dok-item-arr{color:var(--acc,var(--navy));transform:translateX(4px);}

        /* ════════════════════════════════════════════
           MEDIA SECTION
        ════════════════════════════════════════════ */
        .sec-media{padding:80px 0;background:var(--white);}
        .media-grid{display:grid;grid-template-columns:1.45fr 1fr;gap:30px;}
        .blok-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;padding-bottom:12px;border-bottom:2px solid var(--gray-100);}
        .blok-head span{font-size:.8rem;font-weight:800;color:var(--text);display:flex;align-items:center;gap:8px;}
        .blok-head a{font-size:.74rem;font-weight:700;color:var(--navy);text-decoration:none;display:flex;align-items:center;gap:4px;opacity:.6;transition:.2s;}
        .blok-head a:hover{opacity:1;color:var(--gold);}
        .blok-side{display:flex;flex-direction:column;gap:30px;}
        .art-grid{display:grid;grid-template-columns:1fr 1fr;gap:11px;}
        .art-card{text-decoration:none;color:inherit;border-radius:var(--r-sm);overflow:hidden;background:var(--gray-50);transition:.4s var(--spring);}
        .art-card:hover{transform:translateY(-5px);box-shadow:var(--sh-lg);}
        .art-featured{grid-column:1/-1;}
        .art-img{position:relative;overflow:hidden;background:var(--gray-100);}
        .art-featured .art-img{height:200px;}
        .art-card:not(.art-featured) .art-img{height:120px;}
        .art-img img,.art-ph{width:100%;height:100%;object-fit:cover;}
        .art-ph{display:flex;align-items:center;justify-content:center;font-size:2.2rem;color:var(--gray-300);}
        .art-img img{transition:transform .55s var(--slow);}
        .art-card:hover .art-img img{transform:scale(1.08);}
        .art-overlay{position:absolute;top:10px;left:10px;}
        .art-body{padding:13px 15px;}
        .art-title{font-size:.79rem;font-weight:700;color:var(--text);line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;margin-bottom:5px;transition:.18s;}
        .art-card:hover .art-title{color:var(--navy);}
        .art-date{font-size:.63rem;color:var(--gray-500);display:flex;align-items:center;gap:4px;}
        .inf-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:8px;}
        .inf-card{text-decoration:none;color:inherit;}
        .inf-img{height:86px;border-radius:9px;overflow:hidden;background:var(--gray-100);margin-bottom:5px;transition:.3s var(--spring);}
        .inf-card:hover .inf-img{transform:scale(1.05);box-shadow:var(--sh);}
        .inf-img img,.inf-ph{width:100%;height:100%;object-fit:cover;}
        .inf-ph{display:flex;align-items:center;justify-content:center;font-size:1.6rem;color:var(--gray-300);}
        .inf-date{font-size:.58rem;color:var(--gray-500);text-align:center;}
        .buku-list{display:flex;flex-direction:column;gap:2px;}
        .buku-item{display:flex;align-items:center;gap:12px;padding:10px 6px;text-decoration:none;color:inherit;border-radius:9px;transition:.2s;}
        .buku-item:hover{background:var(--gray-50);}
        .buku-spine{width:36px;height:48px;border-radius:6px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.85);font-size:.9rem;flex-shrink:0;transition:.35s var(--spring);}
        .buku-item:hover .buku-spine{transform:scale(1.08) rotate(-3deg);}
        .buku-body{flex:1;min-width:0;}
        .buku-title{font-size:.78rem;font-weight:600;color:var(--text);line-height:1.42;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;margin-bottom:3px;transition:.18s;}
        .buku-item:hover .buku-title{color:var(--navy);}
        .buku-meta{display:flex;gap:5px;align-items:center;}

        /* ════════════════════════════════════════════
           BERITA
        ════════════════════════════════════════════ */
        .sec-berita{padding:80px 0;background:var(--navy-deep);position:relative;overflow:hidden;}
        .sec-berita::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 0% 50%,rgba(200,150,12,.06),transparent),radial-gradient(ellipse 55% 55% at 100% 0%,rgba(26,58,143,.35),transparent);}
        .sec-berita::after{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.012) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.012) 1px,transparent 1px);background-size:52px 52px;pointer-events:none;}
        .berita-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:38px;position:relative;z-index:1;}
        .berita-eyebrow{font-size:.63rem;font-weight:800;color:var(--gold-light);text-transform:uppercase;letter-spacing:.14em;margin-bottom:8px;display:flex;align-items:center;gap:7px;}
        .berita-title{font-family:'Playfair Display',serif;font-size:2.2rem;font-weight:700;color:var(--white);letter-spacing:-.03em;}
        .berita-layout{display:grid;grid-template-columns:1fr 1fr;gap:24px;position:relative;z-index:1;}
        .berita-feat{text-decoration:none;color:inherit;display:flex;flex-direction:column;border-radius:var(--r-lg);overflow:hidden;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);transition:all .45s var(--spring);}
        .berita-feat:hover{transform:translateY(-7px);box-shadow:0 30px 72px rgba(0,0,0,.4);}
        .berita-feat-img{height:285px;overflow:hidden;position:relative;background:var(--navy-light);}
        .berita-feat-img img{width:100%;height:100%;object-fit:cover;transition:transform .6s var(--slow);}
        .berita-feat:hover .berita-feat-img img{transform:scale(1.08);}
        .b-img-ph{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:4rem;color:rgba(255,255,255,.12);}
        .b-overlay{position:absolute;top:14px;left:14px;display:flex;gap:6px;}
        .b-badge{font-size:.6rem;font-weight:800;padding:4px 11px;border-radius:6px;background:rgba(7,20,47,.75);color:var(--white);backdrop-filter:blur(10px);}
        .b-badge-new{background:var(--gold);color:var(--navy);}
        .berita-feat-body{padding:24px;flex:1;}
        .berita-feat-title{font-size:.97rem;font-weight:700;color:var(--white);line-height:1.54;margin-bottom:12px;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;}
        .berita-feat-date{font-size:.69rem;color:rgba(255,255,255,.33);display:flex;align-items:center;gap:5px;margin-bottom:18px;}
        .berita-read{font-size:.78rem;font-weight:700;color:var(--gold-light);display:flex;align-items:center;gap:7px;transition:gap .25s var(--spring);}
        .berita-feat:hover .berita-read{gap:12px;}
        .berita-side{display:flex;flex-direction:column;}
        .berita-item{display:flex;align-items:center;gap:14px;padding:15px 0;text-decoration:none;color:inherit;border-bottom:1px solid rgba(255,255,255,.055);transition:padding-left .3s;}
        .berita-item:last-child{border-bottom:none;}
        .berita-item:hover{padding-left:8px;}
        .b-thumb{width:70px;height:70px;border-radius:11px;overflow:hidden;flex-shrink:0;background:rgba(255,255,255,.08);}
        .b-thumb img,.b-thumb-ph{width:100%;height:100%;object-fit:cover;}
        .b-thumb-ph{display:flex;align-items:center;justify-content:center;font-size:1.55rem;color:rgba(255,255,255,.18);}
        .b-body{flex:1;min-width:0;}
        .b-title{font-size:.79rem;font-weight:600;color:rgba(255,255,255,.82);line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;margin-bottom:4px;transition:.2s;}
        .berita-item:hover .b-title{color:var(--white);}
        .b-date{font-size:.63rem;color:rgba(255,255,255,.27);display:flex;align-items:center;gap:4px;}
        .b-num{font-family:'Playfair Display',serif;font-size:1.75rem;font-weight:700;color:rgba(255,255,255,.045);flex-shrink:0;width:36px;text-align:right;}

        /* ════════════════════════════════════════════
           FOOTER
        ════════════════════════════════════════════ */
        footer{background:var(--navy-deep);color:rgba(255,255,255,.5);padding:72px 0 0;position:relative;}
        footer::before{content:'';display:block;position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,rgba(240,180,41,.28),transparent);}
        .footer-logo{font-family:'Playfair Display',serif;font-size:1.35rem;font-weight:700;color:var(--white);margin-bottom:11px;letter-spacing:-.025em;}
        .footer-logo em{color:var(--gold-light);font-style:normal;}
        .footer-desc{font-size:.81rem;line-height:1.82;max-width:265px;margin-bottom:22px;color:rgba(255,255,255,.38);}
        .footer-socs{display:flex;gap:8px;margin-bottom:16px;}
        .footer-soc{width:36px;height:36px;background:rgba(255,255,255,.07);border-radius:10px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.42);text-decoration:none;font-size:.9rem;transition:.35s var(--spring);}
        .footer-soc:hover{background:var(--gold);color:var(--navy);transform:translateY(-4px) scale(1.1);}
        .footer-col h6{color:rgba(255,255,255,.85);font-size:.67rem;font-weight:800;text-transform:uppercase;letter-spacing:.11em;margin-bottom:15px;padding-bottom:10px;border-bottom:1px solid rgba(255,255,255,.07);}
        .footer-col ul{list-style:none;padding:0;margin:0;}
        .footer-col ul li{margin-bottom:8px;}
        .footer-col ul li a{color:rgba(255,255,255,.38);text-decoration:none;font-size:.79rem;transition:.22s;display:flex;align-items:center;gap:7px;}
        .footer-col ul li a:hover{color:var(--gold-light);padding-left:4px;}
        .footer-bottom{margin-top:52px;padding:17px 0;border-top:1px solid rgba(255,255,255,.055);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;font-size:.69rem;color:rgba(255,255,255,.2);}

        /* Back to top */
        #btt{position:fixed;bottom:26px;right:26px;width:46px;height:46px;background:var(--navy);color:var(--white);border:none;border-radius:13px;display:flex;align-items:center;justify-content:center;font-size:.95rem;cursor:pointer;box-shadow:var(--sh-xl);opacity:0;pointer-events:none;transition:opacity .4s,transform .45s var(--spring),background .22s;z-index:999;}
        #btt.show{opacity:1;pointer-events:all;}
        #btt:hover{background:var(--navy-light);transform:translateY(-5px) scale(1.1);}

        /* ════════════════════════════════════════════
           FIX MOBILE HOVER STUCK
           Semua :hover effect dibungkus @media(hover:hover)
           supaya di touchscreen tidak "nempel"
        ════════════════════════════════════════════ */
        @media (hover: hover) {
            .doc-card:hover{border-color:rgba(11,31,74,.2);box-shadow:var(--sh-lg);transform:translateY(-5px);}
            .doc-card:hover::before{transform:scaleX(1);}
            .doc-card:hover .doc-title{color:var(--navy-light);}
            .doc-card:hover .doc-arrow{background:var(--navy);color:var(--white);transform:translateX(3px);}
            .reg-card:hover{background:rgba(255,255,255,.1);border-color:rgba(255,255,255,.22);transform:translateY(-6px);box-shadow:0 20px 48px rgba(0,0,0,.3);}
            .reg-card:hover::before{opacity:1;}
            .reg-card:hover .reg-icon{transform:scale(1.12) rotate(-5deg);}
            .reg-card:hover .reg-arrow{background:var(--acc,rgba(255,255,255,.2));color:var(--white);transform:translateX(4px);}
            .dok-col:hover{box-shadow:var(--sh-lg);transform:translateY(-6px);}
            .dok-col:hover .dok-icon{transform:scale(1.1) rotate(-6deg);}
            .dok-item:hover{background:var(--gray-50);}
            .dok-item:hover .dok-dot{transform:scale(1.7);}
            .dok-item:hover .dok-item-title{color:var(--navy);}
            .dok-item:hover .dok-item-arr{color:var(--acc,var(--navy));transform:translateX(4px);}
            .art-card:hover{transform:translateY(-5px);box-shadow:var(--sh-lg);}
            .art-card:hover .art-img img{transform:scale(1.08);}
            .art-card:hover .art-title{color:var(--navy);}
            .inf-card:hover .inf-img{transform:scale(1.05);box-shadow:var(--sh);}
            .buku-item:hover{background:var(--gray-50);}
            .buku-item:hover .buku-spine{transform:scale(1.08) rotate(-3deg);}
            .buku-item:hover .buku-title{color:var(--navy);}
            .buku-card:hover{transform:translateY(-8px);}
            .buku-card:hover .buku-card-title{color:var(--navy);}
            .berita-feat:hover{transform:translateY(-7px);box-shadow:0 30px 72px rgba(0,0,0,.4);}
            .berita-feat:hover .berita-feat-img img{transform:scale(1.08);}
            .berita-feat:hover .berita-read{gap:12px;}
            .berita-item:hover{padding-left:8px;}
            .berita-item:hover .b-title{color:var(--white);}
            .berita-grid-card:hover{background:rgba(255,255,255,.1);border-color:rgba(255,255,255,.2);transform:translateY(-6px);box-shadow:0 20px 48px rgba(0,0,0,.3);}
            .berita-grid-card:hover .bgc-img img{transform:scale(1.08);}
            .berita-grid-card:hover .bgc-title{color:var(--white);}
            .bstrip-card:hover{transform:translateY(-6px) scale(1.02);box-shadow:0 14px 36px rgba(11,31,74,.14);border-color:rgba(11,31,74,.2);}
            .bstrip-card:hover .bstrip-img img{transform:scale(1.1);}
            .bstrip-card:hover .bstrip-title{color:var(--navy);}
            .hcat:hover{background:rgba(255,255,255,.13);border-color:rgba(255,255,255,.24);transform:translateY(-5px) scale(1.05);box-shadow:0 14px 32px rgba(0,0,0,.25);}
            .hcat:hover::after{opacity:1;}
            .sbar-item:hover{background:rgba(255,255,255,.04);}
            .sbar-item:hover::after{transform:scaleX(1);}
            .sbar-item:hover .sbar-icon{transform:scale(1.18) rotate(-6deg);background:rgba(240,180,41,.15);}
            .footer-soc:hover{background:var(--gold);color:var(--navy);transform:translateY(-4px) scale(1.1);}
            .footer-col ul li a:hover{color:var(--gold-light);padding-left:4px;}
        }
        /* Hapus hover dari elemen yang pakai :hover langsung (override) */
        .doc-card:hover,
        .reg-card:hover,
        .dok-col:hover,
        .art-card:hover,
        .buku-card:hover,
        .berita-feat:hover,
        .berita-grid-card:hover,
        .bstrip-card:hover { transform: none; box-shadow: none; }
        @media (hover: hover) {
            .doc-card:hover { transform: translateY(-5px); box-shadow: var(--sh-lg); }
            .reg-card:hover { transform: translateY(-6px); box-shadow: 0 20px 48px rgba(0,0,0,.3); }
            .dok-col:hover { transform: translateY(-6px); box-shadow: var(--sh-lg); }
            .art-card:hover { transform: translateY(-5px); box-shadow: var(--sh-lg); }
            .buku-card:hover { transform: translateY(-8px); }
            .berita-feat:hover { transform: translateY(-7px); box-shadow: 0 30px 72px rgba(0,0,0,.4); }
            .berita-grid-card:hover { transform: translateY(-6px); box-shadow: 0 20px 48px rgba(0,0,0,.3); }
            .bstrip-card:hover { transform: translateY(-6px) scale(1.02); box-shadow: 0 14px 36px rgba(11,31,74,.14); }
        }

        /* ════════════════════════════════════════════
           SLIDE PANEL — Artikel / Infografis / Buku
        ════════════════════════════════════════════ */
        .slide-panel-overlay{
            position:fixed;inset:0;background:rgba(6,15,35,.55);
            z-index:1100;opacity:0;pointer-events:none;
            transition:opacity .35s ease;backdrop-filter:blur(4px);
        }
        .slide-panel-overlay.open{opacity:1;pointer-events:all;}
        .slide-panel{
            position:fixed;top:0;right:0;bottom:0;
            width:min(480px, 100vw);
            background:var(--white);
            z-index:1101;
            transform:translateX(100%);
            transition:transform .4s cubic-bezier(.4,0,.2,1);
            display:flex;flex-direction:column;
            box-shadow:-8px 0 48px rgba(11,31,74,.18);
        }
        .slide-panel.open{transform:translateX(0);}
        .sp-header{
            display:flex;align-items:center;justify-content:space-between;
            padding:18px 22px;
            border-bottom:1px solid var(--gray-100);
            flex-shrink:0;
        }
        .sp-header-left{display:flex;align-items:center;gap:10px;}
        .sp-header-icon{
            width:36px;height:36px;border-radius:10px;
            background:linear-gradient(135deg,var(--navy),var(--navy-light));
            display:flex;align-items:center;justify-content:center;
            color:var(--gold-light);font-size:.9rem;flex-shrink:0;
        }
        .sp-title{font-size:.95rem;font-weight:800;color:var(--navy);}
        .sp-subtitle{font-size:.65rem;color:var(--gray-500);margin-top:1px;}
        .sp-close{
            width:34px;height:34px;border-radius:50%;
            background:var(--gray-100);border:none;cursor:pointer;
            display:flex;align-items:center;justify-content:center;
            color:var(--gray-500);font-size:1rem;
            transition:.2s;flex-shrink:0;
        }
        .sp-close:hover{background:var(--gray-200);color:var(--navy);}
        .sp-body{flex:1;overflow-y:auto;padding:18px 22px;}
        .sp-body::-webkit-scrollbar{width:4px;}
        .sp-body::-webkit-scrollbar-thumb{background:var(--gray-200);border-radius:4px;}
        .sp-footer{
            padding:14px 22px;border-top:1px solid var(--gray-100);flex-shrink:0;
        }
        .sp-footer a{
            display:flex;align-items:center;justify-content:center;gap:8px;
            background:var(--navy);color:var(--white);text-decoration:none;
            padding:12px;border-radius:var(--r-sm);font-size:.84rem;font-weight:700;
            transition:.2s;
        }
        .sp-footer a:hover{background:var(--navy-light);color:var(--white);}

        /* Artikel dalam panel */
        .sp-art-card{
            display:flex;gap:12px;padding:12px 0;
            border-bottom:1px solid var(--gray-100);
            text-decoration:none;color:inherit;
            transition:.2s;
        }
        .sp-art-card:last-child{border-bottom:none;}
        @media(hover:hover){.sp-art-card:hover{background:var(--gray-50);padding-left:6px;border-radius:8px;}}
        .sp-art-img{
            width:72px;height:56px;border-radius:8px;overflow:hidden;
            background:var(--gray-100);flex-shrink:0;
        }
        .sp-art-img img{width:100%;height:100%;object-fit:cover;}
        .sp-art-ph{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:var(--gray-300);}
        .sp-art-body{flex:1;min-width:0;}
        .sp-art-title{font-size:.78rem;font-weight:700;color:var(--text);line-height:1.45;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;margin-bottom:4px;}
        .sp-art-date{font-size:.62rem;color:var(--gray-500);display:flex;align-items:center;gap:4px;}

        /* Infografis dalam panel */
        .sp-inf-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:10px;}
        .sp-inf-card{text-decoration:none;color:inherit;}
        .sp-inf-img{height:110px;border-radius:10px;overflow:hidden;background:var(--gray-100);margin-bottom:5px;}
        .sp-inf-img img{width:100%;height:100%;object-fit:cover;transition:transform .35s ease;}
        @media(hover:hover){.sp-inf-card:hover .sp-inf-img img{transform:scale(1.06);}}
        .sp-inf-ph{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:2rem;color:var(--gray-300);}
        .sp-inf-date{font-size:.59rem;color:var(--gray-500);text-align:center;}

        /* Buku dalam panel */
        .sp-buku-card{
            display:flex;gap:12px;padding:10px 0;
            border-bottom:1px solid var(--gray-100);
            text-decoration:none;color:inherit;transition:.2s;
        }
        .sp-buku-card:last-child{border-bottom:none;}
        @media(hover:hover){.sp-buku-card:hover{padding-left:6px;background:var(--gray-50);border-radius:8px;}}
        .sp-buku-cover{
            width:44px;height:60px;border-radius:5px 8px 8px 5px;
            display:flex;align-items:center;justify-content:center;
            color:rgba(255,255,255,.8);font-size:1rem;flex-shrink:0;
            box-shadow:2px 3px 10px rgba(0,0,0,.18);overflow:hidden;
        }
        .sp-buku-cover img{width:100%;height:100%;object-fit:cover;}
        .sp-buku-body{flex:1;min-width:0;}
        .sp-buku-title{font-size:.78rem;font-weight:700;color:var(--text);line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;margin-bottom:4px;}
        .sp-buku-meta{font-size:.62rem;color:var(--gray-500);display:flex;align-items:center;gap:5px;}

        /* Tombol trigger panel di blok-head */
        .sp-trigger{
            display:inline-flex;align-items:center;gap:5px;
            font-size:.74rem;font-weight:700;color:var(--navy);
            text-decoration:none;opacity:.65;transition:.2s;cursor:pointer;
            background:none;border:none;font-family:inherit;padding:0;
        }
        @media(hover:hover){.sp-trigger:hover{opacity:1;color:var(--gold);}}

        /* Tombol nav carousel mobile — default hidden, tampil di ≤767px */
        .carousel-mob-nav { display: none; }

        /* ════════════════════════════════════════════
           ANIMATIONS & REVEAL
        ════════════════════════════════════════════ */
        @keyframes fadeUp{from{opacity:0;transform:translateY(26px);}to{opacity:1;transform:translateY(0);}}
        @keyframes fadeIn{from{opacity:0;}to{opacity:1;}}
        .reveal{opacity:0;transform:translateY(34px);transition:opacity .85s var(--slow),transform .85s var(--slow);}
        .reveal.on{opacity:1;transform:translateY(0);}
        .reveal-left{opacity:0;transform:translateX(-34px);transition:opacity .85s var(--slow),transform .85s var(--slow);}
        .reveal-left.on{opacity:1;transform:translateX(0);}
        .reveal-scale{opacity:0;transform:scale(.92);transition:opacity .75s var(--slow),transform .75s var(--slow);}
        .reveal-scale.on{opacity:1;transform:scale(1);}
        /* Mobile: nonaktifkan reveal transform agar tidak blokir touch scroll carousel */
        @media(max-width:991px){
            .reveal,.reveal-left,.reveal-scale{
                opacity:1 !important;
                transform:none !important;
                transition:none !important;
            }
        }

        /* ════════════════════════════════════════════
        ════════════════════════════════════════════ */

        /* ════════════════════════════════════════════
           OVERFLOW — cegah page scroll horizontal
           CATATAN: body pakai clip bukan hidden supaya
           carousel child tetap bisa scroll horizontal
        ════════════════════════════════════════════ */
        .topbar { overflow: hidden !important; }
        .topbar-marquee { flex-shrink: 0; }
        .berita-ticker-track { overflow: hidden !important; max-width: 100% !important; }

        @media(max-width:991px){
            .nav-links{display:none;}.ham{display:block;}
            .media-grid{grid-template-columns:1fr;}
            .berita-layout{grid-template-columns:1fr;}
            .reg-nav{justify-content:flex-start;}
            /* BUKU — tombol nav sembunyi di tablet, aktifkan touch swipe */
            .buku-nav { display: none !important; }
            /* override: tampilkan di ≤767px via media query sendiri */
            .buku-carousel-wrap {
                position: relative;
                overflow-x: auto;
                overflow-y: visible;
                -webkit-overflow-scrolling: touch;
                scroll-snap-type: x mandatory;
                scrollbar-width: none;
                padding: 8px 0 14px;
                touch-action: pan-x;
            }
            .buku-carousel-wrap::-webkit-scrollbar { display: none; }
            .buku-carousel {
                display: flex !important;
                flex-wrap: nowrap !important;
                overflow: visible !important;
                width: max-content !important;
                gap: 12px;
                padding: 4px 20px 4px 4px;
                scroll-behavior: smooth;
                touch-action: pan-x;
            }
            .buku-card {
                flex: 0 0 115px !important;
                min-width: 115px !important;
                width: 115px !important;
                scroll-snap-align: start;
                touch-action: pan-x;
            }
            .buku-cover {
                width: 115px !important;
                height: 160px !important;
            }
            .buku-carousel-wrap::after {
                content: '';
                position: absolute;
                top: 0; right: 0; bottom: 14px;
                width: 44px;
                background: linear-gradient(to left, var(--white) 30%, transparent 100%);
                pointer-events: none;
                z-index: 3;
            }
        }

        @media(max-width:767px){
            .hero-panel{display:none!important;}
            .hero-inner{padding:72px 0 64px;}
            .sbar-inner{grid-template-columns:repeat(2,1fr);}
            .sbar-item{border-bottom:1px solid rgba(255,255,255,.06);}
            .dok-grid{grid-template-columns:1fr;}
            .reg-header{flex-direction:column;}
            .berita-grid{grid-template-columns:1fr !important;}
            .berita-feat{height:220px !important;}

            /* ARTIKEL swipe horizontal */
            .art-carousel-wrap {
                position: relative;
                overflow-x: auto;
                overflow-y: visible;
                -webkit-overflow-scrolling: touch;
                scroll-snap-type: x mandatory;
                scrollbar-width: none;
                padding-bottom: 10px;
                width: 100%;
                touch-action: pan-x;
            }
            .art-carousel-wrap::-webkit-scrollbar { display: none; }
            .art-grid {
                display: flex !important;
                flex-wrap: nowrap !important;
                width: max-content !important;
                gap: 12px !important;
                padding: 4px 20px 4px 4px !important;
                grid-template-columns: none !important;
                touch-action: pan-x;
            }
            .art-card, .art-featured {
                flex: 0 0 220px !important;
                min-width: 220px !important;
                width: 220px !important;
                scroll-snap-align: start;
                grid-column: auto !important;
                touch-action: pan-x;
            }
            .art-card .art-img,
            .art-featured .art-img { height: 140px !important; }
            .art-carousel-wrap::after {
                content: '';
                position: absolute;
                top: 0; right: 0; bottom: 10px;
                width: 44px;
                background: linear-gradient(to left, var(--white) 30%, transparent 100%);
                pointer-events: none;
                z-index: 3;
            }

            /* INFOGRAFIS swipe horizontal */
            .inf-carousel-wrap {
                position: relative;
                overflow-x: auto;
                overflow-y: visible;
                -webkit-overflow-scrolling: touch;
                scroll-snap-type: x mandatory;
                scrollbar-width: none;
                padding-bottom: 10px;
                width: 100%;
                touch-action: pan-x;
            }
            .inf-carousel-wrap::-webkit-scrollbar { display: none; }
            .inf-grid {
                display: flex !important;
                flex-wrap: nowrap !important;
                width: max-content !important;
                gap: 10px !important;
                padding: 4px 20px 4px 4px !important;
                grid-template-columns: none !important;
                touch-action: pan-x;
            }
            .inf-card {
                flex: 0 0 140px !important;
                min-width: 140px !important;
                width: 140px !important;
                scroll-snap-align: start;
                touch-action: pan-x;
            }
            .inf-img { height: 110px !important; border-radius: 10px !important; }
            .inf-carousel-wrap::after {
                content: '';
                position: absolute;
                top: 0; right: 0; bottom: 10px;
                width: 44px;
                background: linear-gradient(to left, var(--white) 30%, transparent 100%);
                pointer-events: none;
                z-index: 3;
            }

            /* BUKU di ≤767px */
            .buku-card {
                flex: 0 0 105px !important;
                min-width: 105px !important;
                width: 105px !important;
            }
            .buku-cover {
                width: 105px !important;
                height: 148px !important;
            }

            /* TOMBOL NAV MOBILE — Artikel & Infografis */
            .carousel-mob-nav {
                display: flex !important;
                position: absolute;
                top: 50%;
                transform: translateY(-60%);
                z-index: 10;
                width: 34px; height: 34px;
                border-radius: 50%;
                border: none;
                background: rgba(11,31,74,.75);
                backdrop-filter: blur(6px);
                color: #fff;
                font-size: .85rem;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: background .2s, opacity .2s;
                box-shadow: 0 2px 10px rgba(0,0,0,.22);
            }
            .carousel-mob-prev { left: 4px; }
            .carousel-mob-next { right: 48px; }
            .carousel-mob-nav:hover { background: var(--navy); }

            /* Buku nav tombol — tampilkan di mobile (override display:none dari ≤991px) */
            .buku-nav {
                display: flex !important;
                position: absolute;
                top: 50%;
                transform: translateY(-60%);
                z-index: 10;
                width: 34px; height: 34px;
                border-radius: 50%;
                border: none;
                background: rgba(11,31,74,.75);
                backdrop-filter: blur(6px);
                color: #fff;
                font-size: .85rem;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: background .2s, opacity .2s;
                box-shadow: 0 2px 10px rgba(0,0,0,.22);
            }
            .buku-nav-prev { left: 4px; }
            .buku-nav-next { right: 48px; }
        }

        @media(max-width:575px){
            .hero h1{font-size:1.9rem;}
            .reg-title,.berita-title,.sec-title,.dok-title{font-size:1.65rem;}
            .hero-stats{flex-wrap:wrap;}.hs{min-width:50%;}
            .topbar-marquee{animation-duration:16s;}
            .search-box button span{display:none;}
        }


        /* ══════════════════ BERITA FOTO STRIP (TOP) ══════════════════ */
        .berita-strip-section{background:var(--white);border-bottom:1px solid var(--gray-200);}
        .berita-strip-header{padding:14px 0 10px;}
        .bstrip-label{display:flex;align-items:center;gap:9px;font-size:.78rem;font-weight:800;color:var(--navy);}
        .bstrip-label i{color:var(--gold);}
        .bstrip-live{display:inline-flex;align-items:center;gap:5px;background:#fee2e2;color:#dc2626;font-size:.6rem;font-weight:800;padding:3px 9px;border-radius:20px;letter-spacing:.06em;}
        .bstrip-live-dot{width:6px;height:6px;border-radius:50%;background:#dc2626;animation:live-pulse 1.2s ease-in-out infinite;}
        @keyframes live-pulse{0%,100%{opacity:1;transform:scale(1);}50%{opacity:.3;transform:scale(.7);}}
        .bstrip-all{font-size:.75rem;font-weight:700;color:var(--navy);text-decoration:none;display:inline-flex;align-items:center;gap:5px;opacity:.6;transition:.2s;}
        .bstrip-all:hover{opacity:1;color:var(--gold);}

        /* Track wrapper */
        .berita-strip-track-wrap{position:relative;overflow:hidden;padding-bottom:16px;}
        .bstrip-fade{position:absolute;top:0;bottom:0;width:80px;z-index:3;pointer-events:none;}
        .bstrip-fade-left{left:0;background:linear-gradient(to right,var(--white),transparent);}
        .bstrip-fade-right{right:0;background:linear-gradient(to left,var(--white),transparent);}

        /* Scrolling track */
        .berita-strip-track{
            display:flex;gap:14px;
            width:max-content;
            animation:bstrip-scroll 40s linear infinite;
        }
        .berita-strip-track:hover{animation-play-state:paused;}
        @keyframes bstrip-scroll{
            0%{transform:translateX(0);}
            100%{transform:translateX(-50%);}
        }

        /* Setiap kartu foto */
        .bstrip-card{
            flex-shrink:0;width:220px;
            border-radius:var(--r);overflow:hidden;
            text-decoration:none;color:inherit;
            border:1.5px solid var(--gray-200);
            background:var(--white);
            transition:all .35s cubic-bezier(.34,1.56,.64,1);
            position:relative;
        }
        .bstrip-card:hover{
            transform:translateY(-6px) scale(1.02);
            box-shadow:0 14px 36px rgba(11,31,74,.14);
            border-color:rgba(11,31,74,.2);
            z-index:2;
        }
        .bstrip-img{
            height:135px;overflow:hidden;
            background:var(--gray-100);
            position:relative;
        }
        .bstrip-img img{
            width:100%;height:100%;object-fit:cover;
            transition:transform .55s ease;
        }
        .bstrip-card:hover .bstrip-img img{transform:scale(1.1);}
        .bstrip-ph{
            width:100%;height:100%;
            display:flex;align-items:center;justify-content:center;
            font-size:2.2rem;color:var(--gray-300);
            background:linear-gradient(135deg,var(--gray-100),var(--gray-200));
        }
        .bstrip-overlay{
            position:absolute;inset:0;
            background:linear-gradient(to top,rgba(11,31,74,.55) 0%,transparent 60%);
        }
        .bstrip-info{padding:10px 12px 12px;}
        .bstrip-badge{
            display:inline-flex;margin-bottom:5px;
            font-size:.56rem;font-weight:800;padding:2px 8px;border-radius:4px;
            background:#eff6ff;color:#1e40af;letter-spacing:.04em;text-transform:uppercase;
        }
        .bstrip-title{
            font-size:.76rem;font-weight:700;color:var(--text);
            line-height:1.45;margin-bottom:6px;
            display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;
            transition:.2s;
        }
        .bstrip-card:hover .bstrip-title{color:var(--navy);}
        .bstrip-date{font-size:.62rem;color:var(--gray-500);display:flex;align-items:center;gap:4px;}

        /* ══════════════════ BUKU CAROUSEL ══════════════════ */
        .buku-section{position:relative;}
        .buku-carousel-wrap{position:relative;overflow:visible;margin:0 -4px;padding:0 4px;}
        .buku-carousel{
            display:flex;gap:14px;
            overflow-x:scroll;
            scroll-snap-type:x mandatory;
            scroll-behavior:smooth;
            padding:8px 0 16px;
            scrollbar-width:none;
        }
        .buku-carousel::-webkit-scrollbar{display:none;}
        .buku-card{
            flex:0 0 calc((100% - 42px) / 4);
            scroll-snap-align:start;
            text-decoration:none;color:inherit;
            transition:transform .35s cubic-bezier(.34,1.56,.64,1);
        }
        .buku-card:hover{transform:translateY(-8px);}
        .buku-cover{
            width:100%;height:195px;border-radius:6px 12px 12px 6px;
            background:var(--cover-color,#1a3a8f);
            position:relative;overflow:hidden;
            box-shadow:4px 6px 18px rgba(0,0,0,.22),-2px 0 0 rgba(0,0,0,.15);
            display:flex;align-items:center;justify-content:center;
            margin-bottom:10px;
        }
        .buku-cover img{
            width:100%;height:100%;object-fit:cover;
            border-radius:6px 12px 12px 6px;
        }
        .buku-cover-ph{
            display:flex;flex-direction:column;align-items:center;justify-content:center;
            padding:14px 10px;gap:8px;text-align:center;
        }
        .buku-cover-ph i{font-size:1.8rem;color:rgba(255,255,255,.5);}
        .buku-cover-ph span{font-size:.6rem;color:rgba(255,255,255,.75);line-height:1.4;font-weight:600;}
        .buku-cover-shine{
            position:absolute;top:0;left:0;width:35%;height:100%;
            background:linear-gradient(90deg,rgba(255,255,255,.12),transparent);
            pointer-events:none;
        }
        .buku-year-tag{
            position:absolute;bottom:8px;right:8px;
            background:rgba(0,0,0,.45);color:rgba(255,255,255,.85);
            font-size:.55rem;font-weight:700;padding:2px 7px;border-radius:4px;
            backdrop-filter:blur(6px);
        }
        .buku-card-body{padding:0 2px;}
        .buku-card-title{
            font-size:.72rem;font-weight:700;color:var(--text);
            line-height:1.4;margin-bottom:3px;
            display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;
            transition:.2s;
        }
        .buku-card:hover .buku-card-title{color:var(--navy);}
        .buku-card-author{font-size:.62rem;color:var(--gray-500);display:flex;align-items:center;gap:3px;}
        /* Tombol navigasi carousel */
        .buku-nav{
            position:absolute;top:85px;
            width:34px;height:34px;border-radius:50%;
            background:var(--white);border:1.5px solid var(--gray-200);
            color:var(--navy);font-size:.9rem;
            display:flex;align-items:center;justify-content:center;
            cursor:pointer;transition:.25s;
            box-shadow:0 4px 14px rgba(11,31,74,.12);
            z-index:5;
        }
        .buku-nav:hover{background:var(--navy);color:var(--white);border-color:var(--navy);}
        .buku-nav-prev{left:-14px;}
        .buku-nav-next{right:-14px;}

        /* ══════════════════ BERITA MARQUEE ══════════════════ */
        .sec-berita{padding:72px 0;background:var(--navy-deep);position:relative;overflow:hidden;}
        .sec-berita::before{content:'';position:absolute;inset:0;
            background:radial-gradient(ellipse 60% 80% at 0% 50%,rgba(200,150,12,.06),transparent),
                        radial-gradient(ellipse 55% 55% at 100% 0%,rgba(26,58,143,.35),transparent);}
        .sec-berita::after{content:'';position:absolute;inset:0;
            background-image:linear-gradient(rgba(255,255,255,.012) 1px,transparent 1px),
                             linear-gradient(90deg,rgba(255,255,255,.012) 1px,transparent 1px);
            background-size:52px 52px;pointer-events:none;}
        .berita-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:28px;position:relative;z-index:1;flex-wrap:wrap;gap:12px;}
        .berita-eyebrow{font-size:.63rem;font-weight:800;color:var(--gold-light);text-transform:uppercase;letter-spacing:.14em;margin-bottom:6px;display:flex;align-items:center;gap:7px;}
        .berita-title{font-family:'Playfair Display',serif;font-size:2rem;font-weight:700;color:var(--white);letter-spacing:-.03em;}

        /* Featured berita */
        .berita-feat-wrap{position:relative;z-index:1;margin-bottom:20px;}
        .berita-feat{
            display:block;border-radius:var(--r-lg);overflow:hidden;
            text-decoration:none;position:relative;height:280px;
            transition:transform .45s var(--spring);
        }
        .berita-feat:hover{transform:scale(1.015);}
        .berita-feat-img{width:100%;height:100%;position:relative;}
        .berita-feat-img img{width:100%;height:100%;object-fit:cover;}
        .b-img-ph{width:100%;height:100%;background:var(--navy-light);display:flex;align-items:center;justify-content:center;font-size:4rem;color:rgba(255,255,255,.15);}
        .b-overlay{position:absolute;top:16px;left:16px;display:flex;gap:6px;z-index:2;}
        .b-badge{font-size:.6rem;font-weight:800;padding:4px 11px;border-radius:6px;background:rgba(7,20,47,.75);color:var(--white);backdrop-filter:blur(10px);}
        .b-badge-new{background:var(--gold);color:var(--navy);}
        .berita-feat-grad{position:absolute;inset:0;background:linear-gradient(to top,rgba(6,15,35,.92) 0%,rgba(6,15,35,.3) 50%,transparent 100%);z-index:1;}
        .berita-feat-content{position:absolute;bottom:0;left:0;right:0;padding:24px;z-index:2;}
        .berita-feat-title{font-size:1.05rem;font-weight:700;color:var(--white);line-height:1.5;margin-bottom:8px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
        .berita-feat-date{font-size:.69rem;color:rgba(255,255,255,.5);display:flex;align-items:center;gap:5px;}

        /* Ticker / Marquee */
        .berita-ticker-wrap{
            display:flex;align-items:center;
            background:rgba(255,255,255,.06);
            border:1px solid rgba(255,255,255,.1);
            border-radius:var(--r-sm);overflow:hidden;
            margin-bottom:28px;position:relative;z-index:1;
        }
        .berita-ticker-label{
            flex-shrink:0;
            background:var(--gold);color:var(--navy);
            padding:10px 16px;font-size:.64rem;font-weight:800;
            letter-spacing:.1em;text-transform:uppercase;
            display:flex;align-items:center;gap:6px;
            white-space:nowrap;
        }
        .berita-ticker-label i{animation:pulse-ticker 1.5s ease-in-out infinite;}
        @keyframes pulse-ticker{0%,100%{opacity:1;}50%{opacity:.3;}}
        .berita-ticker-track{flex:1;overflow:hidden;height:42px;position:relative;}
        .berita-ticker-track::after{
            content:'';position:absolute;right:0;top:0;bottom:0;width:60px;
            background:linear-gradient(to left,rgba(6,15,35,.9),transparent);
            pointer-events:none;z-index:2;
        }
        .berita-ticker-inner{
            display:flex;align-items:center;
            animation:ticker-scroll 35s linear infinite;
            white-space:nowrap;height:100%;
        }
        .berita-ticker-inner:hover{animation-play-state:paused;}
        @keyframes ticker-scroll{
            0%{transform:translateX(0);}
            100%{transform:translateX(-50%);}
        }
        .btick-item{
            display:inline-flex;align-items:center;gap:10px;
            padding:0 28px;text-decoration:none;
            transition:background .2s;height:42px;
            border-right:1px solid rgba(255,255,255,.07);
        }
        .btick-item:hover{background:rgba(255,255,255,.06);}
        .btick-dot{width:5px;height:5px;border-radius:50%;background:var(--gold-light);flex-shrink:0;}
        .btick-title{font-size:.75rem;font-weight:600;color:rgba(255,255,255,.8);white-space:nowrap;}
        .btick-date{font-size:.62rem;color:rgba(255,255,255,.3);white-space:nowrap;flex-shrink:0;}

        /* Berita grid cards */
        .berita-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:14px;
            position:relative;z-index:1;
        }
        .berita-grid-card{
            display:flex;flex-direction:column;
            border-radius:var(--r);overflow:hidden;
            background:rgba(255,255,255,.05);
            border:1px solid rgba(255,255,255,.09);
            text-decoration:none;color:inherit;
            transition:all .4s cubic-bezier(.34,1.56,.64,1);
        }
        .berita-grid-card:hover{
            background:rgba(255,255,255,.1);
            border-color:rgba(255,255,255,.2);
            transform:translateY(-6px);
            box-shadow:0 20px 48px rgba(0,0,0,.3);
        }
        .bgc-img{height:130px;overflow:hidden;background:var(--navy-light);flex-shrink:0;}
        .bgc-img img{width:100%;height:100%;object-fit:cover;transition:transform .55s ease;}
        .berita-grid-card:hover .bgc-img img{transform:scale(1.08);}
        .bgc-ph{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:2rem;color:rgba(255,255,255,.12);}
        .bgc-body{padding:14px;}
        .bgc-title{
            font-size:.78rem;font-weight:600;color:rgba(255,255,255,.85);
            line-height:1.5;margin-bottom:8px;
            display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;
            transition:.2s;
        }
        .berita-grid-card:hover .bgc-title{color:var(--white);}
        .bgc-date{font-size:.63rem;color:rgba(255,255,255,.3);display:flex;align-items:center;gap:4px;}


        /* ════════════════════════════════════════════
           MOBILE FIX v2 — Carousel scroll + Dropdown
        ════════════════════════════════════════════ */

        /* FIX 1: reveal wrapper jangan blokir overflow carousel child */
        @media(max-width:991px){
            .reveal, .reveal-left, .reveal-scale {
                overflow: visible !important;
            }
            .art-carousel-wrap,
            .inf-carousel-wrap,
            .buku-carousel-wrap,
            .blok-side,
            .media-grid,
            .sec-media {
                overflow: visible !important;
            }
            .art-carousel-wrap,
            .inf-carousel-wrap {
                overflow-x: auto !important;
                overflow-y: visible !important;
                -webkit-overflow-scrolling: touch !important;
                touch-action: pan-x !important;
            }
        }

        /* FIX 2: Dropdown mobile — nonaktifkan :hover, pakai .open class (dikontrol JS) */
        @media(max-width:991px){
            .nav-dd:hover .nav-dd-menu {
                opacity: 0 !important;
                pointer-events: none !important;
                transform: translateY(-6px) scale(.97) !important;
            }
            .nav-dd.open .nav-dd-menu {
                opacity: 1 !important;
                pointer-events: all !important;
                transform: translateY(0) scale(1) !important;
            }
        }

        /* ════════════════════════════════════════════
           TOUCH DEVICE — nonaktifkan SEMUA hover effect
           Ini menimpa seluruh CSS hover yang ada di atas.
           @media(hover:none) = layar sentuh (HP/tablet)
           @media(pointer:coarse) = input tidak presisi (jari)
        ════════════════════════════════════════════ */
        @media (hover: none), (pointer: coarse) {

            /* ── Reset semua transform & shadow pada :hover ── */
            .doc-card:hover,
            .reg-card:hover,
            .dok-col:hover,
            .art-card:hover,
            .buku-card:hover,
            .berita-feat:hover,
            .berita-grid-card:hover,
            .bstrip-card:hover,
            .hcat:hover,
            .sbar-item:hover,
            .inf-card:hover,
            .berita-item:hover,
            .search-box:focus-within,
            .btn-all:hover,
            .btn-all-navy:hover,
            .btn-all-ghost:hover {
                transform: none !important;
                box-shadow: none !important;
            }

            /* ── Reset pseudo-element hover ── */
            .doc-card:hover::after { transform: scaleX(0) !important; }
            .reg-card:hover::before { opacity: 0 !important; }

            /* ── Reset child element hover ── */
            .doc-card:hover .doc-title { color: var(--text) !important; }
            .doc-card:hover .doc-arrow { background: var(--gray-100) !important; color: var(--navy) !important; transform: none !important; }
            .reg-card:hover .reg-icon { transform: none !important; }
            .reg-card:hover .reg-arrow { transform: none !important; background: rgba(255,255,255,.08) !important; }
            .dok-col:hover .dok-icon { transform: none !important; }
            .dok-item:hover { background: transparent !important; }
            .dok-item:hover .dok-dot { transform: none !important; }
            .dok-item:hover .dok-item-title { color: var(--text) !important; }
            .dok-item:hover .dok-item-arr { transform: none !important; color: var(--gray-300) !important; }
            .art-card:hover .art-img img { transform: none !important; }
            .art-card:hover .art-title { color: var(--text) !important; }
            .inf-card:hover .inf-img { transform: none !important; box-shadow: none !important; }
            .buku-card:hover .buku-card-title { color: var(--text) !important; }
            .berita-feat:hover .berita-feat-img img { transform: none !important; }
            .berita-feat:hover .berita-read { gap: 7px !important; }
            .berita-item:hover { padding-left: 0 !important; }
            .berita-item:hover .b-title { color: rgba(255,255,255,.82) !important; }
            .berita-grid-card:hover .bgc-img img { transform: none !important; }
            .berita-grid-card:hover .bgc-title { color: rgba(255,255,255,.85) !important; }
            .bstrip-card:hover .bstrip-img img { transform: none !important; }
            .bstrip-card:hover .bstrip-title { color: var(--text) !important; }
            .sbar-item:hover .sbar-icon { transform: none !important; background: rgba(255,255,255,.1) !important; color: var(--gold-light) !important; }
            .hcat:hover::after { opacity: 0 !important; }

            /* ── Carousel: pastikan touch scroll bekerja ── */
            .art-carousel-wrap,
            .inf-carousel-wrap,
            .buku-carousel-wrap {
                overflow-x: auto !important;
                overflow-y: visible !important;
                -webkit-overflow-scrolling: touch !important;
                touch-action: pan-x !important;
            }

            /* ── Reveal: jangan blokir touch scroll ── */
            .reveal,
            .reveal-left,
            .reveal-scale {
                opacity: 1 !important;
                transform: none !important;
                transition: none !important;
                overflow: visible !important;
            }

            /* ── Parent carousel wrapper harus visible ── */
            .blok-side,
            .media-grid > div,
            .sec-media .reveal {
                overflow: visible !important;
            }
        }

    </style>
</head>
<body>