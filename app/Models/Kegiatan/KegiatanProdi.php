<?php

namespace App\Models\Kegiatan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class KegiatanProdi extends Model implements Viewable
{
    use HasFactory, InteractsWithViews, Sluggable;

    protected $table = 'kegiatan_prodi';

    protected $fillable = [
        'kategori_id',
        'user_id',
        'judul',
        'slug',
        'excerpt',
        'deskripsi',
        'foto',
        'hashtag'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriKegiatanProdi::class, 'kategori_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
