<?php

namespace App\Models\Darmawisata;
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Attachments;

class HotelBookingAge extends Model
{
    protected $table 		= 'trans_hotel_child_ages';
    protected $fillable 	= [
       	'hotel_id',
        'age',
    ];

}
