<?php

namespace App\Http\Controllers\KpMbkm;

use App\Http\Controllers\Controller;
use App\Models\KP\KerjaPraktek;
use App\Models\KP\KerjaPraktekLaporan;
use App\Models\KP\KerjaPraktekPendaftaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KerjaPraktekMahasiswaController extends Controller
{

    private $path = 'upload/kerja-praktek/';

    public function index()
    {
        $cekPendaftaran = KerjaPraktekPendaftaran::where('mahasiswa_id', Auth::user()->mahasiswa->id)
            ->whereIn('status', ['menunggu', 'diterima'])
            ->first();
        $dataPendaftaran = KerjaPraktekPendaftaran::with('kerjaPraktek', 'kerjaPraktek.pendaftaran', 'mahasiswa.user')
            ->where('mahasiswa_id', Auth::user()->mahasiswa->id)->latest('id')->get();
        return view('dashboard.kerja-praktek-mahasiswa.index', [
            'judulHalaman' => 'Kerja Praktek',
            'data' => $dataPendaftaran,
            'cekPendaftaran' => empty($cekPendaftaran) ? true : false,
        ]);
    }

    public function daftar()
    {
        $cek = KerjaPraktekPendaftaran::where('mahasiswa_id', Auth::user()->mahasiswa->id)
            ->whereIn('status', ['menunggu', 'diterima'])
            ->first();
        if (!empty($cek)) {
            notify()->warning('Ada kegiatan KP yang sudah terdaftar', 'Perhatian!');
            return back();
        }
        return view('dashboard.kerja-praktek-mahasiswa.daftar', [
            'judulHalaman' => 'Kerja Praktek',
        ]);
    }

    public function batal($id)
    {
        $data = KerjaPraktekPendaftaran::find($id);
        if (empty($data)) {
            return back();
        }
        unlink($data->transkrip_nilai);
        $data->delete();
        notify()->success('Berhasil membatalkan pendaftaran', 'Berhasil!');
        return back();
    }

    public function laporan(Request $request, $kp)
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
        if (empty($kerjaPraktek)) {
            return back();
        }
        $mahasiswa = Auth::user()->mahasiswa;

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

        // return $isiSekarang;
        $laporanTerakhir = KerjaPraktekLaporan::where('mahasiswa_id', $mahasiswa->id)
            ->where('kerja_praktek_id', $kerjaPraktek->id)
            ->latest('tanggal')
            ->first();

        $laporanHarian = collect($laporanStatus)->where('jenis_laporan', 'harian')->sortByDesc('tanggal')->values()->all();
        $laporanMingguan = collect($laporanStatus)->where('jenis_laporan', 'mingguan')->sortByDesc('tanggal')->values()->all();
        return view('dashboard.kerja-praktek-mahasiswa.laporan', [
            'judulHalaman' => 'Laporan KP',
            'kerjaPraktek' => $kerjaPraktek,
            'mahasiswa' => $mahasiswa,
            'isiSekarang' =>  collect($isiSekarang), // kirim ke view
            'laporanTerakhir' => $laporanTerakhir,
            'laporanStatus' => $r == 'harian' ? $laporanHarian : $laporanMingguan,
            'laporan' => $r == 'harian' ? 'Harian' : 'Mingguan',
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
        $daftar = collect($daftar)->sortBy('tanggal')->values()->all();
        $cek = collect($daftar)->sortByDesc('tanggal')->first();
        $cek = Carbon::parse($cek['tanggal']);
        if ($cek->dayOfWeek() > 2) {
            $daftar[] = [
                'tanggal' => $cek->addDay(),
                'jenis_laporan' => 'mingguan',
            ];
        }
        return $daftar;
    }


    public function simpanLaporan(Request $request, $kp)
    {
        $kerjaPraktek = KerjaPraktek::find($kp);
        if (empty($kerjaPraktek)) {
            notify()->success('Gagal simpan laporan karena Kegiatan tidak ditemukan!', 'Gagal!');
            return back();
        }
        $request->validate([
            'tanggal' => ['required', 'date'],
            'jenis_laporan' => ['required', 'in:harian,mingguan'],
            'kehadiran' => ['required', 'in:hadir,sakit,izin,alpa,libur'],
            'deskripsi' => ['required', 'string'],
            'file' => [$request->jenis_laporan == 'harian' ? 'nullable' : 'required', 'file', 'mimes:pdf,doc,docx', 'max:2124'],
        ]);
        $db = KerjaPraktekLaporan::create([
            'mahasiswa_id' => Auth::user()->mahasiswa->id,
            'kerja_praktek_id' => $kerjaPraktek->id,
            'tanggal' => $request->tanggal,
            'jenis_laporan' => $request->jenis_laporan,
            'kehadiran' => $request->kehadiran,
            'deskripsi' => $request->deskripsi,
        ]);
        if ($request->jenis_laporan == 'mingguan') {
            $fileUpload = null;
            $file = $request->file('file');
            if (isset($file)) {
                $path = $this->path . 'laporan-mingguan/';
                $name = $kerjaPraktek->id . '-' . Carbon::parse($request->tanggal)->format('dmy') . '.' . $file->getClientOriginalExtension();
                $file->move($path, $name);
                $fileUpload = $path . $name;
                $db->file = $fileUpload;
                $db->save();
            }
        }
        notify()->success('Laporan berhasil dibuat', 'Berhasil!');
        return back();
    }


    public function berkas(Request $request, $kp)
    {
        $kerjaPraktek = KerjaPraktek::find($kp);
        if (empty($kerjaPraktek)) {
            notify()->success('Gagal simpan berkas karena Kegiatan tidak ditemukan!', 'Gagal!');
            return back();
        }
        $request->validate([
            'surat_pengantar' => ['nullable', 'file', 'mimes:pdf', 'max:520'],
            'balasan_surat_pengantar' => ['nullable', 'file', 'mimes:pdf', 'max:520'],
            'surat_penarikan' => ['nullable', 'file', 'mimes:pdf', 'max:520'],
            'balasan_surat_penarikan' => ['nullable', 'file', 'mimes:pdf', 'max:520'],
            'laporan_akhir' => ['nullable', 'file', 'mimes:pdf', 'max:10124'],
        ]);
        $surat_pengantar = $request->file('surat_pengantar');
        if (empty($surat_pengantar)) {
            $surat_pengantar = $kerjaPraktek->surat_pengantar;
        } else {
            $path = $this->path . '' . $kerjaPraktek->tahun . '/' . $kerjaPraktek->semester . '/';
            $name = $kerjaPraktek->id . '.' . $surat_pengantar->getClientOriginalExtension();
            if (empty($kerjaPraktek->surat_pengantar)) {
                $surat_pengantar->move($path, $name);
            } else {
                unlink($kerjaPraktek->surat_pengantar);
                $surat_pengantar->move($path, $name);
            }
            $surat_pengantar = $path . $name;
        }
        $balasan_surat_pengantar = $request->file('balasan_surat_pengantar');
        if (empty($balasan_surat_pengantar)) {
            $balasan_surat_pengantar = $kerjaPraktek->balasan_surat_pengantar;
        } else {
            $path = $this->path . '' . $kerjaPraktek->tahun . '/' . $kerjaPraktek->semester . '/';
            $name = $kerjaPraktek->id . '.' . $balasan_surat_pengantar->getClientOriginalExtension();
            if (empty($kerjaPraktek->balasan_surat_pengantar)) {
                $balasan_surat_pengantar->move($path, $name);
            } else {
                unlink($kerjaPraktek->balasan_surat_pengantar);
                $balasan_surat_pengantar->move($path, $name);
            }
            $balasan_surat_pengantar = $path . $name;
        }

        $surat_penarikan = $request->file('surat_penarikan');
        if (empty($surat_penarikan)) {
            $surat_penarikan = $kerjaPraktek->surat_penarikan;
        } else {
            $path = $this->path . '' . $kerjaPraktek->tahun . '/' . $kerjaPraktek->semester . '/';
            $name = $kerjaPraktek->id . '.' . $surat_penarikan->getClientOriginalExtension();
            if (empty($kerjaPraktek->surat_penarikan)) {
                $surat_penarikan->move($path, $name);
            } else {
                unlink($kerjaPraktek->surat_penarikan);
                $surat_penarikan->move($path, $name);
            }
            $surat_penarikan = $path . $name;
        }

        $balasan_surat_penarikan = $request->file('balasan_surat_penarikan');
        if (empty($balasan_surat_penarikan)) {
            $balasan_surat_penarikan = $kerjaPraktek->balasan_surat_penarikan;
        } else {
            $path = $this->path . '' . $kerjaPraktek->tahun . '/' . $kerjaPraktek->semester . '/';
            $name = $kerjaPraktek->id . '.' . $balasan_surat_penarikan->getClientOriginalExtension();
            if (empty($kerjaPraktek->balasan_surat_penarikan)) {
                $balasan_surat_penarikan->move($path, $name);
            } else {
                unlink($kerjaPraktek->balasan_surat_penarikan);
                $balasan_surat_penarikan->move($path, $name);
            }
            $balasan_surat_penarikan = $path . $name;
        }

        $laporan_akhir = $request->file('laporan_akhir');
        if (empty($laporan_akhir)) {
            $laporan_akhir = $kerjaPraktek->laporan_akhir;
        } else {
            $path = $this->path . '' . $kerjaPraktek->tahun . '/' . $kerjaPraktek->semester . '/';
            $name = $kerjaPraktek->id . '.' . $laporan_akhir->getClientOriginalExtension();
            if (empty($kerjaPraktek->laporan_akhir)) {
                $laporan_akhir->move($path, $name);
            } else {
                unlink($kerjaPraktek->laporan_akhir);
                $laporan_akhir->move($path, $name);
            }
            $laporan_akhir = $path . $name;
        }

        $kerjaPraktek->update([
            'surat_pengantar' => $surat_pengantar,
            'balasan_surat_pengantar' => $balasan_surat_pengantar,
            'surat_penarikan' => $surat_penarikan,
            'balasan_surat_penarikan' => $balasan_surat_penarikan,
            'laporan_akhir' => $laporan_akhir,
        ]);

        notify()->success('Berkas anda berhasil diperbarui', 'Berhasil!');
        return back();
    }
}
