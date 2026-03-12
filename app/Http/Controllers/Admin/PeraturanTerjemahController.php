<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PeraturanTerjemah;
use Illuminate\Support\Facades\Storage;

class PeraturanTerjemahController extends Controller
{
    public function index()
    {
        $data = PeraturanTerjemah::latest()->get();
        return view('admin.peraturan_terjemah.index', compact('data'));
    }

    public function create()
    {
        return view('admin.peraturan_terjemah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_dokumen' => 'required',
            'judul'        => 'required',
            'teu_pengarang'=> 'required',
            'tahun'        => 'required',
            'file_pdf'     => 'nullable|mimes:pdf|max:10000',
        ]);

        $data = $request->all();

        // ── Upload PDF ──────────────────────────────────────────────
        if ($request->hasFile('file_pdf')) {
            $data['file_pdf'] = $request->file('file_pdf')
                ->store('assets/peraturan-terjemah', 'public');
        }

        // ── Slug akan di-generate otomatis oleh Model boot() ────────
        // Tapi kalau ingin generate manual di sini juga bisa:
        // $data['slug'] = PeraturanTerjemah::generateUniqueSlug($data['judul']);

        PeraturanTerjemah::create($data);

        return redirect()->route('peraturan-terjemah.index')
            ->with('success', 'Data berhasil ditambah!');
    }

    public function edit($id)
    {
        $item = PeraturanTerjemah::findOrFail($id);
        return view('admin.peraturan_terjemah.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = PeraturanTerjemah::findOrFail($id);

        $request->validate([
            'type_dokumen' => 'required',
            'judul'        => 'required',
            'teu_pengarang'=> 'required',
            'tahun'        => 'required',
            'file_pdf'     => 'nullable|mimes:pdf|max:10000',
        ]);

        $data = $request->all();

        // ── Upload PDF baru, hapus yang lama ────────────────────────
        if ($request->hasFile('file_pdf')) {
            if ($item->file_pdf) {
                Storage::disk('public')->delete($item->file_pdf);
            }
            $data['file_pdf'] = $request->file('file_pdf')
                ->store('assets/peraturan-terjemah', 'public');
        }

        // ── Regenerate slug jika judul berubah ──────────────────────
        if ($item->judul !== $request->judul) {
            $data['slug'] = PeraturanTerjemah::generateUniqueSlug($request->judul, $item->id);
        }

        // ── Jika slug masih kosong (data lama), generate sekarang ───
        if (empty($item->slug)) {
            $data['slug'] = PeraturanTerjemah::generateUniqueSlug(
                $request->judul ?? $item->judul,
                $item->id
            );
        }

        $item->update($data);

        return redirect()->route('peraturan-terjemah.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = PeraturanTerjemah::findOrFail($id);
        if ($item->file_pdf) {
            Storage::disk('public')->delete($item->file_pdf);
        }
        $item->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    // ================================================================
    //  PUBLIK: Halaman Detail
    //  Route: GET /peraturan-terjemah/{slug}
    // ================================================================
    public function show($slug)
    {
        $item = PeraturanTerjemah::where('slug', $slug)->firstOrFail();

        // Increment views
        $item->increment('views');

        return view('peraturan-terjemah.show', compact('item'));
    }
}