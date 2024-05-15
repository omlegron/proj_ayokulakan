<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class DarmaTourCategorie extends Model
{
    protected $table         = 'ref_tour_categories';
    protected $fillable     = [
    	'refID',
		'Category',
    ];

}
