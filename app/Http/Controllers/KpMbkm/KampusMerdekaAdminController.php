<?php

namespace App\Http\Controllers\KpMbkm;

use App\Http\Controllers\Controller;
use App\Models\MSIB\KampusMerdeka;
use App\Models\MSIB\KampusMerdekaLaporan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\BackupGlobals;

class KampusMerdekaAdminController extends Controller
{
    private $path = 'upload/kampus-merdeka/';
    private $paginate = 7;

    public function index(Request $request)
    {

        $cek_tunggu = KampusMerdeka::where('user_id', Auth::user()->id)
            ->where('status', 'menunggu')
            ->first();
        $cek_terima = KampusMerdeka::where('user_id', Auth::user()->id)
            ->where('status', 'diterima')
            ->count();
        $tahun = KampusMerdeka::distinct()
            ->selectRaw('YEAR(tanggal_mulai) as tahun')
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        $data = KampusMerdeka::when($request->keyword, function ($query, $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('mitra', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('user', function ($qUser) use ($keyword) {
                        $qUser->where('nama', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('identitas', 'LIKE', '%' . $keyword . '%');
                    });
            });
        })
            ->when($request->tahun, function ($query, $tahun) {
                $query->whereYear('tanggal_mulai', $tahun);
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->paginate);
        return view('dashboard.kampus-merdeka-admin.index', [
            'judulHalaman' => 'Kampus Merdeka',
            'data' => $data,
            'data_tunggu' => empty($cek_tunggu) ? false : true,
            'data_terima' => $cek_terima,
            'filter_status' => $request->status ?? '',
            'filter_keyword' => $request->keyword ?? '',
            'filter_tahun' => $request->tahun ?? '',
            'tahun' => $tahun,
        ])->with('i', (request()->input('page', 1) - 1) * $this->paginate);
    }

    public function daftar()
    {
        $cek_tunggu = KampusMerdeka::where('user_id', Auth::user()->id)
            ->where('status', 'menunggu')
            ->first();
        $cek_terima = KampusMerdeka::where('user_id', Auth::user()->id)
            ->where('status', 'diterima')
            ->count();
        if (!empty($cek_tunggu) || $cek_terima >= 2) {
            notify()->warning('Sudah mencapai batas atau ada kegiatan masih pending', 'Perhatian!');
            return back();
        }
        return view('dashboard.kampus-merdeka-admin.daftar', [
            'judulHalaman' => 'Kampus Merdeka',

        ]);
    }

    public function postDaftar(Request $request)
    {
        $validData = $request->validate([
            'mitra' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'in:study,internship'],
            'mobilitas' => ['required', 'in:online,onsite'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => ['required', 'date', 'after:tanggal_mulai'],
            'bukti_penerimaan' => ['required', 'file', 'mimes:pdf', 'max:524'],
            'persetujuan_kampus' => ['required', 'file', 'mimes:pdf', 'max:524'],
        ]);
        $km = KampusMerdeka::latest('id')->first();
        if (empty($km)) {
            $id = 1;
        } else {
            $id = intval($km->id) + 1;
        }
        $bukti_penerimaan = $request->file('bukti_penerimaan');
        $name = Auth::user()->identitas . '-' . $id . '-bukti-penerimaan.' . $bukti_penerimaan->getClientOriginalExtension();
        $path = $this->path . Carbon::parse($request->tanggal_mulai)->format('Y') . '/';
        $bukti_penerimaan->move($path, $name);
        $validData['bukti_penerimaan'] = $path . $name;
        $persetujuan_kampus = $request->file('persetujuan_kampus');
        $name = Auth::user()->identitas . '-' . $id . '-persetujuan-kampus.' . $persetujuan_kampus->getClientOriginalExtension();
        $path = $this->path . Carbon::parse($request->tanggal_mulai)->format('Y') . '/';
        $persetujuan_kampus->move($path, $name);
        $validData['persetujuan_kampus'] = $path . $name;

        $validData['user_id'] = Auth::user()->id;

        KampusMerdeka::create($validData);

        notify()->success('Pendaftaran berhasil disimpan', 'Berhasil!');
        return to_route('kampus-merdeka.index');
    }

    public function batalDaftar($msib)
    {
        $data = KampusMerdeka::find($msib);
        if (empty($data)) {
            notify()->warning('Data ditemukan', 'Perhatian!');
            return back();
        }
        unlink($data->bukti_penerimaan);
        unlink($data->persetujuan_kampus);
        $data->delete();
        notify()->success('Berhasil membatalkan pendaftaran!', 'Berhasil!');
    }


    public function terimaPendaftaran($msib)
    {
        $msib = KampusMerdeka::find($msib);
        if (empty($msib)) {
            notify()->warning('Data yang diterima tidak ditemukan', 'Gagal!');
            return back();
        }
        $msib->update([
            'status' => 'diterima',
        ]);
        notify()->success('Pendaftaran telah diterima!', 'Berhasil!');
        return back();
    }

    public function tolakPendaftaran(Request $request, $msib)
    {
        $msib = KampusMerdeka::find($msib);
        if (empty($msib)) {
            notify()->warning('Data yang diterima tidak ditemukan', 'Gagal!');
            return back();
        }
        $request->validate([
            'keterangan' => ['required', 'string'],
        ]);
        $msib->update([
            'status' => 'ditolak',
            'keterangan' => $request->keterangan,
        ]);
        notify()->success('Pendaftaran telah ditolak!', 'Berhasil!');
        return back();
    }

    public function detail($msib)
    {
        $msib = KampusMerdeka::find($msib);
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
        $perPage = $this->paginate;
        $currentPage = request()->get('page', 1);
        $currentItems = $laporanStatusCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $paginatedLaporanStatus = new LengthAwarePaginator(
            $currentItems,
            $laporanStatusCollection->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $laporanTerakhir = KampusMerdekaLaporan::where('kampus_merdeka_id', $msib->id)
            ->latest('tanggal')
            ->first();

        $tanggalMulai = Carbon::parse($msib->tanggal_mulai);
        $tanggalSelesai = Carbon::parse($msib->tanggal_selesai);
        $jumlahHari = $tanggalMulai->diffInDays($tanggalSelesai) + 1;
        $jumlahLaporan = KampusMerdekaLaporan::where('kampus_merdeka_id', $msib->id)->count();
        $sisaLaporan = $jumlahHari - $jumlahLaporan;

        return view('dashboard.kampus-merdeka-admin.detail', [
            'judulHalaman' => 'Laporan MSIB',
            'msib' => $msib,
            'laporanStatus' => $paginatedLaporanStatus,
            'isiSekarang' => collect($isiSekarang),
            'laporanTerakhir' => $laporanTerakhir,
            'sisaLaporan' => $sisaLaporan,
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
