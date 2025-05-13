<?php

namespace App\Models\TugasAkhir;

use App\Models\Mahasiswa;
use App\Models\PemeriksaanPengajuanTugasAkhir;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PengajuanTugasAkhir extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_tugas_akhir';

    protected $guarded = ['id'];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mahasiswa_id', 'id');
    }

    public function pemeriksaan(): HasMany
    {
        return $this->hasMany(PemeriksaanTugasAkhir::class, 'pengajuan_tugas_akhir_id', 'id');
    }

    public function hasil(): HasOne
    {
        return $this->hasOne(HasilPemeriksaanTa::class, 'pengajuan_tugas_akhir_id', 'id');
    }
}
