@extends('layouts.admin')

@section('content')
<div style="padding: 40px; background-color: #f8fafc; min-height: 100vh; font-family: 'Inter', sans-serif;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="font-weight: 700; color: #1e293b; margin: 0; font-size: 24px;">Tambah Kajian Hukum</h2>
            <p style="color: #64748b; margin: 5px 0 0 0;">Lengkapi formulir di bawah untuk menambah data baru.</p>
        </div>
        <a href="{{ route('kajian-hukum.index') }}"
           style="text-decoration: none; color: #64748b; background: white; padding: 10px 20px; border-radius: 10px; border: 1px solid #e2e8f0; font-weight: 600; font-size: 14px; transition: 0.3s;">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div style="background: white; border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; overflow: hidden;">
        <form id="mainForm"
              action="{{ route('kajian-hukum.store') }}"
              method="POST"
              enctype="multipart/form-data"
              style="padding: 30px;"
              novalidate>
            @csrf

            {{-- Type Dokumen & Tahun --}}
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">
                        Type Dokumen <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="text" name="type_dokumen" id="type_dokumen"
                           placeholder="ex: Rancangan Perda"
                           value="{{ old('type_dokumen') }}"
                           style="width: 100%; padding: 12px; border: 1.5px solid #cbd5e1; border-radius: 10px; outline: none; transition: 0.3s; box-sizing: border-box;"
                           onfocus="clearError(this)" onblur="validateField(this)">
                    <small id="err_type_dokumen" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                        <i class="fa-solid fa-circle-exclamation"></i> Type Dokumen wajib diisi.
                    </small>
                </div>

                <div>
                    <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">
                        Tahun <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="number" name="tahun" id="tahun"
                           placeholder="2026"
                           value="{{ old('tahun') }}"
                           style="width: 100%; padding: 12px; border: 1.5px solid #cbd5e1; border-radius: 10px; outline: none; transition: 0.3s; box-sizing: border-box;"
                           onfocus="clearError(this)" onblur="validateField(this)">
                    <small id="err_tahun" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                        <i class="fa-solid fa-circle-exclamation"></i> Tahun wajib diisi.
                    </small>
                </div>
            </div>

            {{-- Judul --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">
                    Judul Kajian <span style="color:#ef4444;">*</span>
                </label>
                <textarea name="judul" id="judul" rows="3"
                          placeholder="Masukkan judul lengkap kajian..."
                          style="width: 100%; padding: 12px; border: 1.5px solid #cbd5e1; border-radius: 10px; outline: none; resize: vertical; transition: 0.3s; box-sizing: border-box;"
                          onfocus="clearError(this)" onblur="validateField(this)">{{ old('judul') }}</textarea>
                <small id="err_judul" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                    <i class="fa-solid fa-circle-exclamation"></i> Judul Kajian wajib diisi.
                </small>
                <small style="color: #94a3b8; font-size: 11px; margin-top: 4px; display: block;">
                    <i class="fa-solid fa-info-circle"></i> Slug URL akan otomatis dibuat dari judul.
                </small>
            </div>

            {{-- TEU Pengarang --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">
                    T.E.U Pengarang/Badan <span style="color:#ef4444;">*</span>
                </label>
                <input type="text" name="teu_pengarang" id="teu_pengarang"
                       placeholder="ex: BPKD Tanah Datar"
                       value="{{ old('teu_pengarang') }}"
                       style="width: 100%; padding: 12px; border: 1.5px solid #cbd5e1; border-radius: 10px; outline: none; transition: 0.3s; box-sizing: border-box;"
                       onfocus="clearError(this)" onblur="validateField(this)">
                <small id="err_teu_pengarang" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                    <i class="fa-solid fa-circle-exclamation"></i> T.E.U Pengarang/Badan wajib diisi.
                </small>
            </div>

            {{-- File PDF --}}
            <div style="margin-bottom: 35px;">
                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">
                    File Kajian (.pdf) <span style="color:#ef4444;">*</span>
                </label>
                <div style="position: relative; border: 2px dashed #cbd5e1; border-radius: 12px; background: #f8fafc; padding: 40px; text-align: center; transition: 0.3s;"
                     id="drop-zone">
                    <input type="file" name="file_pdf" id="file_pdf" accept="application/pdf"
                           style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; opacity: 0; cursor: pointer;">
                    <div id="upload-icon">
                        <i class="fa-solid fa-file-pdf" style="font-size: 40px; color: #10b981; margin-bottom: 15px;"></i>
                        <p id="file-name" style="margin: 0; color: #64748b; font-weight: 500;">Klik atau seret file PDF ke sini</p>
                        <p style="margin: 5px 0 0 0; font-size: 12px; color: #94a3b8;">Maksimal ukuran file 10MB</p>
                    </div>
                </div>
                <small id="err_file_pdf" style="display:none; color:#ef4444; font-size:12px; margin-top:8px;">
                    <i class="fa-solid fa-circle-exclamation"></i> <span id="err_file_msg">File PDF wajib diunggah.</span>
                </small>
            </div>

            <div style="display: flex; justify-content: flex-end; padding-top: 20px; border-top: 1px solid #f1f5f9; gap: 10px;">
                <a href="{{ route('kajian-hukum.index') }}"
                   style="background: #f1f5f9; color: #475569; border: none; padding: 12px 30px; border-radius: 10px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center;">
                    Batal
                </a>
                <button type="submit"
                        style="background: #10b981; color: white; border: none; padding: 12px 40px; border-radius: 10px; font-weight: 600; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2);">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function clearError(el) {
        el.style.borderColor = '#10b981';
        el.style.boxShadow   = '0 0 0 3px rgba(16, 185, 129, 0.1)';
        const errEl = document.getElementById('err_' + el.id);
        if (errEl) errEl.style.display = 'none';
    }

    function validateField(el) {
        if (!el.value.trim()) {
            el.style.borderColor = '#ef4444';
            el.style.boxShadow   = '0 0 0 3px rgba(239, 68, 68, 0.1)';
            const errEl = document.getElementById('err_' + el.id);
            if (errEl) errEl.style.display = 'block';
            return false;
        } else {
            el.style.borderColor = '#10b981';
            el.style.boxShadow   = '0 0 0 3px rgba(16, 185, 129, 0.1)';
            const errEl = document.getElementById('err_' + el.id);
            if (errEl) errEl.style.display = 'none';
            return true;
        }
    }

    const fileInput       = document.getElementById('file_pdf');
    const fileNameDisplay = document.getElementById('file-name');
    const dropZone        = document.getElementById('drop-zone');
    const errFilePdf      = document.getElementById('err_file_pdf');
    const errFileMsg      = document.getElementById('err_file_msg');

    fileInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const file = this.files[0];

            if (file.type !== 'application/pdf') {
                errFileMsg.textContent   = 'File harus berformat PDF.';
                errFilePdf.style.display = 'block';
                dropZone.style.borderColor = '#ef4444';
                dropZone.style.background  = '#fff5f5';
                return;
            }
            if (file.size / 1024 / 1024 > 10) {
                errFileMsg.textContent   = 'Ukuran file tidak boleh melebihi 10MB.';
                errFilePdf.style.display = 'block';
                dropZone.style.borderColor = '#ef4444';
                dropZone.style.background  = '#fff5f5';
                return;
            }

            errFilePdf.style.display      = 'none';
            fileNameDisplay.innerHTML     = 'Terpilih: ' + file.name;
            fileNameDisplay.style.color   = '#10b981';
            dropZone.style.borderColor    = '#10b981';
            dropZone.style.background     = '#f0fdf4';
        }
    });

    document.getElementById('mainForm').addEventListener('submit', function (e) {
        let valid = true;

        ['type_dokumen', 'tahun', 'judul', 'teu_pengarang'].forEach(function (id) {
            const el = document.getElementById(id);
            if (!validateField(el)) valid = false;
        });

        if (!fileInput.files || !fileInput.files[0]) {
            errFileMsg.textContent   = 'File PDF wajib diunggah.';
            errFilePdf.style.display = 'block';
            dropZone.style.borderColor = '#ef4444';
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
            const firstErr = document.querySelector('small[style*="block"]');
            if (firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
</script>
@endsection