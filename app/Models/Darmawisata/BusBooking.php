<?php

namespace App\Models\Darmawisata;
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Attachments;

class BusBooking extends Model
{
    protected $table 		= 'trans_bus_bookings';
    protected $log_table 	= 'log_trans_bus_bookings';
    protected $log_table_fk	= 'bus_id';
    protected $fillable 	= [
       	'bus',
        'operatorName',
        'originTerminal',
        'destinationTerminal',
        'bookingCode',
        'directCode',
        'locationID',
        'departPlace',
        'departTime',
        'bookingTime',
        'salesPrice',
        'memberDiscount',
        'ticketPrice',
        'issuedTimeLimit',
        'accessToken',
        'status',
        'respMessage',
        'created_by',
    ];

}
