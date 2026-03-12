@extends('layouts.admin')

@section('content')
<div style="padding: 40px; background-color: #f8fafc; min-height: 100vh; font-family: 'Inter', sans-serif;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="font-weight: 700; color: #1e293b; margin: 0; font-size: 24px;">Data Kajian Hukum</h2>
            <p style="color: #64748b; margin: 5px 0 0 0;">Kelola daftar dokumen kajian hukum instansi.</p>
        </div>
        <a href="{{ route('kajian-hukum.create') }}"
           style="background: #10b981; color: white; border-radius: 12px; padding: 12px 24px; font-weight: 600; text-decoration: none; font-size: 14px; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2); transition: 0.3s;">
            <i class="fa-solid fa-plus"></i> Tambah Kajian Hukum
        </a>
    </div>

    @if(session('success'))
    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 15px; border-radius: 12px; margin-bottom: 20px; font-weight: 500;">
        <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> {{ session('success') }}
    </div>
    @endif

    <div style="background: white; border-radius: 20px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; overflow: hidden;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead style="background: #f8fafc; border-bottom: 2px solid #f1f5f9;">
                    <tr>
                        <th style="padding: 20px; color: #475569; font-size: 13px; font-weight: 700; text-transform: uppercase; width: 60px;">No.</th>
                        <th style="padding: 20px; color: #475569; font-size: 13px; font-weight: 700; text-transform: uppercase;">Jenis Dokumen</th>
                        <th style="padding: 20px; color: #475569; font-size: 13px; font-weight: 700; text-transform: uppercase;">Judul Kajian</th>
                        <th style="padding: 20px; color: #475569; font-size: 13px; font-weight: 700; text-transform: uppercase;">Pengarang</th>
                        <th style="padding: 20px; color: #475569; font-size: 13px; font-weight: 700; text-transform: uppercase; width: 80px;">Tahun</th>
                        <th style="padding: 20px; color: #475569; font-size: 13px; font-weight: 700; text-transform: uppercase; width: 80px;">Dilihat</th>
                        <th style="padding: 20px; color: #475569; font-size: 13px; font-weight: 700; text-transform: uppercase; text-align: center; width: 140px;">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $item)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: 0.2s;"
                        onmouseover="this.style.backgroundColor='#fcfcfc'"
                        onmouseout="this.style.backgroundColor='transparent'">

                        <td style="padding: 20px; font-size: 14px; color: #64748b;">{{ $index + 1 }}.</td>

                        <td style="padding: 20px; font-size: 14px; color: #1e293b;">
                            <span style="background: #f1f5f9; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; color: #475569;">
                                {{ $item->type_dokumen }}
                            </span>
                        </td>

                        <td style="padding: 20px; font-size: 14px; color: #1e293b; font-weight: 600; line-height: 1.5;">
                            {{ $item->judul }}
                            {{-- Tampilkan slug sebagai info kecil di bawah judul --}}
                            @if($item->slug)
                            <br><small style="font-weight: 400; color: #94a3b8; font-size: 11px;">
                                <i class="fa-solid fa-link" style="margin-right: 3px;"></i>{{ $item->slug }}
                            </small>
                            @endif
                        </td>

                        <td style="padding: 20px; font-size: 14px; color: #64748b;">{{ $item->teu_pengarang }}</td>

                        <td style="padding: 20px; font-size: 14px; color: #64748b; font-weight: 500;">{{ $item->tahun }}</td>

                        <td style="padding: 20px; font-size: 14px; color: #64748b;">
                            <i class="fa-regular fa-eye" style="margin-right: 5px; font-size: 12px;"></i> {{ $item->views }}
                        </td>

                        <td style="padding: 20px; text-align: center;">
                            <div style="display: flex; justify-content: center; gap: 10px;">

                                {{-- ✅ Tombol Edit: ID terenkripsi di URL --}}
                                <a href="{{ route('kajian-hukum.edit', Crypt::encryptString($item->id)) }}"
                                   style="color: #3b82f6; background: #eff6ff; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 10px; text-decoration: none; transition: 0.3s;"
                                   title="Edit Data">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                {{-- ✅ Tombol Delete: ID terenkripsi di URL --}}
                                <form action="{{ route('kajian-hukum.destroy', Crypt::encryptString($item->id)) }}"
                                      method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data kajian hukum ini?')"
                                            style="color: #ef4444; background: #fef2f2; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border: none; border-radius: 10px; cursor: pointer; transition: 0.3s;"
                                            title="Hapus Data">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="padding: 50px; text-align: center;">
                            <img src="https://illustrations.popsy.co/gray/empty-folder.svg" alt="empty"
                                 style="width: 120px; margin-bottom: 15px; opacity: 0.5;">
                            <p style="color: #94a3b8; font-weight: 500;">Belum ada data kajian hukum yang tersedia.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection