<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use Illuminate\Support\Facades\Session;

class LoginDokterController extends Controller
{
    public function showLoginForm()
    {
        if (Session::has('dokter_id')) {
            return redirect()->route('dokter.dashboard', ['id' => Session::get('dokter_id')]);
        }
        return view('auth.logindokter');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|numeric|digits_between:10,15',
        ]);

        $dokter = Dokter::where('nama', $request->username)->first();

        if ($dokter && $dokter->no_hp == $request->password) {
            Session::put('dokter_id', $dokter->id);
            Session::put('dokter_nama', $dokter->nama);
            Session::put('dokter_poli', $dokter->id_poli);

            if ($dokter->nama == 'admin') {
                return redirect()->route('admin.index')
                    ->with('success', 'Login berhasil sebagai Admin.');
            }
            return redirect()->route('dokter.dashboard',)
                ->with('success', 'Login berhasil, selamat datang ' . $dokter->nama);
        }

        return redirect()->back()
            ->with('error', 'Username atau password salah. Mohon periksa kembali!');
    }

    public function logout()
    {
        Session::forget(['dokter_id', 'dokter_nama', 'dokter_poli']);
        return redirect()->route('dokter.loginForm')
            ->with('success', 'Anda telah berhasil logout.');
    }
}
