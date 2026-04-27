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
        'type_dokumen',
        'judul',
        'slug',
        'teu_pengarang',
        'tahun',
        'file_pdf',
        'views',
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