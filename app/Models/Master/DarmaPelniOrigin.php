<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class DarmaPelniOrigin extends Model
{
    protected $table         = 'ref_pelni_origin';
    protected $fillable     = [
    	'originPort', 
    	'originName'
    ];

}
