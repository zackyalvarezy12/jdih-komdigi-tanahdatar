<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class AnalisisEvaluasi extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'analisis_evaluasis';

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
     * Slug otomatis dibuat dari field 'judul'
     * Slug diperbarui otomatis jika judul berubah
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('judul')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(200);
    }

    /**
     * Mendapatkan encrypted ID untuk URL admin
     * Dipanggil dengan: $item->encrypted_id
     */
    public function getEncryptedIdAttribute(): string
    {
        return Crypt::encryptString($this->id);
    }
}