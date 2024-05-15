<?php

namespace App\Http\Controllers\FrontEnd\Darmawisata;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Master\DarmaBusList;
use App\Models\Darmawisata\BusBooking;
use App\Helpers\Darmawisata\Bus;
use App\Models\TransaksiAmpas\TransaksiAmpase;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;

use DataTables;
use PDF;

class BusController extends Controller
{

    protected $link = 'bus/list/';

    public function __construct()
    {
        $this->client = new Client();
        $this->bus = new Bus();
        $this->setLink($this->link);
        $this->setTitle("Pencarian Booking Bus / Travel");
        $this->setGroup("Bus / Travel");
        $this->setSubGroup("Booking");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Bus / Travel' => '#', 'Booking' => 'bus/list/']);

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
                'data' => 'bookingCode',
                'name' => 'bookingCode',
                'label' => 'Booking Code',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'bus',
                'name' => 'bus',
                'label' => 'Bus',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'originTerminal',
                'name' => 'originTerminal',
                'label' => 'Keberangkatan',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'destinationTerminal',
                'name' => 'destinationTerminal',
                'label' => 'Kedatangan',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'ticketPrice',
                'name' => 'ticketPrice',
                'label' => 'Total Harga Tiket',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'departTime',
                'name' => 'departTime',
                'label' => 'Tanggal Keberangkatan',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
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
                'label' => 'Tanggal Pembuatan',
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
            $records = BusBooking::select('*');
        }else{
            $records = BusBooking::where('created_by',auth()->user()->id)->select('*');
        }
        // dd($records);
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
              // $records->->sort();
              $records->orderBy('created_at', 'desc');
          }
            //Filters
          if ($bookingCode = $request->bookingCode) {
              $records->where('bookingCode', $bookingCode);
          }

          if ($bus = $request->bus) {
              $records->where('bus', 'like', '%'.$bus.'%' );
          }

          if ($originTerminal = $request->originTerminal) {
              $records->where('originTerminal', 'like', '%'.$originTerminal.'%' );
          }

          if ($destinationTerminal = $request->destinationTerminal) {
              $records->where('destinationTerminal', 'like', '%'.$destinationTerminal.'%' );
          }
        //Filters
      return Datatables::of($records)
      ->addColumn('num', function ($record) use ($request) {
          return $request->get('start');
      })
      ->addColumn('ticketPrice', function ($record) {
          return isset($record->ticketPrice) ? moneyFormat($record->ticketPrice) : '0';
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
              'target' => url('bus/detail/'.$record->id)
          ]);
          // download
          $btn .= $this->makeButton([
              'type' => 'url',
              'tooltip' => 'Download Data',
              'class' => 'btn btn-sm btn-success',
              'label' => '<i class="fa fa-download"></i>',
              'id'   => $record->id,
              'target' => url('bus/download/'.$record->id)
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
    public function getList()
    {
        return $this->render('frontend.darmawisata.bus.index-list',[
          'mockup' => false
        ]);
    }

    /**
     * Menampilkan halaman form pencarian
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->render('frontend.darmawisata.bus.index');
    }

    /**
     * Menampilkan Pencarian Rute
     *
     * @param Illuminate\Http\Request $request
     * @return Illumintae\Http\Response
     */
    public function rute(Request $request)
    {
        $result = [];
        $result = guzzleGet($request,'/api/darmawisata/bus/route')->data;
        if($result->status == 'FAILED'){
            return response([
                'status' => 'message',
                'message' => $result->respMessage
            ],412);
        }
        return $this->render('frontend.darmawisata.bus.index-rute',[
            'result' => $result,
            'request' => $request
        ]);
    }

    /**
     * Pencarian Jadwal
     *
     * @return Illuminate\Http\Response
     */
    public function schedule(Request $request)
    {

        $this->validate($request,[
          'paxAdult' => 'numeric|min:1|max:5',
          'paxChild' => 'max:5',
          'paxInfant' => 'max:5'
        ]);
        $result = guzzleGet($request,'/api/darmawisata/bus/schedule')->data;
        
        // dump($result);
        return $this->render('frontend.darmawisata.bus.index-schedule',[
            'result' => $result,
            'request' => $request,
        ]);
    }

    /**
     * Pencarian Tempat
     *
     * @return Illuminate\Http\Response
     */
    public function seat(Request $request)
    {
        $result = guzzleGet($request,'/api/darmawisata/bus/seat-map')->data;
        
        $resSeats = [];
        $resReal = [];
        if($result->status == 'SUCCESS' && !is_null($result->seats)){
          $resSeats = array_values(array_sort($result->seats, function ($value) {
              return $value->column;
          }));
          foreach ($resSeats as $element) {
            $resReal[$element->row][] = $element;
          }
        }
        // dump($request->all());
        return $this->render('frontend.darmawisata.bus.index-seat',[
            'result' => $result,
            'request' => $request,
            'resReal' => $resReal
        ]);
    }

    /**
     * Menampilkan data hasil Booking
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function booking(Request $request)
    {
        if(\Auth::check()){
          $this->validate($request,[
            'passengers.*.title' => 'required|max:200',
            'passengers.*.firstName' => 'required|max:200',
            'passengers.*.lastName' => 'required|max:200',
            'passengers.*.identity' => 'required|max:200',
            'passengers.*.phone' => 'required|max:200',
            'passengers.*.address' => 'required|max:200',
            'passengers.*.email' => 'required|max:200',
            'passengers.*.birthDate' => 'required|max:200',
          ]);

          $adult = !is_null($request->paxAdult) ? (int)$request->paxAdult : 0;
          $child = !is_null($request->paxChild) ? (int)$request->paxChild : 0;
          $total = $adult + $child;
          $seat = 0;
          if($request->choosedSeat){
              if($request->choosedSeat && (count($request->choosedSeat) > 0)){
                  $seat = count($request->choosedSeat);
              }
          }
          if($seat < $total){
              return response([
                  'check' => true,
                  'messTitle' => 'Gagal lengkapi data anda atau',
                  'messSub' => 'Silahkan Pilih '.$total.' Tempat Duduk'
              ],500);
          }
          $result = $this->bus->setBusBooking($request);
          // dump($result);
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
            ]);
            return response([
                'status' => true,
                'url' => url('bus/detail/'.$record->id)
            ]);
          }else{
            return response([
              'check' => true,
              'messTitle' => $result->status,
              'messSub' => $result->respMessage
            ],500);
          }
        }else{
            return response([
                'status' => true,
                'url' => url('404')
            ]);
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
            $record = BusBooking::findOrFail($id);
            $result = [];
            
            $request['accessToken'] = $record->accessToken;
            $request['bookingCode'] = $record->bookingCode;
            $request['bookingDate'] = Carbon::parse($record->bookingTime)->format('Y-m-d');

            $getBooking = guzzleGet($request,'/api/darmawisata/bus/booking/detail')->data;
            // dd($getBooking);
            return $this->render('frontend.darmawisata.bus.booking-detail',[
                'record' => $record,
                'getBooking' => $getBooking,
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
    public function bayar(Request $request,$id)
    {
      DB::beginTransaction();
      try {
        if(\Auth::check()){
            $record = BusBooking::findOrFail($id);
            $result = [];
            
            $request['accessToken'] = $record->accessToken;
            $request['bookingCode'] = $record->bookingCode;
            $request['bookingDate'] = Carbon::parse($record->bookingTime)->format('Y-m-d');

            $getBooking = guzzleGet($request,'/api/darmawisata/bus/booking/detail')->data;
            if($getBooking->status == 'SUCCESS'){

                $saveTrans = [];
                $saveTrans['user_id'] = auth()->user()->id;
                $saveTrans['status'] = 'Menunggu Pembayaran';
                $recordTrans = new TransaksiAmpase;
                $recordTrans->fill($saveTrans);
                $recordTrans->save();

                $generateOrder = generateOrder(strlen(auth()->user()->nama));
                $recordTrans->order_id = '0'.$generateOrder.'000'.$recordTrans->id;
                $recordTrans->target_id = $record->id;
                $recordTrans->target_type = 'BusBooking';
                $recordTrans->save();

                $toMidtrans = profileMidtrans();
                $toMidtrans['item_details'][0]['id'] = $getBooking->bookingCode;
                $toMidtrans['item_details'][0]['name'] = $getBooking->operatorName.' - ('.$getBooking->originTerminal.' - '.$getBooking->destinationTerminal.')';
                $toMidtrans['item_details'][0]['price'] = (int)$getBooking->ticketPrice;
                $toMidtrans['item_details'][0]['quantity'] = 1;

                $toMidtrans['transaction_details'] = array(
                  'order_id' => $recordTrans->order_id,
                  'gross_amount' => (int)$getBooking->ticketPrice
                );
                $recordTrans->total_harga = $getBooking->ticketPrice;
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
                'check' => true,
                'messTitle' => $getBooking->status,
                'messSub' => $getBooking->respMessage
              ],500);
            }
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

    public function getBookingDownload(Request $request, $id){
        if(\Auth::check()){
            $namaSurat = 'Bus_'.auth()->user()->name.''.Carbon::now()->format('dmY_His').'.pdf';
            $record = BusBooking::findOrFail($id);
            $result = [];
            
            $request['accessToken'] = $record->accessToken;
            $request['bookingCode'] = $record->bookingCode;
            $request['bookingDate'] = Carbon::parse($record->bookingTime)->format('Y-m-d');

            $getBooking = guzzleGet($request,'/api/darmawisata/bus/booking/detail')->data;
            // dd($getBooking);
            $customPaper = array(0,0,450,550);
            $pdf = PDF::loadView('frontend.darmawisata.bus.pdf', [
                'record' => $record,
                'getBooking' => $getBooking,
            ])->setPaper('A4', 'potrait')->setOptions(
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
}
