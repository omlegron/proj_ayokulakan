<?php

namespace App\Http\Controllers\API\Darmawisata;

use Illuminate\Http\Request;
use App\Helpers\Darmawisata\Ship;
use App\Http\Controllers\Controller;

use App\Models\Darmawisata\KapalBooking;
use App\Models\Master\DarmaPelniOrigin;
use App\Models\User;
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;
use App\Models\TransaksiAmpas\TransaksiAmpase;

use Carbon\Carbon;
use PDF;

class ShipController extends Controller
{
    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->ship = new Ship();

         Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    
    }

    /**
     * Get Ship Route
     *
     * @return Illuminate\Http\Response
     */
    public function getShipRoutes()
    {
        return response()->json(['data' => $this->ship->getShipRoutes()]);
    }

    /**
     * Get Ship Schedule
     *
     * @return Illuminate\Http\Response
     */
    public function getShipSchedule(Request $request)
    {
        return response()->json(['data' => $this->ship->getShipSchedule($request)]);
    }

    /**
     * Get Ship getShipAvalibility
     *
     * @return Illuminate\Http\Response
     */
    public function getShipAvalibility(Request $request)
    {
        return response()->json(['data' => $this->ship->getShipAvalibility($request)]);
    }

    /**
     * getShipRooms
     *
     * @return Illuminate\Http\Response
     */
    public function getShipRooms(Request $request)
    {
        return response()->json(['data' => $this->ship->getShipRooms($request)]);
    }

    /**
     * setShipBooking
     *
     * @return Illuminate\Http\Response
     */
    public function setShipBooking(Request $request)
    {
        return response()->json(['data' => $this->ship->setShipBooking($request)]);
    }

    /**
     * set Ship Issued
     *
     * @return Illuminate\Http\Response
     */
    public function setShipIssued(Request $request)
    {
        return response()->json(['data' => $this->ship->setShipIssued($request)]);
    }

    /**
     * get Ship Booking List
     *
     * @return Illuminate\Http\Response
     */
    public function getShipBookingList(Request $request)
    {
        return response()->json(['data' => $this->ship->getShipBookingList($request)]);
    }

    /**
     * get Ship Booking List
     *
     * @return Illuminate\Http\Response
     */
    public function getShipBookingDetail(Request $request)
    {
        return response()->json(['data' => $this->ship->getShipBookingDetail($request)]);
    }

    //-------------------- End Api  -----------------------------------

    public function bookingList(Request $request){
        $record = KapalBooking::select('*');

        if($numCode = $request->numCode){
            $record->orWhere('numCode', 'like', '%'.$numCode.'%');
        }

        if($departDate = $request->departDate){
            $record->orWhere('departDate', 'like', '%'.$departDate.'%');
        }

        if($bokingNumber = $request->bokingNumber){
            $record->orWhere('bokingNumber', 'like', '%'.$bokingNumber.'%');
        }

        if($kelasKapal = $request->kelasKapal){
            $record->orWhere('kelasKapal', 'like', '%'.$kelasKapal.'%');
        }

        if($bookingDateTime = $request->bookingDateTime){
            $record->orWhere('bookingDateTime', 'like', '%'.$bookingDateTime.'%');
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
        $record = KapalBooking::findOrFail($id);

        return response([
            'status' => true,
            'result' => $record,
        ]);
    }

    public function bookingKapal(Request $request){
        $user = User::findOrFail($request->user_id);
        $resBooking = $this->ship->setShipBooking($request);
        if($resBooking->status == 'SUCCESS'){
            $record = KapalBooking::create([
                'numCode' => $resBooking->numCode,
                'departDate' => $resBooking->departDate,
                'salesPrice' => $resBooking->salesPrice,
                'memberDiscount' => $resBooking->memberDiscount,
                'kelasKapal' => $request->kelasKapal,
                'ticketPrice' => $resBooking->ticketPrice,
                'shipMarkup' => $resBooking->shipMarkup,
                'bookingDateTime' => $resBooking->bookingDateTime,
                'status' => $resBooking->status,
                'bookingStatus' => 'HOLD',
                'respMessage' => $resBooking->respMessage,
                'accessToken' => $resBooking->accessToken,
                'created_by' => $user->id,
            ]);
        }
        return response()->json(['data' => $resBooking]);
    }

    public function transaction(Request $request){
        \DB::beginTransaction();
        try {
            $user = User::findOrFail($request->user_id);
            if($user){
                $record = KapalBooking::findOrFail($id);
                $result = [];
                
                $request['accessToken'] = $record->accessToken;
                $request['numCode'] = $record->numCode;
                $request['bookingDate'] = Carbon::parse($record->bookingDate)->format('Y-m-d');

                $getBooking = $this->ship->getShipBookingDetail($request);
                if($getBooking == 'SUCCESS'){
                    $origin = DarmaPelniOrigin::where('originPort',$getBooking->originPort)->first();
                    $deperature = DarmaPelniOrigin::where('originPort',$getBooking->destinationPort)->first();

                    $saveTrans = [];
                    $saveTrans['user_id'] = $user->id;
                    $saveTrans['status'] = 'Menunggu Pembayaran';
                    $recordTrans = new TransaksiAmpase;
                    $recordTrans->fill($saveTrans);
                    $recordTrans->save();

                    $generateOrder = generateOrder(strlen($user->nama));
                    $recordTrans->order_id = '0'.$generateOrder.'000'.$recordTrans->id;
                    $recordTrans->target_id = $record->id;
                    $recordTrans->target_type = 'KapalBooking';
                    $recordTrans->save();

                    $toMidtrans = [];
                    $toMidtrans = profileMidtransAPI($request->user_id);
                    
                    if($getBooking->paxBookingDetails){
                      if(count($getBooking->paxBookingDetails) > 0){
                        $i = -1;
                        foreach ($getBooking->paxBookingDetails as $k => $value) {
                          $toMidtrans['item_details'][$k]['id'] = $value->ID;
                          $toMidtrans['item_details'][$k]['name'] = $value->paxName.' - Tiket Kapal '.$getBooking->shipName.' '.$origin->originName.'-'.$deperature->originName;
                          $toMidtrans['item_details'][$k]['price'] = (int)$value->fare;
                          $toMidtrans['item_details'][$k]['quantity'] = 1;
                        }

                        $toMidtrans['transaction_details'] = array(
                          'order_id' => $recordTrans->order_id,
                          'gross_amount' => (int)$getBooking->ticketPrice
                        );
                        $recordTrans->total_harga = (int)$getBooking->ticketPrice;
                        $recordTrans->save();
                      }
                    }

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
