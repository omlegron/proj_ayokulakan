<?php

namespace App\Models\TransaksiAmpas;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Helpers\HelpersPPOB;
use app\Models\Notification\NotifFeedback;

class TransaksiKurir extends Model
{
    protected $table 		= 'trans_ampas_transaksi_kurir';
    protected $log_table 	= 'log_trans_ampas_transaksi_kurir';
    protected $log_table_fk	= 'log_trans_id';
    protected $fillable 	= [
        'trans_id',
        'lapak_id',
        'form_type',
        'form_id',
        'kurir_child_tipe',
        'kurir_child_harga',
        'kurir_child_hari',
        'status',
    ];
    
    public function trans()
    {
        return $this->belongsTo(TransaksiAmpase::class, 'trans_id');
    }

    public function form()
    {
        return $this->morphTo();
    }

    public function user(){
    	return $this->belongsTo(User::class, 'user_id');
    }
    public function getKurir()
    {
        switch ($this->kurir_child_tipe) {
            case 'Jalur Nugraha Ekakurir (JNE) - (JNE City Courier)':
                return ' <img src="'.asset("img/rajaongkir/jne.jpg").'" alt="" srcset="" width="100" height="50">';
                break;
            case 'Jalur Nugraha Ekakurir (JNE) - (Ongkos Kirim Ekonomis)':
                return ' <img src="'.asset("img/rajaongkir/jne.jpg").'" alt="" srcset="" width="100" height="50">';
                break;
            case 'Ninja Xpress - (Standard Service)':
                return ' <img src="'.asset("img/rajaongkir/ninja.jpg").'" alt="" srcset="" width="100" height="50">';
                break;
            
            default:
                # code...
                break;
        }
    }
   

   
}
