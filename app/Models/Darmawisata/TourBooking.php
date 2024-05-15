<?php

namespace App\Models\Darmawisata;
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Attachments;

class TourBooking extends Model
{
    protected $table 		= 'log_trans_tour_bookings';
    protected $log_table 	= 'log_log_trans_tour_bookings';
    protected $log_table_fk	= 'tour_id';
    protected $fillable 	= [
       	'BookingCode',
        'BookingDate',
        'DepartDate',
        'TicketStatus',
        'TourName',
        'TotalPrice',
        'TourVariant',
        'PaymentType',
        'TotalPrice',
        'Commision',
        'RemainingBill',
        'DPAmount',
        'accessToken',
        'status',
        'respMessage',
    ];

}
