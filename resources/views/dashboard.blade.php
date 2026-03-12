@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div style="padding: 40px; background: #f8fafc; min-height: 100vh; font-family: 'Inter', sans-serif;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
        <div>
            <h2 style="font-weight: 800; color: #1e293b; margin: 0; font-size: 28px; letter-spacing: -0.5px;">Dashboard Overview</h2>
            <p style="color: #64748b; margin-top: 5px; font-size: 15px;">Monitor dan kelola seluruh data strategis Kominfo dalam satu panel.</p>
        </div>
        <div style="background: white; padding: 10px 20px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); display: flex; align-items: center; gap: 10px;">
            <div style="width: 10px; height: 10px; background: #10b981; border-radius: 50%; animation: pulse 2s infinite;"></div>
            <span style="font-weight: 600; color: #475569; font-size: 14px;">Sistem Aktif</span>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 25px; margin-bottom: 40px;">
        
        <div class="stat-card" style="background: white; padding: 25px; border-radius: 24px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.04); border: 1px solid #f1f5f9; position: relative; overflow: hidden;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 8px;">Total Berita</p>
                    <h3 style="font-size: 32px; font-weight: 800; color: #1e293b; margin: 0;">{{ $countBerita }}</h3>
                </div>
                <div style="background: #eff6ff; color: #3b82f6; width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
            </div>
            <p style="margin-top: 15px; font-size: 13px; color: #10b981; font-weight: 600;"><i class="fa-solid fa-arrow-up"></i> Konten Publikasi</p>
        </div>

        <div class="stat-card" style="background: white; padding: 25px; border-radius: 24px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.04); border: 1px solid #f1f5f9;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 8px;">Infografis</p>
                    <h3 style="font-size: 32px; font-weight: 800; color: #1e293b; margin: 0;">{{ $countInfografis }}</h3>
                </div>
                <div style="background: #ecfdf5; color: #10b981; width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>
            </div>
            <p style="margin-top: 15px; font-size: 13px; color: #10b981; font-weight: 600;"><i class="fa-solid fa-check-double"></i> Visual Aktif</p>
        </div>

        <div class="stat-card" style="background: white; padding: 25px; border-radius: 24px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.04); border: 1px solid #f1f5f9;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 8px;">Kontak</p>
                    <h3 style="font-size: 32px; font-weight: 800; color: #1e293b; margin: 0;">{{ $countKontak }}</h3>
                </div>
                <div style="background: #fff1f2; color: #ef4444; width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
            </div>
            <p style="margin-top: 15px; font-size: 13px; color: #f59e0b; font-weight: 600;"><i class="fa-solid fa-clock"></i> Butuh Respon</p>
        </div>

        <div class="stat-card" style="background: white; padding: 25px; border-radius: 24px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.04); border: 1px solid #f1f5f9;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 8px;">Admin</p>
                    <h3 style="font-size: 32px; font-weight: 800; color: #1e293b; margin: 0;">{{ $countAdmin }}</h3>
                </div>
                <div style="background: #eef2ff; color: #6366f1; width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
            <p style="margin-top: 15px; font-size: 13px; color: #6366f1; font-weight: 600;"><i class="fa-solid fa-id-badge"></i> Pengelola</p>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1.8fr 1.2fr; gap: 30px;">
        
        <div style="background: white; padding: 35px; border-radius: 32px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.03); border: 1px solid #f1f5f9;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h4 style="font-weight: 800; color: #1e293b; margin: 0; font-size: 20px;">
                    <i class="fa-solid fa-folder-tree" style="margin-right: 10px; color: #3b82f6;"></i> Database Dokumen & Risalah
                </h4>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                @php
                    $docs = [
                        ['label' => 'PERDA', 'count' => $countPerda, 'icon' => 'fa-gavel', 'color' => '#3b82f6'],
                        ['label' => 'Peraturan Bupati', 'count' => $countPerbupati, 'icon' => 'fa-landmark', 'color' => '#10b981'],
                        ['label' => 'Risalah Hukum', 'count' => $countRisalah, 'icon' => 'fa-file-shield', 'color' => '#f59e0b'],
                        ['label' => 'Kajian Hukum', 'count' => $countKajian, 'icon' => 'fa-book-open-reader', 'color' => '#6366f1'],
                        ['label' => 'Analisis & Evaluasi', 'count' => $countAnalisis, 'icon' => 'fa-magnifying-glass-chart', 'color' => '#8b5cf6'],
                        ['label' => 'Naskah Akademik', 'count' => $countNaskah, 'icon' => 'fa-graduation-cap', 'color' => '#06b6d4'],
                    ];
                @endphp

                @foreach($docs as $doc)
                <div style="padding: 20px; background: #f8fafc; border-radius: 20px; border: 1px solid #f1f5f9; display: flex; align-items: center; gap: 15px; transition: transform 0.2s;">
                    <div style="background: white; width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: {{ $doc['color'] }}; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <i class="fa-solid {{ $doc['icon'] }}"></i>
                    </div>
                    <div>
                        <p style="margin: 0; font-size: 12px; font-weight: 600; color: #64748b;">{{ $doc['label'] }}</p>
                        <h5 style="margin: 0; font-size: 16px; font-weight: 800; color: #1e293b;">{{ $doc['count'] }} <span style="font-weight: 500; font-size: 12px; color: #94a3b8;">Data</span></h5>
                    </div>
                </div>
                @endforeach
            </div>

            <div style="margin-top: 35px; background: linear-gradient(135deg, #1e293b 0%, #334155 100%); padding: 30px; border-radius: 24px; color: white; position: relative; overflow: hidden;">
                <div style="position: relative; z-index: 1;">
                    <h5 style="margin: 0; font-size: 18px; font-weight: 700;">Akses Cepat Manajemen</h5>
                    <p style="font-size: 14px; opacity: 0.8; margin: 10px 0 20px 0;">Otomasi publikasi konten dalam hitungan detik.</p>
                    <div style="display: flex; gap: 12px;">
                        <a href="{{ route('berita.create') }}" style="background: #3b82f6; color: white; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-size: 13px; font-weight: 700; transition: 0.3s;">
                            <i class="fa-solid fa-plus" style="margin-right: 5px;"></i> Berita Baru
                        </a>
                        <a href="{{ route('infografis.index') }}" style="background: rgba(255,255,255,0.1); color: white; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-size: 13px; font-weight: 700; backdrop-filter: blur(10px);">
                            Kelola Visual
                        </a>
                    </div>
                </div>
                <i class="fa-solid fa-bolt-lightning" style="position: absolute; right: -20px; top: -20px; font-size: 120px; opacity: 0.05; transform: rotate(15deg);"></i>
            </div>
        </div>

        <div style="background: white; padding: 35px; border-radius: 32px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.03); border: 1px solid #f1f5f9;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h4 style="font-weight: 800; color: #1e293b; margin: 0; font-size: 20px;">Aktivitas Terakhir</h4>
                <span style="font-size: 12px; font-weight: 700; color: #10b981; background: #dcfce7; padding: 5px 12px; border-radius: 20px;">Live Update</span>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 25px;">
                @forelse($activities as $act)
                <div style="display: flex; gap: 20px;">
                    <div style="flex-shrink: 0; width: 42px; height: 42px; background: #eef2ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #6366f1; font-weight: 700; border: 2px solid white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                        {{ substr($act->user->name ?? 'A', 0, 1) }}
                    </div>
                    
                    <div style="flex-grow: 1;">
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                            <span style="font-size: 14px; font-weight: 700; color: #1e293b;">{{ $act->user->name ?? 'Admin' }}</span>
                            <span style="font-size: 11px; color: #94a3b8;">• {{ $act->created_at->diffForHumans() }}</span>
                            
                            <span style="font-size: 10px; text-transform: uppercase; padding: 2px 8px; border-radius: 6px; font-weight: 800; background: {{ $act->type == 'success' ? '#dcfce7' : '#f1f5f9' }}; color: {{ $act->type == 'success' ? '#166534' : '#475569' }};">
                                {{ $act->type }}
                            </span>
                        </div>
                        
                        <p style="margin: 0; font-size: 13px; color: #475569; line-height: 1.5; background: #f8fafc; padding: 12px 15px; border-radius: 0 15px 15px 15px; border: 1px solid #f1f5f9;">
                            {{ $act->description }}
                        </p>
                    </div>
                </div>
                @empty
                <p style="text-align: center; color: #94a3b8;">Belum ada aktivitas tercatat.</p>
                @endforelse
            </div>
        </div>

    </div>
</div>

<style>
    @keyframes pulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }
    .stat-card:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
    }
</style>
@endsection