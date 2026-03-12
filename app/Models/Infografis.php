<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Infografis extends Model
{
    protected $table = 'infografis';

    protected $fillable = [
        'judul',
        'slug',
        'file_infografis',
        'views',
    ];

    // =========================================================================
    // Auto-generate slug setiap kali creating & updating
    // =========================================================================
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = self::generateUniqueSlug($model->judul);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('judul')) {
                $model->slug = self::generateUniqueSlug($model->judul, $model->id);
            }
        });
    }

    // =========================================================================
    // Helper: buat slug unik
    // =========================================================================
    private static function generateUniqueSlug(string $judul, ?int $exceptId = null): string
    {
        $base = Str::slug($judul);
        $slug = $base;
        $i    = 1;

        while (
            self::where('slug', $slug)
                ->when($exceptId, fn($q) => $q->where('id', '!=', $exceptId))
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug ?: 'infografis-' . time();
    }
}