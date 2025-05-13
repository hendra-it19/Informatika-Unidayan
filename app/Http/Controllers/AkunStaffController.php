<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunStaffController extends Controller
{

    private $paginate = 10;
    private $path = 'upload/staff/';
    private $hak_akses_kaprodi =  array(
        [
            'id' => 1,
            'nama' => 'dosen',
        ],
        [
            'id' => 2,
            'nama' => 'kaprodi'
        ],
        [
            'id' => 3,
            'nama' => 'admin'
        ]
    );
    private $hak_akses =  array(
        [
            'id' => 1,
            'nama' => 'dosen',
        ],
        [
            'id' => 2,
            'nama' => 'admin'
        ]
    );
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $this->paginate;
        $q = $request->keyword;
        if (empty($q)) {
            $data = User::whereIn('role', ['dosen', 'kaprodi', 'admin'])->orderBy('id', 'DESC')->paginate($paginate);
            $jumlahData = User::whereIn('role', ['dosen', 'kaprodi', 'admin'])->count();
        } else {
            $data =  User::whereIn('role', ['dosen', 'kaprodi', 'admin'])
                ->where('nama', 'like', '%' . $request->keyword . '%')
                ->orWhere('identitas', 'like', '%' . $request->keyword . '%')
                ->orderBy('id', 'DESC')
                ->paginate($paginate);
            $jumlahData =  User::whereIn('role', ['dosen', 'kaprodi', 'admin'])
                ->where('nama', 'like', '%' . $request->keyword . '%')
                ->orWhere('identitas', 'like', '%' . $request->keyword . '%')
                ->count();
        }
        $p = $jumlahData > $paginate ? true : false;

        return view('dashboard.akun-staff.index', [
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
        $cek_kaprodi =  User::where('role', 'kaprodi')->count() < 0 ? true : false;
        return view('dashboard.akun-staff.create', [
            'judulHalaman' => 'Tambah Staff',
            'hak_akses' => $cek_kaprodi ? $this->hak_akses_kaprodi : $this->hak_akses,
            'is_kaprodi' => $cek_kaprodi,
            'verifikator' => User::where('is_verificator', true)->count(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required'],
            'nomor_identitas' => ['required', 'unique:users,identitas,except,id'],
            'hp' => ['nullable', 'unique:users,hp,except,id'],
            'email' => ['nullable', 'email', 'unique:users,email,except,id'],
            'alamat' => ['nullable'],
            'foto' => ['nullable', 'image', 'max:3024'],
            'username' => ['unique:users,username,except,id', empty($request->password) ? 'nullable' : 'required'],
            'password' => [empty($request->username) ? 'nullable' : 'required'],
            'verifikator' => ['required', 'in:0,1'],
        ]);
        $foto = $request->file('foto');
        $fileFoto = null;
        if (!empty($foto)) {
            $name = 'staff-' . $request->nomor_identitas . '.' . $foto->getClientOriginalExtension();
            $path = $this->path;
            $foto->move($path, $name);
            $fileFoto = $path . $name;
        }
        if (User::where('is_verificator', true)->count() >= 5) {
            notify()->warning('verifikator sudah memenuhi kuota!', 'Perhatian');
            return redirect()->back();
        }
        User::create([
            'username' => empty($request->username) ? $request->nomor_identitas : $request->username,
            'password' => empty($request->password) ? Hash::make($request->nomor_identitas) : Hash::make($request->password),
            'nama' => $request->nama,
            'identitas' => $request->nomor_identitas,
            'hp' => $request->hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'role' => $request->hak_akses,
            'foto' => $fileFoto,
            'is_verificator' => ($request->role == 'kaprodi') ? 1 : intval($request->verifikator),
        ]);
        notify()->success('Data staff berhasil ditambahkan!', 'Berhasil');
        return to_route('akun-staff.index');
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
        $user = User::find($id);
        $cek_kaprodi =  User::where('role', 'kaprodi')->count() < 0 ? true : false;
        if ($cek_kaprodi || $user->role == 'kaprodi') {
            $hasil = $this->hak_akses_kaprodi;
        } else {
            $hasil = $this->hak_akses;
        }
        return view('dashboard.akun-staff.edit', [
            'data' => $user,
            'hak_akses' => $hasil,
            'verifikator' => User::where('is_verificator', true)->count(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'nama' => ['required'],
            'nomor_identitas' => ['required', $user->identitas == $request->nomor_identitas ? '' : 'unique:users,identitas,except,id'],
            'hp' => ['nullable', $user->hp == $request->hp ? '' : 'unique:users,hp,except,id'],
            'email' => ['nullable', 'email', $user->email == $request->email ? '' : 'unique:users,email,except,id'],
            'alamat' => ['nullable'],
            'foto' => ['nullable', 'image', 'max:3024'],
            'username' => ['nullable', $request->username == $user->username ? '' : 'unique:users,username,except,id'],
            'password' => ['nullable'],
            'verifikator' => ['required', 'in:0,1'],
        ]);
        $countVerificator = User::where('is_verificator', true)->count();
        if ($countVerificator >= 5 && $request->is_verificator == 1 && $user->is_verificator != 1) {
            notify()->error('verifikator sudah memenuhi kuota!', 'Perhatian');
            return redirect()->back();
        }
        $foto = $request->file('foto');
        $fileFoto = null;
        if (!empty($foto)) {
            if (!empty($user->foto)) {
                unlink($user->foto);
            }
            $name = 'staff-' . $request->nomor_identitas . '.' . $foto->getClientOriginalExtension();
            $path = $this->path;
            $foto->move($path, $name);
            $fileFoto = $path . $name;
        }
        $user->update([
            'username' => empty($request->username) ?  $user->username : $request->username,
            'password' => empty($request->password) ? $user->password : Hash::make($request->password),
            'nama' => $request->nama,
            'identitas' => $request->nomor_identitas,
            'hp' => $request->hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'role' => $request->hak_akses,
            'foto' => $fileFoto,
            'is_verificator' => $request->role == 'kaprodi' ? 1 : $request->verifikator,
        ]);
        notify()->success('Data staff berhasil diubah!', 'Berhasil');
        return to_route('akun-staff.index');
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
        notify('Data staff berhasil dihapus!', 'Berhasil');
        return to_route('akun-staff.index');
    }
}
