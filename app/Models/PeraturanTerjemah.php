<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PeraturanTerjemah extends Model
{
    use HasFactory;

    protected $table = 'peraturan_terjemahs';

    protected $fillable = [
        'type_dokumen',
        'judul',
        'slug',        
        'teu_pengarang',
        'tahun',
        'file_pdf',
        'views',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->judul);
            }
        });

        static::updating(function ($model) {
            // Regenerate slug jika judul berubah DAN slug masih kosong/null
            if ($model->isDirty('judul') && empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->judul, $model->id);
            }
        });
    }

    /**
     * Generate slug unik 
     */
    public static function generateUniqueSlug(string $judul, ?int $ignoreId = null): string
    {
        $base = Str::slug($judul);
        $slug = $base;
        $counter = 2;

        while (true) {
            $query = static::where('slug', $slug);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
            if (!$query->exists()) {
                break;
            }
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }

    /**
     * Accessor: URL publik ke halaman detail.
     */
    public function getUrlAttribute(): string
    {
        return url('/peraturan-terjemah/' . $this->slug);
    }
}