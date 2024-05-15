<?php

namespace App\Http\Controllers\FrontEnd\Darmawisata;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Master\DarmaBusList;
use App\Models\Darmawisata\TourBooking;

use App\Models\TransaksiAmpas\TransaksiAmpase;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;

use DataTables;
use PDF;

class TourController extends Controller
{

    protected $link = 'tour/list/';

    public function __construct()
    {
        $this->client = new Client();

        $this->setLink($this->link);
        $this->setTitle("Pencarian Booking Tour");
        $this->setGroup("Tour");
        $this->setSubGroup("Booking");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Tour' => '#', 'Booking' => 'tour/list/']);

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
                'data' => 'TourName',
                'name' => 'TourName',
                'label' => 'Tour Name',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'TotalPrice',
                'name' => 'TotalPrice',
                'label' => 'Total Price',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'DepartDate',
                'name' => 'DepartDate',
                'label' => 'Keberangkatan',
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
                'data' => 'TicketStatus',
                'name' => 'TicketStatus',
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
            $records = TourBooking::select('*');
        }else{
            $records = TourBooking::where('created_by',auth()->user()->id)->select('*');
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

          if ($TourName = $request->TourName) {
              $records->where('TourName', 'like', '%'.$TourName.'%' );
          }

          
        //Filters
      return Datatables::of($records)
      ->addColumn('num', function ($record) use ($request) {
          return $request->get('start');
      })
      ->addColumn('TotalPrice', function ($record) {
          return isset($record->TotalPrice) ? moneyFormat($record->TotalPrice) : '0';
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
              'target' => url('tour/detail/'.$record->id)
          ]);
          // download
          $btn .= $this->makeButton([
              'type' => 'url',
              'tooltip' => 'Download Data',
              'class' => 'btn btn-sm btn-success',
              'label' => '<i class="fa fa-download"></i>',
              'id'   => $record->id,
              'target' => url('tour/download/'.$record->id)
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
        return $this->render('frontend.darmawisata.tour.index-list',[
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
        return $this->render('frontend.darmawisata.tour.index');
    }

    /**
     * Menampilkan Pencarian search
     *
     * @param Illuminate\Http\Request $request
     * @return Illumintae\Http\Response
     */
    public function search(Request $request)
    {
        $this->validate($request,[
          'TourType' => 'required',
          'Category' => 'required',
          // 'MinimumPax' => 'required',
        ]);
        $result = [];
        $result = guzzleGet($request,'/api/darmawisata/tour/search')->data;
        // dump($result);
        if($result->status == 'FAILED'){
            return response([
              'check' => 'true',
              'messTitle' => $result->status,
              'messSub' => $result->respMessage
            ],400);
        }
        return $this->render('frontend.darmawisata.tour.index-search',[
            'result' => $result,
            'request' => $request
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
          if($request->Pax){
            $this->validate($request,[
              'Pax.*.Title' => 'required',
              'Pax.*.Name' => 'required',
              'Pax.*.Type' => 'required',
              'PackageID' => 'required',
            ]);
          }
          $result = guzzlePost($request,'/api/darmawisata/tour/booking')->data;
          if($result->status == 'FAILED'){
            return response([
              'check' => 'true',
              'messTitle' => 'Pemberitahuan',
              'messSub' => 'MAAF SAAT INI PIHAK KE TIGA / JASA PENYEDIA BELUM BISA MENERIMA PESANAN ANDA.'
            ],400);
          }
          
          $record = TourBooking::create([
            'BookingCode' => $result->BookingCode,
            'BookingDate' => $result->BookingDate,
            'DepartDate' => $result->DepartDate,
            'TicketStatus' => $result->TicketStatus,
            'TourName' => $result->TourName,
            'TotalPrice' => $result->TotalPrice,
            'TourVariant' => $result->TourVariant,
            'PaymentType' => $result->PaymentType,
            'TotalPrice' => $result->TotalPrice,
            'Commision' => $result->Commision,
            'RemainingBill' => $result->RemainingBill,
            'DPAmount' => $result->DPAmount,
            'accessToken' => $result->accessToken,
            'status' => $result->status,
            'respMessage' => $result->respMessage,
          ]);

          $saveTrans = [];
          $saveTrans['user_id'] = auth()->user()->id;
          $saveTrans['status'] = 'Menunggu Pembayaran';
          $recordTrans = new TransaksiAmpase;
          $recordTrans->fill($saveTrans);
          $recordTrans->save();

          $generateOrder = generateOrder(strlen(auth()->user()->nama));
          $recordTrans->order_id = '0'.$generateOrder.'000'.$recordTrans->id;
          $recordTrans->target_id = $record->id;
          $recordTrans->target_type = 'TourBooking';
          $recordTrans->save();

          $toMidtrans = profileMidtrans();
          $toMidtrans['item_details'][0]['id'] = $record->bookingCode;
          $toMidtrans['item_details'][0]['name'] = 'DP Pembayaran Tour '.$record->TourName;
          $toMidtrans['item_details'][0]['price'] = (int)$record->DPAmount;
          $toMidtrans['item_details'][0]['quantity'] = 1;

          $toMidtrans['transaction_details'] = array(
            'order_id' => $recordTrans->order_id,
            'gross_amount' => (int)$record->DPAmount
          );
          $recordTrans->total_harga = $record->DPAmount;
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

    /**
     * Mendapatkan data Booking Detail
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getBookingDetail(Request $request, $id)
    {
        
        if(\Auth::check()){
            $record = TourBooking::findOrFail($id);
            $result = [];
            
            $request['accessToken'] = $record->accessToken;
            $request['bookingCode'] = $record->bookingCode;
            $request['TourVariant'] = $record->TourVariant;

            $getBooking = guzzleGet($request,'/api/darmawisata/tour/booking-detail')->data;
            // dd($getBooking);
            return $this->render('frontend.darmawisata.tour.booking-detail',[
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
            $namaSurat = 'Tour_'.auth()->user()->name.''.Carbon::now()->format('dmY_His').'.pdf';
            $record = TourBooking::findOrFail($id);
            $result = [];
            
            $request['accessToken'] = $record->accessToken;
            $request['bookingCode'] = $record->bookingCode;
            $request['TourVariant'] = $record->TourVariant;

            $getBooking = guzzleGet($request,'/api/darmawisata/tour/booking-detail')->data;
            $customPaper = array(0,0,450,550);
            $pdf = PDF::loadView('frontend.darmawisata.tour.pdf', [
                'record' => $record,
                'getBooking' => $getBooking,
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
}
