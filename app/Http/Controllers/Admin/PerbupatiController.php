<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Perbupati;
use App\Models\Activity;

class PerbupatiController extends Controller
{
    public function index()
    {
        $perbupatis = Perbupati::latest()->get();
        return view('admin.perbupati.index', compact('perbupatis'));
    }

    public function create()
    {
        return view('admin.perbupati.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor'            => 'required|unique:perbupatis,nomor',
            'judul'            => 'required|min:5',
            'tahun'            => 'required|numeric',
            'status'           => 'required',
            'file'             => 'required|mimes:pdf|max:10000',
            'tempat_penetapan' => 'required',
            'tanggal'          => 'required|date',
            'sumber'           => 'required',
            'subjek'           => 'required',
            'bahasa'           => 'required',
            'lokasi'           => 'required',
            'bidang_hukum'     => 'required',
        ], [
            'nomor.required'            => 'Nomor wajib diisi.',
            'nomor.unique'              => 'Nomor sudah terdaftar di sistem.',
            'judul.required'            => 'Judul wajib diisi.',
            'judul.min'                 => 'Judul terlalu singkat (min. 5 karakter).',
            'tahun.required'            => 'Tahun wajib diisi.',
            'tahun.numeric'             => 'Tahun harus berupa angka.',
            'status.required'           => 'Pilih status peraturan.',
            'file.required'             => 'File PDF wajib diunggah.',
            'file.mimes'                => 'Format file harus PDF.',
            'file.max'                  => 'Ukuran file maksimal 10MB.',
            'tempat_penetapan.required' => 'Tempat penetapan wajib diisi.',
            'tanggal.required'          => 'Tanggal wajib diisi.',
            'sumber.required'           => 'Sumber wajib diisi.',
            'subjek.required'           => 'Subjek wajib diisi.',
            'bahasa.required'           => 'Bahasa wajib diisi.',
            'lokasi.required'           => 'Lokasi wajib diisi.',
            'bidang_hukum.required'     => 'Bidang hukum wajib diisi.',
        ]);

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            $data['file_pdf'] = $request->file('file')->store('assets/perbupati', 'public');
        }

        Perbupati::create($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menambahkan Peraturan Bupati No. ' . $request->nomor,
            'type'        => 'success',
        ]);

        return redirect()->route('perbupati.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit(string $encryptedId)
    {
        $item = $this->findByEncryptedId($encryptedId);
        return view('admin.perbupati.edit', compact('item', 'encryptedId'));
    }

    public function update(Request $request, string $encryptedId)
    {
        $item = $this->findByEncryptedId($encryptedId);

        $request->validate([
            'nomor'            => 'required|unique:perbupatis,nomor,' . $item->id,
            'judul'            => 'required|min:5',
            'tahun'            => 'required|numeric',
            'status'           => 'required',
            'tempat_penetapan' => 'required',
            'tanggal'          => 'required|date',
            'sumber'           => 'required',
            'file_pdf'         => 'nullable|mimes:pdf|max:10000',
        ], [
            'nomor.required'            => 'Nomor wajib diisi.',
            'nomor.unique'              => 'Nomor sudah terdaftar di sistem.',
            'judul.required'            => 'Judul wajib diisi.',
            'judul.min'                 => 'Judul terlalu singkat (min. 5 karakter).',
            'tahun.required'            => 'Tahun wajib diisi.',
            'tahun.numeric'             => 'Tahun harus berupa angka.',
            'status.required'           => 'Pilih status peraturan.',
            'tempat_penetapan.required' => 'Tempat penetapan wajib diisi.',
            'tanggal.required'          => 'Tanggal wajib diisi.',
            'sumber.required'           => 'Sumber wajib diisi.',
            'file_pdf.mimes'            => 'Format file harus PDF.',
            'file_pdf.max'              => 'Ukuran file maksimal 10MB.',
        ]);

        $data = $request->except('file_pdf');

        if ($request->hasFile('file_pdf')) {
            if ($item->file_pdf && Storage::disk('public')->exists($item->file_pdf)) {
                Storage::disk('public')->delete($item->file_pdf);
            }
            $data['file_pdf'] = $request->file('file_pdf')->store('assets/perbupati', 'public');
        }

        $item->update($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Memperbarui Peraturan Bupati No. ' . $item->nomor,
            'type'        => 'info',
        ]);

        return redirect()->route('perbupati.index')->with('success', 'Data Perbupati berhasil diperbarui!');
    }

    public function destroy(string $encryptedId)
    {
        $item = $this->findByEncryptedId($encryptedId);

        if ($item->file_pdf) {
            Storage::disk('public')->delete($item->file_pdf);
        }

        $judulLama = $item->judul;
        $item->delete();

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menghapus Peraturan Bupati: ' . $judulLama,
            'type'        => 'danger',
        ]);

        return redirect()->route('perbupati.index')->with('success', 'Perbupati berhasil dihapus!');
    }

    /**
     * Halaman publik — tampilkan detail berdasarkan slug.
     * URL: /perbupati/{slug}
     */
    public function show(string $slug)
    {
        $item = Perbupati::where('slug', $slug)->firstOrFail();
        return view('perbupati.show', compact('item'));
    }

    // ─── Helper ─────────────────────────────────────────────────────────────

    private function findByEncryptedId(string $encryptedId): Perbupati
    {
        try {
            $id = Crypt::decrypt($encryptedId);
        } catch (DecryptException) {
            abort(404, 'Data tidak ditemukan.');
        }

        return Perbupati::findOrFail($id);
    }
}