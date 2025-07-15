<?php

namespace App\Http\Controllers\KpMbkm;

use App\Http\Controllers\Controller;
use App\Models\MSIB\KampusMerdeka;
use App\Models\MSIB\KampusMerdekaLaporan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ReviewLaporanMsibController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $paginate = 10;

    public function index(Request $request)
    {
        $keyword = $request->keyword ?? '';
        $data = KampusMerdeka::with('user', 'user.mahasiswa')->where('dosen_id', Auth::user()->id);
        if ($request->filled('keyword')) {
            $data = $data->where('mitra', 'LIKE', "%{$request->keyword}%")
                ->whereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%")
                        ->orWhere('identitas', 'LIKE', "%{$keyword}%");
                });
        }
        $data = $data->latest('id')->paginate($this->paginate);
        return view('dashboard.kampus-merdeka-review.index', [
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
    public function show(Request $request, string  $id)
    {

        $tab = $request->tab;
        if (empty($tab)) {
            $tab = 'harian';
        }

        if (!in_array($tab, ['harian', 'mingguan'])) {
            notify()->warning('Tab tidak ditemukan', 'Perhatian!');
            return back();
        }

        $msib = KampusMerdeka::find($id);
        if (empty($msib)) {
            notify()->warning('Data tidak ditemukan', 'Perhatian!');
            return back();
        }

        $laporanTersimpan = KampusMerdekaLaporan::where('kampus_merdeka_id', $msib->id)
            ->get()
            ->keyBy(function ($item) {
                return Carbon::parse($item->tanggal)->toDateString();
            });

        $daftarTanggal = $this->generateTanggalLaporan(
            $msib->tanggal_mulai,
            $msib->tanggal_selesai
        );

        $tanggalSekarang = now()->toDateString();
        $tanggalLaporanAktif = null;
        $laporanStatus = [];
        $isiSekarang = null;

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
                $isiSekarang = [
                    'tanggal' => $tglStr,
                    'jenis_laporan' => $tanggal['jenis_laporan'],
                ];
            }
        }

        // Pagination manual untuk array laporanStatus
        $laporanStatusCollection = collect($laporanStatus)->sortByDesc('tanggal')->values();

        if ($tab == 'harian') {
            $laporanHarian = collect($laporanStatus)->where('jenis_laporan', 'harian')->sortByDesc('tanggal')->values();
            $perPage = 6;
            $currentPage = request()->get('page', 1);
            $currentItems = $laporanHarian->slice(($currentPage - 1) * $perPage, $perPage)->values();
            $paginatedLaporanStatus = new LengthAwarePaginator(
                $currentItems,
                $laporanHarian->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        } else {
            $laporanMingguan = collect($laporanStatus)->where('jenis_laporan', 'mingguan')->sortByDesc('tanggal')->values();
            $perPage = 4;
            $currentPage = request()->get('page', 1);
            $currentItems = $laporanMingguan->slice(($currentPage - 1) * $perPage, $perPage)->values();
            $paginatedLaporanStatus = new LengthAwarePaginator(
                $currentItems,
                $laporanMingguan->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }

        $laporanTerakhir = KampusMerdekaLaporan::where('kampus_merdeka_id', $msib->id)
            ->latest('tanggal')
            ->first();

        return view('dashboard.kampus-merdeka-review.detail', [
            'judulHalaman' => 'Laporan MSIB',
            'msib' => $msib,
            'laporanStatus' => $paginatedLaporanStatus,
            'laporanTerakhir' => $laporanTerakhir,
            'tab' => $tab,
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
        $data = KampusMerdekaLaporan::find($id);
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
