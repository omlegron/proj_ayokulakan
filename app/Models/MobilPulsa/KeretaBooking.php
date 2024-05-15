<?php

namespace App\Models\MobilPulsa;
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Attachments;

class KeretaBooking extends Model
{
    protected $table 		= 'trans_kereta_bookings';
    protected $log_table 	= 'log_trans_kereta_bookings';
    protected $log_table_fk	= 'kereta_id';
    protected $fillable 	= [
       	'tr_id',
        'code',
        'hp',
        'tr_name',
        'period',
        'nominal',
        'admin',
        'ref_id',
        'response_code',
        'message',
        'price',
        'selling_price',
        'bookingCode',
        'bookingDateTime',
        'bookingTimeLimit',
        'trainName',
        'trainNumber',
        'class',
        'subClass',
        'org',
        'departDate',
        'departTime',
        'dest',
        'arriveDate',
        'arriveTime',
        'discount',
        'eticket',
        'contactName',
        'contactPhone',
        'contactEmail',
    ];

    public function passenger(){
        return $this->hasMany(KeretaPassenger::class, 'kereta_id');
    }
}
