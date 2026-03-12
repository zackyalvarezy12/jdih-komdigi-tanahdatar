@extends('layouts.admin')

@section('content')
<div style="padding: 40px; background-color: #f8fafc; min-height: 100vh;">
    <div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="font-weight: 800; color: #1e293b; margin: 0; font-size: 24px;">Data Kontak</h2>
            <p style="color: #64748b; margin-top: 5px;">Manajemen pesan masuk dan informasi kontak.</p>
        </div>
        <a href="{{ route('kontak.create') }}" style="background: #10b981; color: white; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-weight: 700; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);">
            + Tambah Kontak
        </a>
    </div>

    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 12px; margin-bottom: 25px; border: 1px solid #bbf7d0;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: white; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; min-width: 1000px;">
            <thead style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                <tr>
                    <th style="padding: 20px; text-align: left; color: #64748b; font-size: 13px; width: 50px;">NO</th>
                    <th style="padding: 20px; text-align: left; color: #64748b; font-size: 13px; width: 150px;">NAMA</th>
                    <th style="padding: 20px; text-align: left; color: #64748b; font-size: 13px; width: 200px;">EMAIL</th>
                    <th style="padding: 20px; text-align: left; color: #64748b; font-size: 13px; width: 150px;">SUBJEK</th>
                    <th style="padding: 20px; text-align: left; color: #64748b; font-size: 13px;">PESAN</th>
                    <th style="padding: 20px; text-align: center; color: #64748b; font-size: 13px; width: 100px;">OPSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $key => $item)
                <tr style="border-bottom: 1px solid #f1f5f9; transition: 0.3s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">
                    <td style="padding: 20px; vertical-align: top;">{{ $key + 1 }}</td>
                    <td style="padding: 20px; vertical-align: top; font-weight: 600; color: #1e293b;">{{ $item->nama }}</td>
                    <td style="padding: 20px; vertical-align: top; color: #2563eb;">{{ $item->email }}</td>
                    <td style="padding: 20px; vertical-align: top;">{{ $item->subjek }}</td>
                    <td style="padding: 20px; vertical-align: top; color: #475569; font-size: 14px; line-height: 1.6;">{{ $item->pesan }}</td>
                    <td style="padding: 20px; text-align: center; vertical-align: top;">
                        <div style="display: flex; justify-content: center; gap: 10px;">
                            <a href="{{ route('kontak.edit', $item->id) }}" style="background: #f1f5f9; color: #475569; width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('kontak.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" style="background: #fef2f2; color: #ef4444; border: none; width: 35px; height: 35px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-trash"></i>
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