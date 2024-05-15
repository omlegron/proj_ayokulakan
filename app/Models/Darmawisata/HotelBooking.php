<?php

namespace App\Models\Darmawisata;
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Attachments;

class HotelBooking extends Model
{
    protected $table 		= 'trans_hotel_bookings';
    protected $log_table 	= 'log_trans_hotel_bookings';
    protected $log_table_fk	= 'hotel_id';
    protected $fillable 	= [
       	'checkInDate',
        'checkOutDate',
        'bookingDate',
        'internalCode',
        'reservationNo',
        'osRefNo',
        'agentOsRef',
        'bookingStatus',
        'status',
        'respMessage',
        'accessToken',
        'hotelID',
        'hotelName',
        'roomName',
        'roomNum',
        'paxPassport',
        'countryID',
        'cityID',
        'roomType',
        'isRequestChildBed',
        'childNum',
        'breakfast',
        'roomID',
        'smookingRoom',
        'email',
        'phone',
        'alamat',
        'price',
        'bedTypeBed',
        'bedTypeID',
    ];

    public function age(){
        return $this->hasMany(HotelBookingAge::class,'hotel_id');
    }

    public function paxe(){
        return $this->hasMany(HotelBookingPaxe::class,'hotel_id');
    }

    public function special(){
        return $this->hasMany(HotelBookingSpecial::class,'hotel_id');
    }
}
