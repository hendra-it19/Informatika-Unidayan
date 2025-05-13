<?php

namespace App\Models;

use App\Models\KP\KerjaPraktek;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KerjaPraktekLaporan extends Model
{
    protected $table = 'kerja_praktek_laporans';

    protected $guarded = ['id'];

    public function kerjaPraktek(): BelongsTo
    {
        return $this->belongsTo(KerjaPraktek::class, 'kerja_praktek_id');
    }

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
