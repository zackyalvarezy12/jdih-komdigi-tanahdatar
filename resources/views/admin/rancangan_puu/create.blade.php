@extends('layouts.admin')

@section('content')
<div style="padding: 40px; background-color: #f8fafc; min-height: 100vh; font-family: 'Inter', sans-serif;">
    <div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; max-width: 1000px; margin-left: auto; margin-right: auto;">
        <div>
            <h2 style="font-weight: 800; color: #1e293b; margin: 0; font-size: 28px; letter-spacing: -1px;">Tambah Rancangan PUU</h2>
            <p style="color: #64748b; margin-top: 5px; font-size: 15px;">Daftarkan draf peraturan perundang-undangan baru ke sistem.</p>
        </div>
        <a href="{{ route('rancangan-puu.index') }}"
           style="text-decoration: none; color: #64748b; background: white; padding: 10px 20px; border-radius: 12px; border: 1px solid #e2e8f0; font-weight: 600; font-size: 14px; transition: 0.3s; display: flex; align-items: center; gap: 8px;"
           onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='white'">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div style="background: white; border-radius: 24px; border: 1px solid #e2e8f0; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05); max-width: 1000px; margin: 0 auto; overflow: hidden;">
        <div style="height: 6px; background: linear-gradient(90deg, #10b981, #34d399);"></div>

        <form id="mainForm"
              action="{{ route('rancangan-puu.store') }}"
              method="POST"
              enctype="multipart/form-data"
              style="padding: 40px;"
              novalidate>
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">
                {{-- Tipe Dokumen --}}
                <div>
                    <label style="display: block; font-weight: 700; color: #334155; margin-bottom: 10px; font-size: 14px;">
                        Tipe Dokumen <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="text" name="type_dokumen" id="type_dokumen"
                           value="{{ old('type_dokumen') }}" placeholder="Misal: Rancangan Perda"
                           style="width: 100%; padding: 15px; border: 1.5px solid #e2e8f0; border-radius: 14px; outline: none; font-size: 14px; transition: 0.3s; box-sizing: border-box;"
                           onfocus="clearError(this)" onblur="validateField(this)">
                    <small id="err_type_dokumen" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                        <i class="fa-solid fa-circle-exclamation"></i> Tipe Dokumen wajib diisi.
                    </small>
                </div>

                {{-- Tahun --}}
                <div>
                    <label style="display: block; font-weight: 700; color: #334155; margin-bottom: 10px; font-size: 14px;">
                        Tahun <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="number" name="tahun" id="tahun"
                           value="{{ old('tahun', date('Y')) }}"
                           style="width: 100%; padding: 15px; border: 1.5px solid #e2e8f0; border-radius: 14px; outline: none; font-size: 14px; transition: 0.3s; box-sizing: border-box;"
                           onfocus="clearError(this)" onblur="validateField(this)">
                    <small id="err_tahun" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                        <i class="fa-solid fa-circle-exclamation"></i> Tahun wajib diisi.
                    </small>
                </div>
            </div>

            {{-- Judul --}}
            <div style="margin-bottom: 30px;">
                <label style="display: block; font-weight: 700; color: #334155; margin-bottom: 10px; font-size: 14px;">
                    Judul Rancangan <span style="color:#ef4444;">*</span>
                </label>
                <textarea name="judul" id="judul" rows="4"
                          placeholder="Masukkan judul lengkap rancangan..."
                          style="width: 100%; padding: 15px; border: 1.5px solid #e2e8f0; border-radius: 14px; outline: none; font-size: 14px; resize: none; transition: 0.3s; line-height: 1.6; box-sizing: border-box;"
                          onfocus="clearError(this)" onblur="validateField(this)">{{ old('judul') }}</textarea>
                <small id="err_judul" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                    <i class="fa-solid fa-circle-exclamation"></i> Judul Rancangan wajib diisi.
                </small>
                <small style="color: #94a3b8; font-size: 11px; margin-top: 4px; display: block;">
                    <i class="fa-solid fa-info-circle"></i> Slug URL akan otomatis dibuat dari judul.
                </small>
            </div>

            {{-- TEU Pengarang --}}
            <div style="margin-bottom: 30px;">
                <label style="display: block; font-weight: 700; color: #334155; margin-bottom: 10px; font-size: 14px;">
                    T.E.U Pengarang / Badan <span style="color:#ef4444;">*</span>
                </label>
                <div style="position: relative;">
                    <i class="fa-solid fa-building" style="position: absolute; left: 15px; top: 18px; color: #94a3b8;"></i>
                    <input type="text" name="teu_pengarang" id="teu_pengarang"
                           value="{{ old('teu_pengarang') }}" placeholder="Nama Instansi Terkait"
                           style="width: 100%; padding: 15px 15px 15px 45px; border: 1.5px solid #e2e8f0; border-radius: 14px; outline: none; font-size: 14px; transition: 0.3s; box-sizing: border-box;"
                           onfocus="clearError(this)" onblur="validateField(this)">
                </div>
                <small id="err_teu_pengarang" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                    <i class="fa-solid fa-circle-exclamation"></i> T.E.U Pengarang / Badan wajib diisi.
                </small>
            </div>

            {{-- File PDF --}}
            <div style="margin-bottom: 40px;">
                <label style="display: block; font-weight: 700; color: #334155; margin-bottom: 15px; font-size: 14px;">
                    Dokumen Pendukung (PDF) <span style="color:#ef4444;">*</span>
                </label>
                <div style="position: relative; border: 2px dashed #cbd5e1; border-radius: 20px; background: #f8fafc; padding: 40px; text-align: center; transition: 0.3s;"
                     id="drop-area">
                    <input type="file" name="file_pdf" id="file_pdf" accept="application/pdf"
                           style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; opacity: 0; cursor: pointer; z-index: 2;">
                    <div id="upload-instruction">
                        <div style="background: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
                            <i class="fa-solid fa-cloud-arrow-up" style="font-size: 24px; color: #10b981;"></i>
                        </div>
                        <p style="margin: 0; font-weight: 700; color: #475569; font-size: 16px;">Klik atau tarik file ke sini</p>
                        <p style="margin: 5px 0 0 0; color: #94a3b8; font-size: 13px;">Format PDF maksimal 10MB</p>
                    </div>
                </div>
                <small id="err_file_pdf" style="display:none; color:#ef4444; font-size:12px; margin-top:8px;">
                    <i class="fa-solid fa-circle-exclamation"></i> <span id="err_file_pdf_msg">File PDF wajib diunggah.</span>
                </small>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 15px; padding-top: 30px; border-top: 1px solid #f1f5f9;">
                <button type="reset" onclick="resetForm()"
                        style="background: #f1f5f9; color: #64748b; border: none; padding: 15px 30px; border-radius: 14px; font-weight: 600; cursor: pointer; transition: 0.3s;">
                    Reset Form
                </button>
                <button type="submit"
                        style="background: #10b981; color: white; border: none; padding: 15px 50px; border-radius: 14px; font-weight: 700; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3); display: flex; align-items: center; gap: 10px;"
                        onmouseover="this.style.transform='translateY(-2px)'"
                        onmouseout="this.style.transform='translateY(0)'">
                    <i class="fa-solid fa-check-circle"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function clearError(el) {
        el.style.borderColor = '#10b981';
        el.style.boxShadow   = '0 0 0 4px rgba(16, 185, 129, 0.1)';
        const errEl = document.getElementById('err_' + el.id);
        if (errEl) errEl.style.display = 'none';
    }

    function validateField(el) {
        if (!el.value.trim()) {
            el.style.borderColor = '#ef4444';
            el.style.boxShadow   = '0 0 0 4px rgba(239, 68, 68, 0.1)';
            const errEl = document.getElementById('err_' + el.id);
            if (errEl) errEl.style.display = 'block';
            return false;
        } else {
            el.style.borderColor = '#10b981';
            el.style.boxShadow   = '0 0 0 4px rgba(16, 185, 129, 0.1)';
            const errEl = document.getElementById('err_' + el.id);
            if (errEl) errEl.style.display = 'none';
            return true;
        }
    }

    const fileInput      = document.getElementById('file_pdf');
    const dropArea       = document.getElementById('drop-area');
    const instruction    = document.getElementById('upload-instruction');
    const errFilePdf     = document.getElementById('err_file_pdf');
    const errFilePdfMsg  = document.getElementById('err_file_pdf_msg');

    fileInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const file   = this.files[0];
            const sizeMB = (file.size / 1024 / 1024).toFixed(2);

            if (file.type !== 'application/pdf') {
                errFilePdfMsg.textContent  = 'File harus berformat PDF.';
                errFilePdf.style.display   = 'block';
                dropArea.style.borderColor = '#ef4444';
                dropArea.style.background  = '#fff5f5';
                return;
            }
            if (file.size / 1024 / 1024 > 10) {
                errFilePdfMsg.textContent  = 'Ukuran file tidak boleh melebihi 10MB.';
                errFilePdf.style.display   = 'block';
                dropArea.style.borderColor = '#ef4444';
                dropArea.style.background  = '#fff5f5';
                return;
            }

            errFilePdf.style.display   = 'none';
            dropArea.style.borderColor = '#10b981';
            dropArea.style.background  = '#f0fdf4';
            instruction.innerHTML = `
                <div style="background: #dcfce7; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                    <i class="fa-solid fa-file-pdf" style="font-size: 24px; color: #166534;"></i>
                </div>
                <p style="margin: 0; font-weight: 700; color: #166534; font-size: 16px;">File Terpilih:</p>
                <p style="margin: 5px 0 0 0; color: #475569; font-size: 14px; font-weight: 600;">${file.name}</p>
                <p style="margin: 3px 0 0 0; color: #64748b; font-size: 12px;">${sizeMB} MB</p>
            `;
        }
    });

    function resetForm() {
        ['type_dokumen', 'tahun', 'judul', 'teu_pengarang'].forEach(function (id) {
            const el = document.getElementById(id);
            if (el) {
                el.style.borderColor = '#e2e8f0';
                el.style.boxShadow   = 'none';
                const errEl = document.getElementById('err_' + id);
                if (errEl) errEl.style.display = 'none';
            }
        });
        errFilePdf.style.display   = 'none';
        dropArea.style.borderColor = '#cbd5e1';
        dropArea.style.background  = '#f8fafc';
        instruction.innerHTML = `
            <div style="background: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
                <i class="fa-solid fa-cloud-arrow-up" style="font-size: 24px; color: #10b981;"></i>
            </div>
            <p style="margin: 0; font-weight: 700; color: #475569; font-size: 16px;">Klik atau tarik file ke sini</p>
            <p style="margin: 5px 0 0 0; color: #94a3b8; font-size: 13px;">Format PDF maksimal 10MB</p>
        `;
    }

    document.getElementById('mainForm').addEventListener('submit', function (e) {
        let valid = true;

        ['type_dokumen', 'tahun', 'judul', 'teu_pengarang'].forEach(function (id) {
            const el = document.getElementById(id);
            if (!validateField(el)) valid = false;
        });

        if (!fileInput.files || !fileInput.files[0]) {
            errFilePdfMsg.textContent  = 'File PDF wajib diunggah.';
            errFilePdf.style.display   = 'block';
            dropArea.style.borderColor = '#ef4444';
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