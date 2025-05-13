<?php

namespace App\Http\Controllers;

use App\Models\Alumni\Alumni;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Break_;

class PengaturanAkunController extends Controller
{
    public function index()
    {
        return view('dashboard.pengaturan-akun', [
            'judulHalaman' => 'Pengaturan Akun',
            'role' => Auth::user()->role,
            'user' => Auth::user(),
        ]);
    }

    public function password(Request $request)
    {
        $request->validate([
            'password' => ['required', 'min:8'],
            'konfirmasi_password' => ['required', 'same:password'],
        ]);
        $user = User::where('username', Auth::user()->username)->first();
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        notify()->success('Password berhasil diperbarui!', 'Berhasil');
        return to_route('pengaturan-akun.index');
    }

    public function mahasiswa(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        $request->validate([
            'foto' => ['image', 'max:2024', empty(Auth::user()->foto) ? 'required' : 'nullable'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'hp' => ['required', 'numeric', $request->hp != $user->hp ? 'unique:users,hp,except,id' : ''],
            'email' => ['required', 'email', $request->email != $user->email ? 'unique:users,email,except,id' : ''],
            'alamat' => ['required'],
        ]);

        $foto = $request->file('foto');
        $fileFoto = Auth::user()->foto;
        if (!empty($foto)) {
            if (!empty($user->foto)) {
                unlink($user->foto);
            }
            $name = 'mahasiswa-' . Auth::user()->identitas . '.' . $foto->getClientOriginalExtension();
            $path = 'upload/mahasiswa/';
            $foto->move($path, $name);
            $fileFoto = $path . $name;
        }

        $user->update([
            'hp' => $request->hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'foto' => $fileFoto,
        ]);
        $mahasiswa->update([
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);
        notify('Data perhasil diperbarui!', 'Berhasil');
        return redirect()->back();
    }

    public function alumni(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $alumni = Alumni::where('user_id', $user->id)->first();
        $request->validate([
            'foto' => ['image', 'max:2024', empty(Auth::user()->foto) ? 'required' : 'nullable'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'hp' => ['required', 'numeric', $request->hp != $user->hp ? 'unique:users,hp,except,id' : ''],
            'email' => ['required', 'email', $request->email != $user->email ? 'unique:users,email,except,id' : ''],
            'alamat' => ['required'],
            'status' => ['required'],
            'keterangan' => ['required'],
        ]);
        $foto = $request->file('foto');
        $fileFoto = Auth::user()->foto;
        if (!empty($foto)) {
            if (!empty($user->foto)) {
                unlink($user->foto);
            }
            $name = 'alumni-' . Auth::user()->identitas . '.' . $foto->getClientOriginalExtension();
            $path = 'upload/alumni/';
            $foto->move($path, $name);
            $fileFoto = $path . $name;
        }
        $user->update([
            'hp' => $request->hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'foto' => $fileFoto,
        ]);
        $alumni->update([
            'foto' => $fileFoto,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status' => $request->status,
            'detail_status' => $request->keterangan,
            'hp' => $request->hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);
        notify('Data anda perhasil diperbarui!', 'Berhasil');
        return redirect()->back();
    }

    public function staff(Request $request)
    {

        $request->validate([
            'nama' => ['required'],
            'nomor_identitas' => [$request->nomor_identitas != Auth::user()->identitas ? 'unique:users,identitas,except,id' : 'required'],
            'foto' => ['image', 'max:2024', empty(Auth::user()->foto) ? 'required' : 'nullable'],
            'hp' => [$request->hp != Auth::user()->hp ? 'unique:users,hp,except,id' : 'required'],
            'email' => [$request->email != Auth::user()->email ? 'unique:users,email,except,id' : 'required'],
            'alamat' => ['required'],
        ]);

        $user = User::find(Auth::user()->id);

        $foto = $request->file('foto');
        $fileFoto = Auth::user()->foto;
        if (!empty($foto)) {
            if (!empty($user->foto)) {
                unlink($user->foto);
            }
            $name = 'staff-' . Auth::user()->identitas . '.' . $foto->getClientOriginalExtension();
            $path = 'upload/staff/';
            $foto->move($path, $name);
            $fileFoto = $path . $name;
        }
        $user->update([
            'hp' => $request->hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'foto' => $fileFoto,
            'nama' => $request->nama,
            'identitas' => $request->nomor_identitas,
            'username' => $request->nomor_identitas,
        ]);
        notify('Data perhasil diperbarui!', 'Berhasil');
        return redirect()->back();
    }
}
