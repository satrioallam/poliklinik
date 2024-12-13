<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';
    public $timestamps = false;
    protected $fillable = ['nama', 'alamat', 'no_ktp', 'no_hp', 'no_rm'];

    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'id_pasien');
    }
}
