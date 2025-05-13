<?php

namespace App\Models\Alumni;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KarirAlumni extends Model
{
    use HasFactory;

    protected $table = 'karir_alumni';

    protected $guarded = ['id'];

    public function alumni(): BelongsTo
    {
        return $this->belongsTo(Alumni::class, 'alumni_id', 'id');
    }
}
