@extends('layouts.admin')

@section('content')
<div style="padding: 40px; background-color: #f8fafc; min-height: 100vh;">
    <div style="max-width: 900px; margin: 0 auto;">
        <div style="margin-bottom: 30px;">
            <a href="{{ route('naskah-akademik.index') }}"
               style="color: #64748b; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px; width: fit-content;">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <h2 style="font-weight: 700; color: #1e293b; margin-top: 15px;">Edit Naskah Akademik</h2>
            <p style="color: #64748b; margin: 0;">Perbarui informasi dokumen naskah akademik.</p>
        </div>

        <div style="background: white; border-radius: 24px; padding: 40px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);">

            {{-- ✅ Action form pakai $encryptedId, bukan $item->id --}}
            <form id="mainForm"
                  action="{{ route('naskah-akademik.update', $encryptedId) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  novalidate>
                @csrf
                @method('PUT')

                {{-- Tipe Dokumen & Tahun --}}
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-bottom: 25px;">
                    <div>
                        <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 10px;">
                            Tipe Dokumen <span style="color:#ef4444;">*</span>
                        </label>
                        <input type="text" name="type_dokumen" id="type_dokumen"
                               value="{{ old('type_dokumen', $item->type_dokumen) }}"
                               style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1.5px solid #e2e8f0; outline: none; transition: 0.3s; box-sizing: border-box;"
                               onfocus="clearError(this)" onblur="validateField(this)">
                        <small id="err_type_dokumen" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                            <i class="fa-solid fa-circle-exclamation"></i> Tipe Dokumen wajib diisi.
                        </small>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 10px;">
                            Tahun <span style="color:#ef4444;">*</span>
                        </label>
                        <input type="number" name="tahun" id="tahun"
                               value="{{ old('tahun', $item->tahun) }}"
                               style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1.5px solid #e2e8f0; outline: none; transition: 0.3s; box-sizing: border-box;"
                               onfocus="clearError(this)" onblur="validateField(this)">
                        <small id="err_tahun" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                            <i class="fa-solid fa-circle-exclamation"></i> Tahun wajib diisi.
                        </small>
                    </div>
                </div>

                {{-- Judul --}}
                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 10px;">
                        Judul <span style="color:#ef4444;">*</span>
                    </label>
                    <textarea name="judul" id="judul" rows="3"
                              style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1.5px solid #e2e8f0; outline: none; transition: 0.3s; box-sizing: border-box;"
                              onfocus="clearError(this)" onblur="validateField(this)">{{ old('judul', $item->judul) }}</textarea>
                    <small id="err_judul" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                        <i class="fa-solid fa-circle-exclamation"></i> Judul wajib diisi.
                    </small>
                    {{-- Info slug saat ini --}}
                    @if($item->slug)
                    <small style="color: #94a3b8; font-size: 11px; margin-top: 4px; display: block;">
                        <i class="fa-solid fa-link"></i> Slug saat ini: <strong>{{ $item->slug }}</strong>
                        &nbsp;(akan otomatis berubah jika judul diedit)
                    </small>
                    @endif
                </div>

                {{-- TEU Pengarang --}}
                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 10px;">
                        T.E.U Pengarang/Badan <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="text" name="teu_pengarang" id="teu_pengarang"
                           value="{{ old('teu_pengarang', $item->teu_pengarang) }}"
                           style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1.5px solid #e2e8f0; outline: none; transition: 0.3s; box-sizing: border-box;"
                           onfocus="clearError(this)" onblur="validateField(this)">
                    <small id="err_teu_pengarang" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                        <i class="fa-solid fa-circle-exclamation"></i> T.E.U Pengarang/Badan wajib diisi.
                    </small>
                </div>

                {{-- File PDF --}}
                <div style="margin-bottom: 35px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 10px;">
                        Ganti File PDF
                        <span style="color:#94a3b8; font-weight: 400; font-size: 13px;">(Kosongkan jika tidak ingin mengubah)</span>
                    </label>

                    @if($item->file_pdf)
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px; background: #eff6ff; padding: 10px 14px; border-radius: 10px; border: 1px solid #dbeafe;">
                        <i class="fa-solid fa-file-pdf" style="color: #3b82f6;"></i>
                        <span style="font-size: 13px; color: #1e40af; font-weight: 600;">File saat ini:</span>
                        <a href="{{ asset('storage/'.$item->file_pdf) }}" target="_blank"
                           style="color: #2563eb; font-size: 13px; font-weight: 600;">Lihat PDF</a>
                    </div>
                    @endif

                    <input type="file" name="file_pdf" id="file_pdf" accept="application/pdf"
                           style="width: 100%; padding: 10px; border: 1.5px dashed #cbd5e1; border-radius: 12px; transition: 0.3s; box-sizing: border-box;">
                    <small style="color: #94a3b8; display: block; margin-top: 5px;">Format: PDF (Maks. 10MB)</small>
                    <small id="err_file_pdf" style="display:none; color:#ef4444; font-size:12px; margin-top:4px;">
                        <i class="fa-solid fa-circle-exclamation"></i> <span id="err_file_pdf_msg"></span>
                    </small>
                </div>

                <div style="display: flex; gap: 10px;">
                    <a href="{{ route('naskah-akademik.index') }}"
                       style="flex: 1; background: #f1f5f9; color: #475569; padding: 16px; border-radius: 14px; border: none; font-weight: 700; font-size: 16px; text-decoration: none; text-align: center; transition: 0.3s;">
                        Batal
                    </a>
                    <button type="submit"
                            style="flex: 2; background: #10b981; color: white; padding: 16px; border-radius: 14px; border: none; font-weight: 700; font-size: 16px; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.2);">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const hasExistingFile = {{ $item->file_pdf ? 'true' : 'false' }};

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

    const fileInput     = document.getElementById('file_pdf');
    const errFilePdf    = document.getElementById('err_file_pdf');
    const errFilePdfMsg = document.getElementById('err_file_pdf_msg');

    fileInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            if (file.type !== 'application/pdf') {
                errFilePdfMsg.textContent = 'File harus berformat PDF.';
                errFilePdf.style.display  = 'block';
                this.style.borderColor    = '#ef4444';
                return;
            }
            if (file.size / 1024 / 1024 > 10) {
                errFilePdfMsg.textContent = 'Ukuran file tidak boleh melebihi 10MB.';
                errFilePdf.style.display  = 'block';
                this.style.borderColor    = '#ef4444';
                return;
            }
            errFilePdf.style.display = 'none';
            this.style.borderColor   = '#10b981';
        }
    });

    document.getElementById('mainForm').addEventListener('submit', function (e) {
        let valid = true;

        ['type_dokumen', 'tahun', 'judul', 'teu_pengarang'].forEach(function (id) {
            const el = document.getElementById(id);
            if (!validateField(el)) valid = false;
        });

        // File wajib hanya jika belum ada file sebelumnya
        if (!hasExistingFile && (!fileInput.files || !fileInput.files[0])) {
            errFilePdfMsg.textContent = 'File PDF wajib diunggah.';
            errFilePdf.style.display  = 'block';
            fileInput.style.borderColor = '#ef4444';
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