<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Alumni\Alumni;
use App\Models\Kegiatan\KategoriKegiatanProdi;
use App\Models\Kegiatan\KegiatanProdi;
use App\Models\Kp\KerjaPraktek;
use App\Models\Mbkm\KampusMerdeka;
use App\Models\Organisasi\Organisasi;
use App\Models\TugasAkhir\BimbinganTugasAkhir;
use App\Models\TugasAkhir\HasilPemeriksaanTa;
use App\Models\TugasAkhir\PemeriksaanTugasAkhir;
use App\Models\TugasAkhir\PengajuanTugasAkhir;
use App\Models\TugasAkhir\TugasAkhir;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'nama',
        'foto',
        'hp',
        'alamat',
        'is_verificator',
        'identitas'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hasRole($role)
    {
        foreach ($role as $r) {
            if ($this->role == $r) {
                return true;
            }
        }
        return false;
    }

    public function mahasiswa(): HasOne
    {
        return $this->hasOne(Mahasiswa::class, 'user_id');
    }

    public function alumni(): HasOne
    {
        return $this->hasOne(Alumni::class, 'user_id');
    }

    public function organisasi(): HasOne
    {
        return $this->hasOne(Organisasi::class, 'user_id');
    }



    // kegiatan prodi
    public function kegiatan_prodi(): HasMany
    {
        return $this->hasMany(KegiatanProdi::class, 'user_id');
    }
    public function kategori_kegiatan_prodi(): HasMany
    {
        return $this->hasMany(KategoriKegiatanProdi::class, 'user_id');
    }

    // ta
    public function ta_pengajuan(): HasMany
    {
        return $this->hasMany(PengajuanTugasAkhir::class, 'mahasiswa_id', 'id');
    }

    public function ta_verifikator(): HasMany
    {
        return $this->hasMany(PemeriksaanTugasAkhir::class, 'verifikator', 'id');
    }

    public function ta_mahasiswa(): HasMany
    {
        return $this->hasMany(TugasAkhir::class, 'mahasiswa_id', 'id');
    }
    public function ta_bimbingan(): HasMany
    {
        return $this->hasMany(BimbinganTugasAkhir::class, 'user_id', 'id');
    }
    public function ta_pembimbing_utama(): HasMany
    {
        return $this->hasMany(TugasAkhir::class, 'pembimbing_utama_id', 'id');
    }
    public function ta_pembimbing_pendamping(): HasMany
    {
        return $this->hasMany(TugasAkhir::class, 'pembimbing_pendamping_id', 'id');
    }

    public function hasil_pemeriksaan_ta(): HasMany
    {
        return $this->hasMany(HasilPemeriksaanTa::class, 'user_id', 'id');
    }


    // msib
    public function kp(): HasMany
    {
        return $this->hasMany(KerjaPraktek::class, 'mahasiswa_id', 'id');
    }
    public function msib(): HasMany
    {
        return $this->hasMany(KampusMerdeka::class, 'mahasiswa_id', 'id');
    }
}
