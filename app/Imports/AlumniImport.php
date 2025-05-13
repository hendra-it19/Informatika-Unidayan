<?php

namespace App\Imports;

use App\Models\Alumni\Alumni;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;



class AlumniImport implements ToModel, WithHeadingRow, WithValidation, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $user = User::create([
            'username' => $row['nim'],
            'password' => Hash::make($row['nim']),
            'role' => 'alumni',
            'nama' => $row['nama'],
            'identitas' => $row['nim'],
            'email' => $row['email'],
            'hp' => $row['hp'],
            'alamat' => $row['alamat'],
        ]);
        Alumni::create([
            'user_id' => $user->id,
            'nama' => $row['nama'],
            'nim' => $row['nim'],
            'email' => $row['email'],
            'hp' => $row['hp'],
            'alamat' => $row['alamat'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_lahir']),
            'tahun_masuk' => $row['tahun_masuk'],
            'status_masuk' => $row['status_masuk'],
            'tahun_lulus' => $row['tahun_lulus'],
            'ipk' => $row['ipk'],
        ]);
        return;
        // return new Alumni([
        // ]);
    }




    /**
     * Write code on Method
     *
     * @return response()
     */
    public function rules(): array
    {
        return [
            'email' => ['email', 'nullable', 'unique:alumni,email,except,id',],
            'hp' => ['nullable', 'unique:alumni,hp,except,id'],
            'alamat' => ['nullable'],
            'nama' => ['required'],
            'nim' => ['required', 'unique:alumni,nim,except,id', 'digits:8'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'tahun_masuk' => ['required', 'digits:4'],
            'status_masuk' => ['required', 'in:maba,pindahan'],
            'tahun_lulus' => ['required', 'digits:4'],
            'ipk' => ['required', 'numeric', 'max:4', 'min:1'],
        ];
    }
}
