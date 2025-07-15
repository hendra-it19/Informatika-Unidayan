<?php

namespace App\Http\Controllers\KpMbkm;

use App\Http\Controllers\Controller;
use App\Models\KP\KerjaPraktek;
use App\Models\KP\KerjaPraktekLaporan;
use App\Models\KP\KerjaPraktekPendaftaran;
use App\Models\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewLaporanKPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $paginate = 10;

    public function index(Request $request)
    {
        $keyword = $request->keyword ?? '';
        $data = KerjaPraktek::with('kelompok', 'pendaftaran')->where('dosen_id', Auth::user()->id);
        if ($request->filled('keyword')) {
            $data = $data->where('mitra', 'LIKE', "%{$request->keyword}%");
        }
        $data = $data->latest('id')->paginate($this->paginate);
        return view('dashboard.kerja-praktek-review.index', [
            'judulHalaman' => 'Kerja Praktek',
            'data' => $data,
            'keyword' => $keyword
        ])->with('i', (request()->input('page', 1) - 1) * $this->paginate);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = KerjaPraktek::find($id);
        if (empty($data)) {
            return back();
        }
        $pendaftaran = KerjaPraktekPendaftaran::with('mahasiswa.user')
            ->where('kerja_praktek_id', $data->id)
            ->latest('id')
            ->get();
        return view('dashboard.kerja-praktek-review.detail', [
            'judulHalaman' => $data->mitra,
            'data' => $data,
            'pendaftaran' => $pendaftaran,
        ]);
    }

    public function laporan(Request $request, $kp, $mahasiswa)
    {

        $r = $request->laporan;
        if (empty($request->laporan)) {
            $r = 'harian';
        }
        if (!in_array($r, ['harian', 'mingguan'])) {
            notify()->warning('Parameter laporan tidak valid!', 'Perhatian!');
            redirect()->back()->with('error', 'Parameter laporan tidak ditemukan!');
        }

        $kerjaPraktek = KerjaPraktek::find($kp);
        $mahasiswa = Mahasiswa::find($mahasiswa);
        if (empty($kerjaPraktek) || empty($mahasiswa)) {
            notify()->warning('Halaman tidak ditemukan!', 'Perhatian!');
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
                'week_count' => $tanggal['week_count'],
            ];

            if ($isi_sekarang) {
                $tanggalLaporanAktif = $tglStr;
            }
        }

        $laporanHarian = collect($laporanStatus)->where('jenis_laporan', 'harian')->sortByDesc('tanggal')->values()->all();
        $laporanMingguan = collect($laporanStatus)->where('jenis_laporan', 'mingguan')->sortByDesc('tanggal')->values()->all();

        $laporan = collect($laporanStatus)->sortByDesc('tanggal')->values()->all();

        return view('dashboard.kerja-praktek-review.laporan', [
            'judulHalaman' => 'Laporan KP',
            'kerjaPraktek' => $kerjaPraktek,
            'mahasiswa' => $mahasiswa,
            'laporan' => $r == 'harian' ? $laporanHarian : $laporanMingguan,
            'jenisLaporan' => $r,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = KerjaPraktekLaporan::find($id);
        if (empty($data)) {
            notify()->warning('Laporan tidak ditemukan!', 'Perhatian!');
            return back();
        }
        $data->update([
            'review_at' => now(),
        ]);
        notify()->success('Laporan berhasil direview!', 'Berhasil!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


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
