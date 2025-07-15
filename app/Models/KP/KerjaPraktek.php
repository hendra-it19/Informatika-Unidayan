<?php

namespace App\Models\KP;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KerjaPraktek extends Model
{
    protected $table = 'kerja_prakteks';

    protected $guarded = ['id'];

    public function kelompok(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'kerja_praktek_mahasiswas');
    }

    public function pendaftaran(): HasMany
    {
        return $this->hasMany(KerjaPraktekPendaftaran::class, 'kerja_praktek_id');
    }

    public function dosenPembimbing(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dosen_id', 'id');
    }
}
