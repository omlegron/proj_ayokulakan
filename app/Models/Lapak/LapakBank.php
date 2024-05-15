<?php

namespace App\Models\Lapak;

use App\Models\Model;

class LapakBank extends Model
{
    protected $table 		= 'trans_lapak_bank';
    protected $fillable 	= ['nama_ktp','lapak_id','nomor_ktp','foto_ktp','swa_foto','nama_rekening','nomor_rekening','bank','foto_tabungan','created_by'];
}
