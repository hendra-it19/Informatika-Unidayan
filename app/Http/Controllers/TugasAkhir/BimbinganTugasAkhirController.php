<?php

namespace App\Http\Controllers\TugasAkhir;

use App\Http\Controllers\Controller;
use App\Models\TugasAkhir\BimbinganTugasAkhir;
use App\Models\TugasAkhir\TugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BimbinganTugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $paginate = 10;

    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->role != 'mahasiswa') {
            $q = $request->keyword;
            if (empty($q)) {
                $data = TugasAkhir::with('pembimbing_utama', 'pembimbing_pendamping', 'mahasiswa')
                    ->where('pembimbing_utama_id', $user->id)
                    ->orWhere('pembimbing_pendamping_id', $user->id)
                    ->paginate($this->paginate);
                $jumlahData = TugasAkhir::where('pembimbing_utama_id', $user->id)
                    ->orWhere('pembimbing_pendamping_id', $user->id)
                    ->count();
            } else {
                $d = TugasAkhir::with('pembimbing_utama', 'pembimbing_pendamping', 'mahasiswa')
                    ->where('pembimbing_utama_id', $user->id)
                    ->orWhere('pembimbing_pendamping_id', $user->id);
                $data = $d->where('judul', 'LIKE', '%' . $q . '%')
                    ->orWhereHas('mahasiswa', function ($query) use ($q) {
                        return $query->where('nama', 'LIKE', '%' . $q . '%')
                            ->orWhere('identitas', 'LIKE', '%' . $q . '%');
                    })->paginate($this->paginate);
                $jumlahData = $d->where('judul', 'LIKE', '%' . $q . '%')
                    ->orWhereHas('mahasiswa', function ($query) use ($q) {
                        return $query->where('nama', 'LIKE', '%' . $q . '%')
                            ->orWhere('identitas', 'LIKE', '%' . $q . '%');
                    })->count();
            }
            $p = $jumlahData > $this->paginate ? true : false;
            return view('dashboard.bimbingan-ta.pembimbing', [
                'data' => $data,
                'p' => $p,
                'q' =>  $q,
            ]);
        } else {
            return view('dashboard.bimbingan-ta.mahasiswa', [
                'judulHalaman' => 'Bimbingan TA',
                'ta' => TugasAkhir::where('mahasiswa_id', $user->id)->first()
            ]);
        }
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
    public function show(BimbinganTugasAkhir $bimbinganTugasAkhir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BimbinganTugasAkhir $bimbinganTugasAkhir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BimbinganTugasAkhir $bimbinganTugasAkhir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BimbinganTugasAkhir $bimbinganTugasAkhir)
    {
        //
    }

    public function chat(int $id)
    {
        $data = TugasAkhir::find($id);
        // $chat = BimbinganTugasAkhir::with('user')
        //     ->where('tugas_akhir_id', $id)
        //     ->orderBy('created_at', 'ASC')
        //     ->get();
        return view('dashboard.bimbingan-ta.mahasiswa-chat', [
            'data' => $data,
            // 'chat' => $chat
        ]);
    }

    public function postChat($id)
    {
        $data = TugasAkhir::find($id);
        return $data;
    }
}
