<?php

namespace App\Http\Controllers\FrontEnd\Darmawisata;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Master\DarmaBusList;
use App\Models\Darmawisata\TravelBooking;

use App\Models\TransaksiAmpas\TransaksiAmpase;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;

use DataTables;
use PDF;
use App\Helpers\Darmawisata\Travel;

class TravelController extends Controller
{

    protected $link = 'travel/list/';

    public function __construct()
    {
        $this->client = new Client();
        $this->travel = new Travel();
        $this->setLink($this->link);
        $this->setTitle("Pencarian Booking Travel");
        $this->setGroup("Travel");
        $this->setSubGroup("Booking");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Travel' => '#', 'Booking' => 'travel/list/']);

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
                'data' => 'origin',
                'name' => 'origin',
                'label' => 'Keberangkatan',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'originCity',
                'name' => 'originCity',
                'label' => 'Wilayah Keberangkatan',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'destination',
                'name' => 'destination',
                'label' => 'Tujuan',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'destinationCity',
                'name' => 'destinationCity',
                'label' => 'Wilayah Tujuan',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'bookingDate',
                'name' => 'bookingDate',
                'label' => 'Tanggal Booking',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'salesPrice',
                'name' => 'salesPrice',
                'label' => 'Total Harga Tiket',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'ticketStatus',
                'name' => 'ticketStatus',
                'label' => 'Status Pemesanan',
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
            $records = TravelBooking::select('*');
        }else{
            $records = TravelBooking::where('created_by',auth()->user()->id)->select('*');
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

          if ($origin = $request->origin) {
              $records->where('origin', 'like', '%'.$origin.'%' );
          }

          if ($originCity = $request->originCity) {
              $records->where('originCity', 'like', '%'.$originCity.'%' );
          }

          if ($destination = $request->destination) {
              $records->where('destination', 'like', '%'.$destination.'%' );
          }

          if ($destinationCity = $request->destinationCity) {
              $records->where('destinationCity', 'like', '%'.$destinationCity.'%' );
          }

          
        //Filters
      return Datatables::of($records)
      ->addColumn('num', function ($record) use ($request) {
          return $request->get('start');
      })
      ->addColumn('salesPrice', function ($record) {
          return isset($record->salesPrice) ? moneyFormat($record->salesPrice) : '0';
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
              'target' => url('travel/detail/'.$record->id)
          ]);
          // download
          $btn .= $this->makeButton([
              'type' => 'url',
              'tooltip' => 'Download Data',
              'class' => 'btn btn-sm btn-success',
              'label' => '<i class="fa fa-download"></i>',
              'id'   => $record->id,
              'target' => url('travel/download/'.$record->id)
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
        return $this->render('frontend.darmawisata.travel.index-list',[
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
        return $this->render('frontend.darmawisata.travel.index');
    }

    /**
     * Menampilkan Pencarian search
     *
     * @param Illuminate\Http\Request $request
     * @return Illumintae\Http\Response
     */
    public function search(Request $request)
    {
      // dd($request->all());
        $this->validate($request,[
          'shuttleID' => 'required',
          'directionID' => 'required',
          'totalTicket' => 'required',
        ]);
        $result = [];
        $result = $this->travel->getShuttleSchedule($request);
        // dump($result);
        if($result->status == 'FAILED'){
            return response([
              'check' => 'true',
              'messTitle' => $result->status,
              'messSub' => $result->respMessage
            ],400);
        }
        return $this->render('frontend.darmawisata.travel.index-search',[
            'result' => $result,
            'request' => $request
        ]);
    }

    /**
     * Menampilkan Pencarian Tempat Duduk
     *
     * @param Illuminate\Http\Request $request
     * @return Illumintae\Http\Response
     */
    public function seat(Request $request)
    {
        // dump($request->all());
        $result = [];
        $result = $this->travel->getShuttleSeatMap($request);
        // dd($result);
        $resSeats = [];
        $resReal = [];
        // dump($result);
        if($result->status == 'SUCCESS' && !is_null($result->seats)){
          $resSeats = array_values(array_sort($result->seats, function ($value) {
              return $value->row;
          }));
          foreach ($resSeats as $element) {
            $resReal[$element->column][] = $element;
          }
        }

        return $this->render('frontend.darmawisata.travel.index-seat',[
            'result' => $result,
            'request' => $request,
            'resReal' => $resReal
        ]);
    }

    /**
     * Pencarian Booking
     *
     * @return Illuminate\Http\Response
     */
    public function booking(Request $request)
    {
      DB::beginTransaction();
      try {
        if(\Auth::check()){
            $this->validate($request,[
              'contactName' => 'required|max:250',
              'contactPhone' => 'required|max:250',
              'contactEmail' => 'required|max:250',
              'contactAddress' => 'required|max:250',
              'paxNames.*' => 'required',
              'seats.*' => 'required',
            ]);

          $seat = count($request->seats);
          $total = count($request->paxNames);
          if($seat < $total){
              return response([
                  'check' => true,
                  'messTitle' => 'Gagal lengkapi data anda atau',
                  'messSub' => 'Silahkan Pilih '.$total.' Tempat Duduk'
              ],500);
          }

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
            ]);
            DB::commit();
            return response([
                'status' => true,
                'url' => url('travel/detail/'.$record->id)
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

    /**
     * Mendapatkan data Booking Detail
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getBookingDetail(Request $request, $id)
    {
        
        if(\Auth::check()){
            $record = TravelBooking::findOrFail($id);
            $result = [];
            
            $request['accessToken'] = $record->accessToken;
            $request['bookingCode'] = $record->bookingCode;
            $request['bookingDate'] = Carbon::parse($record->bookingDate)->format('Y-m-d');

            $getBooking = $this->travel->getShuttleBookingDetail($request);
            // dd($getBooking);
            return $this->render('frontend.darmawisata.travel.booking-detail',[
                'record' => $record,
                'getBooking' => $getBooking,
                'user' => auth()->user()
            ]);
        }else{
            return redirect('login');
        }
    }


    public function getBookingDownload(Request $request, $id){
        if(\Auth::check()){
            $namaSurat = 'Travel'.auth()->user()->name.''.Carbon::now()->format('dmY_His').'.pdf';
            $record = TravelBooking::findOrFail($id);
            $result = [];
            
            $request['accessToken'] = $record->accessToken;
            $request['bookingCode'] = $record->bookingCode;
            $request['bookingDate'] = Carbon::parse($record->bookingDate)->format('Y-m-d');

            $getBooking = $this->travel->getShuttleBookingDetail($request);
            // dd($getBooking);
            
            $customPaper = array(0,0,450,550);
            $pdf = PDF::loadView('frontend.darmawisata.travel.pdf', [
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

    public function bayar(Request $request,$id)
    {
      DB::beginTransaction();
      try {
        if(\Auth::check()){
            $record = TravelBooking::findOrFail($id);
            $result = [];
            
            $request['accessToken'] = $record->accessToken;
            $request['bookingCode'] = $record->bookingCode;
            $request['bookingDate'] = Carbon::parse($record->bookingDate)->format('Y-m-d');

            $getBooking = $this->travel->getShuttleBookingDetail($request);
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
                $recordTrans->target_type = 'TravelBooking';
                $recordTrans->save();

                $toMidtrans = profileMidtrans();
                $toMidtrans['item_details'][0]['id'] = $getBooking->bookingCode;
                $toMidtrans['item_details'][0]['name'] = '('.$getBooking->origin.') - ('.$getBooking->destination.') ';
                $toMidtrans['item_details'][0]['price'] = (int)$getBooking->ticketPrice;
                $toMidtrans['item_details'][0]['quantity'] = $getBooking->totalTicket;

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
}
