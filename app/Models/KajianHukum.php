<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class KajianHukum extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = [];

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'gambar',
        'tanggal',
    ];

    /**
     * Konfigurasi slug otomatis dari field 'judul'.
     * Slug akan ikut berubah jika judul berubah.
     * Jika TIDAK ingin slug berubah saat edit, tambahkan: ->doNotGenerateSlugsOnUpdate()
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('judul')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(200);
    }

    /**
     * Route model binding menggunakan slug (untuk halaman publik)
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}