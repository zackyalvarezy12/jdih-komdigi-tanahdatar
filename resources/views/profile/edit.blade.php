@extends('layouts.admin')

@section('content')
<style>
    :root {
        --red:    #cc0000;
        --red-d:  #a80000;
        --red-l:  #fff0f0;
        --blue:   #003580;
        --blue-m: #0050c8;
        --blue-l: #e8eeff;
        --gold:   #f5a623;
        --green:  #16a34a;
        --green-l:#f0fdf4;
        --text:   #0f1d38;
        --muted:  #64748b;
        --border: #e8ecf3;
        --bg:     #f4f6fb;
    }

    .pr-page {
        padding: 40px;
        max-width: 980px;
        margin: 0 auto;
    }

    /* ─── HERO ─────────────────────────────────────────────────────── */
    .pr-hero {
        border-radius: 24px;
        background: linear-gradient(140deg, #003580 0%, #001a45 55%, #0d0d25 100%);
        padding: 36px 44px;
        display: flex;
        align-items: center;
        gap: 28px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
    }
    .pr-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 80% 20%, rgba(245,166,35,.13) 0%, transparent 50%),
            radial-gradient(circle at 8% 85%,  rgba(204,0,0,.16) 0%, transparent 40%);
        pointer-events: none;
    }
    .pr-hero::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, var(--red), var(--gold), var(--red));
    }

    .pr-av-wrap { position: relative; flex-shrink: 0; z-index: 1; }
    .pr-av-img, .pr-av-ini {
        width: 100px; height: 100px;
        border-radius: 50%;
        border: 3px solid rgba(255,255,255,.22);
        box-shadow: 0 8px 30px rgba(0,0,0,.35);
        object-fit: cover;
        display: block;
    }
    .pr-av-ini {
        background: linear-gradient(135deg, var(--red), var(--red-d));
        display: flex; align-items: center; justify-content: center;
        font-size: 33px; font-weight: 800; color: #fff;
    }
    .pr-online {
        position: absolute; bottom: 4px; right: 4px;
        width: 16px; height: 16px; border-radius: 50%;
        background: #22c55e; border: 3px solid #002560;
    }

    .pr-hero-body { flex: 1; z-index: 1; position: relative; }
    .pr-hero-tag {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(255,255,255,.1);
        border: 1px solid rgba(255,255,255,.15);
        color: rgba(255,255,255,.65);
        font-size: 10px; font-weight: 700; letter-spacing: 1.2px;
        text-transform: uppercase; padding: 4px 12px; border-radius: 99px;
        margin-bottom: 10px;
    }
    .pr-hero-name  { font-size: 27px; font-weight: 800; color: #fff; margin-bottom: 4px; }
    .pr-hero-email { font-size: 13px; color: rgba(255,255,255,.45); }
    .pr-hero-pills { display: flex; gap: 12px; margin-top: 18px; flex-wrap: wrap; }
    .pr-pill {
        background: rgba(255,255,255,.07);
        border: 1px solid rgba(255,255,255,.11);
        border-radius: 12px; padding: 10px 20px; text-align: center;
    }
    .pr-pill-val   { font-size: 16px; font-weight: 800; color: var(--gold); }
    .pr-pill-lbl   { font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; color: rgba(255,255,255,.32); margin-top: 2px; }

    /* ─── ALERTS ───────────────────────────────────────────────────── */
    .pr-alert {
        display: flex; align-items: center; gap: 10px;
        padding: 13px 18px; border-radius: 14px;
        font-size: 13.5px; font-weight: 700; margin-bottom: 22px;
    }
    .pr-alert-ok { background: var(--green-l); color: #065f46; border: 1px solid #86efac; }

    /* ─── GRID ─────────────────────────────────────────────────────── */
    .pr-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 22px; }
    .pr-full  { grid-column: 1/-1; }

    /* ─── CARD ─────────────────────────────────────────────────────── */
    .pr-card {
        background: #fff; border-radius: 20px;
        border: 1px solid var(--border);
        box-shadow: 0 2px 10px rgba(0,0,0,.04);
        overflow: hidden;
    }
    .pr-card-head {
        padding: 22px 28px 18px; border-bottom: 1px solid var(--border);
        display: flex; align-items: center; gap: 14px;
    }
    .pr-card-ico {
        width: 40px; height: 40px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 16px; flex-shrink: 0;
    }
    .ico-blue  { background: var(--blue-l); color: var(--blue); }
    .ico-red   { background: var(--red-l);  color: var(--red);  }
    .ico-gold  { background: #fff8e7;       color: #a06b0a;     }
    .ico-green { background: var(--green-l);color: var(--green);}

    .pr-card-title { font-size: 15px; font-weight: 800; color: var(--text); }
    .pr-card-sub   { font-size: 12px; color: var(--muted); margin-top: 2px; }
    .pr-card-body  { padding: 28px; }

    /* ─── FORM ─────────────────────────────────────────────────────── */
    .fg { margin-bottom: 22px; }
    .fg:last-of-type { margin-bottom: 0; }
    .fl {
        display: block; font-size: 10.5px; font-weight: 800;
        color: var(--muted); text-transform: uppercase;
        letter-spacing: .8px; margin-bottom: 8px;
    }
    .fi {
        width: 100%; padding: 12px 16px;
        background: var(--bg); border: 1.5px solid var(--border);
        border-radius: 12px; font-size: 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--text); font-weight: 500;
        transition: all .2s ease; outline: none; box-sizing: border-box;
    }
    .fi:focus {
        background: #fff; border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(0,53,128,.1);
    }
    .fi-danger:focus {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(204,0,0,.1);
    }
    .f-error {
        font-size: 11.5px; font-weight: 700; color: var(--red);
        margin-top: 6px; display: flex; align-items: center; gap: 5px;
    }

    /* ─── UPLOAD AVATAR ────────────────────────────────────────────── */
    .upl-row { display: flex; align-items: center; gap: 16px; margin-bottom: 22px; }
    .upl-thumb {
        width: 74px; height: 74px; border-radius: 50%;
        object-fit: cover; border: 3px solid var(--border); flex-shrink: 0;
    }
    .upl-thumb-ini {
        width: 74px; height: 74px; border-radius: 50%;
        background: linear-gradient(135deg, var(--red), var(--red-d));
        display: flex; align-items: center; justify-content: center;
        font-size: 24px; font-weight: 800; color: #fff;
        flex-shrink: 0; border: 3px solid var(--border);
    }
    .upl-zone {
        flex: 1; position: relative;
        border: 2px dashed var(--border); border-radius: 14px;
        padding: 18px 20px; background: var(--bg);
        text-align: center; cursor: pointer;
        transition: all .2s; overflow: hidden;
    }
    .upl-zone:hover { border-color: var(--blue); background: var(--blue-l); }
    .upl-zone input[type="file"] {
        position: absolute; inset: 0; opacity: 0;
        cursor: pointer; width: 100%; height: 100%;
    }
    .upl-zone-ico { font-size: 22px; color: var(--blue); margin-bottom: 6px; }
    .upl-zone-txt { font-size: 13px; font-weight: 700; color: var(--text); }
    .upl-zone-sub { font-size: 11px; color: var(--muted); margin-top: 2px; }

    /* ─── BUTTONS ──────────────────────────────────────────────────── */
    .btn-row {
        display: flex; justify-content: flex-end; gap: 10px;
        margin-top: 24px; padding-top: 20px;
        border-top: 1px solid var(--border);
    }
    .pr-btn {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 12px 26px; border-radius: 12px;
        font-size: 13.5px; font-weight: 700;
        font-family: 'Plus Jakarta Sans', sans-serif;
        cursor: pointer; border: none; transition: all .2s ease;
    }
    .pr-btn-blue {
        background: linear-gradient(135deg, var(--blue), var(--blue-m));
        color: #fff; box-shadow: 0 4px 14px rgba(0,53,128,.28);
    }
    .pr-btn-blue:hover { transform: translateY(-2px); box-shadow: 0 7px 20px rgba(0,53,128,.38); }
    .pr-btn-red {
        background: linear-gradient(135deg, var(--red), var(--red-d));
        color: #fff; box-shadow: 0 4px 14px rgba(204,0,0,.22);
    }
    .pr-btn-red:hover { transform: translateY(-2px); box-shadow: 0 7px 20px rgba(204,0,0,.33); }
    .pr-btn-ghost {
        background: #fff; color: var(--muted);
        border: 1.5px solid var(--border);
    }
    .pr-btn-ghost:hover { background: var(--bg); color: var(--text); }

    /* ─── DANGER CARD ──────────────────────────────────────────────── */
    .danger-card { border-color: #fecaca; }
    .danger-card .pr-card-head { background: #fff8f8; border-bottom-color: #fecaca; }

    /* ─── INFO ROWS ────────────────────────────────────────────────── */
    .info-row {
        display: flex; align-items: center; gap: 12px;
        padding: 14px 0; border-bottom: 1px solid var(--border);
    }
    .info-row:first-child { padding-top: 0; }
    .info-row:last-child  { border-bottom: none; padding-bottom: 0; }
    .info-ico {
        width: 36px; height: 36px; border-radius: 10px;
        background: var(--bg);
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; color: var(--muted); flex-shrink: 0;
    }
    .info-key { font-size: 10.5px; font-weight: 800; color: var(--muted); text-transform: uppercase; letter-spacing: .5px; }
    .info-val { font-size: 13.5px; font-weight: 600; color: var(--text); margin-top: 2px; }

    /* ─── MODAL ────────────────────────────────────────────────────── */
    .pr-modal-bg {
        display: none; position: fixed; inset: 0;
        background: rgba(0,0,0,.5); backdrop-filter: blur(4px);
        z-index: 9999; align-items: center; justify-content: center;
    }
    .pr-modal-box {
        background: #fff; border-radius: 24px; padding: 44px;
        max-width: 440px; width: 90%;
        box-shadow: 0 30px 60px rgba(0,0,0,.2);
        position: relative; animation: fadeUp .2s ease-out;
    }
    @keyframes fadeUp {
        from { opacity:0; transform: translateY(16px); }
        to   { opacity:1; transform: translateY(0); }
    }
    .pr-modal-close {
        position: absolute; top: 16px; right: 16px;
        width: 32px; height: 32px; border-radius: 50%;
        background: var(--bg); border: none; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        color: var(--muted); font-size: 14px; transition: .2s;
    }
    .pr-modal-close:hover { background: var(--red-l); color: var(--red); }
</style>

<div class="pr-page">

    {{-- SUCCESS ALERTS --}}
    @if(session('status') === 'profile-updated')
    <div class="pr-alert pr-alert-ok">
        <i class="fa-solid fa-circle-check"></i> Profil berhasil diperbarui!
    </div>
    @endif
    @if(session('status') === 'password-updated')
    <div class="pr-alert pr-alert-ok">
        <i class="fa-solid fa-shield-check"></i> Kata sandi berhasil diperbarui!
    </div>
    @endif

    {{-- ───────────────────────── HERO ──────────────────────────────── --}}
    @php
        $user     = Auth::user();
        $name     = $user->name ?? 'User';
        $initials = collect(explode(' ', $name))->map(fn($n) => strtoupper(substr($n,0,1)))->take(2)->join('');
    @endphp

    <div class="pr-hero">
        <div class="pr-av-wrap">
            @if($user->avatar)
                <img src="{{ asset('storage/'.$user->avatar) }}" alt="avatar" class="pr-av-img">
            @else
                <div class="pr-av-ini">{{ $initials }}</div>
            @endif
            <div class="pr-online"></div>
        </div>

        <div class="pr-hero-body">
            <div class="pr-hero-tag">
                <i class="fa-solid fa-shield-halved" style="font-size:9px;"></i>
                Administrator JDIH Kominfo
            </div>
            <div class="pr-hero-name">{{ $name }}</div>
            <div class="pr-hero-email">{{ $user->email }}</div>
            <div class="pr-hero-pills">
                <div class="pr-pill">
                    <div class="pr-pill-val">{{ \App\Models\User::count() }}</div>
                    <div class="pr-pill-lbl">Pengguna</div>
                </div>
                <div class="pr-pill">
                    <div class="pr-pill-val">{{ date('Y') }}</div>
                    <div class="pr-pill-lbl">Tahun Aktif</div>
                </div>
                <div class="pr-pill">
                    <div class="pr-pill-val">{{ $user->created_at?->format('Y') ?? '-' }}</div>
                    <div class="pr-pill-lbl">Bergabung</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ───────────────────────── GRID ──────────────────────────────── --}}
    <div class="pr-grid">

        {{-- ═══════════════ CARD 1: INFORMASI PROFIL ═══════════════════ --}}
        <div class="pr-card pr-full">
            <div class="pr-card-head">
                <div class="pr-card-ico ico-blue"><i class="fa-solid fa-user-pen"></i></div>
                <div>
                    <div class="pr-card-title">Informasi Profil</div>
                    <div class="pr-card-sub">Perbarui nama, email, dan foto profil akun Anda</div>
                </div>
            </div>
            <div class="pr-card-body">
                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    {{-- Foto Profil --}}
                    <div class="fg">
                        <label class="fl">Foto Profil</label>
                        <div class="upl-row">
                            @if($user->avatar)
                                <img id="avatarThumb" src="{{ asset('storage/'.$user->avatar) }}" alt="thumb" class="upl-thumb">
                            @else
                                <div class="upl-thumb-ini" id="avatarIni">{{ $initials }}</div>
                                <img id="avatarThumb" src="" alt="thumb" class="upl-thumb" style="display:none;">
                            @endif

                            <div class="upl-zone" id="uplZone">
                                <input type="file" name="avatar" id="avatarInput" accept="image/*">
                                <div class="upl-zone-ico"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                <div class="upl-zone-txt" id="uplZoneTxt">Klik untuk unggah foto baru</div>
                                <div class="upl-zone-sub">PNG, JPG, GIF · Maks. 2MB</div>
                            </div>
                        </div>
                        @error('avatar')
                            <div class="f-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama --}}
                    <div class="fg">
                        <label class="fl" for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="fi"
                               value="{{ old('name', $user->name) }}"
                               required autocomplete="name"
                               placeholder="Nama lengkap Anda">
                        @error('name')
                            <div class="f-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email (tanpa verifikasi) --}}
                    <div class="fg">
                        <label class="fl" for="email">Alamat Email</label>
                        <input type="email" id="email" name="email" class="fi"
                               value="{{ old('email', $user->email) }}"
                               required autocomplete="username"
                               placeholder="email@contoh.com">
                        @error('email')
                            <div class="f-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="btn-row">
                        <button type="submit" class="pr-btn pr-btn-blue">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ═══════════════ CARD 2: UBAH KATA SANDI ════════════════════ --}}
        <div class="pr-card">
            <div class="pr-card-head">
                <div class="pr-card-ico ico-blue"><i class="fa-solid fa-lock"></i></div>
                <div>
                    <div class="pr-card-title">Ubah Kata Sandi</div>
                    <div class="pr-card-sub">Gunakan kata sandi kuat dan unik</div>
                </div>
            </div>
            <div class="pr-card-body">
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="fg">
                        <label class="fl" for="current_password">Kata Sandi Saat Ini</label>
                        <input type="password" id="current_password" name="current_password"
                               class="fi" autocomplete="current-password" placeholder="••••••••">
                        @error('current_password', 'updatePassword')
                            <div class="f-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="fg">
                        <label class="fl" for="update_password">Kata Sandi Baru</label>
                        <input type="password" id="update_password" name="password"
                               class="fi" autocomplete="new-password" placeholder="••••••••">
                        @error('password', 'updatePassword')
                            <div class="f-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="fg">
                        <label class="fl" for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="fi" autocomplete="new-password" placeholder="••••••••">
                        @error('password_confirmation', 'updatePassword')
                            <div class="f-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="btn-row">
                        <button type="submit" class="pr-btn pr-btn-blue">
                            <i class="fa-solid fa-shield-halved"></i> Perbarui Kata Sandi
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ═══════════════ CARD 3: INFO AKUN ══════════════════════════ --}}
        <div class="pr-card">
            <div class="pr-card-head">
                <div class="pr-card-ico ico-gold"><i class="fa-solid fa-circle-info"></i></div>
                <div>
                    <div class="pr-card-title">Informasi Akun</div>
                    <div class="pr-card-sub">Detail sistem akun Anda</div>
                </div>
            </div>
            <div class="pr-card-body">

                <div class="info-row">
                    <div class="info-ico"><i class="fa-solid fa-id-badge"></i></div>
                    <div>
                        <div class="info-key">ID Pengguna</div>
                        <div class="info-val" style="font-family:'DM Mono',monospace;font-size:13px;">#{{ $user->id }}</div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-ico"><i class="fa-solid fa-user-shield"></i></div>
                    <div>
                        <div class="info-key">Peran</div>
                        <div class="info-val">
                            <span style="background:var(--red-l);color:var(--red);padding:3px 10px;border-radius:99px;font-size:12px;font-weight:700;">
                                Administrator
                            </span>
                        </div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-ico"><i class="fa-regular fa-calendar"></i></div>
                    <div>
                        <div class="info-key">Bergabung Sejak</div>
                        <div class="info-val">{{ $user->created_at?->format('d F Y') ?? '-' }}</div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-ico"><i class="fa-regular fa-clock"></i></div>
                    <div>
                        <div class="info-key">Terakhir Diperbarui</div>
                        <div class="info-val">{{ $user->updated_at?->format('d F Y, H:i') ?? '-' }}</div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ═══════════════ CARD 4: ZONA BERBAHAYA ═════════════════════ --}}
        <div class="pr-card pr-full danger-card">
            <div class="pr-card-head">
                <div class="pr-card-ico ico-red"><i class="fa-solid fa-triangle-exclamation"></i></div>
                <div>
                    <div class="pr-card-title" style="color:var(--red);">Zona Berbahaya</div>
                    <div class="pr-card-sub">Tindakan ini bersifat permanen dan tidak dapat dibatalkan</div>
                </div>
            </div>
            <div class="pr-card-body">
                <div style="display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;">
                    <div>
                        <div style="font-size:14px;font-weight:700;color:var(--text);margin-bottom:5px;">Hapus Akun Ini</div>
                        <div style="font-size:13px;color:var(--muted);max-width:520px;line-height:1.65;">
                            Setelah akun dihapus, semua data dan resource akan dihapus secara permanen.
                            Harap unduh data Anda terlebih dahulu jika diperlukan.
                        </div>
                    </div>
                    <button type="button" class="pr-btn pr-btn-red"
                            onclick="document.getElementById('deleteModal').style.display='flex'">
                        <i class="fa-solid fa-trash-can"></i> Hapus Akun
                    </button>
                </div>
            </div>
        </div>

    </div>{{-- end .pr-grid --}}
</div>{{-- end .pr-page --}}

{{-- ═══════════════════════════════════ DELETE MODAL ════════════════════ --}}
<div id="deleteModal" class="pr-modal-bg"
     onclick="if(event.target===this)this.style.display='none'">
    <div class="pr-modal-box">
        <button class="pr-modal-close"
                onclick="document.getElementById('deleteModal').style.display='none'">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div style="text-align:center;margin-bottom:28px;">
            <div style="width:64px;height:64px;border-radius:50%;background:#fee2e2;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:26px;color:var(--red);">
                <i class="fa-solid fa-trash-can"></i>
            </div>
            <h3 style="font-size:20px;font-weight:800;color:var(--text);margin-bottom:8px;">Hapus Akun?</h3>
            <p style="font-size:13px;color:var(--muted);line-height:1.6;">
                Masukkan kata sandi Anda untuk mengkonfirmasi penghapusan akun secara permanen.
                Tindakan ini <strong>tidak dapat dibatalkan</strong>.
            </p>
        </div>

        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <div class="fg">
                <label class="fl" for="del_password">Kata Sandi</label>
                <input type="password" id="del_password" name="password"
                       class="fi fi-danger" placeholder="Masukkan kata sandi Anda">
                @error('password', 'userDeletion')
                    <div class="f-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex;gap:10px;margin-top:4px;">
                <button type="button" class="pr-btn pr-btn-ghost" style="flex:1;"
                        onclick="document.getElementById('deleteModal').style.display='none'">
                    Batal
                </button>
                <button type="submit" class="pr-btn pr-btn-red" style="flex:1;">
                    <i class="fa-solid fa-trash-can"></i> Ya, Hapus Akun
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Live avatar preview
    document.getElementById('avatarInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(ev) {
            const thumb = document.getElementById('avatarThumb');
            const ini   = document.getElementById('avatarIni');
            const txt   = document.getElementById('uplZoneTxt');
            thumb.src = ev.target.result;
            thumb.style.display = 'block';
            if (ini) ini.style.display = 'none';
            if (txt) txt.textContent  = file.name;
        };
        reader.readAsDataURL(file);
    });

    // Auto-show delete modal jika ada error validasi
    @if($errors->userDeletion->isNotEmpty())
        document.getElementById('deleteModal').style.display = 'flex';
    @endif
</script>
@endsection