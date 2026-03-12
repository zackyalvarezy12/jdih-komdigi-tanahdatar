<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Berita extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'gambar',
        'tampilkan',
    ];

    /**
     * Konfigurasi Spatie Sluggable
     * Slug dibuat otomatis dari 'judul', disimpan ke kolom 'slug'
     * Jika judul berubah → slug ikut berubah otomatis
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('judul')
            ->saveSlugsTo('slug')
            ->usingSeparator('-');
    }

    /**
     * Route model binding untuk PUBLIC pakai slug
     * Contoh: /berita/peraturan-bupati-2025
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Helper: enkripsi ID untuk URL admin
     * Contoh pakai: $berita->encryptedId()
     */
    public function encryptedId(): string
    {
        return encrypt($this->id);
    }
}