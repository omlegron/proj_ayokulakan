<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class DarmaBusList extends Model
{
    protected $table         = 'ref_bus_lists';
    protected $fillable     = [
    	'name', 
    	'type', 
    ];

}
