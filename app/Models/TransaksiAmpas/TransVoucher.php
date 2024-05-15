<?php

namespace App\Models\TransaksiAmpas;
use App\Models\Model;
use App\Models\User;

class TransVoucher extends Model
{
    protected $table = 'trans_voucher';
    protected $fillable = [
        'kode_voucher',
        'nominal_voucher',
        'desc_voucher',
        'expire_date',
        'created_by',
        'updated_by'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
}
