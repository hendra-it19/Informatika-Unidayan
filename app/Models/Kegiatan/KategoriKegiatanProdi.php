<?php

namespace App\Models\Kegiatan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriKegiatanProdi extends Model
{
    use HasFactory;

    protected $table = 'kategori_kegiatan_prodi';

    protected $fillable  = ['nama', 'user_id'];

    public function kegiatan(): HasMany
    {
        return $this->hasMany(KegiatanProdi::class, 'kategori_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
