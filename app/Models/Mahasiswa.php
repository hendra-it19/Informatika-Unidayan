<?php

namespace App\Models;

use App\Models\KerjaPraktek\KerjaPraktek as KerjaPraktekKerjaPraktek;
use App\Models\Kp\KerjaPraktek;
use App\Models\KP\KerjaPraktekPendaftaran;
use App\Models\TugasAkhir\PengajuanTugasAkhir;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pengajuan_tugas_akhir(): HasMany
    {
        return $this->hasMany(PengajuanTugasAkhir::class, 'mahasiswa_id', 'id');
    }

    public function kerjaPraktek(): BelongsToMany
    {
        return $this->belongsToMany(KerjaPraktek::class, 'kerja_praktek_mahasiswas');
    }

    public function laporanKerjaPraktek()
    {
        return $this->hasMany(KerjaPraktekLaporan::class, 'mahasiswa_id');
    }

    public function pendaftaranKerjaPraktek(): HasMany
    {
        return $this->hasMany(KerjaPraktekPendaftaran::class, 'mahasiswa_id', 'id');
    }
}
