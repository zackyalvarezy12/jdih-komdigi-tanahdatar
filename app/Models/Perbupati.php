<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Perbupati extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'perbupatis';

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal' => 'date',
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