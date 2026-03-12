<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class RancanganPuu extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'rancangan_puus';

    protected $fillable = [
        'type_dokumen',
        'judul',
        'slug',
        'teu_pengarang',
        'tahun',
        'file_pdf',
        'views',
    ];

    /**
     * Slug otomatis dibuat dari field 'judul'.
     * Slug akan ikut berubah jika judul diedit.
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