<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Buku extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'bukus';

    protected $fillable = [
        'judul',
        'slug',
        'rak',
        'baris',
        'penulis',
        'cover',
        'penerbit',
        'edisi',
        'bidang_hukum',
        'isbn',
        'tahun_terbit',
        'deskripsi_fisik',
        'jenis_monografi',
        'nomor_panggil',
    ];

    /**
     * Konfigurasi slug: otomatis dibuat dari field 'judul', unik,
     * dan akan diperbarui jika judul berubah.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('judul')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate() // Jika ingin slug tidak berubah saat edit, hapus baris ini
            ->slugsShouldBeNoLongerThan(200);
    }

    /**
     * Route model binding publik menggunakan slug.
     * Digunakan untuk URL publik: /buku/{slug}
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}