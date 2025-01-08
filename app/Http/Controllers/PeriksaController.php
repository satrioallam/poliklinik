<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\DetailPeriksa;
use App\Models\DaftarPoli;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Session;
use App\Models\Pasien;

class PeriksaController extends Controller
{
    public function formPeriksa($idDaftarPoli)
    {
        try {
            $daftarPoli = DaftarPoli::with(['pasien', 'jadwalPeriksa.dokter'])
                ->findOrFail($idDaftarPoli);

            if ($daftarPoli->periksa) {
                return redirect()
                    ->route('periksa.list')
                    ->with('error', 'Pasien ini sudah diperiksa.');
            }

            $obat = Obat::orderBy('nama_obat')->get();
            return view('periksa.form', compact('daftarPoli', 'obat'));
        } catch (Exception $e) {
            return redirect()
                ->route('periksa.list')
                ->with('error', 'Data pasien tidak ditemukan.');
        }
    }

    public function simpanPeriksa(Request $request)
    {
        try {

            $validated = $request->validate([
                'id_daftar_poli' => 'required|exists:daftar_poli,id',
                'tgl_periksa' => 'required|date',
                'catatan' => 'required|string|min:10',
                'id_obat' => 'required|array|min:1',
                'id_obat.*' => 'exists:obat,id',
                'biaya_total' => 'required|numeric|min:150000'
            ], [
                'id_obat.required' => 'Pilih minimal satu obat',
                'catatan.min' => 'Catatan pemeriksaan minimal 10 karakter',
                'biaya_total.min' => 'Total biaya tidak valid'
            ]);

            DB::beginTransaction();
            $existingPeriksa = Periksa::where('id_daftar_poli', $request->id_daftar_poli)->first();
            if ($existingPeriksa) {
                throw new Exception('Pasien ini sudah diperiksa sebelumnya.');
            }

            $periksa = Periksa::create([
                'id_daftar_poli' => $validated['id_daftar_poli'],
                'tgl_periksa' => $validated['tgl_periksa'],
                'catatan' => $validated['catatan'],
                'biaya_periksa' => $validated['biaya_total']
            ]);

            // Create examination details for medicines
            foreach ($validated['id_obat'] as $idObat) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $idObat
                ]);
            }

            DB::commit();

            return redirect()
                ->route('periksa.list')
                ->with('success', 'Pemeriksaan berhasil disimpan.');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan pemeriksaan: ' . $e->getMessage());
        }
    }

    public function listPasien()
    {
        $dokterId = Session::get('dokter_id');

        $daftarPoli = DaftarPoli::whereHas('jadwalPeriksa', function ($query) use ($dokterId) {
            $query->where('id_dokter', $dokterId);
        })
            ->whereDoesntHave('periksa')
            ->with(['pasien', 'jadwalPeriksa'])
            ->orderBy('no_antrian')
            ->get();

        return view('periksa.list', compact('daftarPoli'));
    }

    public function show($id)
    {
        $dokterId = Session::get('dokter_id');

        $daftarPoli = DaftarPoli::with(['pasien', 'jadwalPeriksa'])
            ->whereHas('jadwalPeriksa', function ($query) use ($dokterId) {
                $query->where('id_dokter', $dokterId);
            })->findOrFail($id);

        if (!$daftarPoli) {
            return redirect()->back()
                ->with('error', 'Anda tidak memiliki akses ke data pasien ini.');
        }

        return view('dokter.detail-pasien', [
            'daftar' => $daftarPoli
        ]);
    }


    public function riwayatPasien()
    {

        $riwayat = Periksa::with([
            'daftarPoli.pasien',
            'daftarPoli.jadwalPeriksa.dokter',
            'detailPeriksa.obat'
        ])
            ->latest('tgl_periksa')
            ->paginate(10);


        return view('periksa.riwayat', compact('riwayat'));
    }
}
