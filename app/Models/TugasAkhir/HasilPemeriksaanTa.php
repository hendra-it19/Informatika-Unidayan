<?php

namespace App\Models\TugasAkhir;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilPemeriksaanTa extends Model
{
    use HasFactory;

    protected $table = 'hasil_pemeriksaan_ta';

    protected $guarded = ['id'];

    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(PengajuanTugasAkhir::class, 'pengajuan_tugas_akhir_id', 'id');
    }

    public function pemeriksa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
