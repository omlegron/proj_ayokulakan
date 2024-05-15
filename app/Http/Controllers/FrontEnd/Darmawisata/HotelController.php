<?php

namespace App\Http\Controllers\FrontEnd\Darmawisata;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Airline;
use Illuminate\Http\Request;
use App\Models\AirlineBooking;
use Illuminate\Support\Facades\DB;
use App\Helpers\Darmawisata\Airline as AirlineDarmawisata;

use App\Http\Controllers\Controller;

use App\Http\Resources\AirlineBookingResource;
use App\Models\Master\TicketingAirport;

use App\Models\Darmawisata\HotelBooking;
use App\Models\Darmawisata\HotelBookingSpecial;
use App\Models\TransaksiAmpas\TransaksiAmpase;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;

use DataTables;
use PDF;

class HotelController extends Controller
{
    protected $link = 'hotel/booking-list/';

    public function __construct()
    {
        $this->client = new Client();
        $this->airline = new AirlineDarmawisata();

        $this->setLink($this->link);
        $this->setTitle("Pencarian Booking Hotel");
        $this->setGroup("Hotel");
        $this->setSubGroup("Booking");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Hotel' => '#', 'Booking' => 'hotel/booking-list/']);

        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');

        // Header Grid Datatable
        $this->setTableStruct([
            [
                'data' => 'num',
                'name' => 'num',
                'label' => '#',
                'orderable' => false,
                'searchable' => false,
                'className' => "text-center text-nowrap",
                'width' => '40px',
            ],
            /* --------------------------- */
            [
                'data' => 'hotelName',
                'name' => 'hotelName',
                'label' => 'Nama Hotel',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'roomID',
                'name' => 'roomID',
                'label' => 'ID Ruangan',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'checkInDate',
                'name' => 'checkInDate',
                'label' => 'Check In Date',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'checkOutDate',
                'name' => 'checkOutDate',
                'label' => 'Check Out Date',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'bookingStatus',
                'name' => 'bookingStatus',
                'label' => 'Status',
                'searchable' => false,
                'sortable' => true,
                'width' => '100px',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'created_by',
                'name' => 'created_by',
                'label' => 'Pemesan',
                'searchable' => false,
                'sortable' => true,
                'width' => '100px',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'created_at',
                'name' => 'created_at',
                'label' => 'Created At',
                'searchable' => false,
                'sortable' => true,
                'width' => '100px',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'action',
                'name' => 'action',
                'label' => 'Aksi',
                'searchable' => false,
                'sortable' => false,
                'width' => '100px',
                'className' => "text-center text-nowrap",

            ]
        ]);
    }

    public function grid(Request $request)
    {
        if(auth()->user()->status == 1010){
            $records = HotelBooking::select('*');
        }else{
            $records = HotelBooking::where('created_by',auth()->user()->id)->select('*');
        }
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
              // $records->->sort();
              $records->orderBy('created_at', 'desc');
          }
            //Filters
          if ($hotelName = $request->hotelName) {
              $records->where('hotelName', 'like', '%'.$hotelName.'%' );
          }

          if ($roomName = $request->roomName) {
              $records->where('roomName', 'like', '%'.$roomName.'%' );
          }

          if ($bookingDate = $request->bookingDate) {
              $records->where('bookingDate', 'like', '%'.$bookingDate.'%' );
          }
        //Filters
      return Datatables::of($records)
      ->addColumn('num', function ($record) use ($request) {
          return $request->get('start');
      })
      ->addColumn('created_at', function ($record) {
          return $record->creationDate();
        })
       ->addColumn('created_by', function ($record) {
          return $record->creatorName();
        })
      ->addColumn('action', function ($record) {
          $btn = '';
          //detail
          $btn .= $this->makeButton([
              'type' => 'url',
              'tooltip' => 'Detail Data',
              'id'   => $record->id,
              'target' => url('hotel/booking/detail/'.$record->id)
          ]);
          // download
          $btn .= $this->makeButton([
              'type' => 'url',
              'tooltip' => 'Download Data',
              'class' => 'btn btn-sm btn-success',
              'label' => '<i class="fa fa-download"></i>',
              'id'   => $record->id,
              'target' => url('hotel/booking/download/'.$record->id)
          ]);
          return $btn;
      })
      ->rawColumns(['action','deskripsi'])
      ->make(true);
    }

    /**
     * Menampilkan halaman form pencarian
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->render('frontend.darmawisata.hotel.index');
    }

    /**
     * Menampilkan Pencarian Hotel
     *
     * @param Illuminate\Http\Request $request
     * @return Illumintae\Http\Response
     */
    public function search(Request $request)
    {
        $result = [];
        $result = guzzleGet($request,'/api/darmawisata/hotel/search')->data;
        if($result->status == 'FAILED'){
            return response([
                'status' => 'message',
                'message' => $result->respMessage
            ],412);
        }
        // dump($result);
        return $this->render('frontend.darmawisata.hotel.list-hotel',[
            'result' => $result
        ]);
    }

    /**
     * Pesan hotel bookings
     *
     * @return Illuminate\Http\Response
     */
    public function searchRooms(Request $request)
    {
        if(\Auth::check()){
            $result = [];
            $result = guzzleGet($request,'/api/darmawisata/hotel/search/rooms')->data;
            if($result->status == 'FAILED'){
                return response([
                    'status' => 'message',
                    'message' => $result->respMessage
                ],412);
            }
            // dump($result); 
            return $this->render('frontend.darmawisata.hotel.search-rooms',[
                'result' => $result,
                'user' => auth()->user(),
                'request' => $request,
            ]);
        }else{
            return redirect('login');
        }
    }

    /**
     * Get data detail rooms
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function getDetailRooms(Request $request)
    {
        // dd($request->all());
        if(\Auth::check()){
            $result = [];
            $result = guzzleGet($request,'/api/darmawisata/hotel/price')->data;
            // dump($result);
            $user = auth()->user();
            if($result->status == 'FAILED'){
                return response([
                    'status' => 'message',
                    'message' => $result->respMessage
                ],412);
            }
            // dd($result);
            return $this->render('frontend.darmawisata.hotel.detail-rooms', compact('result','user'));
        }else{
            return redirect('login');
        }
    }

    /**
     * Posr Booking Hotel
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function setBooking(Request $request)
    {
        // $result = guzzlePost(request(),'/api/darmawisata/hotel/booking')->data;
        // dump($request->all());
        // dd($result);
        if(\Auth::check()){
            $price = substr($request->price,3);
            $price = preg_replace("/[^0-9]/", "", $price);
            $len = strlen($price) - 2;
            $price = substr($price,0,$len);
            $request['price'] = $price;
            $request['status'] = 'Pending';
            $request['bookingStatus'] = 'Pending';
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

            $searchHotel = guzzleGet($request,'/api/darmawisata/hotel/search/rooms')->data;
            if($searchHotel && ($searchHotel->status == 'SUCCESS')){
              $recHotel->hotelName = $searchHotel->hotelInfo->name;
              $recHotel->save();
            }
            $searchRoom = guzzleGet($request,'/api/darmawisata/hotel/price')->data;
            if($searchRoom && ($searchRoom->status == 'SUCCESS')){
              // dd($searchRoom);
              $recHotel->roomID = $searchRoom->roomID;
              $recHotel->save();
            }
            return response([
                'status' => true,
                'url' => url('hotel/booking-list')
            ]);
        }else{
            return response([
                'status' => true,
                'url' => url('login')
            ]);
        }
    }

    /**
     * Menampilkan data hasil Booking
     *
     * @return Illuminate\Http\Response
     */
    public function showHotelBookingList()
    {
        if(\Auth::check()){
            return $this->render('frontend.darmawisata.hotel.booking-list',[
                'mockup' => false
            ]);
        }else{
            return redirect('login');
        }
    }

    /**
     * Mendapatkan data Booking Detail
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getBookingDetail(Request $request, $id)
    {
        
        if(\Auth::check()){
            $record = HotelBooking::findOrFail($id);
            $result = [];
            
            $request['accessToken'] = $record->accessToken;
            $request['reservationNo'] = $record->reservationNo;
            $request['osRefNo'] = $record->osRefNo;
            $request['agentOsRef'] = $record->agentOsRef;
            $request['hotelID'] = $record->hotelID;

            $getBooking = guzzleGet($request,'/api/darmawisata/hotel/booking/detail')->data;
            $getHotel = guzzleGet($request,'/api/darmawisata/hotel/info')->data;
            // $result = guzzlePost(request(),'/api/darmawisata/hotel/issued')->data;
            // dump($getBooking);
            // dump($getHotel);
            // dd($request->all());
            return $this->render('frontend.darmawisata.hotel.detail-booking',[
                'record' => $record,
                'getBooking' => $getBooking,
                'getHotel' => $getHotel,
                'user' => auth()->user()
            ]);
        }else{
            return redirect('login');
        }
    }

    /**
     * Mengubah data status booking di local
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setIssued(Request $request)
    {
        AirlineBooking::updateOrCreate(
            ['bookingCode' => $request->bookingCode],
            ['bookingStatus' => $request->bookingStatus],
        );

        return response()->json([
            'success' => true,
            'message' => 'success'
        ]);
    }

    public function getBookingDownload(Request $request, $id){
        if(\Auth::check()){
            $namaSurat = 'Hotel_'.auth()->user()->name.''.Carbon::now()->format('dmY_His').'.pdf';
            $record = HotelBooking::findOrFail($id);
            $result = [];
            
            $request['accessToken'] = $record->accessToken;
            $request['reservationNo'] = $record->reservationNo;
            $request['osRefNo'] = $record->osRefNo;
            $request['agentOsRef'] = $record->agentOsRef;
            $request['hotelID'] = $record->hotelID;

            $getBooking = guzzleGet($request,'/api/darmawisata/hotel/booking/detail')->data;
            $getHotel = guzzleGet($request,'/api/darmawisata/hotel/info')->data;
            
            $customPaper = array(0,0,350,550);
            $pdf = PDF::loadView('frontend.darmawisata.hotel.pdf', [
                'record' => $record,
                'getBooking' => $getBooking,
                'getHotel' => $getHotel,
            ])->setPaper($customPaper)->setOptions(
                [
                  'isHtml5ParserEnabled' => true,
                  'isRemoteEnabled' => true,
                  'isPhpEnabled' => true
                ]
            );

            return $pdf->stream($namaSurat);
        }else{
            return redirect('login');
        }
    }

    public function bayar(Request $request,$id)
    {
      DB::beginTransaction();
      try {
        if(\Auth::check()){
            $record = HotelBooking::findOrFail($id);
            $result = [];
            
            $saveTrans = [];
            $saveTrans['user_id'] = auth()->user()->id;
            $saveTrans['status'] = 'Menunggu Pembayaran';
            $recordTrans = new TransaksiAmpase;
            $recordTrans->fill($saveTrans);
            $recordTrans->save();

            $generateOrder = generateOrder(strlen(auth()->user()->nama));
            $recordTrans->order_id = '0'.$generateOrder.'000'.$recordTrans->id;
            $recordTrans->target_id = $record->id;
            $recordTrans->target_type = 'HotelBooking';
            $recordTrans->save();
            // dd((float)$getBooking->bookingDetail->price);
            $toMidtrans = profileMidtrans();
            $toMidtrans['item_details'][0]['id'] = $record->id;
            $toMidtrans['item_details'][0]['name'] = $record->hotelName;
            $toMidtrans['item_details'][0]['price'] = (int)$record->price;
            $toMidtrans['item_details'][0]['quantity'] = 1;

            $toMidtrans['transaction_details'] = array(
              'order_id' => $recordTrans->order_id,
              'gross_amount' => (int)$record->price
            );
            $recordTrans->total_harga = $record->price;
            $recordTrans->save();

            $RessSnap = Veritrans_Snap::getSnapToken($toMidtrans);
            $recordTrans->snap_token = $RessSnap;
            $recordTrans->save();
            DB::commit();
            return response([
                'status' => true,
                'data' => $record,
                'record' => $recordTrans,
                'url' => url('history-trans')
            ]);
            
        }else{
            return response([
              'url' => url('login')
            ]);
        }
      } catch (Exception $e) {
        DB::rollback();
        return response([
            'status' => false,
            'errors' => $e
        ]);
      }
        
    }
}
