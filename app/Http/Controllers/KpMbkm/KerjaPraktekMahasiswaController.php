<?php

namespace App\Http\Controllers\KpMbkm;

use App\Http\Controllers\Controller;
use App\Models\KP\KerjaPraktek;
use App\Models\KP\KerjaPraktekPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KerjaPraktekMahasiswaController extends Controller
{
    public function index()
    {
        $data = KerjaPraktekPendaftaran::with('kerjaPraktek')
            ->where('mahasiswa_id', Auth::user()->mahasiswa->id);
        $cekPendaftaran = $data->where('status', 'menunggu')->orWhere('status', 'diterima')->first();
        $dataPendaftaran = $data->latest('id')->get();
        return view('dashboard.kerja-praktek-mahasiswa.index', [
            'judulHalaman' => 'Kerja Praktek',
            'data' => $dataPendaftaran,
            'cekPendaftaran' => empty($cekPendaftaran) ? true : false,
        ]);
    }

    public function daftar()
    {
        return 'daftar';
    }
}
