<?php

namespace App\Http\Controllers\API\Darmawisata;

use Illuminate\Http\Request;
use App\Helpers\Darmawisata\Hotel;
use App\Http\Controllers\Controller;
use App\Models\Master\DarmaHotelNegara;
use App\Models\Master\DarmaHotelKota;
use App\Models\Darmawisata\HotelBooking;

use App\Models\User;
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;
use App\Models\TransaksiAmpas\TransaksiAmpase;

use Carbon\Carbon;
use PDF;

class HotelController extends Controller
{
    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->hotel = new Hotel();

        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    /**
     * Mengambil list Country
     *
     * @return Illuminate\Http\Response
     */
    public function getCountry(Request $request)
    {
        $record = DarmaHotelNegara::select('*');

        if($code = $request->code){
            $record->where('code', 'like', '%'.$code.'%');
        }

        if($name = $request->name){
            $record->where('name', 'like', '%'.$name.'%');
        }

        return response()->json([
            'status' => 200,
            'data' => $record->get()
        ]);
    }

    public function getCountryOne($id)
    {
        $record = DarmaHotelNegara::findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $record
        ]);
    }

    /**
     * Mengambil list Passport
     *
     * @return Illuminate\Http\Response
     */
    public function getPassport()
    {
        return response()->json(['data' => $this->hotel->getPassport()]);
    }

    /**
     * Mengambil list City
     *
     * @return Illuminate\Http\Response
     */
    public function getCity(Request $request)
    {
        $record = DarmaHotelKota::select('*');

        if($id_negara = $request->id_negara){
            $record->where('id_negara', 'like', '%'.$id_negara.'%');
        }

        if($code = $request->code){
            $record->where('code', 'like', '%'.$code.'%');
        }

        if($name = $request->name){
            $record->where('name', 'like', '%'.$name.'%');
        }

        return response()->json([
            'status' => 200,
            'data' => $record->get()
        ]);
    }

    public function getCityOne($id)
    {
        $record = DarmaHotelKota::findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $record
        ]);
    }

    /**
     * Mengambil list All Country All City
     *
     * @return Illuminate\Http\Response
     */
    public function getAllCountryAllCity()
    {
        return response()->json(['data' => $this->hotel->getAllCountryAllCity()]);
    }

    /**
     * search All Supplier
     *
     * @return Illuminate\Http\Response
     */
    public function searchAllSupplier(Request $request)
    {
        return response()->json(['data' => $this->hotel->searchAllSupplier($request)]);
    }

    /**
     * search
     *
     * @return Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return response()->json(['data' => $this->hotel->search($request)]);
    }

    /**
     * Mengambil Available Rooms
     *
     * @return Illuminate\Http\Response
     */
    public function searchAvailableRooms(Request $request)
    {
        return response()->json(['data' => $this->hotel->searchAvailableRooms($request)]);
    }

    /**
     * Mengambil data Images hotels
     *
     * @return Illuminate\Http\Response
     */
    public function getHotelImages(Request $request)
    {
        return response()->json(['data' => $this->hotel->getHotelImages($request)]);
    }

    /**
     * Mengambil Get Hotel Price And Policy Info
     *
     * @return Illuminate\Http\Response
     */
    public function getPriceAndPolicyInfo(Request $request)
    {
        return response()->json(['data' => $this->hotel->getPriceAndPolicyInfo($request)]);
    }

    /**
     * Set Booking All Supplier Hotel
     *
     * @return Illuminate\Http\Response
     */
    public function setBookingAllSupplier(Request $request)
    {
        return response()->json(['data' => $this->hotel->setBookingAllSupplier($request)]);
    }

    /**
     * Set Booking Only
     *
     * @return Illuminate\Http\Response
     */
    public function setBooking(Request $request)
    {
        return response()->json(['data' => $this->hotel->setBooking($request)]);
    }

    /**
     * Set Issued Hotel
     *
     * @return Illuminate\Http\Response
     */
    public function setIssued(Request $request)
    {
        return response()->json(['data' => $this->hotel->setIssued($request)]);
    }

    /**
     * Get Booking List Hotel
     *
     * @return Illuminate\Http\Response
     */
    public function getBookingList(Request $request)
    {
        return response()->json(['data' => $this->hotel->getBookingList($request)]);
    }

    /**
     * Get Booking List Hotel
     *
     * @return Illuminate\Http\Response
     */
    public function getBookingDetail(Request $request)
    {
        return response()->json(['data' => $this->hotel->getBookingDetail($request)]);
    }

    /**
     * Get Hotel Detail Information
     *
     * @return Illuminate\Http\Response
     */
    public function getDetailInfo(Request $request)
    {
        return response()->json(['data' => $this->hotel->getDetailInfo($request)]);
    }
    //-------------------- End Api Hotel -----------------------------------

    public function bookingList(Request $request){
        $record = HotelBooking::select('*');

        if($bookingDate = $request->bookingDate){
            $record->orWhere('bookingDate', 'like', '%'.$bookingDate.'%');
        }

        if($internalCode = $request->internalCode){
            $record->orWhere('internalCode', 'like', '%'.$internalCode.'%');
        }

        if($hotelName = $request->hotelName){
            $record->orWhere('hotelName', 'like', '%'.$hotelName.'%');
        }

        if($roomName = $request->roomName){
            $record->orWhere('roomName', 'like', '%'.$roomName.'%');
        }

        if($roomNum = $request->roomNum){
            $record->orWhere('roomNum', 'like', '%'.$roomNum.'%');
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
        $record = HotelBooking::findOrFail($id);

        return response([
            'status' => true,
            'result' => $record,
        ]);
    }

    public function bookingHotel(Request $request){
        $user = User::findOrFail($request->user_id);
        $request['status'] = 'Pending';
        $request['bookingStatus'] = 'Pending';
        $request['created_by'] = $user->id;

        $recHotel = HotelBooking::saveData($request);
        
        if($request->childAges && (count($request->childAges) > 0)){
          foreach ($request->childAges as $value) {
            $recHotel->age()->create([
              'age' => $value
            ]);
          }
        }

        if($request->paxes && (count($request->paxes) > 0)){
          foreach ($request->paxes as $value) {
            $recHotel->paxe()->create([
              'title' => $value['title'],
              'firstName' => $value['firstName'],
              'lastName' => $value['lastName'],
            ]);
          }
        }

        if($request->specialRequestArray && (count($request->specialRequestArray) > 0)){
          foreach ($request->specialRequestArray as $value) {
            $recHotel->special()->create([
              'special_id' => $value['special_id'],
              'description' => $value['description'],
            ]);
          }
        }

        return response([
            'status' => true,
            'result' => $recHotel,
        ]);

    }

     public function transaction(Request $request){
        \DB::beginTransaction();
        try {
            $user = User::findOrFail($request->user_id);
            if($user){
                $record = HotelBooking::findOrFail($request->target_id);
                $result = [];
            
                if($record){
                    
                    $saveTrans = [];
                    $saveTrans['user_id'] = $user->id;
                    $saveTrans['status'] = 'Menunggu Pembayaran';
                    $recordTrans = new TransaksiAmpase;
                    $recordTrans->fill($saveTrans);
                    $recordTrans->save();

                    $generateOrder = generateOrder(strlen($user->nama));
                    $recordTrans->order_id = '0'.$generateOrder.'000'.$recordTrans->id;
                    $recordTrans->target_id = $record->id;
                    $recordTrans->target_type = 'HotelBooking';
                    $recordTrans->save();

                    $toMidtrans = [];
                    $toMidtrans = profileMidtransAPI($request->user_id);
                    
                    $toMidtrans['item_details'][0]['id'] = $record->id;
                    $toMidtrans['item_details'][0]['name'] = $record->hotelName;
                    $toMidtrans['item_details'][0]['price'] = (int)$record->price;
                    $toMidtrans['item_details'][0]['quantity'] = 1;

                    $resultTotalHarga = (int)$record->price;
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
                        'data' => $record
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
