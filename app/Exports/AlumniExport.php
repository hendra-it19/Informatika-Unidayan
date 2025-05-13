<?php

namespace App\Exports;

use App\Models\Alumni\Alumni;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlumniExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Alumni::select('id', 'nama', 'nim', 'email', 'hp', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'tahun_masuk', 'status_masuk', 'tahun_lulus', 'ipk')->get();
    }
    public function headings(): array
    {
        return ["ID", "Nama", "Nim", "Email", "Handphone", "Alamat", "Tempat Lahir", "Tanggal Lahir", "Tahun Masuk", "Status Masuk", "Tahun Lulus", "IPK"];
    }
}
