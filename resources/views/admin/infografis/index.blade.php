@extends('layouts.admin')

@section('content')
<div style="padding: 40px; background-color: #f8fafc; min-height: 100vh;">
    <div style="margin-bottom: 40px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="font-weight: 800; color: #1e293b; margin: 0; font-size: 24px;">Galeri Infografis</h2>
            <p style="color: #64748b; margin-top: 5px;">Kelola informasi visual sistem dalam bentuk grid.</p>
        </div>
        <a href="{{ route('infografis.create') }}"
           style="background: #10b981; color: white; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-weight: 700; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2); display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-plus"></i> Tambah Infografis
        </a>
    </div>

    @if(session('success'))
    <div style="background: #dcfce7; color: #166534; padding: 14px 18px; border-radius: 12px; margin-bottom: 25px; font-weight: 600;">
        <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i>{{ session('success') }}
    </div>
    @endif

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px;">
        @forelse($data as $item)
        <div style="background: white; border-radius: 20px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); transition: 0.3s;"
             onmouseover="this.style.transform='translateY(-5px)'"
             onmouseout="this.style.transform='translateY(0)'">

            {{-- Gambar --}}
            <div style="height: 200px; background: #f1f5f9; position: relative;">
                <img src="{{ asset('storage/'.$item->file_infografis) }}"
                     style="width: 100%; height: 100%; object-fit: cover;">

                {{-- Tombol expand --}}
                <a href="{{ asset('storage/'.$item->file_infografis) }}" target="_blank"
                   style="position: absolute; top: 12px; right: 12px; background: rgba(255,255,255,0.85); width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #475569; text-decoration: none; backdrop-filter: blur(4px);">
                    <i class="fa-solid fa-expand" style="font-size: 13px;"></i>
                </a>

                {{-- Views badge --}}
                <div style="position: absolute; top: 12px; left: 12px; background: rgba(0,0,0,0.5); color: white; font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 99px; backdrop-filter: blur(4px);">
                    <i class="fa-regular fa-eye" style="margin-right: 4px;"></i>{{ $item->views ?? 0 }}
                </div>
            </div>

            {{-- Info & Aksi --}}
            <div style="padding: 14px 16px;">
                <div style="margin-bottom: 10px;">
                    <div style="font-size: 13.5px; font-weight: 700; color: #1e293b; margin-bottom: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $item->judul }}
                    </div>
                    @if($item->slug)
                    <div style="font-size: 11px; color: #94a3b8;">
                        <i class="fa-solid fa-link" style="margin-right: 3px;"></i>{{ $item->slug }}
                    </div>
                    @endif
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 8px;">
                    {{-- ✅ Edit: ID terenkripsi --}}
                    <a href="{{ route('infografis.edit', Crypt::encryptString($item->id)) }}"
                       style="background: #f1f5f9; color: #475569; width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: 0.2s;"
                       title="Edit">
                        <i class="fa-solid fa-pen-to-square" style="font-size: 14px;"></i>
                    </a>

                    {{-- ✅ Delete: ID terenkripsi --}}
                    <form action="{{ route('infografis.destroy', Crypt::encryptString($item->id)) }}"
                          method="POST"
                          onsubmit="return confirm('Hapus infografis ini?')"
                          style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit"
                                style="background: #fef2f2; color: #ef4444; border: none; width: 35px; height: 35px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: 0.2s;"
                                title="Hapus">
                            <i class="fa-solid fa-trash" style="font-size: 14px;"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 100px 0;">
            <i class="fa-regular fa-image" style="font-size: 48px; color: #cbd5e1; margin-bottom: 16px; display: block;"></i>
            <p style="color: #94a3b8; font-weight: 500;">Belum ada data infografis.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection