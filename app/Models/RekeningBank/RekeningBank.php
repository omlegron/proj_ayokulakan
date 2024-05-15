<?php

namespace App\Models\RekeningBank;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;

class RekeningBank extends Model
{
    protected $table 		= 'sys_users_rekening_bank';
    protected $fillable 	= ['user_id','no_rekening','nama','nama_bank','alamat','kode_pos', 'type_target', 'created_by'];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
