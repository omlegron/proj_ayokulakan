<?php

namespace App\Models;

use App\Models\Model;
use App\Models\User;

use App\Models\Master\WilayahNegara;
use App\Models\Master\WilayahProvinsi;
use App\Models\Master\WilayahKota;
use App\Models\Master\WilayahKecamatan;

class UserProfile extends Model
{
    protected $table 	= 'sys_user_profiles';

    protected $fillable = [
        'id_negara',
        'id_provinsi',
        'id_kota',
        'id_kecamatan',
        'kode_pos',
        'hp',
        'status',
        'alamat',
    ];

    public function negara()
    {
        return $this->belongsTo(WilayahNegara::class, 'id_negara');
    }    

    public function provinsi()
    {
        return $this->belongsTo(WilayahProvinsi::class, 'id_provinsi');
    }   

    public function kota()
    {
        return $this->belongsTo(WilayahKota::class, 'id_kota');
    }  

    public function kecamatan()
    {
        return $this->belongsTo(WilayahKecamatan::class, 'id_kecamatan');
    } 


}
