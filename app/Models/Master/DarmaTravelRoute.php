<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class DarmaTravelRoute extends Model
{
    protected $table         = 'ref_travel_routes';
    protected $fillable     = [
    	'origin',
		'destination',
		'originCity',
		'destinationCity',
		'directionID',
    ];

}
