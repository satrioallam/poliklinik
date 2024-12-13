<?php
namespace App\Http\Controllers;


class PasienController extends Controller
{
    // Fungsi untuk menampilkan dashboard dokter
    public function dashboard()
    {   
        // Tampilkan dashboard dokter
        return view('pasien.dashboard');
    }
}