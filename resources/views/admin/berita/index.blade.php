@extends('layouts.admin')

@section('content')
<div style="font-family: 'Inter', sans-serif;">

    @if(session('success'))
    <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-left:4px solid #22c55e;border-radius:12px;padding:14px 20px;margin-bottom:24px;color:#15803d;font-size:14px;font-weight:600;display:flex;align-items:center;gap:10px;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:30px;">
        <div>
            <h1 style="font-weight:800;color:#1e293b;margin:0;font-size:28px;">Manajemen Berita</h1>
            <p style="color:#64748b;margin-top:5px;">Kelola berita JDIH Kabupaten Tanah Datar.</p>
        </div>
        <a href="{{ route('berita.create') }}" style="background:#7f1d1d;color:white;padding:12px 24px;border-radius:12px;text-decoration:none;font-weight:700;display:flex;align-items:center;gap:8px;box-shadow:0 4px 12px rgba(127,29,29,0.25);">
            <i class="fa-solid fa-plus"></i> Tambah Berita
        </a>
    </div>

    <div style="background:white;border-radius:20px;border:1px solid #f1f5f9;overflow:hidden;box-shadow:0 4px 6px -1px rgba(0,0,0,0.02);">
        <table style="width:100%;border-collapse:collapse;text-align:left;">
            <thead>
                <tr style="background:#f8fafc;border-bottom:1px solid #f1f5f9;">
                    <th style="padding:18px 25px;color:#64748b;font-weight:700;font-size:13px;text-transform:uppercase;">No.</th>
                    <th style="padding:18px 25px;color:#64748b;font-weight:700;font-size:13px;text-transform:uppercase;">Gambar</th>
                    <th style="padding:18px 25px;color:#64748b;font-weight:700;font-size:13px;text-transform:uppercase;">Judul & URL Publik</th>
                    <th style="padding:18px 25px;color:#64748b;font-weight:700;font-size:13px;text-transform:uppercase;text-align:center;">Tampil</th>
                    <th style="padding:18px 25px;color:#64748b;font-weight:700;font-size:13px;text-transform:uppercase;text-align:center;">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($berita as $no => $item)
                <tr style="border-bottom:1px solid #f8fafc;transition:0.2s;" onmouseover="this.style.backgroundColor='#fcfcfd'" onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding:20px 25px;font-weight:600;color:#64748b;">{{ ++$no }}</td>
                    <td style="padding:20px 25px;">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" style="width:80px;height:55px;object-fit:cover;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                        @else
                            <div style="width:80px;height:55px;background:#f1f5f9;border-radius:8px;display:flex;align-items:center;justify-content:center;border:1px dashed #cbd5e1;">
                                <i class="fa-solid fa-image" style="color:#94a3b8;"></i>
                            </div>
                        @endif
                    </td>
                    <td style="padding:20px 25px;">
                        <div style="font-weight:700;color:#1e293b;font-size:15px;margin-bottom:6px;">{{ $item->judul }}</div>
                        {{-- URL publik pakai slug (untuk pengunjung website) --}}
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:4px;">
                            <span style="background:#eff6ff;color:#3b82f6;padding:2px 8px;border-radius:5px;font-size:10px;font-weight:700;">PUBLIC</span>
                            <code style="font-size:11px;color:#64748b;background:#f1f5f9;padding:2px 8px;border-radius:5px;">/berita/{{ $item->slug }}</code>
                        </div>
                        {{-- URL admin pakai encrypted ID (tidak ada angka) --}}
                        <div style="display:flex;align-items:center;gap:6px;">
                            <span style="background:#fef3c7;color:#92400e;padding:2px 8px;border-radius:5px;font-size:10px;font-weight:700;">ADMIN</span>
                            <code style="font-size:11px;color:#94a3b8;background:#f8fafc;padding:2px 8px;border-radius:5px;">ID terenkripsi 🔒</code>
                        </div>
                    </td>
                    <td style="padding:20px 25px;text-align:center;">
                        @if($item->tampilkan === 'Ya')
                            <span style="background:#dcfce7;color:#16a34a;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:700;">Ditampilkan</span>
                        @else
                            <span style="background:#fef2f2;color:#dc2626;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:700;">Disembunyikan</span>
                        @endif
                    </td>
                    <td style="padding:20px 25px;">
                        <div style="display:flex;gap:8px;justify-content:center;">
                            {{-- Edit: pakai encrypted ID, bukan id asli atau slug --}}
                            <a href="{{ route('berita.edit', $item->encryptedId()) }}"
                               title="Edit berita"
                               style="width:35px;height:35px;background:#f1f5f9;color:#64748b;border-radius:10px;display:flex;align-items:center;justify-content:center;text-decoration:none;transition:0.3s;"
                               onmouseover="this.style.background='#fef9c3';this.style.color='#ca8a04'"
                               onmouseout="this.style.background='#f1f5f9';this.style.color='#64748b'">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            {{-- Destroy: pakai encrypted ID --}}
                            <form action="{{ route('berita.destroy', $item->encryptedId()) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Hapus berita \'{{ addslashes($item->judul) }}\'?')"
                                    title="Hapus berita"
                                    style="width:35px;height:35px;background:#fff1f2;color:#f43f5e;border-radius:10px;border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:0.3s;"
                                    onmouseover="this.style.background='#ffe4e6'"
                                    onmouseout="this.style.background='#fff1f2'">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding:60px;text-align:center;color:#94a3b8;">
                        <i class="fa-solid fa-newspaper" style="font-size:36px;margin-bottom:12px;display:block;"></i>
                        Belum ada berita. <a href="{{ route('berita.create') }}" style="color:#7f1d1d;font-weight:700;">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection