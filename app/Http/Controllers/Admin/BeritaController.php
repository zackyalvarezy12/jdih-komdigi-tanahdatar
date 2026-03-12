<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Activity;

class BeritaController extends Controller
{
    /**
     * Daftar semua berita
     * URL: /admin/berita
     */
    public function index()
    {
        $berita = Berita::latest()->get();
        return view('admin.berita.index', compact('berita'));
    }

    /**
     * Form tambah berita baru
     * URL: /admin/berita/create
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Simpan berita baru ke database
     * Slug dibuat otomatis oleh Spatie dari field 'judul'
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|min:5',
            'isi'       => 'required',
            'gambar'    => 'nullable|image|max:2048',
            'tampilkan' => 'required|in:Ya,Tidak',
        ], [
            'judul.required'     => 'Judul berita tidak boleh kosong.',
            'judul.min'          => 'Judul terlalu pendek, minimal 5 karakter.',
            'isi.required'       => 'Harap isi konten berita terlebih dahulu.',
            'gambar.image'       => 'File yang diunggah harus berupa gambar.',
            'gambar.max'         => 'Ukuran gambar terlalu besar, maksimal 2MB.',
            'tampilkan.required' => 'Harap pilih apakah berita akan ditampilkan.',
            'tampilkan.in'       => 'Pilihan tampilan hanya boleh "Ya" atau "Tidak".',
        ]);

        $nama_gambar = null;
        if ($request->hasFile('gambar')) {
            $nama_gambar = $request->file('gambar')->store('berita', 'public');
        }

        // Slug dibuat OTOMATIS oleh Spatie — tidak perlu diisi manual
        $berita = Berita::create([
            'judul'     => $request->judul,
            'isi'       => $request->isi,
            'gambar'    => $nama_gambar,
            'tampilkan' => $request->tampilkan,
        ]);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Mempublikasikan berita baru: ' . $berita->judul,
            'type'        => 'success',
        ]);

        return redirect()->route('berita.index')
            ->with('success', 'Berita "' . $berita->judul . '" berhasil diterbitkan!');
    }

    /**
     * Form edit berita
     * URL: /admin/berita/edit/{encryptedId}
     *
     * ID dienkripsi → tidak ada angka di URL
     * Contoh: /admin/berita/edit/eyJpdiI6Ik1...
     */
    public function edit($encryptedId)
    {
        // Dekripsi ID — jika gagal (dimanipulasi), lempar 404
        try {
            $id = Crypt::decrypt($encryptedId);
        } catch (DecryptException $e) {
            abort(404, 'ID tidak valid.');
        }

        $berita = Berita::findOrFail($id);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Membuka halaman edit berita: ' . $berita->judul,
            'type'        => 'info',
        ]);

        return view('admin.berita.edit', compact('berita', 'encryptedId'));
    }

    /**
     * Simpan perubahan berita
     * URL: POST /admin/berita/update/{encryptedId}
     *
     * Jika judul berubah → Spatie otomatis generate slug baru
     */
    public function update(Request $request, $encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
        } catch (DecryptException $e) {
            abort(404, 'ID tidak valid.');
        }

        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul'     => 'required|min:5',
            'isi'       => 'required',
            'gambar'    => 'nullable|image|max:2048',
            'tampilkan' => 'required|in:Ya,Tidak',
        ], [
            'judul.required'     => 'Judul artikel tidak boleh kosong.',
            'judul.min'          => 'Judul terlalu pendek, minimal 5 karakter.',
            'isi.required'       => 'Harap isi konten berita sebelum memperbarui.',
            'gambar.image'       => 'File harus berupa gambar (JPG, PNG, atau JPEG).',
            'gambar.max'         => 'Ukuran gambar terlalu besar, maksimal 2MB.',
            'tampilkan.required' => 'Harap pilih status tampil berita.',
            'tampilkan.in'       => 'Pilihan tampilan hanya boleh "Ya" atau "Tidak".',
        ]);

        $nama_gambar = $berita->gambar;
        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $nama_gambar = $request->file('gambar')->store('berita', 'public');
        }

        // Update hanya field yang diizinkan
        // Jika judul berubah → Spatie otomatis regenerate slug
        $berita->update([
            'judul'     => $request->judul,
            'isi'       => $request->isi,
            'gambar'    => $nama_gambar,
            'tampilkan' => $request->tampilkan,
        ]);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Memperbarui berita: ' . $berita->judul,
            'type'        => 'info',
        ]);

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Menampilkan detail berita berdasarkan Slug
     * URL: /admin/berita/{slug}
     */
    public function show($slug)
    {
        // Cari berita berdasarkan slug, jika tidak ada langsung 404
        $berita = Berita::where('slug', $slug)->firstOrFail();

        // HANYA catat aktivitas JIKA user sedang login (Admin)
        if (auth()->check()) {
            Activity::create([
                'user_id'     => auth()->id(),
                'description' => 'Melihat detail berita: ' . $berita->judul,
                'type'        => 'info',
            ]);
        }

        // Memanggil file yang sudah buat di resources/views/admin/berita/show.blade.php
        return view('berita.show', compact('berita'));
    }
    /**
     * Hapus berita
     * URL: DELETE /admin/berita/delete/{encryptedId}
     */
    public function destroy($encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
        } catch (DecryptException $e) {
            abort(404, 'ID tidak valid.');
        }

        $berita = Berita::findOrFail($id);

        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $judul = $berita->judul;
        $berita->delete();

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menghapus berita: ' . $judul,
            'type'        => 'warning',
        ]);

        return redirect()->route('berita.index')
            ->with('success', 'Berita "' . $judul . '" berhasil dihapus.');
    }
}