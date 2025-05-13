<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunMahasiswaController extends Controller
{

    private $paginate = 10;
    private $status_masuk = array(
        [
            'id' => 1,
            'nama' => 'maba',
        ],
        [
            'id' => 2,
            'nama' => 'pindahan'
        ]
    );
    private $path = 'upload/mahasiswa/';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $this->paginate;
        $q = $request->keyword;
        if (empty($q)) {
            $data = User::with('mahasiswa')->where('role', 'mahasiswa')->orderBy('id', 'DESC')->paginate($paginate);
            $jumlahData = User::with('mahasiswa')->where('role', 'mahasiswa')->count();
        } else {
            $data =  User::with('mahasiswa')->orderBy('id', 'DESC')
                ->where('role', 'mahasiswa')
                ->where('nama', 'like', '%' . $request->keyword . '%')
                ->orWhere('identitas', 'like', '%' . $request->keyword . '%')
                ->paginate($paginate);
            $jumlahData =  User::with('mahasiswa')->orderBy('id', 'DESC')
                ->where('role', 'mahasiswa')
                ->where('nama', 'like', '%' . $request->keyword . '%')
                ->orWhere('identitas', 'like', '%' . $request->keyword . '%')
                ->count();
        }

        $p = $jumlahData > $paginate ? true : false;

        return view('dashboard.akun-mahasiswa.index', [
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
        return view('dashboard.akun-mahasiswa.create', [
            'judulHalaman' => 'Tambah Mahasiswa',
            'status_masuk' => $this->status_masuk,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required'],
            'nim' => ['required', 'unique:users,identitas,except,id'],
            'hp' => ['nullable', 'unique:users,hp,except,id'],
            'email' => ['nullable', 'email', 'unique:users,email,except,id'],
            'alamat' => ['nullable'],
            'foto' => ['nullable', 'image', 'max:3024'],
            'tahun_masuk' => ['digits:4', 'required'],
            'status_masuk' => ['in:maba,pindahan', 'required'],
            'tempat_lahir' => ['nullable'],
            'tanggal_lahir' => ['nullable'],
        ]);
        $foto = $request->file('foto');
        $fileFoto = null;
        if (!empty($foto)) {
            $name = 'mahasiswa-' . $request->nim . '.' . $foto->getClientOriginalExtension();
            $path = $this->path;
            $foto->move($path, $name);
            $fileFoto = $path . $name;
        }
        $user = User::create([
            'username' => $request->nim,
            'password' => Hash::make($request->nim),
            'nama' => $request->nama,
            'identitas' => $request->nim,
            'hp' => $request->hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'role' => 'mahasiswa',
            'foto' => $fileFoto,
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tahun_masuk' => $request->tahun_masuk,
            'status_masuk' => $request->status_masuk,
        ]);
        notify()->success('Data berhasil ditambahkan!', 'Berhasil');
        return to_route('akun-mahasiswa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::with('mahasiswa')->find($id);
        return view('dashboard.akun-mahasiswa.edit', [
            'data' => $user,
            'status_masuk' => $this->status_masuk,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        $request->validate([
            'nama' => ['required'],
            'nim' => ['required', $request->nim == $user->identitas ? '' : 'unique:users,identitas,except,id'],
            'hp' => ['nullable', $request->hp == $user->hp ? '' : 'unique:users,hp,except,id'],
            'email' => ['nullable', $request->email == $user->email ? '' : 'unique:users,email,except,id'],
            'alamat' => ['nullable'],
            'foto' => ['nullable', 'image', 'max:3024'],
            'tahun_masuk' => ['digits:4', 'required'],
            'status_masuk' => ['in:maba,pindahan', 'required'],
            'tempat_lahir' => ['nullable'],
            'tanggal_lahir' => ['nullable'],
        ]);

        $foto = $request->file('foto');
        $fileFoto = $user->foto;
        if (!empty($foto)) {
            if (!empty($user->foto)) {
                unlink($user->foto);
            }
            $name = 'mahasiswa-' . $request->nim . '.' . $foto->getClientOriginalExtension();
            $path = $this->path;
            $foto->move($path, $name);
            $fileFoto = $path . $name;
        }
        $user->update([
            'username' => $request->nim,
            'password' => Hash::make($request->nim),
            'nama' => $request->nama,
            'identitas' => $request->nim,
            'hp' => $request->hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'foto' => $fileFoto,
        ]);
        $mahasiswa->update([
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tahun_masuk' => $request->tahun_masuk,
            'status_masuk' => $request->status_masuk,
        ]);
        notify()->success('Data berhasil diubah!', 'Berhasil');
        return to_route('akun-mahasiswa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!empty($user->foto)) {
            unlink($user->foto);
        }
        $user->delete();
        notify('Data berhasil dihapus!', 'Berhasil');
        return to_route('akun-mahasiswa.index');
    }
}
