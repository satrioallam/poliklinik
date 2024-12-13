<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Pasien;

class LoginPasienController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.loginpasien');
    }

    
    public function login(Request $request)
    {
        // Validasi input login

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|numeric',
        ]);
        // Cari pasien berdasarkan No KTP atau Nama Lengkap
        $pasien = Pasien::where('no_ktp', $request->username)
                        ->orWhere('nama', $request->username)
                        ->first();
        if ($pasien && $pasien->no_hp == $request->password) {
            session(['pasien_id' => $pasien->id, 'pasien_nama' => $pasien->nama]);
            return redirect()->route('pasien.dashboard', ['id' => $pasien->id])
                ->with('success', 'Login berhasil, selamat datang ' . $pasien->nama);
        } 


        return back()->withErrors(['username' => 'Username atau password salah.']);
    }

    public function showRegisterForm()
    {
        return view('auth.daftarpasien');
    }

    public function register(Request $request)
    {
     
        // Validasi input pendaftaran
        $validator = Validator::make($request->all(), [
            'no_ktp' => 'required|numeric|digits:10|unique:pasien,no_ktp',
            'nama' => 'required|string|max:150',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|numeric|digits_between:10,15',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }        // Generate nomor rekam medis (RM)
        $no_rm = $this->generateNoRM();

        // Simpan data pasien baru
        $pasien = Pasien::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'no_rm' => $no_rm,
        ]);

        session(['pasien_id' => $pasien->id, 'pasien_nama' => $pasien->nama]);
        return redirect()->route('pasien.dashboard', ['id' => $pasien->id])
            ->with('success', 'Pendaftaran berhasil! Nomor RM Anda: ' . $no_rm);
    }

    private function generateNoRM()
    {
        $datePrefix = now()->format('Ym'); // TahunBulan
        $count = Pasien::where('no_rm', 'like', $datePrefix . '%')->count();
        $noUrut = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        return $datePrefix . '-' . $noUrut;
    }
}
