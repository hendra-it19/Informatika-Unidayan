<?php

namespace App\Http\Controllers;

use App\Models\Alumni\Alumni;
use App\Models\Kegiatan\KegiatanProdi;
use App\Models\Mahasiswa;
use App\Models\Organisasi\StrukturOrganisasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $paginate = 10;

        $daftarKepengurusan = null;

        $user = User::with('organisasi')->findOrFail(Auth::user()->id);

        if ($user->role == 'organisasi') {
            $organisasi = $user->organisasi;
            $daftarKepengurusan = StrukturOrganisasi::where('organisasi_id', $organisasi->id)->paginate($paginate);
        }

        return view('dashboard.main', [
            'judulHalaman' => 'Dashboard',
            'user' => User::count(),
            'alumni' => Alumni::count(),
            'kegiatanProdi' => KegiatanProdi::count(),
            'mahasiswa' => Mahasiswa::count(),
            'daftarKepengurusan' => $daftarKepengurusan
        ])->with('i', (request()->input('page', 1) - 1) * $paginate);
    }
}
