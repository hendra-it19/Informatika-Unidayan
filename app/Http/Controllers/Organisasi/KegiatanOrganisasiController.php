<?php

namespace App\Http\Controllers\Organisasi;

use App\Http\Controllers\Controller;
use App\Models\Organisasi\KegiatanOrganisasi;
use App\Models\Organisasi\Organisasi;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KegiatanOrganisasiController extends Controller
{

    private $paginate = 10;
    private $excerpt = 180;
    private $path = 'upload/kegiatan-organisasi/';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $paginate = $this->paginate;
        $q = $request->keyword;
        if (empty($q)) {
            $source = KegiatanOrganisasi::with('organisasi')->latest('id');
            $data = $source->paginate($paginate);
            $jumlahData = $source->count();
        } else {
            $source =  KegiatanOrganisasi::with('organisasi')->latest('id')
                ->whereHas('organisasi', function ($query) use ($q) {
                    return $query->where('nama_organisasi', 'LIKE', '%' . $q . '%');
                })
                ->orWhere('judul', 'LIKE', '%' . $request->keyword . '%');
            $data = $source->paginate($paginate);
            $jumlahData =  $source->count();
        }
        $p = $jumlahData > $paginate ? true : false;
        return view('dashboard.kegiatan-organisasi.index', [
            'judulHalaman' => 'Kegiatan Organisasi',
            'data' => $data,
            'pagination' => $p,
            'keyword' =>  $q,
        ])
            ->with('i', (request()->input('page', 1) - 1) * $paginate);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $user = Auth::user();
        $organisasi = Organisasi::with('user')->latest('id')->get();;
        if ($user->role == 'organisasi') {
            $user = $user;
            $organisasi = $user->organisasi;
        }
        return view('dashboard.kegiatan-organisasi.create', [
            'judulHalaman' => 'Tambah Kegiatan Organisasi',
            'organisasi' => $organisasi,
            'role' => $user->role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'judul' => ['required'],
            'foto' => ['required', 'image', 'max:5024'],
            'hashtag' => ['required'],
            'deskripsi' => ['required'],
            'organisasi' => [$user->role != 'organisasi' ? 'required' : 'nullable']
        ]);
        if ($user->role == 'organisasi') {
            $organisasiId = $request->organisasi_id;
        } else {
            $organisasiId = $request->organisasi;
        }
        $organisasi  = Organisasi::find($organisasiId);
        $slug = SlugService::createSlug(KegiatanOrganisasi::class, 'slug', $request->judul);
        $foto = $request->file('foto');
        $simpanFoto = '';
        if (!empty($foto)) {
            $namaFoto = $slug . '.' . $foto->getClientOriginalExtension();
            $lokasiFoto = $this->path;
            $simpanFoto = $lokasiFoto . $namaFoto;
            $foto->move($lokasiFoto, $namaFoto);
        }
        KegiatanOrganisasi::create([
            'organisasi_id' => $organisasi->id,
            'judul' => $request->judul,
            'slug' => $slug,
            'excerpt' => $this->makeExcerpt($request->deskripsi),
            'deskripsi' => $request->deskripsi,
            'foto' => $simpanFoto,
            'hashtag' => $request->hashtag,
        ]);
        notify()->success('Data kegiatan organisasi berhasil ditambahkan!', 'Berhasil');
        return to_route('postingan-organisasi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(KegiatanOrganisasi $kegiatanOrganisasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();
        $organisasi = Organisasi::with('user')->latest('id')->get();
        if ($user->role == 'organisasi') {
            $user = $user;
            $organisasi = $user->organisasi;
        }
        $kegiatan = KegiatanOrganisasi::with('organisasi')->findOrFail($id);
        return view('dashboard.kegiatan-organisasi.edit', [
            'judulHalaman' => 'Ubah Data Kegiatan',
            'data' => $kegiatan,
            'organisasi' => $organisasi,
            'role' => $user->role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kegiatanOrganisasi = KegiatanOrganisasi::findOrFail($id);
        $user = Auth::user();
        $request->validate([
            'judul' => ['required'],
            'foto' => ['nullable', 'image', 'max:5024'],
            'hashtag' => ['required'],
            'deskripsi' => ['required'],
            'organisasi' => [$user->role != 'organisasi' ? 'required' : 'nullable']
        ]);
        if ($user->role == 'organisasi') {
            $organisasiId = $request->organisasi_id;
        } else {
            $organisasiId = $request->organisasi;
        }
        $organisasi  = Organisasi::find($organisasiId);
        $slug = SlugService::createSlug(KegiatanOrganisasi::class, 'slug', $request->judul);
        $foto = $request->file('foto');
        $simpanFoto = $kegiatanOrganisasi->foto;
        if (!empty($foto)) {
            unlink($kegiatanOrganisasi->foto);
            $namaFoto = $slug . '.' . $foto->getClientOriginalExtension();
            $lokasiFoto = $this->path;
            $simpanFoto = $lokasiFoto . $namaFoto;
            $foto->move($lokasiFoto, $namaFoto);
        }
        $kegiatanOrganisasi->update([
            'organisasi_id' => $organisasi->id,
            'judul' => $request->judul,
            'slug' => $slug,
            'excerpt' => $this->makeExcerpt($request->deskripsi),
            'deskripsi' => $request->deskripsi,
            'foto' => $simpanFoto,
            'hashtag' => $request->hashtag,
        ]);
        notify()->success('Data kegiatan organisasi berhasil diubah!', 'Berhasil');
        return to_route('postingan-organisasi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kegiatanOrganisasi = KegiatanOrganisasi::findOrFail($id);
        if (!empty($kegiatanOrganisasi->foto)) {
            unlink($kegiatanOrganisasi->foto);
        }
        $kegiatanOrganisasi->delete();
        notify()->success('Data kegiatan organisasi berhasil dihapus!', 'Berhasil');
        return to_route('postingan-organisasi.index');
    }

    private function makeExcerpt($data)
    {
        $removeTag = strip_tags($data);
        $hasil = Str::limit($removeTag, $this->excerpt);
        return $hasil;
    }
}
