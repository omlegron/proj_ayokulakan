<?php

namespace App\Models\Darmawisata;
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Attachments;

class TravelBooking extends Model
{
    protected $table 		= 'trans_travel_bookings';
    protected $log_table 	= 'log_trans_travel_bookings';
    protected $log_table_fk	= 'travel_id';
    protected $fillable 	= [
       	'shuttleID',
        'bookingCode',
        'salesPrice',
        'memberCommission',
        'ticketPrice',
        'ticketStatus',
        'departTime',
        'bookingDate',
        'issuedTimeLimit',
        'origin',
        'destination',
        'originCity',
        'destinationCity',
        'accessToken',
        'status',
        'respMessage',
    ];
}
