<?php

namespace App\Models\GantiPassword;
use App\Models\Model;
use App\Models\Roles;
use App\Models\User;

class GantiPassword extends Model
{
    protected $table 		= 'trans_verivikasi_password';
    protected $fillable 	= ['user_id','kode_verivikasi'];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
