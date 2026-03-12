@extends('layouts.admin')

@section('content')
<div class="container-fluid" style="padding: 30px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="font-weight: 700; color: #1e293b; margin: 0;">Ubah Analisis Evaluasi</h2>
            <p style="color: #64748b; margin-top: 5px;">Perbarui informasi dokumen yang sudah ada.</p>
        </div>
        <a href="{{ route('analisis-evaluasi.index') }}" class="btn" style="background: #f1f5f9; color: #64748b; border-radius: 12px; padding: 12px 24px; font-weight: 600; text-decoration: none;">
            <i class="fa-solid fa-arrow-left" style="margin-right: 8px;"></i> Kembali
        </a>
    </div>

    <div style="background: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.02); border: 1px solid #f1f5f9;">
        {{-- Form action menggunakan encryptedId (ID tidak terlihat di URL) --}}
        <form action="{{ route('analisis-evaluasi.update', $encryptedId) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            {{-- Type Dokumen --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 10px; font-size: 14px;">
                    Type Dokumen <span style="color: #ef4444;">*</span>
                </label>
                <input type="text" name="type_dokumen" value="{{ old('type_dokumen', $item->type_dokumen) }}" placeholder="ex : Rancangan perda"
                    style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid {{ $errors->has('type_dokumen') ? '#ef4444' : '#e2e8f0' }}; outline: none; font-size: 14px; box-sizing: border-box;">
                @error('type_dokumen')
                    <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                        <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                        <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- Judul --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 10px; font-size: 14px;">
                    Judul <span style="color: #ef4444;">*</span>
                </label>
                <input type="text" name="judul" value="{{ old('judul', $item->judul) }}" placeholder="ex : APBD Tahun 2026"
                    style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid {{ $errors->has('judul') ? '#ef4444' : '#e2e8f0' }}; outline: none; font-size: 14px; box-sizing: border-box;">
                @error('judul')
                    <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                        <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                        <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- TEU Pengarang --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 10px; font-size: 14px;">
                    T.E.U Pengarang/Badan <span style="color: #ef4444;">*</span>
                </label>
                <input type="text" name="teu_pengarang" value="{{ old('teu_pengarang', $item->teu_pengarang) }}" placeholder="ex : BPKD Tanah Datar"
                    style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid {{ $errors->has('teu_pengarang') ? '#ef4444' : '#e2e8f0' }}; outline: none; font-size: 14px; box-sizing: border-box;">
                @error('teu_pengarang')
                    <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                        <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                        <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- Tahun --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 10px; font-size: 14px;">
                    Tahun <span style="color: #ef4444;">*</span>
                </label>
                <input type="text" name="tahun" value="{{ old('tahun', $item->tahun) }}" placeholder="ex : 2026"
                    style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid {{ $errors->has('tahun') ? '#ef4444' : '#e2e8f0' }}; outline: none; font-size: 14px; box-sizing: border-box;">
                @error('tahun')
                    <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                        <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                        <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- File PDF --}}
            <div style="margin-bottom: 30px;">
                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 10px; font-size: 14px;">
                    File PDF
                    <span style="font-weight: 400; color: #94a3b8; font-size: 12px;">(kosongkan jika tidak ingin mengubah)</span>
                </label>
                @if($item->file_pdf)
                    <div style="margin-bottom: 10px; padding: 10px; background: #f8fafc; border-radius: 8px; display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-file-pdf" style="color: #ef4444;"></i>
                        <span style="font-size: 13px; color: #64748b;">File saat ini: <strong>{{ basename($item->file_pdf) }}</strong></span>
                    </div>
                @endif
                <input type="file" name="file_pdf" style="font-size: 14px; color: #64748b;">
                @error('file_pdf')
                    <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                        <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                        <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div style="text-align: right;">
                <button type="submit" style="background: #3b82f6; color: white; border: none; border-radius: 12px; padding: 12px 45px; font-weight: 600; cursor: pointer; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);">
                    Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection