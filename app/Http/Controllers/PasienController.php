<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Dokter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    // Constructor to check authentication
    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     if (!Session::has('pasien_id')) {
        //         return redirect()->route('pasien.loginForm')
        //             ->with('error', 'Silakan login terlebih dahulu.');
        //     }
        //     return $next($request);
        // })->except(['showLoginForm', 'login', 'showRegisterForm', 'register']);
    }

    public function dashboard()
    {
        $pasien = Pasien::findOrFail(Session::get('pasien_id'));
        return view('pasien.dashboard', compact('pasien'));
    }

    public function listJadwal()
    {
        $pasien_id = Session::get('pasien_id');
        $pasien = Pasien::findOrFail($pasien_id);

        $poli = Poli::with(['dokter' => function ($query) {
            $query->whereHas('jadwalPeriksa');
        }])->get();

        $riwayat = DaftarPoli::with([
            'jadwalPeriksa.dokter.poli',
            'periksa.detailPeriksa.obat'
        ])
            ->where('id_pasien', $pasien_id)
            ->get();

        $jadwal = JadwalPeriksa::with(['dokter.poli'])
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MIN(id)'))
                    ->from('jadwal_periksa')
                    ->groupBy('id_dokter');
            })
            ->orderBy('id')
            ->get();

        return view('poli.jadwal', compact('poli', 'jadwal', 'riwayat', 'pasien'));
    }



    public function getDoctorsByPoli($poliId)
    {
        $doctors = Dokter::where('id_poli', $poliId)
            ->whereHas('jadwalPeriksa')
            ->with(['jadwalPeriksa' => function ($query) {
                $query->orderBy('hari');
            }])
            ->get();

        return response()->json($doctors);
    }



    public function daftarPoliForm($idJadwal)
    {
        $jadwal = JadwalPeriksa::with(['dokter', 'dokter.poli'])->findOrFail($idJadwal);
        $pasien = Pasien::findOrFail(Session::get('pasien_id'));

        return view('poli.daftar', compact('jadwal', 'pasien'));
    }

    public function daftarPoli(Request $request)
    {

        $lastAntrian = DaftarPoli::where('id_jadwal', $request->id_jadwal)
            ->max('no_antrian');

        $noAntrian = $lastAntrian ? $lastAntrian + 1 : 1;

        DaftarPoli::create([
            'id_pasien' => Session::get('pasien_id'),
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $noAntrian,
        ]);

        return redirect()->route('poli.schedule')
            ->with('success', 'Pendaftaran berhasil. Nomor antrian Anda: ' . $noAntrian);
    }

    public function showProfile()
    {
        $pasien = Pasien::findOrFail(Session::get('pasien_id'));
        return view('pasien.profile', compact('pasien'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|numeric|digits_between:10,15',
        ]);

        $pasien = Pasien::findOrFail(Session::get('pasien_id'));
        $pasien->update($request->only(['nama', 'alamat', 'no_hp']));

        return redirect()->route('pasien.profile')
            ->with('success', 'Profile berhasil diperbarui');
    }

    // View appointment history
    public function riwayatPendaftaran()
    {
        $riwayat = DaftarPoli::with(['jadwal.dokter.poli'])
            ->where('id_pasien', Session::get('pasien_id'))
            ->get();

        return view('pasien.riwayat', compact('riwayat'));
    }
}
