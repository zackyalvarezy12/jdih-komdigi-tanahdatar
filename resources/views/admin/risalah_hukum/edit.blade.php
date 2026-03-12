@extends('layouts.admin')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .rh-wrap * { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
    .rh-wrap { padding: 32px; background: #f0f4ff; min-height: 100vh; }

    .rh-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; }
    .rh-header h2 { font-size: 22px; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.5px; }
    .rh-header p { color: #64748b; font-size: 13.5px; margin: 4px 0 0 0; }

    .rh-back-btn {
        display: inline-flex; align-items: center; gap: 8px;
        background: white; color: #475569; border-radius: 10px;
        padding: 10px 18px; font-weight: 600; font-size: 13px;
        text-decoration: none; border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06); transition: all 0.2s;
    }
    .rh-back-btn:hover { background: #f8fafc; color: #1e293b; border-color: #cbd5e1; transform: translateX(-2px); text-decoration: none; }

    .rh-layout { display: grid; grid-template-columns: 1fr 300px; gap: 24px; align-items: start; }

    .rh-card { background: white; border-radius: 16px; padding: 28px; border: 1px solid #e8edf5; box-shadow: 0 4px 20px rgba(15,23,42,0.04); margin-bottom: 20px; }
    .rh-card:last-child { margin-bottom: 0; }
    .rh-card-title { font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.2px; margin: 0 0 20px 0; padding-bottom: 14px; border-bottom: 1px solid #f1f5f9; }

    .rh-field { margin-bottom: 18px; }
    .rh-field:last-child { margin-bottom: 0; }
    .rh-label { display: flex; align-items: center; gap: 5px; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 8px; }
    .rh-label .req { color: #ef4444; font-size: 16px; line-height: 1; }

    .rh-input {
        width: 100%; padding: 11px 14px; border-radius: 10px;
        border: 1.5px solid #e2e8f0; font-size: 13.5px;
        font-family: 'Plus Jakarta Sans', sans-serif; color: #1e293b;
        background: #fafbfc; transition: all 0.2s; outline: none;
    }
    .rh-input:focus { border-color: #3b82f6; background: white; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }
    .rh-input.err { border-color: #ef4444; background: #fffafa; box-shadow: 0 0 0 3px rgba(239,68,68,0.08); }
    .rh-input::placeholder { color: #b0bec5; }

    .rh-error { display: flex; align-items: center; gap: 7px; margin-top: 7px; background: #fef2f2; border-left: 3px solid #ef4444; border-radius: 6px; padding: 7px 11px; }
    .rh-error i { color: #ef4444; font-size: 12px; flex-shrink: 0; }
    .rh-error span { color: #dc2626; font-size: 12px; font-weight: 600; }

    .rh-file-current {
        display: flex; align-items: center; gap: 10px;
        background: #f0fdf4; border: 1px solid #bbf7d0;
        border-radius: 10px; padding: 12px 14px; margin-bottom: 12px;
    }
    .rh-file-current-icon { width: 36px; height: 36px; background: #dcfce7; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #16a34a; font-size: 15px; flex-shrink: 0; }
    .rh-file-current-info p { margin: 0; font-size: 12.5px; color: #166534; font-weight: 600; }
    .rh-file-current-info span { font-size: 11.5px; color: #4ade80; }

    .rh-file-zone {
        border: 2px dashed #cbd5e1; border-radius: 12px; padding: 22px 20px;
        text-align: center; background: #f8faff; transition: all 0.2s;
        cursor: pointer; position: relative;
    }
    .rh-file-zone:hover { border-color: #3b82f6; background: #eff6ff; }
    .rh-file-zone.err { border-color: #ef4444; background: #fffafa; }
    .rh-file-zone input[type="file"] { position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
    .rh-file-icon { width: 44px; height: 44px; background: #eff6ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; color: #3b82f6; font-size: 18px; }
    .rh-file-zone p { margin: 0; font-size: 13px; color: #475569; }
    .rh-file-zone strong { color: #3b82f6; }
    .rh-file-zone small { font-size: 11.5px; color: #94a3b8; display: block; margin-top: 5px; }

    .rh-submit-btn {
        width: 100%; background: linear-gradient(135deg, #065f46, #059669);
        color: white; border: none; border-radius: 12px; padding: 14px;
        font-size: 14px; font-weight: 700; font-family: 'Plus Jakarta Sans', sans-serif;
        cursor: pointer; box-shadow: 0 4px 15px rgba(5,150,105,0.3);
        transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .rh-submit-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(5,150,105,0.4); }
    .rh-submit-btn:active { transform: translateY(0); }
</style>

<div class="rh-wrap">
    <div class="rh-header">
        <div>
            <h2><i class="fa-solid fa-pen-to-square" style="color:#059669; margin-right:10px;"></i>Edit Risalah Hukum</h2>
            <p>Perbarui informasi dokumen risalah hukum yang sudah ada.</p>
        </div>
        <a href="{{ route('risalah-hukum.index') }}" class="rh-back-btn">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Form action menggunakan encryptedId (ID tidak terlihat di URL) --}}
    <form action="{{ route('risalah-hukum.update', $encryptedId) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="rh-layout">

            {{-- MAIN FORM --}}
            <div>
                <div class="rh-card">
                    <p class="rh-card-title"><i class="fa-solid fa-pen-to-square" style="margin-right:6px;"></i>Informasi Dokumen</p>

                    <div class="rh-field">
                        <label class="rh-label">Type Dokumen <span class="req">*</span></label>
                        <input type="text" name="type_dokumen" value="{{ old('type_dokumen', $item->type_dokumen) }}"
                            class="rh-input {{ $errors->has('type_dokumen') ? 'err' : '' }}"
                            placeholder="ex : Rancangan Perda">
                        @error('type_dokumen')
                            <div class="rh-error"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                        @enderror
                    </div>

                    <div class="rh-field">
                        <label class="rh-label">Judul <span class="req">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul', $item->judul) }}"
                            class="rh-input {{ $errors->has('judul') ? 'err' : '' }}"
                            placeholder="ex : APBD Tahun 2026">
                        @error('judul')
                            <div class="rh-error"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                        @enderror
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                        <div class="rh-field">
                            <label class="rh-label">T.E.U Pengarang/Badan <span class="req">*</span></label>
                            <input type="text" name="teu_pengarang" value="{{ old('teu_pengarang', $item->teu_pengarang) }}"
                                class="rh-input {{ $errors->has('teu_pengarang') ? 'err' : '' }}"
                                placeholder="ex : BPKD Tanah Datar">
                            @error('teu_pengarang')
                                <div class="rh-error"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                            @enderror
                        </div>

                        <div class="rh-field">
                            <label class="rh-label">Tahun <span class="req">*</span></label>
                            <input type="text" name="tahun" value="{{ old('tahun', $item->tahun) }}"
                                class="rh-input {{ $errors->has('tahun') ? 'err' : '' }}"
                                placeholder="ex : 2026">
                            @error('tahun')
                                <div class="rh-error"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="rh-card">
                    <p class="rh-card-title"><i class="fa-solid fa-file-pdf" style="margin-right:6px;"></i>File PDF</p>

                    @if($item->file_pdf)
                        <div class="rh-file-current">
                            <div class="rh-file-current-icon"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="rh-file-current-info">
                                <p>{{ basename($item->file_pdf) }}</p>
                                <span>File aktif saat ini</span>
                            </div>
                        </div>
                    @endif

                    <div class="rh-field">
                        <label class="rh-label" style="color:#64748b; font-size:12.5px; font-weight:600;">
                            <i class="fa-solid fa-arrow-up-from-bracket" style="font-size:11px;"></i>
                            Ganti File <span style="font-weight:400; color:#94a3b8;">(opsional)</span>
                        </label>
                        <div class="rh-file-zone {{ $errors->has('file_pdf') ? 'err' : '' }}">
                            <input type="file" name="file_pdf" accept=".pdf">
                            <div class="rh-file-icon"><i class="fa-solid fa-arrow-up-from-bracket"></i></div>
                            <p><strong>Klik untuk upload</strong> atau drag & drop</p>
                            <small>Kosongkan jika tidak ingin mengganti file · PDF · Maks. 10MB</small>
                        </div>
                        @error('file_pdf')
                            <div class="rh-error"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- SIDEBAR --}}
            <div>
                <button type="submit" class="rh-submit-btn">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                </button>
            </div>

        </div>
    </form>
</div>
@endsection