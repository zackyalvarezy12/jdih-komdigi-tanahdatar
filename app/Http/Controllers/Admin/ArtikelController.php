<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::latest()->get();
        return view('admin.artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'         => 'required|string|max:255',
            'konten'        => 'required|string',
            'gambar'        => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'jenis_artikel' => 'required|string|max:255',
            'tempat_terbit' => 'required|string|max:255',
            'tahun'         => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'bahasa'        => 'required|string|max:100',
            'sumber'        => 'required|string|max:255',
            'bidang_hukum'  => 'required|string|max:255',
            'lokasi'        => 'required|string|max:255',
            'teu'           => 'required|string|max:255',
            'subjek'        => 'required|string|max:255',
        ], [
            'judul.required'         => 'Judul wajib diisi.',
            'konten.required'        => 'Isi artikel wajib diisi.',
            'gambar.required'        => 'File dokumen / gambar sampul wajib diunggah.',
            'gambar.image'           => 'File harus berupa gambar.',
            'gambar.mimes'           => 'Format gambar harus jpg, png, atau jpeg.',
            'gambar.max'             => 'Ukuran gambar maksimal 2MB.',
            'jenis_artikel.required' => 'Jenis artikel wajib diisi.',
            'tempat_terbit.required' => 'Tempat terbit wajib diisi.',
            'tahun.required'         => 'Tahun wajib diisi.',
            'tahun.digits'           => 'Tahun harus terdiri dari 4 digit.',
            'tahun.integer'          => 'Tahun harus berupa angka.',
            'tahun.min'              => 'Tahun tidak valid.',
            'tahun.max'              => 'Tahun tidak boleh melebihi tahun ini.',
            'bahasa.required'        => 'Bahasa wajib diisi.',
            'sumber.required'        => 'Sumber wajib diisi.',
            'bidang_hukum.required'  => 'Bidang hukum wajib diisi.',
            'lokasi.required'        => 'Lokasi wajib diisi.',
            'teu.required'           => 'TEU orang/badan wajib diisi.',
            'subjek.required'        => 'Subjek wajib diisi.',
        ]);

        $data = $request->all();

        // Generate slug unik dari judul
        $slug = Str::slug($request->judul);
        $originalSlug = $slug;
        $count = 1;
        while (Artikel::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('assets/artikel', 'public');
        }

        $artikel = Artikel::create($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menulis artikel baru: ' . $request->judul,
            'type'        => 'success',
        ]);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diterbitkan!');
    }

    /**
     * Edit - menerima encryptedId dari URL admin
     */
    public function edit($encryptedId)
    {
        $id     = Crypt::decryptString($encryptedId);
        $artikel = Artikel::findOrFail($id);

        return view('admin.artikel.edit', compact('artikel', 'encryptedId'));
    }

    /**
     * Update - menerima encryptedId dari URL admin
     */
    public function update(Request $request, $encryptedId)
    {
        $id      = Crypt::decryptString($encryptedId);
        $artikel = Artikel::findOrFail($id);

        $request->validate([
            'judul'         => 'required|string|max:255',
            'konten'        => 'required|string',
            'gambar'        => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'jenis_artikel' => 'required|string|max:255',
            'tempat_terbit' => 'required|string|max:255',
            'tahun'         => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'bahasa'        => 'required|string|max:100',
            'sumber'        => 'required|string|max:255',
            'bidang_hukum'  => 'required|string|max:255',
            'lokasi'        => 'required|string|max:255',
            'teu'           => 'required|string|max:255',
            'subjek'        => 'required|string|max:255',
        ], [
            'judul.required'         => 'Judul wajib diisi.',
            'konten.required'        => 'Isi artikel wajib diisi.',
            'gambar.image'           => 'File harus berupa gambar.',
            'gambar.mimes'           => 'Format gambar harus jpg, png, atau jpeg.',
            'gambar.max'             => 'Ukuran gambar maksimal 2MB.',
            'jenis_artikel.required' => 'Jenis artikel wajib diisi.',
            'tempat_terbit.required' => 'Tempat terbit wajib diisi.',
            'tahun.required'         => 'Tahun wajib diisi.',
            'tahun.digits'           => 'Tahun harus terdiri dari 4 digit.',
            'tahun.integer'          => 'Tahun harus berupa angka.',
            'tahun.min'              => 'Tahun tidak valid.',
            'tahun.max'              => 'Tahun tidak boleh melebihi tahun ini.',
            'bahasa.required'        => 'Bahasa wajib diisi.',
            'sumber.required'        => 'Sumber wajib diisi.',
            'bidang_hukum.required'  => 'Bidang hukum wajib diisi.',
            'lokasi.required'        => 'Lokasi wajib diisi.',
            'teu.required'           => 'TEU orang/badan wajib diisi.',
            'subjek.required'        => 'Subjek wajib diisi.',
        ]);

        $data = $request->all();

        // Update slug jika judul berubah, tetap pastikan unik
        $slug         = Str::slug($request->judul);
        $originalSlug = $slug;
        $count        = 1;
        while (Artikel::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('assets/artikel', 'public');
        }

        $artikel->update($data);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Destroy - menerima encryptedId dari URL admin
     */
    public function destroy($encryptedId)
    {
        $id      = Crypt::decryptString($encryptedId);
        $artikel = Artikel::findOrFail($id);

        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }

    /**
     * Show publik - menggunakan SLUG
     */
    public function show($slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();

        return view('artikel.show', compact('artikel'));
    }
}