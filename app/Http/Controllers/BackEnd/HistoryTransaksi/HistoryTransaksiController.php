<?php

namespace App\Http\Controllers\BackEnd\HistoryTransaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Barang\LapakBarang;
use App\Models\Barang\FavoritBarang;
use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;

use DataTables;
use Zipper;
use Carbon\Carbon;
use Auth;
use DB;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;

// AIRLINE
use App\Models\Airline;
use App\Models\AirlineBooking;
use App\Helpers\Darmawisata\Airline as AirlineDarmawisata;
use App\Models\Master\TicketingAirport;

// HOTEL
use App\Models\Darmawisata\HotelBooking;

// BUSS
use App\Models\Darmawisata\BusBooking;

// SHIP
use App\Models\Master\DarmaPelniOrigin;
use App\Models\Darmawisata\KapalBooking;
use App\Helpers\Darmawisata\Ship;

// TOUR
use App\Models\Darmawisata\TourBooking;

// TRAVEL
use App\Helpers\Darmawisata\Travel;
use App\Models\Darmawisata\TravelBooking;

// KERETA
use App\Models\MobilPulsa\KeretaBooking;
use App\Models\MobilPulsa\KeretaPassenger;

class HistoryTransaksiController extends Controller
{
  //
  protected $link = 'history-trans/';

  function __construct()
  {
    $this->airline = new AirlineDarmawisata();
    $this->ship = new Ship();
    $this->travel = new Travel();

    Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
    Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
    Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
    Veritrans_Config::$is3ds = config('services.midtrans.is3ds');

    \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
    \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
    \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
    \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

    $this->setLink($this->link);
    $this->setTitle("Data History Order & Transaksi");
    // $this->setGroup("Master");
    // $this->setSubGroup("Aplikasi");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Data History Order & Transaksi' => 'history-trans']);
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
        'data' => 'user_id',
        'name' => 'user_id',
        'label' => 'Nama Pembeli ',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'target_type',
        'name' => 'target_type',
        'label' => 'Tipe Transaksi',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'order_id',
        'name' => 'order_id',
        'label' => 'Order Id',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'status',
        'name' => 'status',
        'label' => 'Status Order',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'created_at',
        'name' => 'created_at',
        'label' => 'Tanggal Order',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
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
    
    if(isset(auth()->user()->status) && auth()->user()->status == '1010'){
      $records = TransaksiAmpase::select('*');
    }else{
      $records = TransaksiAmpase::where('created_by',auth()->user()->id)->select('*');
    }

    if (!isset(request()->order[0]['column'])) {
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($name = $request->nama) {
      $records->where('order_id', 'like', '%'.$name.'%' );
    }
    //Filters
    return Datatables::of($records)
    ->addColumn('num', function ($record) use ($request) {
      return $request->get('start');
    })
    ->addColumn('target_type', function ($record) {

      $data = '-';
      if($record->detail && ($record->detail->count() > 0)){
        $data = 'Product Barang / Sewa';
      }elseif($record->prepaid){
        $data = 'PPOB Prepaid';
      }elseif($record->postpaid){
        $data = 'PPOB Postpaid';
      }elseif($record->target){
        $data = $record->target_type;
      }
      return $data;
    })
    ->addColumn('user_id', function ($record) {
      return $record->user->nama;
    })
    ->addColumn('status', function ($record) {
        $status = '';
      
        $status .= '<span class="badge badge-pill badge-warning">'.$record->status.'</span>';
        return $status;
    })
    ->addColumn('action', function ($record) {
      $btn = '';
      //Edit
        if(($record->payment_type == 'credit_card') && ($record->transaction_status == 'accept') || ($record->transaction_status == 'success')){
          $btn .= $this->makeButton([
            'type' => 'approve',
            'tooltip' => 'Refound',
            'class' => 'btn btn-sm btn-danger approve',
            'label' => '<i class="fa fa-history"></i>',
            'id'   => $record->id,
            'datas' => [
              'url' => url('history-trans/refound/'.$record->id),  
              'title' => 'Apakah anda yakin ingin mengcancel transaksi ?',  
              'text' => 'Silahkan Pilih Ya Untuk Cancel, Tidak Untuk Batalkan!'
            ] 
          ]);
        }

        $btn .= $this->makeButton([
          'type' => 'url',
          'tooltip' => 'Proses Data',
          'class' => 'btn btn-sm btn-success',
          'label' => '<i class="fa fa-eye"></i>',
          'id'   => $record->id,
          'target' => url('history-trans/'.$record->id.'/detail')
        ]);

        $btn .= $this->makeButton([
          'type' => 'url',
          'tooltip' => 'Download Tata cara transfer',
          'class' => 'btn btn-sm btn-warning',
          'label' => '<i class="fa fa-download"></i>',
          'id'   => $record->id,
          'attributes'   => [
            'target' => '_blank'
          ],
          'target' => env('MIDTRANS_URL_PDF').'/snap/v1/transactions/'.$record->snap_token.'/pdf'
        ]);
        // Delete
        // $btn .= $this->makeButton([
        //   'type' => 'delete',
        //   'id'   => $record->id
        // ]);

      return $btn;
    })
    ->rawColumns(['action','harga_barang','status'])
    ->make(true);
  }

  public function index()
  {
    // dd(config('services.midtrans.midtransUrl'));
    return $this->render('backend.history-transaksi.index', [
      'mockup' => false,
    ]);
  }
  
  public function show($id)
  {
    
    $record = TransaksiAmpase::findOrFail($id);
    
    if($record->target){
      if(isset($record->target_type)){
        return $this->checkTarget($record);
      }
    }else{
      return $this->render('backend.history-transaksi.show',[
          'record' => $record,
      ]);
    }
  }

  public function refound(Request $request, $id){
    \DB::beginTransaction();
    try {
      $record = TransaksiAmpase::findOrFail($id);
      $cancel = \Midtrans\Transaction::cancel($record->order_id);
      if($cancel == '200'){
        $status = \Midtrans\Transaction::status($record->order_id);
        $record->status = 'cancel';
        $record->transaction_status = $status->transaction_status;
        $record->fraud_status = $status->fraud_status;
        $record->save();
      }
      \DB::commit();
      return response([
        'status' => true,
      ]);
    } catch (Exception $e) {
      \DB::rollback();
      return response([
          'status' => false,
          'message' => 'Sayang Sekali ID Transaction Tidak Dapat Di Cancel'
      ],500);
    }
    
  }

  public function checkTarget($recordTrans){
    if($recordTrans->target){
      if(isset($recordTrans->target_type) && $recordTrans->target_type == 'AirlineBooking'){
        $record = AirlineBooking::findOrFail($recordTrans->target_id);
        $cities = TicketingAirport::get();
        request()['bookingCode'] = $record->bookingCode;
        request()['bookingDate'] = $record->bookingDate;
        $result = $this->airline->getBookingDetail(request());
        return $this->render('frontend.tickets.airline.booking',[
            'result' => $result,
            'cities' => $cities,
            'record' => $record,
        ]); 
      }elseif(isset($recordTrans->target_type) && $recordTrans->target_type == 'HotelBooking'){
        if(\Auth::check()){
          $record = HotelBooking::findOrFail($recordTrans->target_id);
          $result = [];
          
          request()['accessToken'] = $record->accessToken;
          request()['reservationNo'] = $record->reservationNo;
          request()['osRefNo'] = $record->osRefNo;
          request()['agentOsRef'] = $record->agentOsRef;
          request()['hotelID'] = $record->hotelID;

          $getBooking = guzzleGet(request(),'/api/darmawisata/hotel/booking/detail')->data;
          $getHotel = guzzleGet(request(),'/api/darmawisata/hotel/info')->data;
          // $result = guzzlePost(request(),'/api/darmawisata/hotel/issued')->data;
          // dump($getBooking);
          // dd($getHotel);
          return $this->render('frontend.darmawisata.hotel.detail-booking',[
              'record' => $record,
              'getBooking' => $getBooking,
              'getHotel' => $getHotel,
              'user' => auth()->user()
          ]);
        }else{
            return redirect('login');
        }
      }elseif(isset($recordTrans->target_type) && $recordTrans->target_type == 'BusBooking'){
        if(\Auth::check()){
            $record = BusBooking::findOrFail($recordTrans->target_id);
            $result = [];
            
            request()['accessToken'] = $record->accessToken;
            request()['bookingCode'] = $record->bookingCode;
            request()['bookingDate'] = Carbon::parse($record->bookingTime)->format('Y-m-d');

            $getBooking = guzzleGet(request(),'/api/darmawisata/bus/booking/detail')->data;
            // dd($getBooking);
            return $this->render('frontend.darmawisata.bus.booking-detail',[
                'record' => $record,
                'getBooking' => $getBooking,
                'user' => auth()->user()
            ]);
        }else{
            return redirect('login');
        }
      }elseif(isset($recordTrans->target_type) && $recordTrans->target_type == 'KapalBooking'){
        if(\Auth::check()){
            $record = KapalBooking::findOrFail($recordTrans->target_id);
            $result = [];
            
            request()['accessToken'] = $record->accessToken;
            request()['numCode'] = $record->numCode;
            request()['bookingDate'] = Carbon::parse($record->bookingDate)->format('Y-m-d');

            $getBooking = $this->ship->getShipBookingDetail(request());
            // $getBooking = guzzleGet($request,'/api/darmawisata/ship/booking/detail')->data;
            return $this->render('frontend.darmawisata.kapal.booking-detail',[
                'record' => $record,
                'getBooking' => $getBooking,
                'origin' => DarmaPelniOrigin::where('originPort',$getBooking->originPort)->first(),
                'deperature' => DarmaPelniOrigin::where('originPort',$getBooking->destinationPort)->first(),
                'user' => auth()->user()
            ]);
        }else{
            return redirect('login');
        }
      }elseif(isset($recordTrans->target_type) && $recordTrans->target_type == 'TourBooking'){
        if(\Auth::check()){
            $record = TourBooking::findOrFail($recordTrans->target_id);
            $result = [];
            
            request()['accessToken'] = $record->accessToken;
            request()['bookingCode'] = $record->bookingCode;
            request()['TourVariant'] = $record->TourVariant;

            $getBooking = guzzleGet(request(),'/api/darmawisata/tour/booking-detail')->data;
            // dd($getBooking);
            return $this->render('frontend.darmawisata.tour.booking-detail',[
                'record' => $record,
                'getBooking' => $getBooking,
                'user' => auth()->user()
            ]);
        }else{
            return redirect('login');
        }
      }elseif(isset($recordTrans->target_type) && $recordTrans->target_type == 'TravelBooking'){
        if(\Auth::check()){
            $record = TravelBooking::findOrFail($recordTrans->target_id);
            $result = [];
            
            request()['accessToken'] = $record->accessToken;
            request()['bookingCode'] = $record->bookingCode;
            request()['bookingDate'] = Carbon::parse($record->bookingDate)->format('Y-m-d');

            $getBooking = $this->travel->getShuttleBookingDetail(request());
            // dd($getBooking);
            return $this->render('frontend.darmawisata.travel.booking-detail',[
                'record' => $record,
                'getBooking' => $getBooking,
                'user' => auth()->user()
            ]);
        }else{
            return redirect('login');
        }
      }elseif(isset($recordTrans->target_type) && $recordTrans->target_type == 'KeretaBooking'){
        if(\Auth::check()){
          $record = KeretaBooking::find($recordTrans->target_id);
          return $this->render('frontend.tickets.kereta.index-detail', [
              'record' => $record,
          ]);
        }else{
          redirect('login');
        }
      }


    }
  }
}
