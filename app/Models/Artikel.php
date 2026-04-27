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

    protected $guarded = ['id'];

    protected $fillable = [
        'judul',
        'slug',
        'konten',        
        'jenis_artikel',
        'tempat_terbit',
        'tahun',
        'bahasa',
        'sumber',
        'bidang_hukum',
        'lokasi',
        'teu',
        'subjek',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('judul')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(200);
    }

    public function getPublicUrlAttribute(): string
    {
        return route('artikel.show', $this->slug);
    }

    public function getEncryptedIdAttribute(): string
    {
        return Crypt::encryptString($this->id);
    }
}