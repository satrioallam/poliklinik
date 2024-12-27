<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{
    protected $table = 'daftar_poli';
    protected $fillable = ['id_pasien', 'id_jadwal', 'keluhan', 'no_antrian'];
    public $timestamps = false; // Disable timestamps

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function jadwalPeriksa()
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }

    // Add this relationship
    public function periksa()
    {
        return $this->hasOne(Periksa::class, 'id_daftar_poli');
    }
}
