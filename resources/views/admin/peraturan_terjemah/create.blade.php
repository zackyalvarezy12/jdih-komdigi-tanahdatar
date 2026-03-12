@extends('layouts.admin')

@section('content')
<div style="padding: 40px; background-color: #f8fafc; min-height: 100vh; font-family: 'Inter', sans-serif;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="font-weight: 700; color: #1e293b; margin: 0; font-size: 26px; letter-spacing: -0.5px;">Tambah Peraturan Terjemah</h2>
            <p style="color: #64748b; margin: 5px 0 0 0; font-size: 15px;">Input data dokumen hukum baru yang telah diterjemahkan.</p>
        </div>
        <a href="{{ route('peraturan-terjemah.index') }}" style="text-decoration: none; color: #64748b; background: white; padding: 10px 22px; border-radius: 12px; border: 1px solid #e2e8f0; font-weight: 600; font-size: 14px; transition: all 0.3s ease; display: flex; align-items: center; gap: 8px;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='white'">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div style="background: white; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.04); overflow: hidden; max-width: 1000px; margin: 0 auto;">
        
        <div style="background: #f8fafc; padding: 20px 30px; border-bottom: 1px solid #e2e8f0;">
            <span style="background: #dcfce7; color: #166534; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 700; text-transform: uppercase;">Form Input Data</span>
        </div>

        <form id="mainForm" action="{{ route('peraturan-terjemah.store') }}" method="POST" enctype="multipart/form-data" style="padding: 40px;" novalidate>
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 25px;">
                {{-- Tipe Dokumen --}}
                <div class="form-group">
                    <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 10px; font-size: 14px;">
                        Tipe Dokumen <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="text" name="type_dokumen" id="type_dokumen" value="{{ old('type_dokumen') }}" 
                           style="width: 100%; padding: 14px; border: 1.5px solid #e2e8f0; border-radius: 12px; outline: none; transition: 0.3s; font-size: 14px; box-sizing: border-box;" 
                           placeholder="Contoh: Peraturan Daerah"
                           onfocus="clearError(this)" 
                           onblur="validateField(this, 'Tipe Dokumen')">
                    <small id="err_type_dokumen" style="display:none; color:#ef4444; font-size:12px; margin-top:6px; display:none;">
                        <i class="fa-solid fa-circle-exclamation"></i> Tipe Dokumen wajib diisi.
                    </small>
                </div>

                {{-- Tahun Terbit --}}
                <div class="form-group">
                    <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 10px; font-size: 14px;">
                        Tahun Terbit <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="number" name="tahun" id="tahun" value="{{ old('tahun', date('Y')) }}"
                           style="width: 100%; padding: 14px; border: 1.5px solid #e2e8f0; border-radius: 12px; outline: none; transition: 0.3s; font-size: 14px; box-sizing: border-box;"
                           onfocus="clearError(this)" 
                           onblur="validateField(this, 'Tahun Terbit')">
                    <small id="err_tahun" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                        <i class="fa-solid fa-circle-exclamation"></i> Tahun Terbit wajib diisi.
                    </small>
                </div>
            </div>

            {{-- Judul --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 10px; font-size: 14px;">
                    Judul Terjemahan Lengkap <span style="color:#ef4444;">*</span>
                </label>
                <textarea name="judul" id="judul" rows="4" 
                          style="width: 100%; padding: 14px; border: 1.5px solid #e2e8f0; border-radius: 12px; outline: none; transition: 0.3s; font-size: 14px; line-height: 1.6; box-sizing: border-box;" 
                          placeholder="Masukkan judul lengkap peraturan terjemahan..."
                          onfocus="clearError(this)" 
                          onblur="validateField(this, 'Judul Terjemahan')">{{ old('judul') }}</textarea>
                <small id="err_judul" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                    <i class="fa-solid fa-circle-exclamation"></i> Judul Terjemahan wajib diisi.
                </small>
            </div>

            {{-- TEU Pengarang --}}
            <div style="margin-bottom: 30px;">
                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 10px; font-size: 14px;">
                    T.E.U Pengarang / Instansi <span style="color:#ef4444;">*</span>
                </label>
                <input type="text" name="teu_pengarang" id="teu_pengarang" value="{{ old('teu_pengarang') }}"
                       style="width: 100%; padding: 14px; border: 1.5px solid #e2e8f0; border-radius: 12px; outline: none; transition: 0.3s; font-size: 14px; box-sizing: border-box;"
                       placeholder="Masukkan nama pengarang atau badan"
                       onfocus="clearError(this)" 
                       onblur="validateField(this, 'T.E.U Pengarang / Instansi')">
                <small id="err_teu_pengarang" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                    <i class="fa-solid fa-circle-exclamation"></i> T.E.U Pengarang / Instansi wajib diisi.
                </small>
            </div>

            {{-- File PDF --}}
            <div style="margin-bottom: 40px; background: #fdfdfd; padding: 25px; border-radius: 16px; border: 1px solid #f1f5f9;">
                <label style="display: block; font-weight: 700; color: #1e293b; margin-bottom: 15px; font-size: 15px;">
                    Dokumen Pendukung (.PDF) <span style="color:#ef4444;">*</span>
                </label>
                
                <div style="position: relative; border: 2px dashed #cbd5e1; border-radius: 14px; background: white; padding: 40px; text-align: center; transition: 0.3s;" id="drop-area">
                    <input type="file" name="file_pdf" id="file_pdf_input" accept="application/pdf" 
                           style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; opacity: 0; cursor: pointer; z-index: 2;">
                    <div id="file-preview">
                        <i class="fa-solid fa-cloud-arrow-up" style="font-size: 40px; color: #10b981; margin-bottom: 15px;"></i>
                        <p style="margin: 0; color: #475569; font-weight: 600; font-size: 15px;">Tarik file PDF ke sini atau klik untuk memilih</p>
                        <p style="margin: 8px 0 0 0; color: #94a3b8; font-size: 13px;">Ukuran maksimal file: 10MB</p>
                    </div>
                </div>
                <small id="err_file_pdf" style="display:none; color:#ef4444; font-size:12px; margin-top:8px;">
                    <i class="fa-solid fa-circle-exclamation"></i> <span id="err_file_pdf_msg">File PDF wajib diunggah.</span>
                </small>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 15px; border-top: 1px solid #f1f5f9; padding-top: 30px;">
                <a href="{{ route('peraturan-terjemah.index') }}" style="text-decoration: none; color: #64748b; background: #f1f5f9; padding: 14px 30px; border-radius: 12px; font-weight: 600; font-size: 14px; transition: 0.3s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">Batal</a>
                <button type="submit" style="background: #10b981; color: white; border: none; padding: 14px 45px; border-radius: 12px; font-weight: 700; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25); display: flex; align-items: center; gap: 10px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 15px rgba(16, 185, 129, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(16, 185, 129, 0.25)'">
                    <i class="fa-solid fa-circle-plus"></i> Simpan Data Baru
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function showError(el) {
        el.style.borderColor = '#ef4444';
        el.style.boxShadow = '0 0 0 4px rgba(239, 68, 68, 0.1)';
        const errEl = document.getElementById('err_' + el.id);
        if (errEl) errEl.style.display = 'block';
    }

    function clearError(el) {
        el.style.borderColor = '#10b981';
        el.style.boxShadow = '0 0 0 4px rgba(16, 185, 129, 0.1)';
        const errEl = document.getElementById('err_' + el.id);
        if (errEl) errEl.style.display = 'none';
    }

    function validateField(el) {
        if (!el.value.trim()) {
            showError(el);
            return false;
        } else {
            el.style.borderColor = '#10b981';
            el.style.boxShadow = '0 0 0 4px rgba(16, 185, 129, 0.1)';
            const errEl = document.getElementById('err_' + el.id);
            if (errEl) errEl.style.display = 'none';
            return true;
        }
    }

    // --- File Upload Preview & Validasi ---
    const fileInput = document.getElementById('file_pdf_input');
    const dropArea = document.getElementById('drop-area');
    const filePreview = document.getElementById('file-preview');
    const errFilePdf = document.getElementById('err_file_pdf');
    const errFilePdfMsg = document.getElementById('err_file_pdf_msg');

    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const sizeMB = (file.size / 1024 / 1024).toFixed(2);

            if (file.type !== 'application/pdf') {
                errFilePdfMsg.textContent = 'File harus berformat PDF.';
                errFilePdf.style.display = 'block';
                dropArea.style.borderColor = '#ef4444';
                dropArea.style.background = '#fff5f5';
                return;
            }
            if (file.size / 1024 / 1024 > 10) {
                errFilePdfMsg.textContent = 'Ukuran file tidak boleh melebihi 10MB.';
                errFilePdf.style.display = 'block';
                dropArea.style.borderColor = '#ef4444';
                dropArea.style.background = '#fff5f5';
                return;
            }

            errFilePdf.style.display = 'none';
            dropArea.style.borderColor = '#10b981';
            dropArea.style.background = '#f0fdf4';
            filePreview.innerHTML = `
                <i class="fa-solid fa-file-circle-check" style="font-size: 40px; color: #10b981; margin-bottom: 15px;"></i>
                <p style="margin: 0; color: #10b981; font-weight: 700; font-size: 15px;">File Terpilih:</p>
                <p style="margin: 8px 0 0 0; color: #334155; font-size: 14px; font-weight: 600;">${file.name}</p>
                <p style="margin: 5px 0 0 0; color: #64748b; font-size: 12px;">${sizeMB} MB — Klik kembali jika ingin mengganti file</p>
            `;
        }
    });

    // --- Validasi saat Submit ---
    document.getElementById('mainForm').addEventListener('submit', function(e) {
        let valid = true;

        ['type_dokumen', 'tahun', 'judul', 'teu_pengarang'].forEach(function(id) {
            const el = document.getElementById(id);
            if (!validateField(el)) valid = false;
        });

        if (!fileInput.files || !fileInput.files[0]) {
            errFilePdfMsg.textContent = 'File PDF wajib diunggah.';
            errFilePdf.style.display = 'block';
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