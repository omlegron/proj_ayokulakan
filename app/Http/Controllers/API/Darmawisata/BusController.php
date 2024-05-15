<?php

namespace App\Http\Controllers\API\Darmawisata;

use Illuminate\Http\Request;
use App\Helpers\Darmawisata\Bus;
use App\Http\Controllers\Controller;
use App\Models\Darmawisata\BusBooking;
use App\Models\User;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;
use App\Models\TransaksiAmpas\TransaksiAmpase;

use Carbon\Carbon;
use PDF;

class BusController extends Controller
{
    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->bus = new Bus();

        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    /**
     * Get Bus List
     *
     * @return Illuminate\Http\Response
     */
    public function getBusList()
    {
        return response()->json(['data' => $this->bus->getBusList()]);
    }

    /**
     * Get Bus Route
     *
     * @return Illuminate\Http\Response
     */
    public function getBusRoute(Request $request)
    {
        return response()->json(['data' => $this->bus->getBusRoute($request)]);
    }

    /**
     * Get Bus Schedules
     *
     * @return Illuminate\Http\Response
     */
    public function getBusSchedule(Request $request)
    {
        return response()->json(['data' => $this->bus->getBusSchedule($request)]);
    }

    /**
     * Get Bus Schedules
     *
     * @return Illuminate\Http\Response
     */
    public function getBusSeatMap(Request $request)
    {
        return response()->json(['data' => $this->bus->getBusSeatMap($request)]);
    }

    /**
     * set Bus Booking
     *
     * @return Illuminate\Http\Response
     */
    public function setBusBooking(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $result = $this->bus->setBusBooking($request);
        if($result->status == 'SUCCESS'){
            $record = BusBooking::create([
              'bus' => $result->bus,
              'operatorName' => $result->operatorName,
              'originTerminal' => $result->originTerminal,
              'destinationTerminal' => $result->destinationTerminal,
              'bookingCode' => $result->bookingCode,
              'directCode' => $result->directCode,
              'locationID' => $result->locationID,
              'departPlace' => $result->departPlace,
              'departTime' => $result->departTime,
              'bookingTime' => $result->bookingTime,
              'salesPrice' => $result->salesPrice,
              'memberDiscount' => $result->memberDiscount,
              'ticketPrice' => $result->ticketPrice,
              'issuedTimeLimit' => $result->issuedTimeLimit,
              'accessToken' => $result->accessToken,
              'status' => $result->status,
              'respMessage' => $result->respMessage,
              'created_by' => $request->user_id,
            ]);
        }
        return response()->json(['data' => $result]);
    }

    /**
     * set Bus Issued
     *
     * @return Illuminate\Http\Response
     */
    public function setBusIssued(Request $request)
    {
        return response()->json(['data' => $this->bus->setBusIssued($request)]);
    }

    /**
     * get Bus Booking List
     *
     * @return Illuminate\Http\Response
     */
    public function getBusBookingList(Request $request)
    {
        return response()->json(['data' => $this->bus->getBusBookingList($request)]);
    }

    /**
     * get Bus Booking List
     *
     * @return Illuminate\Http\Response
     */
    public function getBusBookingDetail(Request $request)
    {
        return response()->json(['data' => $this->bus->getBusBookingDetail($request)]);
    }

    public function bookingList(Request $request){
        $record = BusBooking::select('*');

        if($bus = $request->bus){
            $record->orWhere('bus', 'like', '%'.$bus.'%');
        }

        if($operatorName = $request->operatorName){
            $record->orWhere('operatorName', 'like', '%'.$operatorName.'%');
        }

        if($originTerminal = $request->originTerminal){
            $record->orWhere('originTerminal', 'like', '%'.$originTerminal.'%');
        }

        if($destinationTerminal = $request->destinationTerminal){
            $record->orWhere('destinationTerminal', 'like', '%'.$destinationTerminal.'%');
        }

        if($bookingCode = $request->bookingCode){
            $record->orWhere('bookingCode', 'like', '%'.$bookingCode.'%');
        }

        if($created_by = $request->created_by){
            $record->where('created_by', 'like', '%'.$created_by.'%');
        }
        
        return response([
            'status' => true,
            'result' => $record->paginate(),
        ]);
    }

    public function bookingListOne($id){
        $record = BusBooking::findOrFail($id);

        return response([
            'status' => true,
            'result' => $record,
        ]);
    }

     public function transaction(Request $request){
        \DB::beginTransaction();
        try {
            $user = User::findOrFail($request->user_id);
            if($user){
                $record = BusBooking::findOrFail($request->target_id);
                $result = [];
            
                $request['accessToken'] = $record->accessToken;
                $request['bookingCode'] = $record->bookingCode;
                $request['bookingDate'] = Carbon::parse($record->bookingTime)->format('Y-m-d');

                $getBooking = guzzleGet($request,'/api/darmawisata/bus/booking/detail')->data;
                if($getBooking == 'SUCCESS'){
                    $name = $getBooking->operatorName.' - ('.$getBooking->originTerminal.' - '.$getBooking->destinationTerminal.')';

                    $saveTrans = [];
                    $saveTrans['user_id'] = $user->id;
                    $saveTrans['status'] = 'Menunggu Pembayaran';
                    $recordTrans = new TransaksiAmpase;
                    $recordTrans->fill($saveTrans);
                    $recordTrans->save();

                    $generateOrder = generateOrder(strlen($user->nama));
                    $recordTrans->order_id = '0'.$generateOrder.'000'.$recordTrans->id;
                    $recordTrans->target_id = $record->id;
                    $recordTrans->target_type = 'BusBooking';
                    $recordTrans->save();

                    $toMidtrans = [];
                    $toMidtrans = profileMidtransAPI($request->user_id);
                    
                    $toMidtrans['item_details'][0]['id'] = $getBooking->bookingCode;
                    $toMidtrans['item_details'][0]['name'] = $getBooking->operatorName.' - ('.$getBooking->originTerminal.' - '.$getBooking->destinationTerminal.')';
                    $toMidtrans['item_details'][0]['price'] = (int)$getBooking->ticketPrice;
                    $toMidtrans['item_details'][0]['quantity'] = 1;

                    $resultTotalHarga = (int)$getBooking->ticketPrice;
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
                        'status' => false,
                        'data' => $getBooking
                    ]);
                }
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
