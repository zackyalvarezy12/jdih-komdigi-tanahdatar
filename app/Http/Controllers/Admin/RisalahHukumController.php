<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RisalahHukum;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class RisalahHukumController extends Controller
{
    public function index()
    {
        $data = RisalahHukum::latest()->get();
        return view('admin.risalah_hukum.index', compact('data'));
    }

    public function create()
    {
        return view('admin.risalah_hukum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_dokumen'  => 'required|string|max:255',
            'judul'         => 'required|string|max:255',
            'teu_pengarang' => 'required|string|max:255',
            'tahun'         => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'file_pdf'      => 'required|mimes:pdf|max:10000',
        ], [
            'type_dokumen.required'  => 'Type dokumen wajib diisi.',
            'judul.required'         => 'Judul wajib diisi.',
            'teu_pengarang.required' => 'T.E.U pengarang/badan wajib diisi.',
            'tahun.required'         => 'Tahun wajib diisi.',
            'tahun.digits'           => 'Tahun harus terdiri dari 4 digit.',
            'tahun.integer'          => 'Tahun harus berupa angka.',
            'tahun.min'              => 'Tahun tidak valid.',
            'tahun.max'              => 'Tahun tidak boleh melebihi tahun ini.',
            'file_pdf.required'      => 'File PDF wajib diunggah.',
            'file_pdf.mimes'         => 'File harus berformat PDF.',
            'file_pdf.max'           => 'Ukuran file maksimal 10MB.',
        ]);

        $data = $request->all();

        // Generate slug unik dari judul
        $slug         = Str::slug($request->judul);
        $originalSlug = $slug;
        $count        = 1;
        while (RisalahHukum::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('file_pdf')) {
            $data['file_pdf'] = $request->file('file_pdf')->store('assets/risalah', 'public');
        }

        RisalahHukum::create($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menambahkan Risalah Hukum: ' . $request->judul,
            'type'        => 'success',
        ]);

        return redirect()->route('risalah-hukum.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Edit - menerima encryptedId dari URL admin
     */
    public function edit($encryptedId)
    {
        $id   = Crypt::decryptString($encryptedId);
        $item = RisalahHukum::findOrFail($id);

        return view('admin.risalah_hukum.edit', compact('item', 'encryptedId'));
    }

    /**
     * Update - menerima encryptedId dari URL admin
     */
    public function update(Request $request, $encryptedId)
    {
        $id   = Crypt::decryptString($encryptedId);
        $item = RisalahHukum::findOrFail($id);

        $request->validate([
            'type_dokumen'  => 'required|string|max:255',
            'judul'         => 'required|string|max:255',
            'teu_pengarang' => 'required|string|max:255',
            'tahun'         => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'file_pdf'      => 'nullable|mimes:pdf|max:10000',
        ], [
            'type_dokumen.required'  => 'Type dokumen wajib diisi.',
            'judul.required'         => 'Judul wajib diisi.',
            'teu_pengarang.required' => 'T.E.U pengarang/badan wajib diisi.',
            'tahun.required'         => 'Tahun wajib diisi.',
            'tahun.digits'           => 'Tahun harus terdiri dari 4 digit.',
            'tahun.integer'          => 'Tahun harus berupa angka.',
            'tahun.min'              => 'Tahun tidak valid.',
            'tahun.max'              => 'Tahun tidak boleh melebihi tahun ini.',
            'file_pdf.mimes'         => 'File harus berformat PDF.',
            'file_pdf.max'           => 'Ukuran file maksimal 10MB.',
        ]);

        $data = $request->all();

        // Update slug jika judul berubah, tetap pastikan unik
        $slug         = Str::slug($request->judul);
        $originalSlug = $slug;
        $count        = 1;
        while (RisalahHukum::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('file_pdf')) {
            if ($item->file_pdf) {
                Storage::disk('public')->delete($item->file_pdf);
            }
            $data['file_pdf'] = $request->file('file_pdf')->store('assets/risalah', 'public');
        }

        $item->update($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Memperbarui Risalah Hukum: ' . $item->judul,
            'type'        => 'info',
        ]);

        return redirect()->route('risalah-hukum.index')->with('success', 'Data Berhasil Diperbarui!');
    }

    /**
     * Destroy - menerima encryptedId dari URL admin
     */
    public function destroy($encryptedId)
    {
        $id   = Crypt::decryptString($encryptedId);
        $item = RisalahHukum::findOrFail($id);

        if ($item->file_pdf) {
            Storage::disk('public')->delete($item->file_pdf);
        }

        $judulLama = $item->judul;
        $item->delete();

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menghapus Risalah Hukum: ' . $judulLama,
            'type'        => 'danger',
        ]);

        return redirect()->route('risalah-hukum.index')->with('success', 'Data Berhasil Dihapus!');
    }

    /**
     * Show publik - menggunakan SLUG
     */
    public function show($slug)
    {
        $item = RisalahHukum::where('slug', $slug)->firstOrFail();

        return view('risalah_hukum.show', compact('item'));
    }
}