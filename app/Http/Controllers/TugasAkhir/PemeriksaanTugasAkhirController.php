<?php

namespace App\Http\Controllers\TugasAkhir;

use App\Http\Controllers\Controller;
use App\Models\TugasAkhir\HasilPemeriksaanTa;
use App\Models\TugasAkhir\PemeriksaanTugasAkhir;
use App\Models\TugasAkhir\PengajuanTugasAkhir;
use App\Models\TugasAkhir\TugasAkhir;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemeriksaanTugasAkhirController extends Controller
{

    private $paginate = 10;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $this->paginate;
        $q = $request->keyword;
        if (empty($q)) {
            $s = PengajuanTugasAkhir::with('mahasiswa')->orderBy('id', 'DESC');
            $data = $s->paginate($paginate);
            $jumlahData = $s->count();
        } else {
            $s =  PengajuanTugasAkhir::with('mahasiswa')->orderBy('id', 'DESC')
                ->whereHas('mahasiswa', function ($query) use ($q) {
                    $query->where('nama', 'LIKE', '%' . $q . '%')
                        ->orWhere('identitas', 'LIKE', '%' . $q . '%');
                })
                ->orWhere('judul1', 'like', '%' . $request->keyword . '%')
                ->orWhere('judul2', 'like', '%' . $request->keyword . '%')
                ->orWhere('judul3', 'like', '%' . $request->keyword . '%');
            $data = $s->paginate($paginate);
            $jumlahData =  $s->count();
        }
        $p = $jumlahData > $paginate ? true : false;

        return view('dashboard.pemeriksaan-ta.index', [
            'judulHalaman' => 'Pemeriksaan TA',
            'data' => $data,
            'p' => $p,
            'q' =>  $q,
        ])->with('i', (request()->input('page', 1) - 1) * $this->paginate);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pengajuan_tugas_akhir_id' => ['exists:pengajuan_tugas_akhir,id'],
            'status_judul_pertama' => ['required', 'in:terima,revisi,tolak'],
            'keterangan_judul_pertama' => ['required'],
            'status_judul_kedua' => ['required', 'in:terima,revisi,tolak'],
            'keterangan_judul_kedua' => ['required'],
            'status_judul_ketiga' => ['required', 'in:terima,revisi,tolak'],
            'keterangan_judul_ketiga' => ['required'],
        ]);
        PemeriksaanTugasAkhir::create([
            'pengajuan_tugas_akhir_id' => $request->pengajuan_tugas_akhir_id,
            'verifikator' => Auth::user()->id,
            'status1' => $request->status_judul_pertama,
            'pesan1' => $request->keterangan_judul_pertama,
            'status2' => $request->status_judul_kedua,
            'pesan2' => $request->keterangan_judul_kedua,
            'status3' => $request->status_judul_ketiga,
            'pesan3' => $request->keterangan_judul_ketiga,
        ]);
        $pengajuan = PengajuanTugasAkhir::find($request->pengajuan_tugas_akhir_id);
        $pengajuan->update([
            'step' => 1,
        ]);
        $pemeriksaan = PemeriksaanTugasAkhir::where('pengajuan_tugas_akhir_id', $pengajuan->id);
        if ($pemeriksaan->count() >= 5) {
            $listPemeriksaan = $pemeriksaan->get();
            $status1 = 0;
            $status2 = 0;
            $status3 = 0;
            foreach ($listPemeriksaan as $row) {
                if ($row->status1 == 'terima') {
                    $status1++;
                } else if ($row->status2 == 'terima') {
                    $status2++;
                } else if ($row->status3 == 'terima') {
                    $status3++;
                }
            }
            if ($status1 >= 3) {
                $pengajuan->update([
                    'step' => 2,
                ]);
                TugasAkhir::create([
                    'mahasiswa_id' => $pengajuan->mahasiswa_id,
                    'judul' => $pengajuan->judul1,
                    'abstrak' => $pengajuan->abstrak1,
                ]);
            } else if ($status2 >= 3) {
                $pengajuan->update([
                    'step' => 2,
                ]);
                TugasAkhir::create([
                    'mahasiswa_id' => $pengajuan->mahasiswa_id,
                    'judul' => $pengajuan->judul2,
                    'abstrak' => $pengajuan->abstrak2,
                ]);
            } else if ($status3 >= 3) {
                $pengajuan->update([
                    'step' => 2,
                ]);
                TugasAkhir::create([
                    'mahasiswa_id' => $pengajuan->mahasiswa_id,
                    'judul' => $pengajuan->judul3,
                    'abstrak' => $pengajuan->abstrak3,
                ]);
            } else {
                $pengajuan->update([
                    'step' => 3,
                ]);
            }
        }

        notify()->success('Pemeriksaan berhasil dimasukkan!', 'Berhasil');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = PengajuanTugasAkhir::with('mahasiswa', 'hasil', 'pemeriksaan', 'pemeriksaan.getVerifikator')->find($id);
        $mahasiswa = $data->mahasiswa;
        $pemeriksaan = $data->pemeriksaan;
        $hasil = $data->hasil;
        $cekPemeriksaan = PemeriksaanTugasAkhir::where('pengajuan_tugas_akhir_id', $id)
            ->where('verifikator', Auth::user()->id)
            ->first();
        $ta = TugasAkhir::where('mahasiswa_id', $mahasiswa->id)->first();
        return view('dashboard.pemeriksaan-ta.show', [
            'judulHalaman' => 'Pemeriksaan TA',
            'data' => $data,
            'id' => $id,
            'mahasiswa' => $mahasiswa,
            'pemeriksaan' => $pemeriksaan,
            'cekPemeriksaanButton' => $cekPemeriksaan,
            'hasil' => $hasil,
            'ta' => $ta
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PemeriksaanTugasAkhir $pemeriksaanTugasAkhir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PemeriksaanTugasAkhir $pemeriksaanTugasAkhir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PemeriksaanTugasAkhir $pemeriksaanTugasAkhir)
    {
        //
    }

    public function tolak(Request $request)
    {
        $pengajuan = PengajuanTugasAkhir::find($request->pengajuan_id);
        $pengajuan->update(['step' => 3]);
        HasilPemeriksaanTa::create([
            'pengajuan_tugas_akhir_id' => $request->pengajuan_id,
            'user_id' => Auth::user()->id,
            'status' => 'tolak',
            'pesan' => $request->keterangan_tambahan,
        ]);
        notify('Pengajuan judul ditolak', 'Berhasil!');
        return to_route('pemeriksaan-ta.index');
    }

    public function terima(Request $request)
    {
        if ($request->pembimbing_utama == $request->pembimbing_pendamping) {
            notify()->warning('Harap pilih dosen yang berbeda untuk pembimbing utama dan pendamping!', 'Perhatian');
            return redirect()->back();
        }
        $pengajuan = PengajuanTugasAkhir::find($request->pengajuan_id);
        $pengajuan->update(['step' => 2]);
        HasilPemeriksaanTa::create([
            'pengajuan_tugas_akhir_id' => $request->pengajuan_id,
            'user_id' => Auth::user()->id,
            'status' => 'terima',
            'pesan' => $request->keterangan_tambahan,
        ]);
        TugasAkhir::create([
            'mahasiswa_id' =>  $request->mahasiswa_id,
            'pembimbing_utama_id' => $request->pembimbing_utama,
            'pembimbing_pendamping_id' => $request->pembimbing_pendamping,
            'judul' => $request->judul,
        ]);
        notify('Pengajuan judul telah diterima', 'Berhasil!');
        return to_route('pemeriksaan-ta.index');
    }
}
