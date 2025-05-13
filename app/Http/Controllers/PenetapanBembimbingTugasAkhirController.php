<?php

namespace App\Http\Controllers;

use App\Models\TugasAkhir\TugasAkhir;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PenetapanBembimbingTugasAkhirController extends Controller
{

    private $paginate = 10;

    public function index(Request $request): View
    {
        $paginate = $this->paginate;
        $q = $request->keyword;
        $tabs = $request->tabs;
        if (empty($q) && empty($tabs)) {
            $s = TugasAkhir::with('mahasiswa')->orderBy('id', 'DESC');
            $data = $s->paginate($paginate);
            $jumlahData = $s->count();
        } else if (empty($tabs) && !empty($q)) {
            $s =  TugasAkhir::with('mahasiswa')->orderBy('id', 'DESC')
                ->whereHas('mahasiswa', function ($query) use ($q) {
                    $query->where('nama', 'LIKE', '%' . $q . '%')
                        ->orWhere('identitas', 'LIKE', '%' . $q . '%');
                })
                ->orWhere('judul', 'like', '%' . $request->keyword . '%');
            $data = $s->paginate($paginate);
            $jumlahData =  $s->count();
        } else if (empty($q) && !empty($tabs)) {
            if ($tabs == 'belum') {
                $s = TugasAkhir::with('mahasiswa')->whereNull('pembimbing_utama_id')->orderBy('id', 'DESC');
                $data = $s->paginate($paginate);
                $jumlahData = $s->count();
            } else if ($tabs == 'sudah') {
                $s = TugasAkhir::with('mahasiswa')->whereNotNull('pembimbing_utama_id')->orderBy('id', 'DESC');
                $data = $s->paginate($paginate);
                $jumlahData = $s->count();
            } else {
                $s = TugasAkhir::with('mahasiswa')->orderBy('id', 'DESC');
                $data = $s->paginate($paginate);
                $jumlahData = $s->count();
            }
        } else {
            if ($tabs == 'belum') {
                $s = TugasAkhir::with('mahasiswa')->whereNull('pembimbing_utama_id');
                $d = $s->whereHas('mahasiswa', function ($query) use ($q) {
                    $query->where('nama', 'LIKE', '%' . $q . '%')
                        ->orWhere('identitas', 'LIKE', '%' . $q . '%');
                })
                    ->orWhere('judul', 'like', '%' . $request->keyword . '%')->latest('id');
                $data = $d->paginate($paginate);
                $jumlahData = $d->count();
            } else if ($tabs == 'sudah') {
                $s = TugasAkhir::with('mahasiswa')->whereNotNull('pembimbing_utama_id');
                $d = $s->whereHas('mahasiswa', function ($query) use ($q) {
                    $query->where('nama', 'LIKE', '%' . $q . '%')
                        ->orWhere('identitas', 'LIKE', '%' . $q . '%');
                })
                    ->orWhere('judul', 'like', '%' . $request->keyword . '%')->latest('id');
                $data = $d->paginate($paginate);
                $jumlahData = $d->count();
            } else {
                $s = TugasAkhir::with('mahasiswa');
                $d = $s->whereHas('mahasiswa', function ($query) use ($q) {
                    $query->where('nama', 'LIKE', '%' . $q . '%')
                        ->orWhere('identitas', 'LIKE', '%' . $q . '%');
                })
                    ->orWhere('judul', 'like', '%' . $request->keyword . '%')->latest('id');
                $data = $d->paginate($paginate);
                $jumlahData = $d->count();
            }
        }
        $p = $jumlahData > $paginate ? true : false;
        return view('dashboard.penetapan-pembimbing-ta.index', [
            'judulHalaman' => 'Daftar Judul',
            'data' => $data,
            'p' => $p,
            'q' =>  $q,
            'tabs' => $tabs,
            'now' => Carbon::now()
        ])->with('i', (request()->input('page', 1) - 1) * $this->paginate);
    }

    public function show($id): View
    {
        $data = TugasAkhir::with('pembimbing_utama', 'pembimbing_pendamping', 'mahasiswa')->findOrFail($id);
        $judulHalaman = 'Penetapan Pembimbing';
        return view('dashboard.penetapan-pembimbing-ta.show', compact('data', 'judulHalaman'));
    }

    public function create(): View
    {
        $judulHalaman = 'Penetapan Pembimbing';
        $dosen = User::whereIn('role', ['dosen', 'kaprodi'])->latest('id')->get();
        $mahasiswa = User::with('mahasiswa')->where('role', 'mahasiswa')->latest('identitas')->get();
        return view('dashboard.penetapan-pembimbing-ta.create', compact('judulHalaman', 'dosen', 'mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_diterima' => ['required', 'date'],
            'mahasiswa' => ['required', 'exists:users,id', 'unique:tugas_akhir,mahasiswa_id,except,id'],
            'judul' => ['required'],
            'abstrak' => ['required'],
            'pembimbing_utama' => ['required', 'exists:users,id'],
            'pembimbing_pendamping' => ['required', 'exists:users,id'],
        ]);
        if ($request->pembimbing_utama == $request->pembimbing_pendamping) {
            notify()->warning('Harap pilih dosen yang berbeda untuk pembimbing utama dan pendamping!', 'Perhatian');
            return redirect()->back()->withErrors(['pembimbing_pendamping' => 'Pilih dosen yang berbeda.'])->withInput();
        }
        TugasAkhir::create([
            'created_at' => $request->tanggal_diterima,
            'mahasiswa_id' => $request->mahasiswa,
            'judul' => $request->judul,
            'abstrak' => $request->abstrak,
            'pembimbing_utama_id' => $request->pembimbing_utama,
            'pembimbing_pendamping_id' => $request->pembimbing_pendamping,
        ]);
        notify()->success('Tugas akhir berhasil ditambahkan!', 'Berhasil');
        return to_route('penetapan-pembimbing-ta.index');
    }

    public function edit($id): View
    {
        $data = TugasAkhir::with('mahasiswa')->findOrFail($id);
        $judulHalaman = 'Penetapan Pembimbing';
        $dosen = User::whereIn('role', ['dosen', 'kaprodi'])->latest('id')->get();
        return view('dashboard.penetapan-pembimbing-ta.edit', compact('judulHalaman', 'dosen', 'data'));
    }

    public function update($id, Request $request)
    {
        if ($request->pembimbing_utama == $request->pembimbing_pendamping) {
            notify()->warning('Pilih dosen berbeda untuk pembimbing utama dan pendamping!', 'Perhatian');
            return redirect()->back()->withErrors(['pembimbing_pendamping' => 'Pilih dosen yang berbeda.'])->withInput();
        }
        $request->validate([
            'judul' => ['required'],
            'abstrak' => ['required'],
            'pembimbing_utama' => ['required', 'exists:users,id'],
            'pembimbing_pendamping' => ['required', 'exists:users,id'],
        ]);
        $data = TugasAkhir::with('mahasiswa')->findOrFail($id);
        $data->update([
            'judul' => $request->judul,
            'abstrak' => $request->abstrak,
            'pembimbing_utama_id' => $request->pembimbing_utama,
            'pembimbing_pendamping_id' => $request->pembimbing_pendamping,
        ]);
        notify()->success('Pembimbing berhasil ditetapkan untuk mahasiswa ' . $data->mahasiswa->nama . '');
        return to_route('penetapan-pembimbing-ta.index');
    }

    public function destroy() {}

    public function exportPdf(Request $request)
    {
        if (empty($request->tanggal_awal) || empty($request->tanggal_akhir)) {
            notify()->warning('Harap lengkapi jangkauan waktu data export!', 'Perhatian!');
            return redirect()->back()->withInput([
                'tanggal_awal' => $request->tanggal_awal,
                'tanggal_akhir' => $request->tanggal_akhir,
            ]);
        }
        $tgl_awal = Carbon::parse($request->tanggal_awal);
        $tgl_akhir = Carbon::parse($request->tanggal_akhir);
        if ($tgl_awal->gt($tgl_akhir)) {
            notify()->warning('Tanggal awal harus lebih kecil atau sama dengan tanggal akhir!', 'Perhatian!');
            return redirect()->back()->withInput([
                'tanggal_awal' => $tgl_awal,
                'tanggal_akhir' => $tgl_akhir,
            ]);
        }
        $data = TugasAkhir::with('mahasiswa', 'pembimbing_utama', 'pembimbing_pendamping')
            ->whereDate('created_at', '>=', $request->tanggal_awal)
            ->whereDate('created_at', '<=', $request->tanggal_akhir)
            ->whereNotNull('pembimbing_utama_id')
            ->get();
        $pdf = PDF::loadView('dashboard.penetapan-pembimbing-ta.pdf', [
            'no' => 1,
            'judul' => '',
            'date' => Carbon::now()->format('d m Y'),
            'data' => $data,
            'tgl_awal' => $tgl_awal->format('d-m-Y'),
            'tgl_akhir' => $tgl_akhir->format('d-m-Y'),
            'kaprodi' => User::where('role', 'kaprodi')->first() ?? 'Belum ada data',
        ]);
        return $pdf->stream();
    }
}
