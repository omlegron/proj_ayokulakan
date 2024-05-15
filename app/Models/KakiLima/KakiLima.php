<?php

namespace App\Models\KakiLima;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;


class KakiLima extends Model
{
    protected $table         = 'trans_kaki_lima';
    protected $log_table    = 'log_trans_kaki_lima';
    protected $log_table_fk = 'trans_id';
    protected $fillable     = [
        'user_id',
        'name',
        'type_usaha',
        'keterangan',
        'lat',
        'lng',
        'last_active',
        'status',
        'nomor_telepon',
        'email',
        'ktp',
        'swafoto',
        'skck',
        'alamat_toko',
        'negara',
        'provinsi',
        'kota',
        'distrik',
        'kode_pos',
        
    ];

    public function filesMorphClass()
    {
        return 'img_kaki_lima';
    }

    public function attachments()
    {
        return $this->morphMany(Attachments::class, 'target');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getLabel()
    {
        switch($this->status) {
            case 1 : return '<span class="badge badge-secondary">Belum Verivikasi</span>';
            break;
            case 2 : return '<span class="badge badge-danger">Verivikasi</span>';
            break;
            case 3 : return '<span class="badge badge-success">Aktif</span>';
            break;
            case 4 : return '<span class="badge badge-secondary">Gagal</span>';
            break;
        }
    }
}
