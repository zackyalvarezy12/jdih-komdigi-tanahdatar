@extends('layouts.admin')

@section('content')

@if(session('success'))
    <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 12px; margin-bottom: 20px; border: 1px solid #bbf7d0; margin: 30px 30px 0 30px;">
        <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> {{ session('success') }}
    </div>
@endif

<div class="container-fluid" style="padding: 30px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="font-weight: 700; color: #1e293b; margin: 0; text-transform: lowercase;">kelola artikel</h2>
            <p style="color: #64748b; margin-top: 5px;">Kelola data artikel secara sistematis.</p>
        </div>
        <a href="{{ route('artikel.create') }}" class="btn" style="background: #10b981; color: white; border-radius: 12px; padding: 12px 24px; font-weight: 600; text-decoration: none;">
            <i class="fa-solid fa-plus" style="margin-right: 8px;"></i> Tambah artikel
        </a>
    </div>

    <div style="background: white; border-radius: 20px; padding: 25px; box-shadow: 0 10px 25px rgba(0,0,0,0.02); border: 1px solid #f1f5f9; overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; min-width: 800px;">
            <thead>
                <tr style="border-bottom: 2px solid #f8fafc;">
                    <th style="text-align: left; padding: 15px 20px; color: #94a3b8; font-size: 12px; text-transform: uppercase;">No.</th>
                    <th style="text-align: left; padding: 15px 20px; color: #94a3b8; font-size: 12px; text-transform: uppercase; width: 50%;">Judul</th>
                    <th style="text-align: center; padding: 15px 20px; color: #94a3b8; font-size: 12px; text-transform: uppercase;">Tanggal</th>
                    <th style="text-align: center; padding: 15px 20px; color: #94a3b8; font-size: 12px; text-transform: uppercase;">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($artikels as $index => $artikel)
                <tr style="border-bottom: 1px solid #f8fafc; transition: 0.3s;" onmouseover="this.style.backgroundColor='#fcfdfe'" onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding: 20px; color: #64748b; font-size: 14px;">{{ $index + 1 }}</td>
                    <td style="padding: 20px;">
                        <div style="font-weight: 600; color: #334155; line-height: 1.5; font-size: 14px;">{{ $artikel->judul }}</div>
                        {{-- Tampilkan slug sebagai info tambahan --}}
                        <div style="font-size: 11px; color: #94a3b8; margin-top: 3px;">
                            <i class="fa-solid fa-link" style="margin-right: 4px;"></i>{{ $artikel->slug }}
                        </div>
                    </td>
                    <td style="padding: 20px; text-align: center; color: #64748b; font-size: 14px;">
                        {{ $artikel->created_at->format('d/m/Y') }}
                    </td>
                    <td style="padding: 20px; text-align: center;">
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            {{-- Edit menggunakan encrypted_id --}}
                            <a href="{{ route('artikel.edit', $artikel->encrypted_id) }}" style="background: #f1f5f9; color: #64748b; width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: 0.2s;">
                                <i class="fa-solid fa-pen-to-square" style="font-size: 14px;"></i>
                            </a>
                            {{-- Hapus menggunakan encrypted_id --}}
                            <form action="{{ route('artikel.destroy', $artikel->encrypted_id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" style="background: #fff1f2; color: #fb7185; width: 35px; height: 35px; border-radius: 8px; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-trash" style="font-size: 14px;"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection