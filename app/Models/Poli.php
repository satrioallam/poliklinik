<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = 'poli';
    public $timestamps = false;
    protected $fillable = ['nama_poli', 'keterangan'];

    public function dokter()
    {
        return $this->hasMany(Dokter::class, 'id_poli');
    }
}
