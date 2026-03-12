<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Relaas;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class RelaasController extends Controller
{
    public function index()
    {
        $relaas = Relaas::latest()->get();
        return view('admin.relaas.index', compact('relaas'));
    }

    public function create()
    {
        return view('admin.relaas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor'             => 'required|string|max:255',
            'tanggal'           => 'required|date',
            'pengumuman'        => 'required|string',
            'file_pdf'          => 'required|mimes:pdf|max:5120',
            'jenis_putusan'     => 'required|string|max:255',
            'jenis_peradilan'   => 'required|string|max:255',
            'status_putusan'    => 'required|string|max:255',
            'bahasa'            => 'required|string|max:100',
            'bidang_hukum'      => 'required|string|max:255',
            'tempat_peradilan'  => 'required|string|max:255',
            'tanggal_dibacakan' => 'required|date',
            'subjek'            => 'required|string|max:255',
        ], [
            'nomor.required'             => 'Nomor wajib diisi.',
            'tanggal.required'           => 'Tanggal wajib diisi.',
            'tanggal.date'               => 'Format tanggal tidak valid.',
            'pengumuman.required'        => 'Pengumuman wajib diisi.',
            'file_pdf.required'          => 'File PDF wajib diunggah.',
            'file_pdf.mimes'             => 'File harus berformat PDF.',
            'file_pdf.max'               => 'Ukuran file maksimal 5MB.',
            'jenis_putusan.required'     => 'Jenis putusan wajib diisi.',
            'jenis_peradilan.required'   => 'Jenis peradilan wajib diisi.',
            'status_putusan.required'    => 'Status putusan wajib diisi.',
            'bahasa.required'            => 'Bahasa wajib diisi.',
            'bidang_hukum.required'      => 'Bidang hukum / jenis perkara wajib diisi.',
            'tempat_peradilan.required'  => 'Tempat peradilan wajib diisi.',
            'tanggal_dibacakan.required' => 'Tanggal dibacakan wajib diisi.',
            'tanggal_dibacakan.date'     => 'Format tanggal dibacakan tidak valid.',
            'subjek.required'            => 'Subjek wajib diisi.',
        ]);

        $data = $request->all();

        // Generate slug unik dari nomor
        $slug         = Str::slug($request->nomor);
        $originalSlug = $slug;
        $count        = 1;
        while (Relaas::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('file_pdf')) {
            $data['file_pdf'] = $request->file('file_pdf')->store('assets/relaas', 'public');
        }

        Relaas::create($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menambahkan Relaas Nomor: ' . $request->nomor,
            'type'        => 'success',
        ]);

        return redirect()->route('relaas.index')->with('success', 'Data Relaas Berhasil Ditambahkan!');
    }

    /**
     * Edit - menerima encryptedId dari URL admin
     */
    public function edit($encryptedId)
    {
        $id     = Crypt::decryptString($encryptedId);
        $relaas = Relaas::findOrFail($id);

        return view('admin.relaas.edit', compact('relaas', 'encryptedId'));
    }

    /**
     * Update - menerima encryptedId dari URL admin
     */
    public function update(Request $request, $encryptedId)
    {
        $id     = Crypt::decryptString($encryptedId);
        $relaas = Relaas::findOrFail($id);

        $request->validate([
            'nomor'             => 'required|string|max:255',
            'tanggal'           => 'required|date',
            'pengumuman'        => 'required|string',
            'file_pdf'          => 'nullable|mimes:pdf|max:5120',
            'jenis_putusan'     => 'required|string|max:255',
            'jenis_peradilan'   => 'required|string|max:255',
            'status_putusan'    => 'required|string|max:255',
            'bahasa'            => 'required|string|max:100',
            'bidang_hukum'      => 'required|string|max:255',
            'tempat_peradilan'  => 'required|string|max:255',
            'tanggal_dibacakan' => 'required|date',
            'subjek'            => 'required|string|max:255',
        ], [
            'nomor.required'             => 'Nomor wajib diisi.',
            'tanggal.required'           => 'Tanggal wajib diisi.',
            'tanggal.date'               => 'Format tanggal tidak valid.',
            'pengumuman.required'        => 'Pengumuman wajib diisi.',
            'file_pdf.mimes'             => 'File harus berformat PDF.',
            'file_pdf.max'               => 'Ukuran file maksimal 5MB.',
            'jenis_putusan.required'     => 'Jenis putusan wajib diisi.',
            'jenis_peradilan.required'   => 'Jenis peradilan wajib diisi.',
            'status_putusan.required'    => 'Status putusan wajib diisi.',
            'bahasa.required'            => 'Bahasa wajib diisi.',
            'bidang_hukum.required'      => 'Bidang hukum / jenis perkara wajib diisi.',
            'tempat_peradilan.required'  => 'Tempat peradilan wajib diisi.',
            'tanggal_dibacakan.required' => 'Tanggal dibacakan wajib diisi.',
            'tanggal_dibacakan.date'     => 'Format tanggal dibacakan tidak valid.',
            'subjek.required'            => 'Subjek wajib diisi.',
        ]);

        $data = $request->all();

        // Update slug jika nomor berubah, tetap pastikan unik
        $slug         = Str::slug($request->nomor);
        $originalSlug = $slug;
        $count        = 1;
        while (Relaas::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('file_pdf')) {
            if ($relaas->file_pdf) {
                Storage::disk('public')->delete($relaas->file_pdf);
            }
            $data['file_pdf'] = $request->file('file_pdf')->store('assets/relaas', 'public');
        }

        $relaas->update($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Memperbarui Relaas Nomor: ' . $relaas->nomor,
            'type'        => 'info',
        ]);

        return redirect()->route('relaas.index')->with('success', 'Data Relaas Berhasil Diperbarui!');
    }

    /**
     * Destroy - menerima encryptedId dari URL admin
     */
    public function destroy($encryptedId)
    {
        $id     = Crypt::decryptString($encryptedId);
        $relaas = Relaas::findOrFail($id);

        if ($relaas->file_pdf) {
            Storage::disk('public')->delete($relaas->file_pdf);
        }

        $nomorLama = $relaas->nomor;
        $relaas->delete();

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menghapus Relaas Nomor: ' . $nomorLama,
            'type'        => 'danger',
        ]);

        return redirect()->route('relaas.index')->with('success', 'Data Relaas Berhasil Dihapus!');
    }

    /**
     * Show publik - menggunakan SLUG
     */
    public function show($slug)
    {
        $relaas = Relaas::where('slug', $slug)->firstOrFail();

        return view('relaas.show', compact('relaas'));
    }
}