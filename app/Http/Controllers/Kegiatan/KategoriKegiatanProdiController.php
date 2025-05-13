<?php

namespace App\Http\Controllers\Kegiatan;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan\KategoriKegiatanProdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriKegiatanProdiController extends Controller
{

    private $paginate = 10;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        notify()->success('dsfa', 'berhasil');
        $keyword = $request->keyword;
        $data = KategoriKegiatanProdi::latest('id')->paginate($this->paginate);
        $jumlahData = KategoriKegiatanProdi::count();
        if (!empty($keyword)) {
            $data = KategoriKegiatanProdi::where('nama', 'LIKE', '%' . $keyword . '%')
                ->orderBy('id', 'DESC')->paginate($this->paginate);
            $jumlahData = KategoriKegiatanProdi::where('nama', 'LIKE', '%' . $keyword . '%')
                ->count();
        }
        $pagination = $jumlahData > $this->paginate ? true : false;
        return view('dashboard.kategori-kegiatan-prodi.index', [
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
        return view('dashboard.kategori-kegiatan-prodi.create', [
            'judulHalaman' => 'Tambah Kategori',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => ['required', 'unique:kategori_kegiatan_prodi,nama,except,id'],
        ]);
        KategoriKegiatanProdi::create([
            'nama' => strtoupper($request->kategori),
            'user_id' => Auth::user()->id,
        ]);
        notify()->success('kategori berhasil ditambahkan!', 'Berhasil');
        return to_route('kategori-kegiatan-prodi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriKegiatanProdi $kategoriKegiatanProdi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriKegiatanProdi $kategoriKegiatanProdi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriKegiatanProdi $kategoriKegiatanProdi)
    {
        $request->validate([
            'kategori' => ['required', $request->kategori == $kategoriKegiatanProdi->nama ? '' : 'unique:kategori_kegiatan_prodi,nama,except,id']
        ]);
        $kategoriKegiatanProdi->update([
            'nama' => strtoupper($request->kategori),
        ]);
        notify()->success('kategori berhasil diperbarui!', 'Berhasil');
        return to_route('kategori-kegiatan-prodi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriKegiatanProdi $kategoriKegiatanProdi)
    {
        if (count($kategoriKegiatanProdi->kegiatan) > 0) {
            notify()->error('Kategori telah digunakan!', 'Gagal');
            return to_route('kategori-kegiatan-prodi.index');
        }
        $kategoriKegiatanProdi->delete();
        notify()->success('Kategori berhasil dihapus!', 'Berhasil');
        return to_route('kategori-kegiatan-prodi.index');
    }

    public function api(Request $request)
    {
        $data = KategoriKegiatanProdi::where('nama', 'like', '%' . $request->search . '%')->paginate();
        return response()->json($data, 200);
    }
}
