<?php

namespace App\Http\Controllers;

use App\Mail\EmailPemeriksaanTugasAkhir;
use App\Models\Alumni\Alumni;
use App\Models\Alumni\KarirAlumni;
use App\Models\Kegiatan\KategoriKegiatanProdi;
use App\Models\Kegiatan\KegiatanProdi;
use App\Models\Organisasi\KegiatanOrganisasi;
use App\Models\Organisasi\Organisasi;
use App\Models\Organisasi\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    private $paginate = 20;
    public $path = 'upload/mitra/';


    private function mitra()
    {
        $logos = [
            $this->path . 'kota-baubau.png',
            $this->path . 'dishub-baubau.png',
            $this->path . 'kepton-tv.png',
            $this->path . 'pertanahan.png',
            $this->path . 'kalla-group.png',
            $this->path . 'nf-computer.jpg',
            $this->path . 'imigrasi.jpg',
            $this->path . 'ruang-guru.png',
        ];
        return $logos;
    }


    public function beranda(): View
    {

        $carousel = [
            'upload/slider/1.jpg',
            'upload/slider/2.jpg',
            'upload/slider/3.jpg',
            'upload/slider/4.jpg'
        ];
        $kegiatan = KegiatanProdi::latest('id')->take(5)->get();
        $alumni = Alumni::latest('id')->take(6)->get();

        return view('landing-page.beranda', [
            'judulHalaman' => 'Beranda',
            'carousel' => $carousel,
            'kegiatan' => $kegiatan,
            'alumni' => $alumni,
        ]);
    }

    public function kegiatan(Request $request): View
    {
        $kegiatan = KegiatanProdi::with('kategori', 'user')->latest('id')->paginate($this->paginate);
        if (!empty($request->kategori)) {
            $param = $request->kategori;
            $kegiatan = KegiatanProdi::with('kategori', 'user')
                ->whereHas('kategori', function ($k) use ($param) {
                    $k->where('nama', $param);
                })
                ->latest('id')
                ->paginate($this->paginate);
        }
        $kategori = KategoriKegiatanProdi::latest('id')->get();
        return view('landing-page.kegiatan.index', [
            'judulHalaman' => 'Kegiatan Prodi',
            'kegiatan' => $kegiatan,
            'kategori' => $kategori,
        ]);
    }

    public function kegiatanDetail($slug)
    {
        $kegiatan = KegiatanProdi::with('kategori', 'user')
            ->where('slug', $slug)
            ->first();
        if (empty($kegiatan)) {
            return back();
        }
        views($kegiatan)->cooldown(now()->addHours(1))->record();
        $views = views($kegiatan)->count();
        $kegaitanTerbaru = KegiatanProdi::with('kategori')->latest('id')->take(5)->get();
        return view('landing-page.kegiatan.detail', [
            'judulHalaman' => 'Detail Kegiatan Prodi',
            'data' => $kegiatan,
            'views' => $views,
            'kegiatanTerbaru' => $kegaitanTerbaru,
            'metaKeyword' => $kegiatan->hashtag,
            'metaDescription' => $kegiatan->excerpt,
            'metaAuthor' => $kegiatan->user->nama,
        ]);
    }

    public function alumni(Request $request): View
    {
        $paginate = $this->paginate;
        $data = Alumni::latest('id')->paginate($paginate);
        $total = Alumni::count();
        $ditampilkan = $total < $paginate ? $total : $paginate;
        if (!empty($request->tahun_lulus) && !empty($request->nama)) {
            $data = Alumni::whereYear('tahun_lulus', $request->tahun_lulus)
                ->where('nama', 'like', '%' . $request->nama . '%')
                ->latest('id')
                ->paginate($paginate);
            $ditampilkan = Alumni::whereYear('tahun_lulus', $request->tahun_lulus)
                ->where('nama', 'like', '%' . $request->nama . '%')->count();
            $ditampilkan = $ditampilkan < $paginate ? $ditampilkan : $paginate;
        } else if (!empty($request->nama) && empty($request->tahun_lulus)) {
            $data = Alumni::where('nama', 'like', '%' . $request->nama . '%')
                ->latest('id')
                ->paginate($paginate);
            $ditampilkan = Alumni::where('nama', 'like', '%' . $request->nama . '%')->count();
            $ditampilkan = $ditampilkan < $paginate ? $ditampilkan : $paginate;
        } else if (!empty($request->tahun_lulus) && empty($request->nama)) {
            $data = Alumni::whereYear('tahun_lulus', $request->tahun_lulus)
                ->latest('id')
                ->paginate($paginate);
            $ditampilkan = Alumni::whereYear('tahun_lulus', $request->tahun_lulus)->count();
            $ditampilkan = $ditampilkan < $paginate ? $ditampilkan : $paginate;
        }
        $p = $total > $paginate ? true : false;
        $data_tahun_lulus = Alumni::select('tahun_lulus')->distinct('tahun_lulus')->pluck('tahun_lulus');
        return view('landing-page.alumni.alumni', [
            'judulHalaman' => 'Daftar Alumni',
            'data' => $data,
            'p' => $p,
            'tahun_lulus' => $request->tahun_lulus,
            'nama' => $request->nama,
            'data_tahun_lulus' => $data_tahun_lulus,
            'total' => $total,
            'ditampilkan' => $ditampilkan,
        ]);
    }

    public function karir(Request $request): View
    {
        $paginate = $this->paginate;
        $data = KarirAlumni::with('alumni')->where('status', 'konfirmasi')->latest('id')->paginate($paginate);
        $total = KarirAlumni::count();
        $ditampilkan = $total < $paginate ? $total : $paginate;
        $keyword = $request->keyword;
        if (!empty($keyword)) {
            $data = KarirAlumni::with('alumni')
                ->where('status', 'konfirmasi')
                ->whereHas('alumni', function ($query) use ($keyword) {
                    return $query->where('nama', 'like', '%' . $keyword . '%');
                })
                ->orWhere('mitra', 'like', '%' . $keyword . '%')
                ->orWhere('pekerjaan', 'like', '%' . $keyword . '%')
                ->latest('id')
                ->paginate($paginate);
            $ditampilkan = KarirAlumni::with('alumni')
                ->where('status', 'konfirmasi')
                ->whereHas('alumni', function ($query) use ($keyword) {
                    return $query->where('nama', 'like', '%' . $keyword . '%');
                })
                ->orWhere('mitra', 'like', '%' . $keyword . '%')
                ->orWhere('pekerjaan', 'like', '%' . $keyword . '%')
                ->latest('id')->count();
            $ditampilkan = $ditampilkan < $paginate ? $ditampilkan : $paginate;
        }
        $p = $total > $paginate ? true : false;
        return view('landing-page.alumni.karir', [
            'judulHalaman' => 'Karir',
            'data' => $data,
            'p' => $p,
            'keyword' => $keyword,
            'total' => $total,
            'ditampilkan' => $ditampilkan,
        ]);
    }

    public function tentangKami(): View
    {
        return view('landing-page.tentang-kami', [
            'judulHalaman' => 'Tentang Kami'
        ]);
    }

    public function daftarOrganisasi()
    {
        $kegiatanTerbaru = KegiatanOrganisasi::with('organisasi')->latest('id')->take(5)->get();
        $organisasi = Organisasi::latest('id')->get();
        return view('landing-page.organisasi.daftar-organisasi', [
            'judulHalaman' => 'Organisasi',
            'organisasi' => $organisasi,
            'kegiatanTerbaru' => $kegiatanTerbaru,
        ]);
    }
    public function daftarOrganisasiDetail($slug)
    {
        $data = Organisasi::where('slug', $slug)->first();
        if (empty($data)) {
            return back();
        }
        $struktural = StrukturOrganisasi::where('organisasi_id', $data->id)->latest('awal_jabatan')->get();
        $kegiatanTerbaru = KegiatanOrganisasi::with('organisasi')
            ->where('organisasi_id', $data->id)
            ->latest('id')->take(5)->get();
        return view('landing-page.organisasi.daftar-organisasi', [
            'judulHalaman' => 'Organisasi',
            'kegiatanTerbaru' => $kegiatanTerbaru,
            'struktural' => $struktural,
            'data' => $data,
        ]);
    }

    public function kegiatanOrganisasi(Request $request)
    {
        $kegiatan = KegiatanOrganisasi::with('organisasi')->latest('id')->paginate($this->paginate);
        $param = null;
        $organisasi_param = null;
        if (!empty($request->organisasi)) {
            $param = $request->organisasi;
            $organisasi_param = Organisasi::where('slug', $param)->first();
            $kegiatan = KegiatanOrganisasi::where('organisasi_id', $organisasi_param->id)
                ->latest('id')
                ->paginate($this->paginate);
        }
        $organisasi = Organisasi::with('kegiatan')->where('can_upload', 1)->get();
        return view('landing-page.organisasi.kegiatan', [
            'judulHalaman' => 'Kegiatan Organisasi',
            'kegiatan' => $kegiatan,
            'organisasi' => $organisasi,
            'organisasi_param' => $organisasi_param,
            'param' => $param
        ]);
    }

    public function kegiatanOrganisasiDetail($slug)
    {
        $kegiatan = KegiatanOrganisasi::with('organisasi')->where('slug', $slug)->first();
        if (empty($kegiatan)) {
            return back();
        }
        views($kegiatan)->cooldown(now()->addHours(1))->record();
        $views = views($kegiatan)->count();
        $kegiatanTerbaru = KegiatanOrganisasi::with('organisasi')->latest('id')->take(5)->get();
        return view('landing-page.organisasi.kegiatan-detail', [
            'judulHalaman' => 'Tentang Kami',
            'views' => $views,
            'data' => $kegiatan,
            'kegiatanTerbaru' => $kegiatanTerbaru,
            'metaKeyword' => $kegiatan->hashtag,
            'metaAuthor' => $kegiatan->organisasi->nama_organisasi,
        ]);
    }

    public function kp()
    {
        $param = 'KP';
        $param2 = 'Kerja Praktek';
        $data = KegiatanProdi::with('kategori', 'user')
            ->whereHas('kategori', function ($k) use ($param, $param2) {
                $k->where('nama', 'LIKE', "%{$param}%")->orWhere('nama', 'LIKE', "%{$param2}%");
            })
            ->latest('id')
            ->take(5)->get();
        return view('landing-page.kp-msib.kp', [
            'judulHalaman' => 'Kerja Praktek',
            'kegiatanTerbaru' =>  $data,
            'mitra' => $this->mitra(),
        ]);
    }

    public function msib()
    {
        $param = 'MBKM';
        $param2 = 'Kampus Merdeka';
        $param3 = 'MSIB';
        $data = KegiatanProdi::with('kategori', 'user')
            ->whereHas('kategori', function ($k) use ($param, $param2, $param3) {
                $k->where('nama', 'LIKE', "%{$param}%")->orWhere('nama', 'LIKE', "%{$param2}%")->orWhere('nama', 'LIKE', "%{$param3}%");
            })
            ->latest('id')
            ->take(5)->get();
        // return $data;
        return view('landing-page.kp-msib.msib', [
            'judulHalaman' => 'Kampus Merdeka',
            'kegiatanTerbaru' =>  $data,
            'mitra' => $this->mitra(),
        ]);
    }
}
