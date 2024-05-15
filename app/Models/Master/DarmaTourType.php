<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class DarmaTourType extends Model
{
    protected $table         = 'ref_tour_types';
    protected $fillable     = [
    	'refID',
		'Type',
    ];

}
