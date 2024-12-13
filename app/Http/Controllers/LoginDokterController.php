<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;

class LoginDokterController extends Controller
{
    public function showLoginForm()
    {
        // Tampilkan form login dokter
        return view('auth.logindokter');
    }

    public function login(Request $request)
    {
        // Validasi input dari form login
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|numeric|digits_between:10,15',
        ]);
        // Cari dokter berdasarkan nama atau nomor telepon
        $dokter = Dokter::where('nama', $request->username)
                        ->first();

        if ($dokter && $dokter->no_hp == $request->password) {
            // coba admin
            if ($dokter->nama == 'admin') {
                return redirect()->route('admin.index')
                    ->with('success', 'Login berhasil sebagai Admin.');
            }
            // Jika nomor telepon cocok, anggap login berhasil
            return redirect()->route('dokter.dashboard', ['id' => $dokter->id])
                ->with('success', 'Login berhasil, selamat datang ' . $dokter->nama);
        }

        return redirect()->back()
            ->with('error', 'Username atau password salah. Mohon periksa kembali!');
    }
}
