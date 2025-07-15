<?php

namespace App\Http\Controllers\KpMbkm;

use App\Http\Controllers\Controller;
use App\Models\KP\KerjaPraktek;
use App\Models\KP\KerjaPraktekLaporan;
use App\Models\KP\KerjaPraktekMahasiswa;
use App\Models\KP\KerjaPraktekPendaftaran;
use App\Models\Mahasiswa;
use App\Models\User;
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
        $data = KerjaPraktek::with('kelompok', 'pendaftaran', 'dosenPembimbing');
        if ($request->filled('keyword')) {
            $data = $data->where('mitra', 'LIKE', "%{$request->keyword}%")
                ->orWhereHas('dosenPembimbing', function ($query) use ($keyword) {
                    $query->where('nama', 'LIKE', "%{$keyword}%")
                        ->orWhere('identitas', 'LIKE', "%{$keyword}%");
                });
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
            'check' => $check,
            'dosen' => User::where('role', 'dosen')->get(),
        ]);
    }

    public function updatePembimbing(Request $request, $id)
    {
        $data = KerjaPraktek::find($id);
        if (empty($data)) {
            return back();
        }
        $request->validate([
            'dosen_pembimbing' => ['required', 'exists:users,id'],
        ]);
        try {
            DB::beginTransaction();
            $data->update([
                'dosen_id' => $request->dosen_pembimbing,
            ]);
            DB::commit();
            notify()->success('Berhasil mengubah pembimbing', 'Berhasil!');
            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
            return dd($th->getMessage());
            notify()->warning($th->getMessage(), 'Gagal!');
            return back();
        }
    }

    public function terima($id)
    {
        $data = KerjaPraktekPendaftaran::with('kerjaPraktek')->find($id);
        if (empty($data->kerjaPraktek->dosen_id)) {
            notify()->warning('Pembimbing belum diisi!', 'Perhatian!');
            return back();
        }

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

    public function laporanMahasiswa(Request $request, $kp, $mhs)
    {
        $r = $request->laporan;
        if (!filled($r)) {
            $r = 'harian'; // Default to 'harian' if not provided
        }
        if (!filled($r) | $r != 'harian' && $r != 'mingguan') {
            notify()->warning('Parameter laporan tidak valid!', 'Perhatian!');
            redirect()->back()->with('error', 'Parameter laporan tidak ditemukan!');
        }

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

        $laporanHarian = collect($laporanStatus)->where('jenis_laporan', 'harian')->sortByDesc('tanggal')->values()->all();
        $laporanMingguan = collect($laporanStatus)->where('jenis_laporan', 'mingguan')->sortByDesc('tanggal')->values()->all();

        return view('dashboard.kerja-praktek-admin.laporan', [
            'judulHalaman' => 'Laporan KP',
            'kerjaPraktek' => $kerjaPraktek,
            'mahasiswa' => $mahasiswa,
            'laporanStatus' => $r == 'harian' ? $laporanHarian : $laporanMingguan,
            'laporan' => $r == 'harian' ? 'Harian' : 'Mingguan',
            'isiSekarang' => $isiSekarang, // kirim ke view
        ]);
    }

    // public function update(Request $request, string $id)
    // {
    //     $data = KerjaPraktekLaporan::find($id);
    //     if (empty($data)) {
    //         notify()->warning('Laporan tidak ditemukan!', 'Perhatian!');
    //         return back();
    //     }
    //     $data->update([
    //         'review_at' => now(),
    //     ]);
    //     notify()->success('Laporan berhasil direview!', 'Berhasil!');
    //     return back();
    // }

    public function generateTanggalLaporan($mulai, $selesai)
    {
        $tanggalMulai = Carbon::parse($mulai);
        $tanggalSelesai = Carbon::parse($selesai);

        $weekCount = 1;

        $daftar = [];

        while ($tanggalMulai->lte($tanggalSelesai)) {
            if ($tanggalMulai->isSunday()) {
                $daftar[] = [
                    'tanggal' => $tanggalMulai->copy(),
                    'jenis_laporan' => 'mingguan',
                    'week_count' => $weekCount,
                ];
                $weekCount++;
            } else {
                $daftar[] = [
                    'tanggal' => $tanggalMulai->copy(),
                    'jenis_laporan' => 'harian',
                    'week_count' => $weekCount,
                ];
            }
            $tanggalMulai->addDay();
        }
        $daftar = collect($daftar)->sortBy('tanggal')->values()->all();
        $cek = collect($daftar)->sortByDesc('tanggal')->first();
        $cek_tgl = Carbon::parse($cek['tanggal']);
        if ($cek_tgl->dayOfWeek() > 2) {
            $daftar[] = [
                'tanggal' => $cek_tgl->addDay(),
                'jenis_laporan' => 'mingguan',
                'week_count' => $cek['week_count'],
            ];
        }
        return $daftar;
    }
}
