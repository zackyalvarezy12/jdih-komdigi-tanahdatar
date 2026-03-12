<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeputusanBupati;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class KeputusanBupatiController extends Controller
{
    public function index()
    {
        $kepbupatis = KeputusanBupati::latest()->get();
        return view('admin.kepbupati.index', compact('kepbupatis'));
    }

    public function create()
    {
        return view('admin.kepbupati.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor'            => 'required|unique:keputusan_bupatis,nomor',
            'judul'            => 'required|min:5',
            'tahun'            => 'required|numeric',
            'status'           => 'required',
            'file'             => 'required|mimes:pdf|max:10000',
            'tempat_penetapan' => 'required',
            'tanggal'          => 'required|date',
            'sumber'           => 'required',
            'subjek'           => 'required',
            'bidang_hukum'     => 'required',
        ], [
            'nomor.required'            => 'Nomor Keputusan wajib diisi.',
            'nomor.unique'              => 'Nomor Keputusan sudah terdaftar.',
            'judul.required'            => 'Judul wajib diisi.',
            'judul.min'                 => 'Judul minimal 5 karakter.',
            'tahun.required'            => 'Tahun wajib diisi.',
            'tahun.numeric'             => 'Tahun harus berupa angka.',
            'status.required'           => 'Status wajib dipilih.',
            'file.required'             => 'File PDF wajib diunggah.',
            'file.mimes'                => 'File harus berformat PDF.',
            'file.max'                  => 'Ukuran file maksimal 10MB.',
            'tempat_penetapan.required' => 'Tempat Penetapan wajib diisi.',
            'tanggal.required'          => 'Tanggal wajib diisi.',
            'sumber.required'           => 'Sumber wajib diisi.',
            'subjek.required'           => 'Subjek wajib diisi.',
            'bidang_hukum.required'     => 'Bidang Hukum wajib diisi.',
        ]);

        $data = $request->except(['file', '_token']);

        if ($request->hasFile('file')) {
            $data['file_pdf'] = $request->file('file')->store('assets/kepbupati', 'public');
        }

        KeputusanBupati::create($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menambahkan Keputusan Bupati No. ' . $request->nomor,
            'type'        => 'success',
        ]);

        return redirect()->route('kepbupati.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit(string $encryptedId)
    {
        $kepbupati = $this->findByEncryptedId($encryptedId);
        return view('admin.kepbupati.edit', compact('kepbupati', 'encryptedId'));
    }

    public function update(Request $request, string $encryptedId)
    {
        $kepbupati = $this->findByEncryptedId($encryptedId);

        $request->validate([
            'nomor'            => 'required|unique:keputusan_bupatis,nomor,' . $kepbupati->id,
            'judul'            => 'required|min:5',
            'tahun'            => 'required|numeric',
            'status'           => 'required',
            'file'             => 'nullable|mimes:pdf|max:10000',
            'tempat_penetapan' => 'required',
            'tanggal'          => 'required|date',
            'sumber'           => 'required',
            'subjek'           => 'required',
            'bidang_hukum'     => 'required',
        ], [
            'nomor.required'            => 'Nomor Keputusan wajib diisi.',
            'nomor.unique'              => 'Nomor Keputusan sudah terdaftar.',
            'judul.required'            => 'Judul wajib diisi.',
            'judul.min'                 => 'Judul minimal 5 karakter.',
            'tahun.required'            => 'Tahun wajib diisi.',
            'tahun.numeric'             => 'Tahun harus berupa angka.',
            'status.required'           => 'Status wajib dipilih.',
            'file.mimes'                => 'File harus berformat PDF.',
            'file.max'                  => 'Ukuran file maksimal 10MB.',
            'tempat_penetapan.required' => 'Tempat Penetapan wajib diisi.',
            'tanggal.required'          => 'Tanggal wajib diisi.',
            'sumber.required'           => 'Sumber wajib diisi.',
            'subjek.required'           => 'Subjek wajib diisi.',
            'bidang_hukum.required'     => 'Bidang Hukum wajib diisi.',
        ]);

        $data = $request->except(['file', '_token', '_method']);

        if ($request->hasFile('file')) {
            if ($kepbupati->file_pdf && Storage::disk('public')->exists($kepbupati->file_pdf)) {
                Storage::disk('public')->delete($kepbupati->file_pdf);
            }
            $data['file_pdf'] = $request->file('file')->store('assets/kepbupati', 'public');
        }

        $kepbupati->update($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Memperbarui Keputusan Bupati No. ' . $kepbupati->nomor,
            'type'        => 'warning',
        ]);

        return redirect()->route('kepbupati.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $encryptedId)
    {
        $kepbupati = $this->findByEncryptedId($encryptedId);

        if ($kepbupati->file_pdf) {
            Storage::disk('public')->delete($kepbupati->file_pdf);
        }

        $nomorLama = $kepbupati->nomor;
        $kepbupati->delete();

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menghapus Keputusan Bupati No. ' . $nomorLama,
            'type'        => 'danger',
        ]);

        return redirect()->route('kepbupati.index')->with('success', 'Data berhasil dihapus!');
    }

    /**
     * Halaman publik — tampilkan detail berdasarkan slug.
     * URL: /kepbupati/{slug}
     */
    public function show(string $slug)
    {
        $kepbupati = KeputusanBupati::where('slug', $slug)->firstOrFail();
        return view('kepbupati.show', compact('kepbupati'));
    }

    // ─── Helper ─────────────────────────────────────────────────────────────

    private function findByEncryptedId(string $encryptedId): KeputusanBupati
    {
        try {
            $id = Crypt::decrypt($encryptedId);
        } catch (DecryptException) {
            abort(404, 'Data tidak ditemukan.');
        }

        return KeputusanBupati::findOrFail($id);
    }
}