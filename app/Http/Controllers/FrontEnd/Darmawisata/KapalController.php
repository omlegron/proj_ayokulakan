<?php

namespace App\Http\Controllers\FrontEnd\Darmawisata;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Master\DarmaPelniOrigin;
use App\Models\Darmawisata\KapalBooking;

use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Helpers\Darmawisata\Ship;
use App\Models\Master\AplikasiPanduan;
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;

use DataTables;
use PDF;
use QrCode;
class KapalController extends Controller
{

    protected $link = 'kapal/booking-list/';

    public function __construct()
    {
        $this->client = new Client();
        $this->ship = new Ship();

        $this->setLink($this->link);
        $this->setTitle("Pencarian Booking Kapal");
        $this->setGroup("Kapal");
        $this->setSubGroup("Booking");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Kapal' => '#', 'Booking' => 'kapal/booking-list/']);

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
                'data' => 'numCode',
                'name' => 'numCode',
                'label' => 'Nomor Code',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'departDate',
                'name' => 'departDate',
                'label' => 'Tanggal Keberangkatan',
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
                'data' => 'bookingStatus',
                'name' => 'bookingStatus',
                'label' => 'Status',
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
            $records = KapalBooking::select('*');
        }else{
            $records = KapalBooking::where('created_by',auth()->user()->id)->select('*');
        }
        // dd($records);
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
              // $records->->sort();
              $records->orderBy('created_at', 'desc');
          }
            //Filters
          if ($numCode = $request->numCode) {
              $records->where('numCode', $numCode);
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
              'target' => url('kapal/booking/detail/'.$record->id)
          ]);
          // download
          $btn .= $this->makeButton([
              'type' => 'url',
              'tooltip' => 'Download Data',
              'class' => 'btn btn-sm btn-success',
              'label' => '<i class="fa fa-download"></i>',
              'id'   => $record->id,
              'target' => url('kapal/booking/download/'.$record->id)
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
        return $this->render('frontend.darmawisata.kapal.index');
    }

    /**
     * Menampilkan Pencarian Jadwal
     *
     * @param Illuminate\Http\Request $request
     * @return Illumintae\Http\Response
     */
    public function schedule(Request $request)
    {
        // dd($request->all());
        // dd(date('y-M-d'));
        $this->validate($request,[
          'ticketBuyerName' => 'required|max:200',
          'ticketBuyerEmail' => 'required|max:200',
          'ticketBuyerAddress' => 'required|max:200',
          'ticketBuyerPhone' => 'required|max:200',
        ]);
        $result = [];
        $result = $this->ship->getShipSchedule($request);
        // guzzleGet($request,'/api/darmawisata/ship/schedule')->data;
        if($result->status == 'FAILED'){
            return response([
                'status' => 'message',
                'message' => $result->respMessage
            ],412);
        }
        return $this->render('frontend.darmawisata.kapal.list-kapal',[
            'result' => $result,
            'request' => $request
        ]);
    }

    /**
     * Pencarian Kamar
     *
     * @return Illuminate\Http\Response
     */
    public function rooms(Request $request)
    {
        if(\Auth::check()){
            $resAvail = [];
            $resRoom = [];
            $cekPax = [];
            if($request->pax && (count($request->pax) > 0)){
              foreach ($request->pax as $k => $value) {
                if(($value['paxTotal'] != null) && ((int)$value['paxTotal'] > 0)){
                  array_push($cekPax,$value);
                }
              }
            }
            $request['pax'] = $cekPax;
            // dump($request->all());
            $resAvail = $this->ship->getShipAvalibility($request);
            // $resAvail = guzzleGet($request,'/api/darmawisata/ship/availabel')->data;
            $resRoom = $this->ship->getShipRooms($request);
            // $resRoom = guzzleGet($request,'/api/darmawisata/ship/rooms')->data;
            // dump($resAvail);
            // dump($resRoom);
            $timeLimit = Carbon::now()->addMinutes(360);

            return $this->render('frontend.darmawisata.kapal.booking',[
                'resAvail' => $resAvail,
                'resRoom' => $resRoom,
                'origin' => DarmaPelniOrigin::where('originPort',$resAvail->originPort)->first(),
                'deperature' => DarmaPelniOrigin::where('originPort',$resAvail->destinationPort)->first(),
                'user' => auth()->user(),
                'request' => $request,
                'timeLimit' => $timeLimit
            ]);
        }else{
            return redirect('login');
        }
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
                'paxDetail.*.firstName' => 'required|max:200',
                'paxDetail.*.lastName' => 'required|max:200',
                'paxDetail.*.birthDate' => 'required',
            ]);

            $resBooking = $this->ship->setShipBooking($request);
            // $resBooking = guzzlePost($request,'/api/darmawisata/ship/booking')->data;
            if($resBooking->status == 'FAILED'){
                return response([
                    'check' => true,
                    'messTitle' => 'Expire',
                    'messSub' => $resBooking->respMessage
                ],412);
            }else{

                $KapalBooking = KapalBooking::create([
                    'numCode' => $resBooking->numCode,
                    'departDate' => $resBooking->departDate,
                    'salesPrice' => $resBooking->salesPrice,
                    'memberDiscount' => $resBooking->memberDiscount,
                    'kelasKapal' => $request->kelasKapal,
                    'issuedDateTimeLimit' => $resBooking->issuedDateTimeLimit,
                    'ticketPrice' => $resBooking->ticketPrice,
                    'shipMarkup' => $resBooking->shipMarkup,
                    'bookingDateTime' => $resBooking->bookingDateTime,
                    'status' => $resBooking->status,
                    'bookingStatus' => 'HOLD',
                    'respMessage' => $resBooking->respMessage,
                    'accessToken' => $resBooking->accessToken,
                ]);

                return response([
                    'status' => true,
                    'url' => url('kapal/booking/detail/'.$KapalBooking->id)
                ]);
            }
        }else{
            return response([
                'status' => true,
                'url' => url('404')
            ]);
        }
    }

    /**
     * Mendapatkan data Booking List
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getBookingList(Request $request)
    {
        if(\Auth::check()){
            return $this->render('frontend.darmawisata.kapal.booking-list',[
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
            $record = KapalBooking::findOrFail($id);
            $result = [];
            
            $request['accessToken'] = $record->accessToken;
            $request['numCode'] = $record->numCode;
            $request['bookingDate'] = Carbon::parse($record->bookingDate)->format('Y-m-d');

            $getBooking = $this->ship->getShipBookingDetail($request);
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
    }

    /**
     * Mengubah data status booking di local
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function bayar(Request $request,$id)
    {
      return $this->bayarNew($request,$id);
      // DB::beginTransaction();
      // try {
      //   if(\Auth::check()){
      //       $record = KapalBooking::findOrFail($id);
      //       $result = [];
            
      //       $request['accessToken'] = $record->accessToken;
      //       $request['numCode'] = $record->numCode;
      //       $request['bookingDate'] = Carbon::parse($record->bookingDate)->format('Y-m-d');

      //       $getBooking = $this->ship->getShipBookingDetail($request);
      //       // $getBooking = guzzleGet($request,'/api/darmawisata/ship/booking/detail')->data;
      //       if($getBooking->status == 'SUCCESS'){
      //           $origin = DarmaPelniOrigin::where('originPort',$getBooking->originPort)->first();
      //           $deperature = DarmaPelniOrigin::where('originPort',$getBooking->destinationPort)->first();

      //           $saveTrans = [];
      //           $saveTrans['user_id'] = auth()->user()->id;
      //           $saveTrans['status'] = 'Menunggu Pembayaran';
      //           $saveTrans['transaction_time'] = Carbon::now()->format('Y-m-d H:i:s');
      //           $saveTrans['transaction_time_expiry'] = Carbon::now()->addDays(1)->format('Y-m-d H:i:s');
      //           $recordTrans = new TransaksiAmpase;
      //           $recordTrans->fill($saveTrans);
      //           $recordTrans->save();

      //           $generateOrder = generateOrder(strlen(auth()->user()->nama));
      //           $recordTrans->order_id = '0'.$generateOrder.'000'.$recordTrans->id;
      //           $recordTrans->target_id = $record->id;
      //           $recordTrans->target_type = 'KapalBooking';
      //           $recordTrans->save();

      //           $request['accessToken'] = $record->accessToken;
      //           $request['numCode'] = $record->numCode;
      //           $request['bookingDate'] = Carbon::parse($record->bookingDate)->format('Y-m-d');

      //           $result = guzzlePost($request,'/api/darmawisata/ship/issued')->data;
      //           $record->update([
      //               'status' => $result->status,
      //               'respMessage' => $result->respMessage,
      //               'bookingStatus' => $result->bookingStatus,
      //           ]);

      //           $toMidtrans = profileMidtrans();
      //           if($getBooking->paxBookingDetails){
      //             if(count($getBooking->paxBookingDetails) > 0){
      //               $i = -1;
      //               foreach ($getBooking->paxBookingDetails as $k => $value) {
      //                 $toMidtrans['item_details'][$k]['id'] = $value->ID;
      //                 $toMidtrans['item_details'][$k]['name'] = $value->paxName.' - Tiket Kapal '.$getBooking->shipName.' '.$origin->originName.'-'.$deperature->originName;
      //                 $toMidtrans['item_details'][$k]['price'] = (int)$value->fare;
      //                 $toMidtrans['item_details'][$k]['quantity'] = 1;
      //               }

      //               $toMidtrans['transaction_details'] = array(
      //                 'order_id' => $recordTrans->order_id,
      //                 'gross_amount' => (int)$getBooking->ticketPrice
      //               );
      //               $recordTrans->total_harga = (int)$getBooking->ticketPrice;
      //               $recordTrans->save();
      //             }
      //           }

      //           $RessSnap = Veritrans_Snap::getSnapToken($toMidtrans);
      //           $recordTrans->snap_token = $RessSnap;
      //           $recordTrans->save();
      //           DB::commit();
      //           return response([
      //               'status' => true,
      //               'data' => $record,
      //               'record' => $recordTrans,
      //               'url' => url('history-trans')
      //           ]);
      //       }else{
      //         return response([
      //           'check' => true,
      //           'messTitle' => $getBooking->status,
      //           'messSub' => $getBooking->respMessage
      //         ],500);
      //       }
      //       // return $this->render('frontend.darmawisata.kapal.booking-detail',[
      //       //     'record' => $record,
      //       //     'getBooking' => $getBooking,
      //       //     'origin' => DarmaPelniOrigin::where('originPort',$getBooking->originPort)->first(),
      //       //     'deperature' => DarmaPelniOrigin::where('originPort',$getBooking->destinationPort)->first(),
      //       //     'user' => auth()->user()
      //       // ]);
      //   }else{
      //       return response([
      //         'url' => url('login')
      //       ]);
      //   }
      // } catch (Exception $e) {
      //   DB::rollback();
      //   return response([
      //       'status' => false,
      //       'errors' => $e
      //   ]);
      // }
        
    }

    public function bayarNew(Request $request, $id){
      if(\Auth::check()){
            $record = KapalBooking::findOrFail($id);
            $result = [];
            
            $request['accessToken'] = $record->accessToken;
            $request['numCode'] = $record->numCode;
            $request['bookingDate'] = Carbon::parse($record->bookingDate)->format('Y-m-d');

            $getBooking = $this->ship->getShipBookingDetail($request);

            $request['accessToken'] = $record->accessToken;
            $request['numCode'] = $record->numCode;
            $request['bookingDate'] = Carbon::parse($record->bookingDate)->format('Y-m-d');

            $result = guzzlePost($request,'/api/darmawisata/ship/issued')->data;
            $record->update([
                'status' => $result->status,
                'respMessage' => $result->respMessage,
                'bookingStatus' => $result->bookingStatus,
            ]);
            return response([
              'url' => url('kapal/booking-list'),
              'transaksi' => true
            ]);
      }else{
        return response([
          'url' => url('login')
        ]);
      }
    }

    public function getBookingDownload(Request $request, $id){
        if(\Auth::check()){
            $namaSurat = 'Pelni_'.auth()->user()->name.''.Carbon::now()->format('dmY_His').'.pdf';
            $record = KapalBooking::findOrFail($id);
            $result = [];
            $request['accessToken'] = $record->accessToken;
            $request['numCode'] = $record->numCode;
            $request['bookingDate'] = Carbon::parse($record->bookingDate)->format('Y-m-d');

            $getBooking = $this->ship->getShipBookingDetail($request);
            $codeBook = isset($getBooking->bokingNumber) ? $getBooking->bokingNumber : $record->numCode;
            $QrCode = QrCode::format('png')->size(100)->generate($codeBook);
            // $getBooking = [];
            // $getBooking = guzzleGet($request,'/api/darmawisata/ship/booking/detail')->data;
            $customPaper = array(0,0,550,600);
            $pdf = PDF::loadView('frontend.darmawisata.kapal.pdf', [
                'record' => $record,
                'getBooking' => $getBooking,
                'QrCode' => $QrCode,
                'origin' => DarmaPelniOrigin::where('originPort',$getBooking->originPort)->first(),
                'deperature' => DarmaPelniOrigin::where('originPort',$getBooking->destinationPort)->first(),
            ])->setPaper("a4","potrait")->setOptions(
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

    public function info(){
      return $this->render('frontend.darmawisata.kapal.info');
    }

    public function panduan(){
      return $this->render('frontend.darmawisata.kapal.panduan',[
        'panduan' => AplikasiPanduan::where('kategori','PanduanPelni')->first()
      ]);
    }
}
