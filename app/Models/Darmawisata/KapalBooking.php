<?php

namespace App\Models\Darmawisata;
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Attachments;

class KapalBooking extends Model
{
    protected $table 		= 'trans_kapal_bookings';
    protected $log_table 	= 'log_trans_kapal_bookings';
    protected $log_table_fk	= 'kapal_id';
    protected $fillable 	= [
       	'numCode',
        'departDate',
        'bokingNumber',
        'kelasKapal',
        'salesPrice',
        'memberDiscount',
        'ticketPrice',
        'shipMarkup',
        'bookingDateTime',
        'status',
        'respMessage',
        'accessToken',
        'bookingStatus',
        'issuedDateTimeLimit'
    ];

    public function transaksi(){
        return $this->morphOne('App\Models\TransaksiAmpas\TransaksiAmpase','target');
    }
}
