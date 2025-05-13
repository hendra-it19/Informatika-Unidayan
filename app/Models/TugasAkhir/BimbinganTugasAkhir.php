<?php

namespace App\Models\TugasAkhir;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BimbinganTugasAkhir extends Model
{
    use HasFactory;

    protected $table = 'bimbingan_tugas_akhir';

    protected $guarded = ['id'];

    protected $with = ['user', 'tugas_akhir'];
    public function tugas_akhir(): BelongsTo
    {
        return $this->belongsTo(TugasAkhir::class, 'tugas_akhir_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
