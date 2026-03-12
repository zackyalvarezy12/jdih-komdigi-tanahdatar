<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Artikel extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = [
        'id',
    ];
    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'gambar',
    ];
    /**
     * Konfigurasi slug otomatis dari field 'judul'
     * Slug akan diperbarui otomatis jika judul berubah
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('judul')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(200);
    }

    /**
     * Mendapatkan URL publik menggunakan slug
     */
    public function getPublicUrlAttribute(): string
    {
        return route('artikel.show', $this->slug);
    }

    /**
     * Mendapatkan encrypted ID untuk URL admin
     */
    public function getEncryptedIdAttribute(): string
    {
        return Crypt::encryptString($this->id);
    }
}