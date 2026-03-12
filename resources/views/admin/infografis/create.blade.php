@extends('layouts.admin')

@section('content')
<div style="padding: 40px; background-color: #f8fafc; min-height: 100vh;">
    <div style="max-width: 700px; margin: 0 auto;">
        <div style="margin-bottom: 30px;">
            <a href="{{ route('infografis.index') }}"
               style="color: #64748b; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px; width: fit-content;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Galeri
            </a>
            <h2 style="font-weight: 700; color: #1e293b; margin-top: 15px;">Tambah Infografis Baru</h2>
            <p style="color: #64748b; margin: 0;">Isi judul dan unggah gambar infografis.</p>
        </div>

        <div style="background: white; border-radius: 24px; padding: 40px; border: 1px solid #e2e8f0; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05);">
            <form id="mainForm" action="{{ route('infografis.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf

                {{-- Judul --}}
                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 10px;">
                        Judul Infografis <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="text" name="judul" id="judul"
                           value="{{ old('judul') }}"
                           placeholder="Masukkan judul infografis..."
                           style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1.5px solid #e2e8f0; outline: none; font-size: 14px; box-sizing: border-box; transition: 0.2s;"
                           onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16,185,129,0.1)'"
                           onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                    <small id="err_judul" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                        <i class="fa-solid fa-circle-exclamation"></i> Judul wajib diisi.
                    </small>
                    <small style="color: #94a3b8; display: block; margin-top: 5px; font-size: 11px;">
                        <i class="fa-solid fa-info-circle"></i> Slug URL akan otomatis dibuat dari judul.
                    </small>
                </div>

                {{-- File Upload --}}
                <div style="margin-bottom: 30px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 12px;">
                        Pilih File Infografis <span style="color:#ef4444;">*</span>
                    </label>
                    <div style="border: 2px dashed #cbd5e1; border-radius: 16px; padding: 30px; text-align: center; position: relative; transition: 0.3s;" id="drop-area">
                        <input type="file" name="file_infografis" id="file_infografis" accept="image/*"
                               style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; opacity: 0; cursor: pointer;">
                        <div id="placeholder-content">
                            <i class="fa-solid fa-cloud-arrow-up" style="font-size: 40px; color: #94a3b8; margin-bottom: 15px; display: block;"></i>
                            <p style="color: #64748b; margin: 0; font-weight: 600;">Klik atau seret gambar ke sini</p>
                            <small style="color: #94a3b8;">Format: JPG, JPEG, atau PNG (Maks. 5MB)</small>
                        </div>
                        <img id="image-preview" src="#" alt="Pratinjau"
                             style="display: none; max-width: 100%; border-radius: 12px; margin-top: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    </div>
                    <small id="err_file_infografis" style="display:none; color:#ef4444; font-size:12px; margin-top:8px;">
                        <i class="fa-solid fa-circle-exclamation"></i> <span id="err_msg">File gambar wajib diunggah.</span>
                    </small>
                </div>

                <button type="submit"
                        style="width: 100%; background: #10b981; color: white; padding: 16px; border-radius: 14px; border: none; font-weight: 700; font-size: 16px; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.2);">
                    Unggah Infografis
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const fileInput   = document.getElementById('file_infografis');
    const dropArea    = document.getElementById('drop-area');
    const preview     = document.getElementById('image-preview');
    const placeholder = document.getElementById('placeholder-content');
    const errFile     = document.getElementById('err_file_infografis');
    const errMsg      = document.getElementById('err_msg');
    const errJudul    = document.getElementById('err_judul');

    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];

    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            if (!allowedTypes.includes(file.type)) {
                errMsg.textContent = 'Format file harus JPG, JPEG, atau PNG.';
                errFile.style.display = 'block';
                dropArea.style.borderColor = '#ef4444';
                dropArea.style.background  = '#fff5f5';
                preview.style.display     = 'none';
                placeholder.style.display = 'block';
                return;
            }
            if (file.size / 1024 / 1024 > 5) {
                errMsg.textContent = 'Ukuran file tidak boleh melebihi 5MB.';
                errFile.style.display = 'block';
                dropArea.style.borderColor = '#ef4444';
                dropArea.style.background  = '#fff5f5';
                return;
            }
            errFile.style.display      = 'none';
            dropArea.style.borderColor = '#10b981';
            dropArea.style.background  = '#f0fdf4';

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src           = e.target.result;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('mainForm').addEventListener('submit', function(e) {
        let valid = true;

        const judul = document.getElementById('judul');
        if (!judul.value.trim()) {
            errJudul.style.display = 'block';
            judul.style.borderColor = '#ef4444';
            valid = false;
        } else {
            errJudul.style.display = 'none';
        }

        if (!fileInput.files || !fileInput.files[0]) {
            errMsg.textContent = 'File gambar wajib diunggah.';
            errFile.style.display = 'block';
            dropArea.style.borderColor = '#ef4444';
            valid = false;
        }

        if (!valid) e.preventDefault();
    });
</script>
@endsection