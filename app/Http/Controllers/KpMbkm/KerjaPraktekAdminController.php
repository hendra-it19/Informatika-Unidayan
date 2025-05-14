<?php

namespace App\Http\Controllers\KpMbkm;

use App\Http\Controllers\Controller;
use App\Models\KP\KerjaPraktek;
use App\Models\KP\KerjaPraktekLaporan;
use App\Models\KP\KerjaPraktekMahasiswa;
use App\Models\KP\KerjaPraktekPendaftaran;
use App\Models\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KerjaPraktekAdminController extends Controller
{
    private $paginate = 10;

    public function index(Request $request)
    {
        $keyword = $request->keyword ?? '';
        $data = KerjaPraktek::with('kelompok', 'pendaftaran');
        if ($request->filled('keyword')) {
            $data = $data->where('mitra', 'LIKE', "%{$request->keyword}");
        }
        $data = $data->latest('id')->paginate($this->paginate);
        return view('dashboard.kerja-praktek-admin.index', [
            'judulHalaman' => 'Kerja Praktek',
            'data' => $data,
            'keyword' => $keyword
        ])->with('i', (request()->input('page', 1) - 1) * $this->paginate);
    }

    public function detail($id)
    {
        $data = KerjaPraktek::find($id);
        if (empty($data)) {
            return back();
        }
        $uncheck = KerjaPraktekPendaftaran::with('mahasiswa.user')
            ->where('kerja_praktek_id', $data->id)
            ->where('status', 'menunggu')
            ->latest('id')
            ->get();
        $check = KerjaPraktekPendaftaran::with('mahasiswa.user')
            ->where('kerja_praktek_id', $data->id)
            ->where('status', '!=', 'menunggu')
            ->latest('id')
            ->get();
        return view('dashboard.kerja-praktek-admin.detail', [
            'judulHalaman' => $data->mitra,
            'data' => $data,
            'uncheck' => $uncheck,
            'check' => $check
        ]);
    }

    public function terima($id)
    {
        $data = KerjaPraktekPendaftaran::find($id);
        if (empty($data)) {
            return back();
        }
        try {
            DB::beginTransaction();
            $data->update([
                'status' => 'diterima',
            ]);
            KerjaPraktekMahasiswa::create([
                'kerja_praktek_id' => $data->kerja_praktek_id,
                'mahasiswa_id' => $data->mahasiswa_id,
            ]);
            DB::commit();
            notify()->success('Berhasil konfirmasi pendaftaran', 'Berhasil!');
            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
            notify()->warning($th->getMessage(), 'Gagal!');
            return back();
        }
    }

    public function tolak(Request $request, $id)
    {
        $data = KerjaPraktekPendaftaran::find($id);
        if (empty($data)) {
            return back();
        }
        $request->validate([
            'catatan' => ['required', 'string'],
        ]);
        try {
            DB::beginTransaction();
            $data->update([
                'status' => 'ditolak',
                'catatan' => $request->catatan,
            ]);
            DB::commit();
            notify()->success('Berhasil konfirmasi penolakan pendaftaran', 'Berhasil!');
            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
            notify()->warning($th->getMessage(), 'Gagal!');
            return back();
        }
    }

    public function laporanMahasiswa($kp, $mhs)
    {
        $kerjaPraktek = KerjaPraktek::find($kp);
        $mahasiswa = Mahasiswa::with('user')->find($mhs);

        if (empty($kerjaPraktek) || empty($mahasiswa)) {
            return back();
        }

        $laporanTersimpan = KerjaPraktekLaporan::where('mahasiswa_id', $mahasiswa->id)
            ->where('kerja_praktek_id', $kerjaPraktek->id)
            ->get()
            ->keyBy(function ($item) {
                return Carbon::parse($item->tanggal)->toDateString();
            });

        $daftarTanggal = $this->generateTanggalLaporan(
            $kerjaPraktek->tanggal_mulai,
            $kerjaPraktek->tanggal_selesai
        );

        $tanggalSekarang = now()->toDateString();
        $tanggalLaporanAktif = null;
        $laporanStatus = [];
        $isiSekarang = null; // variabel baru

        foreach ($daftarTanggal as $tanggal) {
            $tglStr = $tanggal['tanggal']->toDateString();
            $terisi = $laporanTersimpan->has($tglStr);

            $isi_sekarang = !$terisi && !$tanggalLaporanAktif && $tglStr <= $tanggalSekarang;

            $laporanStatus[] = [
                'tanggal' => $tglStr,
                'jenis_laporan' => $tanggal['jenis_laporan'],
                'sudah_isi' => $terisi,
                'isi_sekarang' => $isi_sekarang,
                'laporan' => $terisi ? $laporanTersimpan[$tglStr] : null,
            ];

            if ($isi_sekarang) {
                $tanggalLaporanAktif = $tglStr;

                // Buat isiSekarang menyimpan detail tanggal yang aktif
                $isiSekarang = [
                    'tanggal' => $tglStr,
                    'jenis_laporan' => $tanggal['jenis_laporan'],
                ];
            }
        }

        return view('dashboard.kerja-praktek-admin.laporan', [
            'judulHalaman' => 'Laporan KP',
            'kerjaPraktek' => $kerjaPraktek,
            'mahasiswa' => $mahasiswa,
            'laporanStatus' => collect($laporanStatus)->sortByDesc('tanggal')->values()->all(),
            'isiSekarang' => $isiSekarang, // kirim ke view
        ]);
    }


    public function generateTanggalLaporan($mulai, $selesai)
    {
        $tanggalMulai = Carbon::parse($mulai);
        $tanggalSelesai = Carbon::parse($selesai);

        $daftar = [];

        while ($tanggalMulai->lte($tanggalSelesai)) {
            if ($tanggalMulai->isSunday()) {
                $daftar[] = [
                    'tanggal' => $tanggalMulai->copy(),
                    'jenis_laporan' => 'mingguan',
                ];
            } else {
                $daftar[] = [
                    'tanggal' => $tanggalMulai->copy(),
                    'jenis_laporan' => 'harian',
                ];
            }

            $tanggalMulai->addDay();
        }

        return collect($daftar)->sortBy('tanggal')->values()->all();
    }
}
