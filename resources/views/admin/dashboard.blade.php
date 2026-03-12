@extends('layouts.admin')

@section('content')
<div style="padding: 30px; background: #f4f6f9; min-height: 100vh;">
    <div style="margin-bottom: 30px;">
        <h2 style="font-weight: 700; color: #334155; margin: 0;">Dashboard Overview</h2>
        <p style="color: #64748b;">Halo, <strong>{{ Auth::user()->name }}</strong>. Berikut statistik sistem hari ini.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div style="background: white; padding: 20px; border-radius: 15px; border-left: 5px solid #3b82f6; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <p style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin: 0;">Berita</p>
            <h3 style="margin: 5px 0;">{{ $countBerita }}</h3>
        </div>
        <div style="background: white; padding: 20px; border-radius: 15px; border-left: 5px solid #10b981; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <p style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin: 0;">Buku</p>
            <h3 style="margin: 5px 0;">{{ $countBuku }}</h3>
        </div>
        <div style="background: white; padding: 20px; border-radius: 15px; border-left: 5px solid #f59e0b; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <p style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin: 0;">Infografis</p>
            <h3 style="margin: 5px 0;">{{ $countInfografis }}</h3>
        </div>
        <div style="background: white; padding: 20px; border-radius: 15px; border-left: 5px solid #6366f1; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <p style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin: 0;">Kontak Pesan</p>
            <h3 style="margin: 5px 0;">{{ $countKontak }}</h3>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px;">
        <div style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); padding: 40px; border-radius: 20px; color: white;">
            <h2 style="font-weight: 800;">Manajemen Konten</h2>
            <p style="opacity: 0.8; margin-bottom: 25px;">Publikasikan berita atau naskah akademik baru sekarang.</p>
            <a href="{{ url('admin/berita/create') }}" style="background: #10b981; color: white; padding: 12px 25px; border-radius: 10px; text-decoration: none; font-weight: 700;">+ Posting Baru</a>
        </div>

    <h3 style="margin: 0; font-size: 28px; font-weight: 800; color: #1e293b;">
        {{ $countBerita ?? 0 }}
    </h3>   

        <div style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); max-height: 400px; overflow-y: auto;">
            <h4 style="font-weight: 800; color: #1e293b; margin-bottom: 20px;">Riwayat Aktivitas</h4>
            @foreach($activities as $act)
            <div style="margin-bottom: 15px; border-left: 2px solid #10b981; padding-left: 15px;">
                <p style="margin: 0; font-size: 13px; font-weight: 600;">{{ $act->user->name ?? 'Admin' }}</p>
                <p style="margin: 0; font-size: 12px; color: #64748b;">{{ $act->activity }}</p>
                <p style="margin: 0; font-size: 10px; color: #94a3b8;">{{ $act->created_at->diffForHumans() }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection