<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Alumni\KarirAlumni;
use Illuminate\Http\Request;

class KarirAlumniController extends Controller
{
    public $paginate = 10;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $this->paginate;
        $q = $request->keyword;
        if (empty($q)) {
            $data = KarirAlumni::with('alumni')
                ->orderBy('id', 'DESC')
                ->paginate($paginate);
            $jumlahData = KarirAlumni::count();
        } else {
            $data =  KarirAlumni::with('alumni')->orderBy('id', 'DESC')
                ->whereHas('alumni', function ($query) use ($q) {
                    return $query->where('nama', 'like', '%' . $q . '%');
                })
                ->orWhere('mitra', 'like', '%' . $request->keyword . '%')
                ->orWhere('pekerjaan', 'like', '%' . $request->keyword . '%')
                ->paginate($paginate);
            $jumlahData =  KarirAlumni::with('alumni')->orderBy('id', 'DESC')
                ->whereHas('alumni', function ($query) use ($q) {
                    return $query->where('nama', 'like', '%' . $q . '%');
                })
                ->orWhere('mitra', 'like', '%' . $request->keyword . '%')
                ->orWhere('pekerjaan', 'like', '%' . $request->keyword . '%')
                ->count();
        }
        $p = $jumlahData > $paginate ? true : false;
        return view('dashboard.alumni-karir.index', [
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
    public function show($id)
    {
        $data = KarirAlumni::find($id);
        return view('dashboard.alumni-karir.show', [
            'data' => $data,
            'judulHalaman' => 'Detail'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KarirAlumni $karirAlumni)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = KarirAlumni::find($id);
        if (!empty($data->foto)) {
            unlink($data->foto);
        }
        $data->delete();
        notify()->success('Lowongan berhasil dihapus!', 'Berhasil');
        return to_route('alumni-karir.index');
    }

    public function konfirmasi($id)
    {
        $data = KarirAlumni::find($id);
        $data->update([
            'status' => 'konfirmasi',
        ]);
        notify()->success('Lowongan berhasil dikonfirmasi!', 'Berhasil');
        return to_route('alumni-karir.index');
    }
    public function tolak(Request $request, $id)
    {
        $data = KarirAlumni::find($id);
        if ($data->status == 'konfirmasi') {
            notify()->warning('Data sudah dikonfirmasi!', 'Peringatan');
        }
        $request->validate([
            'pesan' => ['required']
        ]);
        $data->update([
            'status' => 'tolak',
            'pesan' => $request->pesan,
        ]);
        notify()->success('Lowongan berhasil di tolak!', 'Berhasil');
        return redirect()->back();
    }
}
