<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Perda extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'nomor', 'judul', 'slug', 'tahun', 'keterangan', 'status', 'file_pdf',
        'tempat_penetapan', 'tanggal', 'sumber', 'subjek', 'bahasa', 'lokasi', 'bidang_hukum'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('judul')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(200);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}