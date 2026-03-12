@extends('layouts.admin')

@section('content')
@php use Illuminate\Support\Facades\Crypt; @endphp

<div style="font-family: 'Inter', sans-serif;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-weight: 800; color: #1e293b; margin: 0; font-size: 28px; letter-spacing: -0.5px;">Koleksi Perpustakaan</h1>
            <p style="color: #64748b; margin-top: 5px; font-size: 15px;">Kelola data buku dan literatur digital Kominfo.</p>
        </div>
        <a href="{{ route('buku.create') }}" style="background: #10b981; color: white; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-weight: 700; display: flex; align-items: center; gap: 8px; transition: 0.3s; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);">
            <i class="fa-solid fa-plus"></i> Tambah Buku Baru
        </a>
    </div>

    @if(session('success'))
        <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 14px 18px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; color: #166534; font-size: 14px; font-weight: 600;">
            <i class="fa-solid fa-circle-check" style="color: #16a34a;"></i>
            {{ session('success') }}
        </div>
    @endif

    <div style="background: white; border-radius: 20px; border: 1px solid #f1f5f9; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 1px solid #f1f5f9;">
                    <th style="padding: 18px 25px; color: #64748b; font-weight: 700; font-size: 13px; text-transform: uppercase;">No.</th>
                    <th style="padding: 18px 25px; color: #64748b; font-weight: 700; font-size: 13px; text-transform: uppercase;">Cover</th>
                    <th style="padding: 18px 25px; color: #64748b; font-weight: 700; font-size: 13px; text-transform: uppercase;">Detail Buku</th>
                    <th style="padding: 18px 25px; color: #64748b; font-weight: 700; font-size: 13px; text-transform: uppercase;">Lokasi Rak</th>
                    <th style="padding: 18px 25px; color: #64748b; font-weight: 700; font-size: 13px; text-transform: uppercase; text-align: center;">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($buku as $no => $item)
                @php $encId = Crypt::encrypt($item->id); @endphp
                <tr style="border-bottom: 1px solid #f8fafc; transition: 0.2s;" onmouseover="this.style.backgroundColor='#fcfcfd'" onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding: 20px 25px; font-weight: 600; color: #64748b;">{{ ++$no }}</td>
                    <td style="padding: 20px 25px;">
                        @if($item->cover)
                            <img src="{{ asset('storage/' . $item->cover) }}" 
                                style="width: 60px; height: 85px; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border: 1px solid #e2e8f0;">
                        @else
                            <div style="width: 60px; height: 85px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; border: 1px dashed #cbd5e1;">
                                <i class="fa-solid fa-image" style="color: #94a3b8; font-size: 18px;"></i>
                            </div>
                        @endif
                    </td>
                    <td style="padding: 20px 25px;">
                        <div style="font-weight: 700; color: #1e293b; font-size: 16px; margin-bottom: 4px;">{{ $item->judul }}</div>
                        <div style="font-size: 13px; color: #94a3b8;">
                            <span style="color: #64748b;"><i class="fa-solid fa-user-pen" style="font-size: 11px;"></i> {{ $item->penulis }}</span> • 
                            <span>{{ $item->tahun_terbit }}</span>
                        </div>
                        @if($item->penerbit)
                        <div style="margin-top: 6px;">
                            <span style="background: #eff6ff; color: #3b82f6; padding: 3px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase;">{{ $item->penerbit }}</span>
                        </div>
                        @endif
                        {{-- Slug info (hanya untuk referensi admin) --}}
                        <div style="margin-top: 5px;">
                            <span style="font-size: 11px; color: #94a3b8;"><i class="fa-solid fa-link" style="font-size: 10px;"></i> /buku/{{ $item->slug }}</span>
                        </div>
                    </td>
                    <td style="padding: 20px 25px;">
                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            <span style="font-size: 13px; color: #1e293b; font-weight: 600;">Rak: {{ $item->rak }}</span>
                            <span style="font-size: 12px; color: #64748b;">Baris: {{ $item->baris }}</span>
                        </div>
                    </td>
                    <td style="padding: 20px 25px;">
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            {{-- Link edit menggunakan encrypted ID --}}
                            <a href="{{ route('buku.edit', $encId) }}" 
                               title="Edit"
                               style="width: 35px; height: 35px; background: #f1f5f9; color: #64748b; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: 0.3s;" 
                               onmouseover="this.style.background='#e2e8f0'; this.style.color='#10b981'" 
                               onmouseout="this.style.background='#f1f5f9'; this.style.color='#64748b'">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>

                            {{-- Form delete menggunakan encrypted ID --}}
                            <form action="{{ route('buku.destroy', $encId) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        title="Hapus"
                                        onclick="return confirm('Hapus buku \'{{ addslashes($item->judul) }}\'?')" 
                                        style="width: 35px; height: 35px; background: #fff1f2; color: #f43f5e; border-radius: 10px; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.3s;" 
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
                    <td colspan="5" style="padding: 50px; text-align: center; color: #94a3b8;">
                        <i class="fa-solid fa-book-open" style="font-size: 32px; margin-bottom: 12px; display: block;"></i>
                        Belum ada data buku. <a href="{{ route('buku.create') }}" style="color: #10b981; font-weight: 700;">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection