<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class DarmaTravelList extends Model
{
    protected $table         = 'ref_travel_lists';
    protected $fillable     = [
    	'name', 
    	'listID', 
    ];

}
