<?php

namespace App\Models\MSIB;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KampusMerdeka extends Model
{
    protected $table = 'kampus_merdekas';

    protected $guarded = ['id'];

    public function laporan(): HasMany
    {
        return $this->hasMany(KampusMerdekaLaporan::class, 'kampus_merdeka_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
