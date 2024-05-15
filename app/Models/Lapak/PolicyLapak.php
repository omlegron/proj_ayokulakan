<?php

namespace App\Models\Lapak;

use App\Models\Model;

class PolicyLapak extends Model
{
    protected $table 		= 'trans_kebijakan_lapak';
    protected $fillable 	= ['judul_kebijakan','lapak_id','isi_kebijakan','created_by'];
}
