<?php

namespace App\Livewire;

use App\Models\KP\KerjaPraktek;
use App\Models\KP\KerjaPraktekPendaftaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class DaftarKerjaPraktek extends Component
{

    use WithFileUploads;

    public $loading = false;
    public $isLoadingMitra = false;

    public $tab = 'baru';
    public $path = 'upload/kerja-praktek/transkrip/';

    protected $queryString = ['tab'];

    public $mitra, $tahun, $semester, $tanggal_mulai, $tanggal_selesai;

    public $sks_tempuh, $transkrip_nilai;

    public $listTahun = [];
    public $listMitra = [];
    public $simpanMitra;
    public $listPendaftar = [];
    public $showModal = false;
    public $loadingModal = false;

    public function render()
    {
        $this->listTahun = KerjaPraktek::select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc') // atau 'asc'
            ->pluck('tahun');
        return view('livewire.daftar-kerja-praktek');
    }

    public function simpanBaru()
    {
        try {
            $this->loading = true;

            $this->validate([
                'mitra' => 'required',
                'tahun' => 'required',
                'semester' => 'required|in:ganjil,genap',
                'tanggal_mulai' => 'required',
                'tanggal_selesai' => 'required|date|after:tanggal_mulai',
                'sks_tempuh' => 'required|numeric',
                'transkrip_nilai' => 'required|file|max:1024|mimes:pdf',
            ]);

            DB::beginTransaction();

            $kerjaPraktek = KerjaPraktek::create([
                'diusulkan_oleh' => Auth::user()->nama . ' (' . Auth::user()->identitas . ')',
                'mitra' => $this->mitra,
                'tahun' => $this->tahun,
                'semester' => $this->semester,
                'tanggal_mulai' => $this->tanggal_mulai,
                'tanggal_selesai' => $this->tanggal_selesai,
            ]);

            $filename = Auth::user()->identitas . '.' . $this->transkrip_nilai->getClientOriginalExtension();
            $this->transkrip_nilai->storeAs($this->path, $filename, 'public_path');

            KerjaPraktekPendaftaran::create([
                'kerja_praktek_id' => $kerjaPraktek->id,
                'mahasiswa_id' => Auth::user()->mahasiswa->id,
                'sks_ditempuh' => $this->sks_tempuh,
                'transkrip_nilai' => $this->path . $filename,
            ]);

            DB::commit();

            $this->loading = false;
            notify()->success('Berhasil mendaftarkan kelompok KP', 'Berhasil!');

            return redirect()->route('kerja-praktek.index');
        } catch (ValidationException $e) {
            $this->loading = false;
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            $this->loading = false;
            DB::rollBack();
            notify()->error('Gagal mendaftarkan kelompok KP', 'Error!');
            return redirect()->route('kerja-praktek.index');
        }
    }


    public function simpanLama()
    {

        try {
            $this->loading = true;
            $this->validate([
                'sks_tempuh' => 'required|numeric',
                'transkrip_nilai' => 'required|file|max:1024|mimes:pdf',
            ]);
            DB::beginTransaction();
            $filename = Auth::user()->identitas . '.' . $this->transkrip_nilai->getClientOriginalExtension();
            $this->transkrip_nilai->storeAs($this->path, $filename, 'public_path');
            KerjaPraktekPendaftaran::create([
                'kerja_praktek_id' => $this->simpanMitra->id,
                'mahasiswa_id' => Auth::user()->mahasiswa->id,
                'sks_ditempuh' => $this->sks_tempuh,
                'transkrip_nilai' => $this->path . $filename,
            ]);
            DB::commit();

            $this->loading = false;
            notify()->success('Berhasil mendaftarkan kelompok KP', 'Berhasil!');
            return redirect()->route('kerja-praktek.index');
        } catch (ValidationException $e) {
            $this->loading = false;
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            $this->loading = false;
            DB::rollBack();
            notify()->error('Gagal mendaftarkan kelompok KP', 'Error!');
            return redirect()->route('kerja-praktek.index');
        }
    }


    public function perbaruiTahun()
    {
        $this->updateListMitra();
    }

    public function perbaruiSemester()
    {
        $this->updateListMitra();
    }

    public function updateListMitra()
    {
        $this->isLoadingMitra = true;
        if ($this->tahun && $this->semester) {
            $this->listMitra = KerjaPraktek::where('tahun', $this->tahun)
                ->where('semester', $this->semester)
                ->whereNotNull('mitra')
                ->get();
        } else {
            $this->listMitra = [];
        }
        // Reset pilihan mitra saat tahun/semester berganti
        $this->mitra = null;
        $this->isLoadingMitra = false;
    }

    public function perbaruiMitra()
    {
        $this->simpanMitra = KerjaPraktek::where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            ->first();
        $this->tanggal_mulai = $this->simpanMitra->tanggal_mulai;
        $this->tanggal_selesai = $this->simpanMitra->tanggal_selesai;
    }

    public function bukaModal()
    {
        $this->loadingModal = true;
        $this->listPendaftar = KerjaPraktekPendaftaran::with('mahasiswa', 'mahasiswa.user')
            ->where('kerja_praktek_id', $this->simpanMitra->id)
            ->get();
        $this->showModal = true;
        $this->loadingModal = false;
    }

    public function tutupModal()
    {
        $this->showModal = false;
    }
}
