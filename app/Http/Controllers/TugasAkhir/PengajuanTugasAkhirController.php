<?php

namespace App\Http\Controllers\TugasAkhir;

use App\Http\Controllers\Controller;
use App\Models\TugasAkhir\PengajuanTugasAkhir;
use App\Models\TugasAkhir\TugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanTugasAkhirController extends Controller
{
    private $paginate = 10;

    public function index(Request $request)
    {
        $paginate = $this->paginate;
        $q = $request->keyword;
        if (empty($q)) {
            $s = PengajuanTugasAkhir::with('mahasiswa')
                ->where('mahasiswa_id', Auth::user()->id)
                ->orderBy('id', 'DESC');
            $data = $s->paginate($paginate);
            $jumlahData = $s->count();
        } else {
            $s =  PengajuanTugasAkhir::with('mahasiswa')->orderBy('id', 'DESC')
                ->where('mahasiswa_id', Auth::user()->id)
                ->orWhere('judul1', 'like', '%' . $request->keyword . '%')
                ->orWhere('judul2', 'like', '%' . $request->keyword . '%')
                ->orWhere('judul3', 'like', '%' . $request->keyword . '%');
            $data = $s->paginate($paginate);
            $jumlahData =  $s->count();
        }
        $p = $jumlahData > $paginate ? true : false;
        $status_tambah = PengajuanTugasAkhir::where('mahasiswa_id', Auth::user()->id)
            ->where('step', '<', 3)
            ->first();

        return view('dashboard.pengajuan-ta.index', [
            'judulHalaman' => 'Pengajuan TA',
            'data' => $data,
            'p' => $p,
            'q' =>  $q,
            'status_tambah' => $status_tambah
        ])->with('i', (request()->input('page', 1) - 1) * $this->paginate);
    }

    public function create()
    {
        $status_tambah = PengajuanTugasAkhir::where('mahasiswa_id', Auth::user()->id)
            ->where('step', '<', 3)
            ->first();
        if (!empty($status_tambah)) {
            return redirect()->back();
        }
        return view('dashboard.pengajuan-ta.create', [
            'judulHalaman' => 'Pengajuan TA',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_pertama' => ['required'],
            'abstrak_judul_pertama' => ['required'],
            'judul_kedua' => ['required'],
            'abstrak_judul_kedua' => ['required'],
            'judul_ketiga' => ['required'],
            'abstrak_judul_ketiga' => ['required'],
        ]);
        PengajuanTugasAkhir::create([
            'mahasiswa_id' => Auth::user()->id,
            'judul1' => $request->judul_pertama,
            'abstrak1' => $request->abstrak_judul_pertama,
            'judul2' => $request->judul_kedua,
            'abstrak2' => $request->abstrak_judul_kedua,
            'judul3' => $request->judul_ketiga,
            'abstrak3' => $request->abstrak_judul_ketiga,
        ]);
        notify()->success('Pengajuan judul berhasil!', 'Berhasil');
        return to_route('pengajuan-ta.index');
    }

    public function show($id)
    {
        $data = PengajuanTugasAkhir::with('pemeriksaan', 'hasil')->find($id);
        $ta = TugasAkhir::where('mahasiswa_id', Auth::user()->id)->first();
        return view('dashboard.pengajuan-ta.show', [
            'data' => $data,
            'pemeriksaan' => $data->pemeriksaan,
            'hasil' => $data->hasil,
            'judulHalaman' => 'Detail Pengajuan TA',
            'ta' => $ta,
        ]);
    }

    public function edit($id)
    {
        return view('dashboard.pengajuan-ta.edit', [
            'judulHalaman' => 'Edit Pengajuan TA',
            'data' => PengajuanTugasAkhir::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $pengajuanTugasAkhir = PengajuanTugasAkhir::find($id);
        $request->validate([
            'judul_pertama' => ['required'],
            'abstrak_judul_pertama' => ['required'],
            'judul_kedua' => ['required'],
            'abstrak_judul_kedua' => ['required'],
            'judul_ketiga' => ['required'],
            'abstrak_judul_ketiga' => ['required'],
        ]);
        $pengajuanTugasAkhir->update([
            'judul1' => $request->judul_pertama,
            'abstrak1' => $request->abstrak_judul_pertama,
            'judul2' => $request->judul_kedua,
            'abstrak2' => $request->abstrak_judul_kedua,
            'judul3' => $request->judul_ketiga,
            'abstrak3' => $request->abstrak_judul_ketiga,
        ]);
        notify()->success('Berhasil memperbarui data!', 'Berhasil');
        return to_route('pengajuan-ta.index');
    }
}
