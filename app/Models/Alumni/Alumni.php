<?php

namespace App\Models\Alumni;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    protected $fillable = ['user_id', 'nama', 'nim', 'tempat_lahir', 'tanggal_lahir', 'tahun_masuk', 'status_masuk', 'tahun_lulus', 'ipk', 'foto', 'hp', 'email', 'alamat', 'status', 'detail_status'];

    public function karir(): HasMany
    {
        return $this->hasMany(KarirAlumni::class, 'alumni_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
