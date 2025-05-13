<?php

namespace App\Models\Organisasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StrukturOrganisasi extends Model
{
    use HasFactory;

    protected $table = 'struktur_organisasi';

    protected $fillable = [
        'organisasi_id',
        'awal_jabatan',
        'akhir_jabatan',
        'sk',
        'ketua',
        'wakil',
        'sekretaris',
        'bendahara',
    ];

    public function organisasi(): BelongsTo
    {
        return $this->belongsTo(Organisasi::class, 'organisasi_id', 'id');
    }
}
