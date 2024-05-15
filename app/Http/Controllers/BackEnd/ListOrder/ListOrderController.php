<?php

namespace App\Http\Controllers\BackEnd\ListOrder;

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

class ListOrderController extends Controller
{
  //
  protected $link = 'list-order/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Pesanan Barang Masuk ");
    // $this->setGroup("Master");
    // $this->setSubGroup("Aplikasi");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Pesanan Barang Masuk ' => 'list-order']);
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
    if(auth()->user()->status == 1010){
      $records = TransaksiAmpase::with('detail')->whereHas('detail',function($q){
        $q->where('form_type','img_barang');
      })->select('*');
    }else{
      $records = TransaksiAmpase::with('detail')->where(function ($insp) {
        $insp->where('transaction_status','!=','deny')->orWhere('transaction_status','!=','expiers');
      })->whereHas('detail',function($q){
        $q->where('form_type','img_barang');
      })->select('*');
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
        $btn .= $this->makeButton([
          'type' => 'url',
          'tooltip' => 'Proses Data',
          'class' => 'btn btn-sm btn-success',
          'label' => '<i class="fa fa-eye"></i>',
          'id'   => $record->id,
          'target' => url('list-order/'.$record->id.'/detail')
        ]);
        // $btn .= $this->makeButton([
        //   'type' => 'approve',
        //   'tooltip' => 'Lihat Data',
        //   'id'   => $record->id
        // ]);
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
    return $this->render('backend.list-order.index', [
      'mockup' => false,
    ]);
  }
  
  public function show($id)
  {
    if(auth()->user()->status == 1010){
      $record = TransaksiAmpase::with('detail')->findOrFail($id);
    }else{
      $record = TransaksiAmpase::with('detail','detail.barang')->whereHas('detail',function($q){
        $q->where('form_type','img_barang')->whereHas('barang',function($qq){
          $qq->where('created_by',auth()->user()->id);
        });
      })->findOrFail($id);
    }

    if($record->target){
      if(isset($record->target_type)){
        return $this->checkTarget($record);
      }
    }else{
      return $this->render('backend.list-order.show',[
        'record' => $record,
      ]);
    }
    
  }

  public function prosesBarang(Request $request, $id){
    $cekPembatalan = 'false';
    if($request->detail){
      if(count($request->detail) > 0){
        foreach ($request->detail as $k => $value) {
            $cekRec = TransaksiAmpaseBarangDetail::findOrFail($k);
            $cekRec->status_barang = $value;
            $cekRec->save();
            if($value == 'Pesanan Dibatalkan'){
              $cekPembatalan = 'true';
            }
        }
      }
    }
    $record = TransaksiAmpase::with('detail')->findOrFail($id);
    $record->status = 'Pesanan Dibatalkan';
    $record->save();
    return response([
      'status' => true,
      'url' => url('list-order')
    ]);
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
