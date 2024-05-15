<?php

namespace App\Http\Controllers\API\Darmawisata;

use App\Helpers\Darmawisata\Airline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Darmawisata\Ticket\CityResource;
use App\Models\AirlineBooking;
use App\Models\Master\TicketingAirport;
use App\Models\Airline as AirlineModel;
use App\Models\User;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;
use App\Models\TransaksiAmpas\TransaksiAmpase;

use Carbon\Carbon;
use PDF;

class AirlineController extends Controller
{
    public function __construct()
    {
        $this->airline = new Airline();
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function getAirlineRute(Request $request){
        $record = TicketingAirport::select('*');

        if($airport_name = $request->airport_name){
            $record->where('airport_name', 'like', '%'.$airport_name.'%');
        }

        if($airport_code = $request->airport_code){
            $record->orWhere('airport_code', 'like', '%'.$airport_code.'%');
        }

        if($location_name = $request->location_name){
            $record->orWhere('location_name', 'like', '%'.$location_name.'%');
        }

        if($country_id = $request->country_id){
            $record->orWhere('country_id', 'like', '%'.$country_id.'%');
        }

        if($country_name = $request->country_name){
            $record->orWhere('country_name', 'like', '%'.$country_name.'%');
        }

        return response([
            'status' => true,
            'result' => $record->get(),
        ]);
    }

    public function getAirlineRuteOne($id){
        $record = TicketingAirport::findOrFail($id);
        return response([
            'status' => true,
            'result' => $record,
        ]);
    }


    /**
     * Mengambil list Airline
     *
     * @return Illuminate\Http\Response
     */
    public function getAirline()
    {
        return response()->json(['data' => $this->airline->getAirline()]);
    }

    /**
     * Menampilkan data Negara
     *
     * @return Illuminate\Http\Response
     */
    public function getAirlineNationality()
    {
        return response()->json(['data' => $this->airline->getAirlineNationality()]);
    }

    /**
     * Mengambil data Route penerbangan
     *
     * @return Illuminate\Http\Response
     */
    public function getAirlineRoute(Request $request)
    {
        return response()->json(['data' => $this->airline->getAirlineRoute($request)]);
    }

    /**
     * Mengambil data Route penerbangan
     *
     * @return Illuminate\Http\Response
     */
    public function getAirlineLowFareRoute()
    {
        return response()->json(['data' => $this->airline->getAirlineLowFareRoute()]);
    }

    /**
     * Mengambil jadwal seluruh Airline
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getScheduleAllAirline(Request $request)
    {
        return response()->json(['data' => $this->airline->getScheduleAllAirline($request)]);
    }

    /**
     * Mengambil data harga Airline
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getPriceAllAirline(Request $request)
    {
        return response()->json(['data' => $this->airline->getPriceAllAirline($request)]);
    }

    /**
     * Mengambil jadwal satu Airline
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAirlineSchedule(Request $request)
    {
        return response()->json(['data' => $this->airline->getAirlineSchedule($request)]);
    }

    /**
     * Mendapatkan seluruh data Bandara
     *
     * @return App\Http\Resources\Darmawisata\Ticket\CityResource
     */
    public function getCities($resource = false)
    {
        $cities = TicketingAirport::get();

        if ($resource) {
            return CityResource::collection($cities);
        }

        return $cities;
    }

    /**
     * Mendapatkan data Bagasi dan Makanan
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getBaggageAndMeal(Request $request)
    {
        return response()->json(['data' => $this->airline->getBaggageAndMeal($request)]);
    }

    /**
     * Mendapatkan data Kursi
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getSeat(Request $request)
    {
        return response()->json(['data' => $this->airline->getSeat($request)]);
    }

    /**
     * Mendapatkan data Harga Detail Airline
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getPriceAirline(Request $request)
    {
        return response()->json(['data' => $this->airline->getPriceAirline($request)]);
    }

    /**
     * Mendapatkan data Booking List
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getBookingList(Request $request)
    {
        return response()->json(['data' => $this->airline->getBookingList($request)]);
    }

    /**
     * Mendapatkan data Booking List
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getBookingDetail(Request $request)
    {
        return response()->json(['data' => $this->airline->getBookingDetail($request)]);
    }

    /**
     * Input data booking
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setBooking(Request $request)
    {
        \DB::beginTransaction();
        try {
            $setBooking = $this->airline->setBooking($request);
            if($setBooking->status == 'SUCCESS'){
                $airline = AirlineModel::where('code', $request->airlineID)->first();
                $record = AirlineBooking::create([
                    'user_id' => $request->user_id,
                    'airline' => $airline->name,
                    'airlineID' => $airline->code,
                    'bookingCode' => $setBooking->bookingCode,
                    'bookingDate' => $setBooking->bookingDate,
                    'bookingStatus' => 'HOLD',
                ]);
            }
            \DB::commit();
            return response()->json(['data' => $setBooking]);  
        } catch (Exception $e) {
            \DB::rollback();
              return response([
                  'status' => false,
                  'errors' => $e
              ]);
        }
        
    }

    /**
     * Input data Issued
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setIssued(Request $request)
    {
        return response()->json(['data' => $this->airline->setIssued($request)]);
    }
    //-------------------- End Api Airline -----------------------------------


    public function getBookings(Request $request){
        $record = AirlineBooking::select('*');

        if($airline = $request->airline){
            $record->where('airline', 'like', '%'.$airline.'%');
        }

        if($airlineID = $request->airlineID){
            $record->orWhere('airlineID', 'like', '%'.$airlineID.'%');
        }

        if($bookingCode = $request->bookingCode){
            $record->orWhere('bookingCode', 'like', '%'.$bookingCode.'%');
        }

        if($bookingDate = $request->bookingDate){
            $record->orWhere('bookingDate', 'like', '%'.$bookingDate.'%');
        }

        if($bookingStatus = $request->bookingStatus){
            $record->orWhere('bookingStatus', 'like', '%'.$bookingStatus.'%');
        }

        if($user_id = $request->user_id){
            $record->where('user_id', $user_id);
        }

        return response([
            'status' => true,
            'result' => $record->paginate(),
        ]);
    }

    public function transaction(Request $request){
        \DB::beginTransaction();
        try {
            $user = User::findOrFail($request->user_id);
            if($user){
                $record = AirlineBooking::findOrFail($request->target_id);
                $cities = TicketingAirport::get();
                request()['bookingCode'] = $record->bookingCode;
                request()['bookingDate'] = $record->bookingDate;
                $booking = $this->airline->getBookingDetail(request());
                // dd($booking);
                $airline = AirlineModel::where('code',$booking->airlineID)->first();
                $nameAlias = ($airline) ? $airline->name : '';

                $name = $nameAlias.' '.$booking->origin.'-'.$booking->destination.' ('.$booking->bookingCode.')';

                $saveTrans = [];
                $saveTrans['user_id'] = $user->id;
                $saveTrans['status'] = 'Menunggu Pembayaran';
                $recordTrans = new TransaksiAmpase;
                $recordTrans->fill($saveTrans);
                $recordTrans->save();

                $generateOrder = generateOrder(strlen($user->nama));
                $recordTrans->order_id = '0'.$generateOrder.'000'.$recordTrans->id;
                $recordTrans->target_id = $record->id;
                $recordTrans->target_type = 'AirlineBooking';
                $recordTrans->save();

                $toMidtrans = [];
                $toMidtrans = profileMidtransAPI($request->user_id);
                
                $toMidtrans['item_details'][0]['id'] = $record->id;
                $toMidtrans['item_details'][0]['name'] = $name;
                $toMidtrans['item_details'][0]['price'] = (int)$booking->adminFee->ticketPrice;
                $toMidtrans['item_details'][0]['quantity'] = count($booking->passengers);

                $resultTotalHarga = (int)$booking->adminFee->ticketPrice;
                $toMidtrans['transaction_details'] = array(
                  'order_id' => $recordTrans->order_id,
                  'gross_amount' => $resultTotalHarga
                );
                $recordTrans->total_harga = $resultTotalHarga;
                $recordTrans->save();

                if($request->form){
                    if(count($request->form) > 0){
                      foreach ($request->form as $k => $value) {
                        if(!is_array($value)){
                          $toMidtrans[$k] = $value;  
                        }else{
                          if(count($value) > 0){
                            foreach ($value as $k1 => $value1) {
                              if(!is_array($value1)){
                                $toMidtrans[$k][$k1] = $value1;    
                              }else{
                                if(count($value1) > 0){
                                  foreach ($value1 as $k2 => $value2) {
                                    $toMidtrans[$k][$k1][$k2] = $value2;    
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                }
                $RessSnap = Veritrans_VtDirect::charge($toMidtrans);
                \DB::commit();
                return response([
                    'status' => true,
                    'data' => $RessSnap,
                ]);
            }else{
                return response([
                    'status' => true,
                    'url' => 'User Tidak Ditemukan'
                ]);
            }
        } catch (Exception $e) {
          \DB::rollback();
          return response([
              'status' => false,
              'errors' => $e
          ]);
        }
    }
}
