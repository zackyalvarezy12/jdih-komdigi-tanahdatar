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
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

    {{-- Fallback: SVG favicon inline via data URI jika logo.png gagal --}}
    <script>
    (function(){
        var img = new Image();
        img.onerror = function(){
            var svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"><rect width="64" height="64" rx="14" fill="#0b1f4a"/><rect x="4" y="4" width="56" height="56" rx="11" fill="url(%23g)"/><defs><linearGradient id="g" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="%230d2255"/><stop offset="1" stop-color="%231a3a8f"/></linearGradient></defs><text x="50%" y="54%" dominant-baseline="middle" text-anchor="middle" font-family="Georgia,serif" font-weight="700" font-size="26" fill="%23f0b429">JD</text></svg>';
            var link = document.querySelector("link[rel~=\'icon\']");
            if(link) link.href = "data:image/svg+xml," + svg;
        };
        img.src = "{{ asset('images/logo.png') }}";
    })();
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style-jdih.css') }}">

</head>
<body>