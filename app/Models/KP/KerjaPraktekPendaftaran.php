<?php

namespace App\Models\KP;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KerjaPraktekPendaftaran extends Model
{
    protected $table = 'kerja_praktek_pendaftarans';

    protected $guarded = ['id'];

    public function kerjaPraktek(): BelongsTo
    {
        return $this->belongsTo(KerjaPraktek::class, 'kerja_praktek_id');
    }

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }
}
