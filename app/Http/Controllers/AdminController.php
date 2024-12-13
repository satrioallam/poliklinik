<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Obat;

class AdminController extends Controller
{
    public function showDashboardAdmin()
    {
        // Tampilkan dashboard
        return view('admin.index');
    }
   
    // ============= DOKTER =============
    public function listDokter()
    {
        $dokter = Dokter::all();
        return view('dokter.index', compact('dokter'));
    }

    public function storeDokter(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|numeric',
            'id_poli' => 'required|numeric',
        ]);

        Dokter::create($request->all());
        return redirect()->back()->with('success', 'Data Dokter Berhasil Ditambahkan');
    }

     public function editDokter($id)
    {
        // Menampilkan form edit dengan data dokter yang dipilih
        $dokter = Dokter::findOrFail($id);
        return response()->json($dokter);
    }

    public function updateDokter(Request $request, $id)
    {
        // Validasi input untuk update data dokter
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|numeric',
            'id_poli' => 'required|numeric',
        ]);

        // Update data dokter berdasarkan id
        $dokter = Dokter::findOrFail($id);
        $dokter->update($request->all());
        return redirect()->route('dokter.index')->with('success', 'Data Dokter Berhasil Diperbarui');
    }

    public function deleteDokter($id)
    {
        // Menghapus data dokter berdasarkan id
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();
        return redirect()->route('dokter.index')->with('success', 'Data Dokter Berhasil Dihapus');
    }

    // ============= PASIEN =============
    public function listPasien()
    {
        $pasien = Pasien::all();
        return view('pasien.index', compact('pasien'));
    }


    public function storePasien(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|numeric',
            'no_ktp' => 'required|numeric',
        ]);

        $no_rm = $this->generateNoRM();

        // Pasien::create($request->all());
        Pasien::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_ktp,
            'no_rm' => $no_rm, // Auto-generated No RM
        ]);
        return redirect()->back()->with('success', 'Data Pasien Berhasil Ditambahkan');
    }

    public function editPasien($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.index', compact('pasien'));
    }

    public function updatePasien(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|numeric',
            'no_ktp' => 'required|numeric',
        ]);

        $pasien = Pasien::findOrFail($id);
        $pasien->update($request->all());
        return redirect()->route('pasien.index')->with('success', 'Data Pasien Berhasil Diperbarui');
    }

    public function deletePasien($id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();
        return redirect()->route('pasien.index')->with('success', 'Data Pasien Berhasil Dihapus');
    }

     // Fungsi untuk generate No RM
     private function generateNoRM()
     {
         $datePrefix = now()->format('Ym'); // TahunBulan, contoh: 202406
         $count = Pasien::where('no_rm', 'like', $datePrefix . '%')->count(); // Hitung pasien bulan ini
         $noUrut = str_pad($count + 1, 3, '0', STR_PAD_LEFT); // Urutan 3 digit, dimulai dari 001
         return $datePrefix . '-' . $noUrut; // Format: TahunBulan-NoUrut
     }

    // ============= POLI =============
    public function listPoli()
    {
        $poli = Poli::all();
        return view('poli.index', compact('poli'));
    }

    public function storePoli(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
        ]);

        Poli::create($request->all());
        return redirect()->back()->with('success', 'Data Poli Berhasil Ditambahkan');
    }

    public function editPoli($id)
    {
        $poli = Poli::findOrFail($id);
        return view('poli.index', compact('poli'));
    }

    public function updatePoli(Request $request, $id)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        $poli = Poli::findOrFail($id);
        $poli->update($request->all());
        return redirect()->route('poli.index')->with('success', 'Data Poli Berhasil Diperbarui');
    }

    public function deletePoli($id)
    {
        $poli = Poli::findOrFail($id);
        $poli->delete();
        return redirect()->route('poli.index')->with('success', 'Data Poli Berhasil Dihapus');
    }

    // ============= OBAT =============
    public function listObat()
    {
        $obat = Obat::all();
        return view('obat.index', compact('obat'));
    }

    // public function storeObat(Request $request)
    // {
    //     $request->validate([
    //         'nama_obat' => 'required|string|max:255',
    //         'kemasan' => 'required|string',
    //         'harga' => 'required|numeric',
    //     ]);

    //     Obat::create($request->all());
    //     return redirect()->back()->with('success', 'Data Obat Berhasil Ditambahkan');
    // }

    public function storeObat(Request $request)
{
    // Validasi input
    $request->validate([
        'nama_obat' => 'required|string|max:255',
        'kemasan' => 'required|string',
        'harga' => 'required|numeric',  // Pastikan harga yang dikirimkan hanya angka
    ]);
    $harga = preg_replace('/[^0-9]/', '', $request->harga);

    // Simpan data obat ke database
    Obat::create([
        'nama_obat' => $request->nama_obat,
        'kemasan' => $request->kemasan,
        'harga' => $harga,
    ]);

    return redirect()->back()->with('success', 'Data Obat Berhasil Ditambahkan');
}

    public function editObat($id)
    {
        $obat = Obat::findOrFail($id);
        return view('obat.index', compact('obat'));
    }

    public function updateObat(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string',
            'harga' => 'required|numeric',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update($request->all());
        return redirect()->route('obat.index')->with('success', 'Data Obat Berhasil Diperbarui');
    }

    public function deleteObat($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();
        return redirect()->route('obat.index')->with('success', 'Data Obat Berhasil Dihapus');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna
        $request->session()->invalidate(); // Hapus session
        $request->session()->regenerateToken(); // Regenerasi token CSRF

        return redirect()->route('home')->with('success', 'Anda berhasil logout'); // Redirect ke halaman login
    }
}
