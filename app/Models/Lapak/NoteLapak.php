<?php

namespace App\Models\Lapak;

use App\Models\Model;

class NoteLapak extends Model
{
    protected $table 		= 'trans_note_lapak';
    protected $fillable 	= ['judul_catatan','lapak_id','isi_catatan','created_by'];
}
