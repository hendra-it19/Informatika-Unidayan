<?php

namespace App\Http\Controllers\KpMbkm;

use App\Http\Controllers\Controller;
use App\Models\MSIB\KampusMerdeka;
use App\Models\MSIB\KampusMerdekaLaporan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class KampusMerdekaMahasiswaController extends Controller
{
    private $path = 'upload/kampus-merdeka/';
    private $paginate = 7;

    public function index()
    {
        $cek_tunggu = KampusMerdeka::where('user_id', Auth::user()->id)
            ->where('status', 'menunggu')
            ->first();
        $cek_terima = KampusMerdeka::where('user_id', Auth::user()->id)
            ->where('status', 'diterima')
            ->count();
        $dataPendaftaran = KampusMerdeka::with('user')
            ->where('user_id', Auth::user()->id)->latest('id')->get();
        return view('dashboard.kampus-merdeka-mahasiswa.index', [
            'judulHalaman' => 'Kampus Merdeka',
            'data' => $dataPendaftaran,
            'data_tunggu' => empty($cek_tunggu) ? false : true,
            'data_terima' => $cek_terima,
        ]);
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
        return view('dashboard.kampus-merdeka-mahasiswa.daftar', [
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

        return view('dashboard.kampus-merdeka-mahasiswa.detail', [
            'judulHalaman' => 'Laporan MSIB',
            'msib' => $msib,
            'laporanStatus' => $paginatedLaporanStatus,
            'isiSekarang' => collect($isiSekarang),
            'laporanTerakhir' => $laporanTerakhir,
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


    public function simpanLaporan(Request $request, $msib)
    {
        $KampusMerdeka = KampusMerdeka::find($msib);
        if (empty($KampusMerdeka)) {
            notify()->success('Gagal simpan laporan karena Kegiatan tidak ditemukan!', 'Gagal!');
            return back();
        }
        $request->validate([
            'tanggal' => ['required', 'date'],
            'jenis_laporan' => ['required', 'in:harian,mingguan'],
            'kehadiran' => ['required', 'in:hadir,sakit,izin,alpa,libur'],
            'deskripsi' => ['required', 'string'],
        ]);
        KampusMerdekaLaporan::create([
            'kampus_merdeka_id' => $KampusMerdeka->id,
            'tanggal' => $request->tanggal,
            'jenis_laporan' => $request->jenis_laporan,
            'kehadiran' => $request->kehadiran,
            'deskripsi' => $request->deskripsi,
        ]);
        notify()->success('Laporan berhasil dibuat', 'Berhasil!');
        return back();
    }

    public function updateBerkas(Request $request, $msib)
    {
        $kampusMerdeka = KampusMerdeka::find($msib);
        if (empty($kampusMerdeka)) {
            notify()->success('Gagal simpan berkas karena Kegiatan tidak ditemukan!', 'Gagal!');
            return back();
        }
        $request->validate([
            'laporan_akhir' => ['nullable', 'file', 'mimes:pdf', 'max:10124'],
        ]);

        $laporan_akhir = $request->file('laporan_akhir');
        if (empty($laporan_akhir)) {
            $laporan_akhir = $kampusMerdeka->laporan_akhir;
        } else {
            $name = Auth::user()->identitas . '-' . $kampusMerdeka->id . '-laporan-akhir.' . $laporan_akhir->getClientOriginalExtension();
            $path = $this->path . Carbon::parse($request->tanggal_mulai)->format('Y') . '/';
            if (empty($kampusMerdeka->laporan_akhir)) {
                $laporan_akhir->move($path, $name);
            } else {
                unlink($kampusMerdeka->laporan_akhir);
                $laporan_akhir->move($path, $name);
            }
            $laporan_akhir = $path . $name;
        }

        $kampusMerdeka->update([
            'laporan_akhir' => $laporan_akhir,
        ]);

        notify()->success('Laporan anda berhasil diupload', 'Berhasil!');
        return back();
    }
}
