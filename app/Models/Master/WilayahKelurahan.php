<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;

class WilayahKelurahan extends Model
{
    protected $table 		= 'ref_wilayah_kelurahan';
    protected $fillable 	= ['id','id_negara','id_provinsi','id_kota','id_kecamatan','kelurahan'];
}
