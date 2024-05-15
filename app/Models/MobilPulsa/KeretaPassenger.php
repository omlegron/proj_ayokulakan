<?php

namespace App\Models\MobilPulsa;
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Attachments;

class KeretaPassenger extends Model
{
    protected $table 		= 'trans_kereta_passengers';
    protected $fillable 	= [
        'kereta_id',
       	'trID',
        'name',
        'category',
        'wagonCode',
        'seat',
        'amount',
        'refundStatus',
        'ticketNumber',
    ];

}
