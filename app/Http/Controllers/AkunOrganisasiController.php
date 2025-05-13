<?php

namespace App\Http\Controllers;

use App\Models\Organisasi\Organisasi;
use App\Models\Organisasi\StrukturOrganisasi;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;

class AkunOrganisasiController extends Controller
{
    private $paginate = 10;
    private $path = 'upload/organisasi/';
    private $pathSK = 'upload/organisasi/sk/';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $paginate = $this->paginate;
        $q = $request->keyword;
        if (empty($q)) {
            $source = User::with('organisasi')->where('role', 'organisasi')->orderBy('id', 'DESC');
            $data = $source->paginate($paginate);
            $jumlahData = $source->count();
        } else {
            $source =  User::with('organisasi')->orderBy('id', 'DESC')
                ->where('role', 'organisasi')
                ->where('nama', 'like', '%' . $request->keyword . '%')
                ->orWhere('username', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('identitas', 'like', '%' . $request->keyword . '%');
            $data = $source->paginate($paginate);
            $jumlahData =  $source->count();
        }
        $p = $jumlahData > $paginate ? true : false;
        return view('dashboard.akun-organisasi.index', [
            'judulHalaman' => 'Daftar Akun Organisasi',
            'data' => $data,
            'p' => $p,
            'q' =>  $q,
        ])->with('i', (request()->input('page', 1) - 1) * $paginate);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('dashboard.akun-organisasi.create', [
            'judulHalaman' => 'Tambah Akun Organisasi'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => ['required', 'image', 'max:5024'],
            'logo' => ['required', 'image', 'max:3024'],
            'nama_organisasi' => ['required'],
            'nama_penanggung_jawab' => ['required'],
            'username' => ['required', 'unique:users,username'],
            'password' => ['required', 'min:8'],
            'keterangan_tambahan' => ['required'],
            'postingan' => ['required', 'in:0,1']
        ]);
        $foto = $request->file('foto');
        if (!empty($foto)) {
            $nama_foto =  $request->nama_organisasi . '-' . date('dmy His') . '.' . $foto->getClientOriginalExtension();
            $tujuan_foto = $this->path;
            $foto->move($tujuan_foto, $nama_foto);
        }
        $logo = $request->file('logo');
        if (!empty($logo)) {
            $nama_logo = $request->nama_organisasi . '-logo-' . date('dmy His') . '.' . $foto->getClientOriginalExtension();
            $tujuan_logo = $this->path;
            $logo->move($tujuan_logo, $nama_logo);
        }
        $user = User::create([
            'nama' => $request->nama_penanggung_jawab,
            'username' => $request->username,
            'password' =>  Hash::make($request->password),
            'role' => 'organisasi',
            'foto' => $tujuan_logo . $nama_logo,
        ]);
        Organisasi::create([
            'user_id' => $user->id,
            'foto' =>  $tujuan_foto . $nama_foto,
            'logo' => $tujuan_logo . $nama_logo,
            'nama_organisasi' => $request->nama_organisasi,
            'keterangan_tambahan' => $request->keterangan_tambahan,
            'can_upload' => $request->postingan
        ]);
        notify()->success('Organisasi Berhasil Ditambahkan!', 'Berhasil');
        return to_route('akun-organisasi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $organisasi = Organisasi::with('user')->findOrFail($id);
        $struktural = StrukturOrganisasi::where('organisasi_id', $organisasi->id)
            ->latest('awal_jabatan')
            ->paginate(10);
        return view('dashboard.akun-organisasi.show', [
            'judulHalaman' => 'Detail ' . $organisasi->nama_organisasi,
            'organisasi' => $organisasi,
            'struktural' => $struktural,
        ])->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Organisasi::with('user')->findOrFail($id);
        return view('dashboard.akun-organisasi.edit', [
            'judulHalaman' => 'Ubah Akun Organisasi',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Organisasi::with('user')->findOrFail($id);
        $user = User::findOrFail($data->user->id);
        $request->validate([
            'foto' => ['nullable', 'image', 'max:5024'],
            'logo' => ['nullable', 'image', 'max:3024'],
            'nama_organisasi' => ['required'],
            'nama_penanggung_jawab' => ['required'],
            'username' => ['required', ($user->username == $request->username) ? '' : 'unique:users,username'],
            'password' => ['nullable', 'min:8'],
            'keterangan_tambahan' => ['required'],
            'hak_akses_upload_kegiatan' => ['required', 'in:0,1']
        ]);
        $foto = $request->file('foto');
        if (!empty($foto)) {
            unlink($data->foto);
            $nama_foto =  $request->nama_organisasi . '-' . date('dmy His') . '.' . $foto->getClientOriginalExtension();
            $tujuan_foto = $this->path;
            $foto->move($tujuan_foto, $nama_foto);
            $simpanFoto = $tujuan_foto . $nama_foto;
        } else {
            $simpanFoto = $data->foto;
        }
        $logo = $request->file('logo');
        if (!empty($logo)) {
            unlink($data->logo);
            $nama_logo =  $request->nama_organisasi . '-logo-' . date('dmy His') . '.' . $foto->getClientOriginalExtension();
            $tujuan_logo = $this->path;
            $logo->move($tujuan_logo, $nama_logo);
            $simpanLogo = $tujuan_logo . $nama_logo;
        } else {
            $simpanLogo = $data->logo;
        }
        if (!empty($request->password)) {
            $password = Hash::make($request->password);
            $user->update([
                'nama' => $request->nama_penanggung_jawab,
                'username' => $request->username,
                'password' =>  $password,
                'foto' => $simpanLogo,
            ]);
        } else {
            $user->update([
                'nama' => $request->nama_penanggung_jawab,
                'username' => $request->username,
                'foto' => $simpanLogo,
            ]);
        }

        $data->update([
            'foto' => $simpanFoto,
            'logo' => $simpanLogo,
            'nama_organisasi' => $request->nama_organisasi,
            'keterangan_tambahan' => $request->keterangan_tambahan,
            'can_upload' => $request->hak_akses_upload_kegiatan
        ]);
        notify()->success('Organisasi Berhasil Diubah!', 'Berhasil');
        return to_route('akun-organisasi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $organisasi = Organisasi::with('user')->findOrFail($id);
            $user = User::findOrFail($organisasi->user_id);
            unlink($user->foto);
            unlink($organisasi->foto);
            $organisasi->delete();
            $user->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            notify()->error($e->getMessage(), 'Ggagal');
            return to_route('akun-organisasi.index');
        }

        notify()->success('Organisasi Berhasil Dihapus!', 'Berhasil');
        return to_route('akun-organisasi.index');
    }

    public function tambahAnggota(Request $request)
    {
        $request->validate([
            'organisasi' => ['required', 'exists:organisasi,id'],
            'awal_jabatan' => ['required', 'date'],
            'akhir_jabatan' => ['required', 'date', 'after:' . $request->awal_jabatan . ''],
            'ketua' => ['required'],
            'wakil_ketua' => ['required'],
            'sekretaris' => ['required'],
            'bendahara' => ['required'],
            'sk' => ['required', 'mimes:pdf']
        ]);
        $fileSK = $request->file('sk');
        if (!empty($fileSK)) {
            $namaFileSK = 'sk-' . $request->organisasi . '-' . date('dmy His') . '.' . $fileSK->getClientOriginalExtension();
            $path = $this->pathSK;
            $fileSK->move($path, $namaFileSK);
            $simpanSK = $path . $namaFileSK;
        } else {
            $simpanSK = '';
        }
        StrukturOrganisasi::create([
            'organisasi_id' => $request->organisasi,
            'awal_jabatan' => $request->awal_jabatan,
            'akhir_jabatan' => $request->akhir_jabatan,
            'ketua' => $request->ketua,
            'wakil' => $request->wakil_ketua,
            'sekretaris' => $request->sekretaris,
            'bendahara' => $request->bendahara,
            'sk' => $simpanSK,
        ]);
        notify()->success('Riwayat sktruktural organisasi berhasil ditambahkan!', 'Berhasil');
        return redirect()->back();
    }

    public function hapusAnggota($id)
    {
        $data = StrukturOrganisasi::findOrFail($id);
        if (!empty($data->sk)) {
            unlink($data->sk);
        }
        $data->delete();
        notify()->success('Riwayat struktural organisasi berhasil dihapus!', 'Berhasil');
        return redirect()->back();
    }
}
