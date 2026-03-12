<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Buku;
use App\Models\Activity;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::latest()->get();
        return view('admin.buku.index', compact('buku'));
    }

    public function create()
    {
        return view('admin.buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required|min:3',
            'penulis'      => 'required',
            'rak'          => 'required',
            'baris'        => 'required',
            'penerbit'     => 'nullable',
            'isbn'         => 'nullable|min:10',
            'tahun_terbit' => 'nullable|numeric|digits:4',
            'cover'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'judul.required'       => 'Judul buku wajib diisi.',
            'judul.min'            => 'Judul minimal 3 karakter.',
            'penulis.required'     => 'Nama penulis tidak boleh kosong.',
            'rak.required'         => 'Tentukan lokasi rak.',
            'baris.required'       => 'Tentukan baris pada rak.',
            'tahun_terbit.numeric' => 'Tahun harus berupa angka.',
            'tahun_terbit.digits'  => 'Tahun harus 4 digit (contoh: 2024).',
            'cover.image'          => 'File harus berupa gambar.',
            'cover.max'            => 'Ukuran cover maksimal 2MB.',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('assets/buku', 'public');
        }

        Buku::create($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menambahkan koleksi buku baru: ' . $request->judul,
            'type'        => 'success',
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit(string $encryptedId)
    {
        $buku = $this->findByEncryptedId($encryptedId);
        return view('admin.buku.edit', compact('buku', 'encryptedId'));
    }

    public function update(Request $request, string $encryptedId)
    {
        $buku = $this->findByEncryptedId($encryptedId);

        $request->validate([
            'judul'        => 'required|min:3',
            'penulis'      => 'required',
            'rak'          => 'required',
            'baris'        => 'required',
            'cover'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tahun_terbit' => 'nullable|numeric|digits:4',
            'isbn'         => 'nullable',
        ], [
            'judul.required'       => 'Judul buku tidak boleh kosong!',
            'judul.min'            => 'Judul terlalu pendek (min. 3 karakter).',
            'penulis.required'     => 'Nama penulis wajib diisi.',
            'rak.required'         => 'Lokasi rak wajib diisi.',
            'baris.required'       => 'Nomor baris wajib diisi.',
            'cover.image'          => 'File harus berupa gambar (JPG, PNG).',
            'cover.max'            => 'Ukuran gambar maksimal 2MB.',
            'tahun_terbit.numeric' => 'Tahun harus berupa angka.',
            'tahun_terbit.digits'  => 'Tahun harus 4 digit.',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            if ($buku->cover) {
                Storage::disk('public')->delete($buku->cover);
            }
            $data['cover'] = $request->file('cover')->store('assets/buku', 'public');
        }

        $buku->update($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Memperbarui data buku: ' . $buku->judul,
            'type'        => 'info',
        ]);

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    public function destroy(string $encryptedId)
    {
        $buku = $this->findByEncryptedId($encryptedId);

        if ($buku->cover) {
            Storage::disk('public')->delete($buku->cover);
        }

        $judulLama = $buku->judul;
        $buku->delete();

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menghapus buku: ' . $judulLama,
            'type'        => 'warning',
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
    }

    /**
     * Halaman publik — tampilkan detail buku berdasarkan slug.
     * Dipanggil dari route: GET /buku/{slug}  (tanpa prefix /admin)
     */
    public function show(string $slug)
    {
        $buku = Buku::where('slug', $slug)->firstOrFail();
        return view('buku.show', compact('buku'));
    }

    // ─── Helper ─────────────────────────────────────────────────────────────

    private function findByEncryptedId(string $encryptedId): Buku
    {
        try {
            $id = Crypt::decrypt($encryptedId);
        } catch (DecryptException) {
            abort(404, 'Data tidak ditemukan.');
        }

        return Buku::findOrFail($id);
    }
}