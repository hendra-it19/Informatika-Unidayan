<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public $role = [
        'admin',
        'mahasiswa',
        'kaprodi',
        'dosen,',
        'organisasi',
        'alumni',
    ];

    public function login(): View
    {
        return view('landing-page.login', [
            'judulHalaman' => 'Login'
        ]);
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
            'captcha' => ['required', 'captcha'],
        ],  ['captcha.captcha' => 'Invalid captcha code.']);
        $user = User::where('username', $request->username)
            ->orWhere('email', $request->username)
            ->orWhere('identitas', $request->username)
            ->first();
        if (!empty($user) && Hash::check($request->password, $user->password)) {
            $request->session()->regenerate();
            Auth::login($user, false);
            notify()->success('Anda masuk dengan hak akses ' . $user->role, 'Berhasil');
            return redirect()->intended('dashboard');
        }
        return redirect()->back()->withErrors(['username' => 'Username atau password anda salah!']);
    }

    public function captcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerateToken();
        $request->session()->invalidate();
        return to_route('login');
    }
}
