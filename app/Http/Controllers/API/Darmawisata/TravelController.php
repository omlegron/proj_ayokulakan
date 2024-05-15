<?php

namespace App\Http\Controllers\API\Darmawisata;

use Illuminate\Http\Request;
use App\Helpers\Darmawisata\Travel;
use App\Http\Controllers\Controller;
use App\Models\Darmawisata\TravelBooking;
use App\Models\User;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;
use App\Models\TransaksiAmpas\TransaksiAmpase;

use Carbon\Carbon;
use PDF;

class TravelController extends Controller
{
    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->travel = new Travel();

        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    /**
     * Get Travel List
     *
     * @return Illuminate\Http\Response
     */
    public function getTravelList()
    {
        return response()->json(['data' => $this->travel->getTravelList()]);
    }

    /**
     * Get Travel Route
     *
     * @return Illuminate\Http\Response
     */
    public function getTravelRoute(Request $request)
    {
        return response()->json(['data' => $this->travel->getTravelRoute($request)]);
    }

    /**
     * Get Travel Schedules
     *
     * @return Illuminate\Http\Response
     */
    public function getShuttleSchedule(Request $request)
    {
        return response()->json(['data' => $this->travel->getShuttleSchedule($request)]);
    }

    /**
     * Get Travel Schedules
     *
     * @return Illuminate\Http\Response
     */
    public function getShuttleSeatMap(Request $request)
    {
        return response()->json(['data' => $this->travel->getShuttleSeatMap($request)]);
    }

    /**
     * set Travel Booking
     *
     * @return Illuminate\Http\Response
     */
    public function setShuttleBooking(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $result = $this->travel->setShuttleBooking($request);
        if($result->status == 'SUCCESS'){
            $record = TravelBooking::create([
              'shuttleID' => $result->shuttleID,
              'bookingCode' => $result->bookingCode,
              'salesPrice' => $result->salesPrice,
              'memberCommission' => $result->memberCommission,
              'ticketPrice' => $result->ticketPrice,
              'ticketStatus' => $result->ticketStatus,
              'departTime' => $result->departTime,
              'bookingDate' => $result->bookingDate,
              'issuedTimeLimit' => $result->issuedTimeLimit,
              'origin' => $result->origin,
              'destination' => $result->destination,
              'originCity' => $result->originCity,
              'destinationCity' => $result->destinationCity,
              'accessToken' => $result->accessToken,
              'status' => $result->status,
              'respMessage' => $result->respMessage,
              'created_by' => $user->id,
            ]);
        }
        return response()->json(['data' => $result]);
    }

    /**
     * get Travel Booking List
     *
     * @return Illuminate\Http\Response
     */
    public function getShuttleBookingDetail(Request $request)
    {
        return response()->json(['data' => $this->travel->getShuttleBookingDetail($request)]);
    }

    public function bookingList(Request $request){
        $record = TravelBooking::select('*');

        if($shuttleID = $request->shuttleID){
            $record->orWhere('shuttleID', 'like', '%'.$shuttleID.'%');
        }

        if($bookingCode = $request->bookingCode){
            $record->orWhere('bookingCode', 'like', '%'.$bookingCode.'%');
        }

        if($bookingDate = $request->bookingDate){
            $record->orWhere('bookingDate', 'like', '%'.$bookingDate.'%');
        }

        if($origin = $request->origin){
            $record->orWhere('origin', 'like', '%'.$origin.'%');
        }

        if($destination = $request->destination){
            $record->orWhere('destination', 'like', '%'.$destination.'%');
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
        $record = TravelBooking::findOrFail($id);

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
                $record = TravelBooking::findOrFail($id);
                $result = [];
                
                $request['accessToken'] = $record->accessToken;
                $request['bookingCode'] = $record->bookingCode;
                $request['bookingDate'] = Carbon::parse($record->bookingDate)->format('Y-m-d');

                $getBooking = $this->travel->getShuttleBookingDetail($request);
                if($getBooking == 'SUCCESS'){

                    $saveTrans = [];
                    $saveTrans['user_id'] = $user->id;
                    $saveTrans['status'] = 'Menunggu Pembayaran';
                    $recordTrans = new TransaksiAmpase;
                    $recordTrans->fill($saveTrans);
                    $recordTrans->save();

                    $generateOrder = generateOrder(strlen($user->nama));
                    $recordTrans->order_id = '0'.$generateOrder.'000'.$recordTrans->id;
                    $recordTrans->target_id = $record->id;
                    $recordTrans->target_type = 'TravelBooking';
                    $recordTrans->save();

                    $toMidtrans = [];
                    $toMidtrans = profileMidtransAPI($request->user_id);
                    
                    $toMidtrans['item_details'][0]['id'] = $getBooking->bookingCode;
                    $toMidtrans['item_details'][0]['name'] = '('.$getBooking->origin.') - ('.$getBooking->destination.') ';
                    $toMidtrans['item_details'][0]['price'] = (int)$getBooking->ticketPrice;
                    $toMidtrans['item_details'][0]['quantity'] = $getBooking->totalTicket;

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
