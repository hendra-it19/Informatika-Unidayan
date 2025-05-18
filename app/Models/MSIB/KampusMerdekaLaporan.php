<?php

namespace App\Models\MSIB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KampusMerdekaLaporan extends Model
{
    protected $table = 'kampus_merdeka_laporans';

    protected $guarded = ['id'];

    public function kampusMerdeka(): BelongsTo
    {
        return $this->belongsTo(KampusMerdeka::class, 'kampus_merdeka_id');
    }
}
