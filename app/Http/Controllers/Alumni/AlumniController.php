<?php

namespace App\Http\Controllers\Alumni;

use App\Exports\AlumniExport;
use App\Http\Controllers\Controller;
use App\Imports\AlumniImport;
use App\Models\Alumni\Alumni;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AlumniController extends Controller
{


    public $paginate = 10;
    public $status_masuk = array(
        [
            'id' => 1,
            'nama' => 'maba',
        ],
        [
            'id' => 2,
            'nama' => 'pindahan'
        ]
    );
    public $path = 'upload/alumni/';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $this->paginate;
        $q = $request->keyword;
        if (empty($q)) {
            $data = Alumni::orderBy('id', 'DESC')->paginate($paginate);
            $jumlahData = Alumni::count();
        } else {
            $data =  Alumni::orderBy('id', 'DESC')
                ->where('nama', 'like', '%' . $request->keyword . '%')
                ->orWhere('nim', 'like', '%' . $request->keyword . '%')
                ->paginate($paginate);
            $jumlahData =  Alumni::orderBy('id', 'DESC')
                ->where('nama', 'like', '%' . $request->keyword . '%')
                ->orWhere('nim', 'like', '%' . $request->keyword . '%')
                ->count();
        }
        $p = $jumlahData > $paginate ? true : false;

        return view('dashboard.alumni.index', [
            'judulHalaman' => 'Daftar Alumni',
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
        return view('dashboard.alumni.create', [
            'judulHalaman' => 'Tambah Alumni',
            'status_masuk' => $this->status_masuk,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['email', 'nullable', 'unique:alumni,email,except,id'],
            'hp' => ['nullable', 'unique:alumni,hp,except,id'],
            'alamat' => ['nullable'],
            'nama' => ['required'],
            'nim' => ['required', 'unique:alumni,nim,except,id', 'digits:8'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'tahun_masuk' => ['required', 'digits:4'],
            'status_masuk' => ['required', 'in:maba,pindahan'],
            'tahun_lulus' => ['required', 'digits:4'],
            'ipk' => ['required', 'numeric', 'max:4', 'min:2'],
            'foto' => ['nullable', 'image', 'max:3024'],
        ]);
        $foto = $request->file('foto');
        if (!empty($foto)) {
            $foto = $request->file('foto');
            $name = 'alumni-' . $request->nim . '.' . $foto->getClientOriginalExtension();
            $path = $this->path;
            $foto->move($path, $name);
            $validated['foto'] = $path . $name;
        }
        $alumni = Alumni::create($validated);
        $user = User::create([
            'username' => $alumni->nim,
            'password' => Hash::make($alumni->nim),
            'role' => 'alumni',
            'email' => $request->email,
            'hp' => $request->hp,
            'alamat' => $request->alamat,
            'nama' => $request->nama,
            'identitas' => $request->nim,
        ]);
        $alumni->update([
            'user_id' => $user->id,
        ]);
        notify()->success('Alumni berhasil ditambahkan!', 'Berhasil');
        return to_route('alumni.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Alumni::find($id);
        return view('dashboard.alumni.edit', [
            'judulHalaman' => 'Edit Alumni',
            'data' => $data,
            'status_masuk' => $this->status_masuk,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Alumni::find($id);
        $validated = $request->validate([
            'email' => ['email', 'nullable', $request->email == $data->email ? '' : 'unique:alumni,email,except,id'],
            'hp' => ['nullable', $request->hp == $data->hp ? '' : 'unique:alumni,hp,except,id'],
            'alamat' => ['nullable'],
            'nama' => ['required'],
            'nim' => [$data->nim != $request->nim ? 'unique:alumni,nim,except,id' : '', 'required', 'digits:8'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'tahun_masuk' => ['required', 'digits:4'],
            'status_masuk' => ['required', 'in:maba,pindahan'],
            'tahun_lulus' => ['required', 'digits:4'],
            'ipk' => ['required', 'numeric', 'max:4', 'min:2'],
            'foto' => ['nullable', 'image', 'max:3024']
        ]);
        $foto = $request->file('foto');
        $validated['foto'] = $data->foto;
        if (!empty($foto)) {
            if (!empty($data->foto)) {
                unlink($data->foto);
            }
            $name = 'alumni-' . $request->nim . '.' . $foto->getClientOriginalExtension();
            $path = $this->path;
            $foto->move($path, $name);
            $validated['foto'] = $path . $name;
        }
        $data->update($validated);
        $user = User::where('username', $data->nim)->first();
        $user->update([
            'username' => $request->nim,
            'password' => Hash::make($request->nim),
            'role' => 'alumni',
            'email' => $request->email,
            'hp' => $request->hp,
            'alamat' => $request->alamat,
            'nama' => $request->nama,
            'identitas' => $request->nim,
        ]);
        notify()->success('Data alumni berhasil diperbarui!', 'Berhasil');
        return to_route('alumni.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $alumni = Alumni::find($id);
        if (!empty($alumni->foto)) {
            unlink($alumni->foto);
        }
        $user = User::where('username', $alumni->nim)->first();
        $user->delete();
        $alumni->delete();
        notify()->success('Alumni berhasil dihapus!', 'Berhasil');
        return to_route('alumni.index');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new AlumniExport, 'alumni-' . date('dmY') . '.xlsx');
    }

    public function importPage()
    {
        return view('dashboard.alumni.import', [
            'judulHalaman' => 'Import Data Alumni'
        ]);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'file' => 'required|max:2048',
        ]);
        Excel::import(new AlumniImport, $request->file('file'));
        notify()->success('Import data alumni berhasil!', 'Berhasil');
        return to_route('alumni.index');
    }
}
