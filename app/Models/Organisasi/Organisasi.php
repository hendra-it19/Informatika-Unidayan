<?php

namespace App\Models\Organisasi;

use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Cviebrock\EloquentSluggable\Sluggable;

class Organisasi extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'organisasi';

    protected $fillable = [
        'foto',
        'logo',
        'slug',
        'nama_organisasi',
        'keterangan_tambahan',
        'can_upload',
        'user_id'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_organisasi'
            ]
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kegiatan(): HasMany
    {
        return $this->hasMany(KegiatanOrganisasi::class, 'organisasi_id', 'id');
    }

    public function struktural(): HasMany
    {
        return $this->hasMany(StrukturOrganisasi::class, 'organisasi_id', 'id');
    }
}
