<?php
namespace App\Http\Controllers;


class DokterController extends Controller
{
    // Fungsi untuk menampilkan dashboard dokter
    public function dashboard()
    {   
        // Tampilkan dashboard dokter
        return view('dokter.dashboard');
    }
}