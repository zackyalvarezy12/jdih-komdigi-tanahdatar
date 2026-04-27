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

    .rh-file-zone {
        border: 2px dashed #cbd5e1; border-radius: 12px; padding: 28px 20px;
        text-align: center; background: #f8faff; transition: all 0.2s;
        cursor: pointer; position: relative;
    }
    .rh-file-zone:hover { border-color: #3b82f6; background: #eff6ff; }
    .rh-file-zone.err { border-color: #ef4444; background: #fffafa; }
    .rh-file-zone input[type="file"] { position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
    .rh-file-icon { width: 48px; height: 48px; background: #eff6ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; color: #3b82f6; font-size: 20px; }
    .rh-file-zone p { margin: 0; font-size: 13px; color: #475569; }
    .rh-file-zone strong { color: #3b82f6; }
    .rh-file-zone small { font-size: 11.5px; color: #94a3b8; display: block; margin-top: 5px; }

    .rh-info-card { background: linear-gradient(145deg, #1e3a8a 0%, #2563eb 100%); border-radius: 16px; padding: 22px; color: white; margin-bottom: 16px; }
    .rh-info-card h4 { font-size: 13px; font-weight: 700; margin: 0 0 14px 0; }
    .rh-info-item { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 10px; font-size: 12px; opacity: 0.85; line-height: 1.55; }
    .rh-info-item i { margin-top: 3px; flex-shrink: 0; font-size: 10px; }
    .rh-info-item:last-child { margin-bottom: 0; }

    .rh-note { background: #fffbeb; border: 1px solid #fde68a; border-radius: 10px; padding: 13px 15px; font-size: 12px; color: #92400e; display: flex; gap: 8px; align-items: flex-start; margin-bottom: 16px; }
    .rh-note i { color: #f59e0b; margin-top: 1px; flex-shrink: 0; }

    .rh-submit-btn {
        width: 100%; background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white; border: none; border-radius: 12px; padding: 14px;
        font-size: 14px; font-weight: 700; font-family: 'Plus Jakarta Sans', sans-serif;
        cursor: pointer; box-shadow: 0 4px 15px rgba(59,130,246,0.35);
        transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .rh-submit-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(59,130,246,0.45); }
    .rh-submit-btn:active { transform: translateY(0); }
</style>

<div class="rh-wrap">
    <div class="rh-header">
        <div>
            <h2><i class="fa-solid fa-file-lines" style="color:#3b82f6; margin-right:10px;"></i>Tambah Risalah Hukum</h2>
            <p>Lengkapi semua informasi dokumen risalah hukum di bawah ini.</p>
        </div>
        <a href="{{ route('risalah-hukum.index') }}" class="rh-back-btn">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ route('risalah-hukum.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="rh-layout">

            {{-- MAIN FORM --}}
            <div>
                <div class="rh-card">
                    <p class="rh-card-title"><i class="fa-solid fa-pen-to-square" style="margin-right:6px;"></i>Informasi Dokumen</p>

                    <div class="rh-field">
                        <label class="rh-label">Type Dokumen <span class="req">*</span></label>
                        <input type="text" name="type_dokumen" value="{{ old('type_dokumen') }}"
                            class="rh-input {{ $errors->has('type_dokumen') ? 'err' : '' }}"
                            placeholder="ex : Rancangan Perda">
                        @error('type_dokumen')
                            <div class="rh-error"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                        @enderror
                    </div>

                    <div class="rh-field">
                        <label class="rh-label">Judul <span class="req">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul') }}"
                            class="rh-input {{ $errors->has('judul') ? 'err' : '' }}"
                            placeholder="ex : APBD Tahun 2026">
                        @error('judul')
                            <div class="rh-error"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                        @enderror
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                        <div class="rh-field">
                            <label class="rh-label">T.E.U Pengarang/Badan <span class="req">*</span></label>
                            <input type="text" name="teu_pengarang" value="{{ old('teu_pengarang') }}"
                                class="rh-input {{ $errors->has('teu_pengarang') ? 'err' : '' }}"
                                placeholder="ex : BPKD Tanah Datar">
                            @error('teu_pengarang')
                                <div class="rh-error"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                            @enderror
                        </div>

                        <div class="rh-field">
                            <label class="rh-label">Tahun <span class="req">*</span></label>
                            <input type="text" name="tahun" value="{{ old('tahun') }}"
                                class="rh-input {{ $errors->has('tahun') ? 'err' : '' }}"
                                placeholder="ex : 2026">
                            @error('tahun')
                                <div class="rh-error"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="rh-card">
                    <p class="rh-card-title"><i class="fa-solid fa-upload" style="margin-right:6px;"></i>Upload File PDF</p>

                    <div class="rh-field">
                        <label class="rh-label">File Risalah <span class="req">*</span></label>
                        <div class="rh-file-zone {{ $errors->has('file_pdf') ? 'err' : '' }}">
                            <input type="file" name="file_pdf" accept=".pdf">
                            <div class="rh-file-icon"><i class="fa-solid fa-file-pdf"></i></div>
                            <p><strong>Klik untuk upload</strong> atau drag & drop</p>
                            <small>Format: PDF &nbsp;·&nbsp; Maks. 10MB</small>
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
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Data
                </button>
            </div>

        </div>
    </form>
</div>

<script>
    // ── File PDF preview nama file saat dipilih ──
    document.querySelector('input[type="file"][name="file_pdf"]').addEventListener('change', function() {
        const zone   = this.closest('.rh-file-zone');
        const icon   = zone.querySelector('.rh-file-icon i');
        const title  = zone.querySelector('p');
        const hint   = zone.querySelector('small');

        if (this.files && this.files[0]) {
            const file     = this.files[0];
            const sizeMB   = (file.size / 1024 / 1024).toFixed(2);
            const fileName = file.name.length > 40 ? file.name.substring(0, 37) + '...' : file.name;

            // Ubah tampilan zona menjadi sukses
            zone.style.borderColor  = '#10b981';
            zone.style.background   = '#f0fdf4';
            icon.className          = 'fa-solid fa-file-pdf';
            icon.parentElement.style.background = '#dcfce7';
            icon.parentElement.style.color      = '#16a34a';
            title.innerHTML  = '<strong style="color:#16a34a">' + fileName + '</strong>';
            hint.textContent = sizeMB + ' MB · Siap diunggah';
            hint.style.color = '#16a34a';
        }
    });
</script>
@endsection