<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KerjaSama;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class KerjaSamaController extends Controller
{
    public function index()
    {
        $kerjasamas = KerjaSama::latest()->get();
        return view('admin.kerjasama.index', compact('kerjasamas'));
    }

    public function create()
    {
        return view('admin.kerjasama.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor'            => 'required|unique:kerja_samas,nomor',
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
            'nomor.required'            => 'Nomor Kerja Sama wajib diisi.',
            'nomor.unique'              => 'Nomor Kerja Sama sudah terdaftar.',
            'judul.required'            => 'Judul Kerja Sama wajib diisi.',
            'judul.min'                 => 'Judul Kerja Sama minimal 5 karakter.',
            'tahun.required'            => 'Tahun wajib diisi.',
            'tahun.numeric'             => 'Tahun harus berupa angka.',
            'status.required'           => 'Status wajib dipilih.',
            'file.required'             => 'File PDF wajib diunggah.',
            'file.mimes'                => 'File harus berformat PDF.',
            'file.max'                  => 'Ukuran file maksimal 10MB.',
            'tempat_penetapan.required' => 'Tempat Penetapan wajib diisi.',
            'tanggal.required'          => 'Tanggal wajib diisi.',
            'tanggal.date'              => 'Format tanggal tidak valid.',
            'sumber.required'           => 'Sumber wajib diisi.',
            'subjek.required'           => 'Subjek wajib diisi.',
            'bahasa.required'           => 'Bahasa wajib diisi.',
            'lokasi.required'           => 'Lokasi wajib diisi.',
            'bidang_hukum.required'     => 'Bidang Hukum wajib diisi.',
        ]);

        $data = $request->except(['file', '_token']);

        if ($request->hasFile('file')) {
            $data['file_pdf'] = $request->file('file')->store('assets/kerjasama', 'public');
        }

        KerjaSama::create($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menambahkan Kerja Sama No. ' . $request->nomor,
            'type'        => 'success',
        ]);

        return redirect()->route('kerjasama.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit(string $encryptedId)
    {
        $kerjasama = $this->findByEncryptedId($encryptedId);
        return view('admin.kerjasama.edit', compact('kerjasama', 'encryptedId'));
    }

    public function update(Request $request, string $encryptedId)
    {
        $kerjasama = $this->findByEncryptedId($encryptedId);

        $request->validate([
            'nomor'            => 'required|unique:kerja_samas,nomor,' . $kerjasama->id,
            'judul'            => 'required|min:5',
            'tahun'            => 'required|numeric',
            'status'           => 'required',
            'file'             => 'nullable|mimes:pdf|max:10000',
            'tempat_penetapan' => 'required',
            'tanggal'          => 'required|date',
            'sumber'           => 'required',
            'subjek'           => 'required',
            'bahasa'           => 'required',
            'lokasi'           => 'required',
            'bidang_hukum'     => 'required',
        ], [
            'nomor.required'            => 'Nomor Kerja Sama wajib diisi.',
            'nomor.unique'              => 'Nomor Kerja Sama sudah terdaftar.',
            'judul.required'            => 'Judul Kerja Sama wajib diisi.',
            'judul.min'                 => 'Judul Kerja Sama minimal 5 karakter.',
            'tahun.required'            => 'Tahun wajib diisi.',
            'tahun.numeric'             => 'Tahun harus berupa angka.',
            'status.required'           => 'Status wajib dipilih.',
            'file.mimes'                => 'File harus berformat PDF.',
            'file.max'                  => 'Ukuran file maksimal 10MB.',
            'tempat_penetapan.required' => 'Tempat Penetapan wajib diisi.',
            'tanggal.required'          => 'Tanggal wajib diisi.',
            'tanggal.date'              => 'Format tanggal tidak valid.',
            'sumber.required'           => 'Sumber wajib diisi.',
            'subjek.required'           => 'Subjek wajib diisi.',
            'bahasa.required'           => 'Bahasa wajib diisi.',
            'lokasi.required'           => 'Lokasi wajib diisi.',
            'bidang_hukum.required'     => 'Bidang Hukum wajib diisi.',
        ]);

        $data = $request->except(['file', '_token', '_method']);

        if ($request->hasFile('file')) {
            if ($kerjasama->file_pdf && Storage::disk('public')->exists($kerjasama->file_pdf)) {
                Storage::disk('public')->delete($kerjasama->file_pdf);
            }
            $data['file_pdf'] = $request->file('file')->store('assets/kerjasama', 'public');
        }

        $kerjasama->update($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Memperbarui Kerja Sama No. ' . $kerjasama->nomor,
            'type'        => 'warning',
        ]);

        return redirect()->route('kerjasama.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $encryptedId)
    {
        $kerjasama = $this->findByEncryptedId($encryptedId);

        if ($kerjasama->file_pdf) {
            Storage::disk('public')->delete($kerjasama->file_pdf);
        }

        $nomorLama = $kerjasama->nomor;
        $kerjasama->delete();

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menghapus Kerja Sama No. ' . $nomorLama,
            'type'        => 'danger',
        ]);

        return redirect()->route('kerjasama.index')->with('success', 'Data berhasil dihapus!');
    }

    /**
     * Halaman publik — tampilkan detail berdasarkan slug.
     * URL: /kerjasama/{slug}
     */
    public function show(string $slug)
    {
        $kerjasama = KerjaSama::where('slug', $slug)->firstOrFail();
        return view('kerjasama.show', compact('kerjasama'));
    }

    // ─── Helper ─────────────────────────────────────────────────────────────

    private function findByEncryptedId(string $encryptedId): KerjaSama
    {
        try {
            $id = Crypt::decrypt($encryptedId);
        } catch (DecryptException) {
            abort(404, 'Data tidak ditemukan.');
        }

        return KerjaSama::findOrFail($id);
    }
}