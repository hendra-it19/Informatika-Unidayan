<?php

namespace App\Models\TugasAkhir;

use App\Models\Dosen;
use App\Models\Kaprodi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PemeriksaanTugasAkhir extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan_tugas_akhir';

    protected $guarded = ['id'];

    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(PengajuanTugasAkhir::class, 'pengajuan_tugas_akhir_id', 'id');
    }

    public function getVerifikator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verifikator', 'id');
    }
}
