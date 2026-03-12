<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Relaas extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'relaas';

    protected $fillable = [
        'nomor',
        'slug',
        'tanggal',
        'pengumuman',
        'file_pdf',
        'jenis_putusan',
        'jenis_peradilan',
        'singkatan_jenis_peradilan',
        'status_putusan',
        'bahasa',
        'sumber',
        'bidang_hukum',
        'tempat_peradilan',
        'amar',
        'tanggal_dibacakan',
        'teu_badan',
        'subjek',
        'lampiran',
    ];

    /**
     * Slug otomatis dibuat dari field 'nomor'
     * Slug diperbarui otomatis jika nomor berubah
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nomor')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(200);
    }

    /**
     * Mendapatkan encrypted ID untuk URL admin
     * Dipanggil dengan: $relaas->encrypted_id
     */
    public function getEncryptedIdAttribute(): string
    {
        return Crypt::encryptString($this->id);
    }
}