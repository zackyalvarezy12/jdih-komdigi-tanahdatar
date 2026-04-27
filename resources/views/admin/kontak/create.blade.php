@extends('layouts.admin')

@section('content')
<div style="padding: 40px; background-color: #f8fafc; min-height: 100vh;">
    <div style="max-width: 800px; margin: 0 auto;">
        <div style="margin-bottom: 30px;">
            <a href="{{ route('kontak.index') }}" style="color: #64748b; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
            </a>
            <h2 style="font-weight: 700; color: #1e293b; margin-top: 15px;">Tambah Kontak Baru</h2>
        </div>

        <div style="background: white; border-radius: 24px; padding: 40px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);">
            <form id="mainForm" action="{{ route('kontak.store') }}" method="POST" novalidate>
                @csrf

                {{-- Nama & Email --}}
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-bottom: 25px;">
                    <div>
                        <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 10px;">
                            Nama Lengkap <span style="color:#ef4444;">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Masukkan nama..."
                               style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1.5px solid #e2e8f0; outline: none; transition: 0.3s; box-sizing: border-box;"
                               onfocus="clearError(this)" onblur="validateField(this)">
                        <small id="err_nama" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                            <i class="fa-solid fa-circle-exclamation"></i> Nama Lengkap wajib diisi.
                        </small>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 10px;">
                            Alamat Email <span style="color:#ef4444;">*</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="contoh@mail.com"
                               style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1.5px solid #e2e8f0; outline: none; transition: 0.3s; box-sizing: border-box;"
                               onfocus="clearError(this)" onblur="validateEmail(this)">
                        <small id="err_email" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                            <i class="fa-solid fa-circle-exclamation"></i> <span id="err_email_msg">Alamat Email wajib diisi.</span>
                        </small>
                    </div>
                </div>

                {{-- Subjek --}}
                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 10px;">
                        Subjek <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="text" name="subjek" id="subjek" value="{{ old('subjek') }}" placeholder="Tujuan pesan..."
                           style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1.5px solid #e2e8f0; outline: none; transition: 0.3s; box-sizing: border-box;"
                           onfocus="clearError(this)" onblur="validateField(this)">
                    <small id="err_subjek" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                        <i class="fa-solid fa-circle-exclamation"></i> Subjek wajib diisi.
                    </small>
                </div>

                {{-- Pesan --}}
                <div style="margin-bottom: 35px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 10px;">
                        Isi Pesan <span style="color:#ef4444;">*</span>
                    </label>
                    <textarea name="pesan" id="pesan" rows="6" placeholder="Ketik pesan di sini..."
                              style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1.5px solid #e2e8f0; outline: none; resize: vertical; transition: 0.3s; box-sizing: border-box;"
                              onfocus="clearError(this)" onblur="validateField(this)">{{ old('pesan') }}</textarea>
                    <small id="err_pesan" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                        <i class="fa-solid fa-circle-exclamation"></i> Isi Pesan wajib diisi.
                    </small>
                </div>

                {{-- Submit button — ID dipakai JS untuk disable setelah klik --}}
                <button type="submit" id="submitBtn"
                        style="width: 100%; background: #10b981; color: white; padding: 16px; border-radius: 14px; border: none; font-weight: 700; font-size: 16px; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.2);">
                    <i class="fa-solid fa-floppy-disk" style="margin-right:8px;"></i>
                    Simpan Kontak
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// ── Guard: cegah double-submit ─────────────────────────────────────────────
// Variabel flag — satu kali submit, selesai.
let _isSubmitting = false;

function clearError(el) {
    el.style.borderColor = '#10b981';
    el.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
    const errEl = document.getElementById('err_' + el.id);
    if (errEl) errEl.style.display = 'none';
}

function validateField(el) {
    if (!el.value.trim()) {
        el.style.borderColor = '#ef4444';
        el.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
        const errEl = document.getElementById('err_' + el.id);
        if (errEl) errEl.style.display = 'block';
        return false;
    }
    el.style.borderColor = '#10b981';
    el.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
    const errEl = document.getElementById('err_' + el.id);
    if (errEl) errEl.style.display = 'none';
    return true;
}

function validateEmail(el) {
    const errEl  = document.getElementById('err_email');
    const errMsg = document.getElementById('err_email_msg');
    const regex  = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!el.value.trim()) {
        el.style.borderColor = '#ef4444';
        el.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
        errMsg.textContent = 'Alamat Email wajib diisi.';
        errEl.style.display = 'block';
        return false;
    }
    if (!regex.test(el.value.trim())) {
        el.style.borderColor = '#ef4444';
        el.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
        errMsg.textContent = 'Format email tidak valid.';
        errEl.style.display = 'block';
        return false;
    }
    el.style.borderColor = '#10b981';
    el.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
    errEl.style.display = 'none';
    return true;
}

document.getElementById('mainForm').addEventListener('submit', function(e) {
    // ── Guard double-submit: jika sudah dalam proses submit, batalkan ──
    if (_isSubmitting) {
        e.preventDefault();
        return;
    }

    // Validasi semua field
    let valid = true;
    ['nama', 'subjek', 'pesan'].forEach(function(id) {
        const el = document.getElementById(id);
        if (!validateField(el)) valid = false;
    });
    if (!validateEmail(document.getElementById('email'))) valid = false;

    if (!valid) {
        e.preventDefault();
        // Scroll ke error pertama
        const firstErr = document.querySelector('small[style*="block"]');
        if (firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }

    _isSubmitting = true;
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.style.opacity = '0.6';
    btn.style.cursor  = 'not-allowed';
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin" style="margin-right:8px;"></i> Menyimpan...';
});
</script>
@endsection