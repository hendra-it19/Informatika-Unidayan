<?php

namespace App\Models\TugasAkhir;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TugasAkhir extends Model
{
    use HasFactory;

    protected $table = 'tugas_akhir';

    protected $guarded = ['id'];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mahasiswa_id', 'id');
    }
    public function pembimbing_utama(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pembimbing_utama_id', 'id');
    }
    public function pembimbing_pendamping(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pembimbing_pendamping_id', 'id');
    }

    public function bimbingan(): HasMany
    {
        return $this->hasMany(BimbinganTugasAkhir::class, 'tugas_akhir_id', 'id');
    }
}
