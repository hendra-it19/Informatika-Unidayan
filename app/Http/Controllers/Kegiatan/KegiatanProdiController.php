<?php

namespace App\Http\Controllers\Kegiatan;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan\KategoriKegiatanProdi;
use App\Models\Kegiatan\KegiatanProdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class KegiatanProdiController extends Controller
{

    private $paginate = 10;
    private $excerpt = 180;
    private $path = 'upload/kegiatan-prodi/';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $data = KegiatanProdi::latest('id')->paginate($this->paginate);
        $jumlahData = KegiatanProdi::count();
        if (!empty($keyword)) {
            $data = KegiatanProdi::where('judul', 'LIKE', '%' . $keyword . '%')
                ->orderBy('id', 'DESC')->paginate($this->paginate);
            $jumlahData = KegiatanProdi::where('judul', 'LIKE', '%' . $keyword . '%')->count();
        }
        $pagination = $jumlahData > $this->paginate ? true : false;
        return view('dashboard.kegiatan-prodi.index', [
            'judulHalaman' => 'Kategori Kegiatan Prodi',
            'data' => $data,
            'keyword' => $keyword,
            'pagination' => $pagination
        ])->with('i', (request()->input('page', 1) - 1) * $this->paginate);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.kegiatan-prodi.create', [
            'judulHalaman' => 'Tambah Kegiatan',
            'kategori' => KategoriKegiatanProdi::latest('id')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['required'],
            'foto' => ['required', 'mimes:png,jpg,jpeg,webp,svg', 'max:5024'],
            'deskripsi' => ['required'],
            'kategori' => ['required', 'exists:kategori_kegiatan_prodi,id'],
            'tagsvalue' => ['required'],
        ]);

        $foto = $request->file('foto');
        $simpanFoto = null;
        if (!empty($foto)) {
            $name = Str::slug($request->judul) . '-' . date('dmyHis') . '.' . $foto->getClientOriginalExtension();
            $path = $this->path;
            $foto->move($path, $name);
            $simpanFoto = $path . $name;
        }

        KegiatanProdi::create([
            'judul' => ucwords($request->judul),
            'kategori_id' => $request->kategori,
            'user_id' => Auth::user()->id,
            'excerpt' => $this->makeExcerpt($request->deskripsi),
            'foto' => $simpanFoto,
            'deskripsi' => $request->deskripsi,
            'hashtag' => $request->tagsvalue,
        ]);
        notify()->success('kegiatan berhasil ditambahkan!', 'Berhasil');
        return to_route('kegiatan-prodi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(KegiatanProdi $kegiatanProdi) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KegiatanProdi $kegiatanProdi)
    {
        return view('dashboard.kegiatan-prodi.edit', [
            'judulHalaman' => 'Perbarui Kegiatan',
            'data' => $kegiatanProdi,
            'kategori' => KategoriKegiatanProdi::latest('id')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KegiatanProdi $kegiatanProdi)
    {
        $request->validate([
            'judul' => ['required'],
            'foto' => ['nullable', 'mimes:png,jpg,jpeg,webp,svg', 'max:5024'],
            'deskripsi' => ['required'],
            'kategori' => ['required', 'exists:kategori_kegiatan_prodi,id'],
            'tagsvalue' => ['nullable'],
        ]);

        $foto = $request->file('foto');
        $simpanFoto = $kegiatanProdi->foto;
        if (!empty($foto)) {
            unlink($kegiatanProdi->foto);
            $name = Str::slug($request->judul) . '-' . date('dmyHis') . '.' . $foto->getClientOriginalExtension();
            $path = $this->path;
            $foto->move($path, $name);
            $simpanFoto = $path . $name;
        }

        $kegiatanProdi->update([
            'judul' => ucwords($request->judul),
            'kategori_id' => $request->kategori,
            'user_id' => Auth::user()->id,
            'excerpt' => $this->makeExcerpt($request->deskripsi),
            'foto' => $simpanFoto,
            'deskripsi' => $request->deskripsi,
            'hashtag' => empty($request->tagsvalue) ? $kegiatanProdi->hashtag : $request->tagsvalue,
        ]);
        notify()->success('kegiatan berhasil diperbarui!', 'Berhasil');
        return to_route('kegiatan-prodi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KegiatanProdi $kegiatanProdi)
    {
        if (!empty($kegiatanProdi->foto)) {
            unlink($kegiatanProdi->foto);
        }
        $kegiatanProdi->delete();
        notify()->success('kegiatan berhasil dihapus!', 'Berhasil');
        return to_route('kegiatan-prodi.index');
    }

    private function makeExcerpt($data)
    {
        $removeTag = strip_tags($data);
        $hasil = Str::limit($removeTag, $this->excerpt);
        return $hasil;
    }
}
