<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Models\Periksa;
use App\Models\DetailPeriksa;

class DokterController extends Controller
{
    public function __construct() {}

    public function dashboard()
    {
        $dokter = Dokter::findOrFail(Session::get('dokter_id'));
        return view('dokter.dashboard', compact('dokter'));
    }

    public function editProfile()
    {
        $dokter = Dokter::findOrFail(Session::get('dokter_id'));
        return view('dokter.edit', compact('dokter'));
    }

    public function riwayatPasien()
    {
        $pasiens = Pasien::all();
        $periksa = Pasien::with(['daftarPoli.periksa.detailPeriksa.obat'])->get()->toArray();
        // return $periksa;
        return view('dokter.riwayatpasien', compact('pasiens', 'periksa'));
    }

    public function updateStatus($id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);
        $dokterId = session('dokter_id');

        if ($jadwal->id_dokter != $dokterId) {
            return redirect()->route('dokter.schedule')
                ->with('error', 'Anda tidak memiliki izin untuk mengubah jadwal ini.');
        }

        $earliestSchedule = JadwalPeriksa::where('id_dokter', $dokterId)
            ->orderBy('id', 'asc')
            ->first();

        if ($earliestSchedule && $jadwal->id != $earliestSchedule->id) {
            DB::transaction(function () use ($jadwal, $earliestSchedule) {
                $currentScheduleData = [
                    'id_dokter' => $jadwal->id_dokter,
                    'hari' => $jadwal->hari,
                    'jam_mulai' => $jadwal->jam_mulai,
                    'jam_selesai' => $jadwal->jam_selesai
                ];

                $earliestScheduleData = [
                    'id_dokter' => $earliestSchedule->id_dokter,
                    'hari' => $earliestSchedule->hari,
                    'jam_mulai' => $earliestSchedule->jam_mulai,
                    'jam_selesai' => $earliestSchedule->jam_selesai
                ];

                DB::table('jadwal_periksa')
                    ->where('id', $earliestSchedule->id)
                    ->update($currentScheduleData);

                DB::table('jadwal_periksa')
                    ->where('id', $jadwal->id)
                    ->update($earliestScheduleData);
            });
        }

        return redirect()->route('dokter.schedule')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'id_poli' => 'required|exists:poli,id',
        ]);

        $dokter = Dokter::findOrFail(Session::get('dokter_id'));
        $dokter->update($request->all());

        Session::put('dokter_nama', $request->nama);
        Session::put('dokter_poli', $request->id_poli);

        return redirect()->route('dokter.edit')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function manageSchedule()
    {
        $dokter = Dokter::findOrFail(Session::get('dokter_id'));

        // Get the minimum ID for the doctor's schedules
        $minId = $dokter->jadwalPeriksa()->min('id');

        // Get all schedules with status determined by a single query
        $jadwal = $dokter->jadwalPeriksa()
            ->select('*')
            ->selectRaw('CASE 
            WHEN id = ? THEN "Aktif" 
            ELSE "Tidak Aktif" 
            END as status', [$minId])
            ->orderBy('id')
            ->get();

        return view('dokter.schedule', compact('dokter', 'jadwal'));
    }


    public function storeSchedule(Request $request)
    {
        $request->validate([
            'hari' => 'required|string|max:50',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);


        JadwalPeriksa::create([
            'id_dokter' => Session::get('dokter_id'),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('dokter.schedule')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }
}
