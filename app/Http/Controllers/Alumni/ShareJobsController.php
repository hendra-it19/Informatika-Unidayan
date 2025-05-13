<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Alumni\KarirAlumni;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShareJobsController extends Controller
{
    public $path = 'upload/karir/';
    public $paginate = 10;
    public function index(Request $request)
    {
        $paginate = $this->paginate;
        $q = $request->keyword;
        if (empty($q)) {
            $data = KarirAlumni::with('alumni')
                ->where('alumni_id', auth()->user()->alumni->id)
                ->orderBy('id', 'DESC')
                ->paginate($paginate);
            $jumlahData = KarirAlumni::with('alumni')
                ->where('alumni_id', auth()->user()->alumni->id)
                ->count();
        } else {
            $data =  KarirAlumni::with('alumni')->orderBy('id', 'DESC')
                ->where('alumni_id', auth()->user()->alumni->id)
                ->whereHas('alumni', function ($query) use ($q) {
                    return $query->where('nama', 'like', '%' . $q . '%');
                })
                ->orWhere('mitra', 'like', '%' . $request->keyword . '%')
                ->orWhere('pekerjaan', 'like', '%' . $request->keyword . '%')
                ->paginate($paginate);
            $jumlahData = KarirAlumni::with('alumni')
                ->where('alumni_id', auth()->user()->alumni->id)
                ->whereHas('alumni', function ($query) use ($q) {
                    return $query->where('nama', 'like', '%' . $q . '%');
                })
                ->orWhere('mitra', 'like', '%' . $request->keyword . '%')
                ->orWhere('pekerjaan', 'like', '%' . $request->keyword . '%')
                ->count();
        }
        $p = $jumlahData > $paginate ? true : false;
        return view('dashboard.share-jobs.index', [
            'judulHalaman' => 'Lowongan',
            'data' => $data,
            'p' => $p,
            'q' =>  $q,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.share-jobs.create', [
            'judulHalaman' => 'Tambah Lowongan',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => ['nullable', 'image', 'max:3024'],
            'mitra' => ['required'],
            'pekerjaan' => ['required'],
            'batas_penerimaan' => ['required', 'after:' . Carbon::now()],
            'deskripsi' => ['required']
        ]);
        $foto = $request->file('foto');
        if (!empty($foto)) {
            $name = 'karir-' . auth()->user()->username . '-' . date('dmyHis') . '.' . $foto->getClientOriginalExtension();
            $path = $this->path;
            $foto->move($path, $name);
            $fotoBaru = $path . $name;
        } else {
            $fotoBaru = null;
        }
        KarirAlumni::create([
            'alumni_id' => auth()->user()->alumni->id,
            'mitra' => $request->mitra,
            'pekerjaan' => $request->pekerjaan,
            'batas_penerimaan' => $request->batas_penerimaan,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoBaru,
        ]);
        notify()->success('Lowongan pekerjaan baru berhasil ditambahkan!', 'Berhasil');
        return to_route('share-jobs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = KarirAlumni::find($id);
        return view('dashboard.share-jobs.show', [
            'data' => $data,
            'judulHalaman' => 'Detail Lowongan',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $karirAlumni = KarirAlumni::find($id);
        if ($karirAlumni->status == 'konfirmasi') {
            notify()->warning('Lowongan sudah di konfirmasi!', 'Peringatan');
            return to_route('share-jobs.index');
        }
        return view('dashboard.share-jobs.edit', [
            'judulHalaman' => 'Edit Lowongan',
            'data' => $karirAlumni,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $karirAlumni = KarirAlumni::find($id);
        if ($karirAlumni->status == 'konfirmasi') {
            notify()->warning('Lowongan sudah di konfirmasi!', 'Peringatan');
            return to_route('share-jobs.index');
        }
        $request->validate([
            'foto' => ['nullable', 'image', 'max:3024'],
            'mitra' => ['required'],
            'pekerjaan' => ['required'],
            'batas_penerimaan' => ['required', 'after:' . Carbon::now()],
            'deskripsi' => ['required']
        ]);
        $foto = $request->file('foto');
        if (!empty($foto)) {
            if (!empty($karirAlumni->foto)) {
                unlink($karirAlumni->foto);
            }
            $name = 'karir-' . auth()->user()->username . '-' . date('dmyHis') . '.' . $foto->getClientOriginalExtension();
            $path = $this->path;
            $foto->move($path, $name);
            $fotoBaru = $path . $name;
        } else {
            $fotoBaru = $karirAlumni->foto;
        }
        $karirAlumni->update([
            'foto' => $fotoBaru,
            'mitra' => $request->mitra,
            'pekerjaan' => $request->pekerjaan,
            'batas_penerimaan' => $request->batas_penerimaan,
            'deskripsi' => $request->deskripsi,
            'pesan' => '',
            'status' => $karirAlumni->status == 'tolak' ? 'pengajuan' : $karirAlumni->status,
        ]);
        notify()->success('Lowongan pekerjaan baru berhasil diperbarui!', 'Berhasil');
        return to_route('share-jobs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = KarirAlumni::find($id);
        if ($data->status == 'konfirmasi') {
            notify()->warning('Lowongan ini sudah dikonfirmasi!', 'Peringatan');
            return to_route('share-jobs.index');
        }
        if (!empty($data->foto)) {
            unlink($data->foto);
        }
        $data->delete();
        notify()->success('Lowongan berhasil dihapus!', 'Berhasil');
        return to_route('share-jobs.index');
    }
}
