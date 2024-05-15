<?php

namespace App\Models\Rental;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Attachments;


use App\Models\Master\KategoriRental;
use App\Models\Master\KategoriRentalSub;
use App\Models\Feedback\Feedback;
use App\Models\Master\WilayahNegara;
use App\Models\Master\WilayahProvinsi;
use App\Models\Master\WilayahKota;
use App\Models\Master\WilayahKecamatan;
use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;

class Rental extends Model
{
    protected $table 		= 'trans_rental';
     protected $log_table 	= 'log_trans_rental';
    protected $log_table_fk	= 'trans_id';
    protected $fillable 	= [
    	'judul',
    	'keterangan',
    	'status',
    	'kategori_id',
    	'sub_kategori_id',
    	'unit',
        'unit_tersewa',
        'harga_sewa',
        'waktu_sewa',
        'rating',
        'id_negara',
        'id_provinsi',
        'id_kota',
        'id_kecamatan'
    ];

    public function filesMorphClass()
    {
        return 'img_rental';
    }

    public function attachments()
    {
        return $this->morphMany(Attachments::class, 'target');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriRental::class, 'kategori_id');
    }

    public function sub_kategori()
    {
        return $this->belongsTo(KategoriRentalSub::class, 'sub_kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'form_id');
    }
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

    public function trans_rental()
    {
        return $this->morphMany(TransaksiAmpaseBarangDetail::class, 'form');
    }

    public function rental(){
        return $this->hasMany(TransaksiAmpaseBarangDetail::class, 'form_id');
    }
}
