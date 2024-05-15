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

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;
use App\Models\TransaksiAmpas\TransaksiAmpase;

use DataTables;
use PDF;
class AirlineController extends Controller
{
    protected $link = 'airlinee/booking/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Pencarian Booking Pesawat");
        $this->setGroup("Airline");
        $this->setSubGroup("Booking");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Airline' => '#', 'Booking' => 'airlinee/booking/']);

        $this->client = new Client();
        $this->airline = new AirlineDarmawisata();

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
            'data' => 'airline',
            'name' => 'airline',
            'label' => 'Airline',
            'searchable' => false,
            'sortable' => true,
            'width' => '20%',
            'className' => "text-center text-nowrap",

        ],
        [
            'data' => 'bookingCode',
            'name' => 'bookingCode',
            'label' => 'Code',
            'searchable' => false,
            'sortable' => true,
            'width' => '20%',
            'className' => "text-center text-nowrap",

        ],
        [
            'data' => 'bookingDate',
            'name' => 'bookingDate',
            'label' => 'Date',
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
        $records = AirlineBooking::select('*');
        // dd($records);
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
          // $records->->sort();
          $records->orderBy('created_at', 'desc');
      }
        //Filters
      if ($name = $request->nama) {
          $records->where('judul', 'like', '%'.$name.'%' );
      }
        //Filters
      return Datatables::of($records)
      ->addColumn('num', function ($record) use ($request) {
          return $request->get('start');
      })
      ->addColumn('created_at', function ($record) {
          return $record->creationDate();
        })
      ->addColumn('action', function ($record) {
          $btn = '';
          //detail
          $btn .= $this->makeButton([
              'type' => 'url',
              'tooltip' => 'Detail Data',
              'id'   => $record->id,
              'target' => url('airlinee/booking/detail/'.$record->id)
          ]);
          // download
          $btn .= $this->makeButton([
              'type' => 'url',
              'tooltip' => 'Download Data',
              'class' => 'btn btn-sm btn-success',
              'label' => '<i class="fa fa-download"></i>',
              'id'   => $record->id,
              'target' => url('airlinee/booking/download/'.$record->id)
          ]);
          return $btn;
      })
      ->rawColumns(['action','deskripsi'])
      ->make(true);
  }

  public function guzzleGet(Request $request, $url){
    $client = new Client();
    $apiUrl = Config('app.url');
    $param  = '?'.http_build_query($request->all()); 
    $result = $client->get($apiUrl.$url.$param,[
        'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ],
        'verify' => false
    ])->getBody();
    return json_decode($result);
}

public function guzzlePost(Request $request, $url){
    $client = new Client();
    $apiUrl = Config('app.url');
    $option = [
        'body' => json_encode($request->all()),
        'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ],
        'verify' => false
    ];

    $result = $client->post($apiUrl.$url,$option)->getBody();
    return json_decode($result);
}


    /**
     * Menampilkan halaman form pencarian
     *
     * @return Illuminate\Http\Response
     */
    public function showAirlineForm()
    {
        $cities = TicketingAirport::get();
        return $this->render('frontend.tickets.airline.index', compact('cities'));
    }

    /**
     * Menampilkan jadwal penerbangan
     *
     * @param Illuminate\Http\Request $request
     * @return Illumintae\Http\Response
     */
    public function showAirlineSchedule(Request $request)
    {
        // dump($this->airline->sessionLoginDua());
        $request['pulang_data'] = $request->tripType;
        $request['pulang_tanggal'] = $request->returnDate;
        if (!$request->tripType) {
            $request['tripType'] = 'OneWay';
        }

        if (!$request->promoCode) {
            $request['promoCode'] = '';
        }

        if (!$request->returnDate) {
            $request['returnDate'] = '';
        }

        if (!$request->airlineAccessCode) {
            $request['airlineAccessCode'] = '';
        }

        $client = new Client();
        $apiUrl = Config('app.url');
        $param  = '?'.http_build_query($request->all()); 
        $result = $this->airline->getScheduleAllAirline($request);
        if($result->airlineAccessCode && (strlen($result->airlineAccessCode) > 10)){
            $capth = asset(base64_to_jpeg($result->airlineAccessCode,'airline-photo/capth-'.Carbon::now()->format('Ymdhis').'.png'));
            return $this->render('frontend.tickets.airline.captha', compact('request', 'capth','result'));
        }else{
            $schedules = $result;
            $departs = $schedules->journeyDepart;
            $returns = $schedules->journeyReturn;

            return $this->render('frontend.tickets.airline.schedule', compact('request', 'schedules', 'departs', 'returns'));
        }
    }

    /**
     * Menampilkan halaman form pencarian
     *
     * @return Illuminate\Http\Response
     */
    public function showAirlineCart(Request $request, $cart)
    {
        $cityOrigin = TicketingAirport::where('airport_code', $request->origin)->first();
        $cityDestination = TicketingAirport::where('airport_code', $request->destination)->first();

        if (!$request->tripType) {
            $request['tripType'] = 'OneWay';
        }

        if (!$request->promoCode) {
            $request['promoCode'] = '';
        }

        if (!$request->returnDate) {
            $request['returnDate'] = '';
        }

        $request['airlineAccessCode'] = '';

        $request['accessToken'] = $accessToken = $cart;

        $capthSche = null;
        $capthPrice = null;
        
            $prices = $this->airline->getPriceAllAirline($request);
            $capthPrice = asset(base64_to_jpeg($prices->airlineAccessCode,'airline-photo/capthPrice-'.Carbon::now()->format('Ymdhis').'.png'));
            
            $schedule = $this->airline->getAirlineSchedule($request);
            $capthSche = asset(base64_to_jpeg($schedule->airlineAccessCode,'airline-photo/capthSche'.Carbon::now()->format('Ymdhis').'.png'));
        
        
        $response = $this->client->get('http://www.geoplugin.net/json.gp')->getBody();
        $visitor = json_decode($response);
        return $this->render(
            'frontend.tickets.airline.cart',
            compact(
                'cityOrigin',
                'cityDestination',
                'request',
                'accessToken',
                'prices',
                'visitor',
                'schedule',
                'capthPrice',
                'capthSche'
            )
        );
        
    }

    /**
     * Menampilkan halaman form pencarian
     *
     * @return Illuminate\Http\Response
     */
    public function showAirlineCartDul(Request $request, $cart)
    {
        $cityOrigin = TicketingAirport::where('airport_code', $request->origin)->first();
        $cityDestination = TicketingAirport::where('airport_code', $request->destination)->first();

        if (!$request->tripType) {
            $request['tripType'] = 'OneWay';
        }

        if (!$request->promoCode) {
            $request['promoCode'] = '';
        }

        if (!$request->returnDate) {
            $request['returnDate'] = '';
        }

        $request['airlineAccessCode'] = '';

        $request['accessToken'] = $accessToken = $cart;

        $capthSche = null;
        $capthPrice = null;
            $request['airlineAccessCode'] = $request->airlineAccessCode1;
            $prices = $this->airline->getPriceAllAirline($request);

            if($prices->status == 'FAILED'){
                $capthPrice = asset(base64_to_jpeg($prices->airlineAccessCode,'airline-photo/capthPrice-'.Carbon::now()->format('Ymdhis').'.png'));
            }

            $request['airlineAccessCode'] = $request->airlineAccessCode2;
            $schedule = $this->airline->getAirlineSchedule($request);
            if($schedule->status == 'FAILED'){
                $capthSche = asset(base64_to_jpeg($schedule->airlineAccessCode,'airline-photo/capthSche'.Carbon::now()->format('Ymdhis').'.png'));
            }
           
        
        $response = $this->client->get('http://www.geoplugin.net/json.gp')->getBody();
        $visitor = json_decode($response);
        return $this->render(
            'frontend.tickets.airline.cart2',
            compact(
                'cityOrigin',
                'cityDestination',
                'request',
                'accessToken',
                'prices',
                'visitor',
                'schedule',
                'capthPrice',
                'capthSche'
            )
        );
        
    }

    public function getSchedule(Request $request){
        $capthSche = null;
        $schedule = $this->airline->getAirlineSchedule($request);
        if($schedule->status == 'FAILED'){
            $capthSche = asset(base64_to_jpeg($schedule->airlineAccessCode,'airline-photo/capthSche'.Carbon::now()->format('Ymdhis').'.png'));
        }

        return $this->render(
            'frontend.tickets.airline.get-schedule',
            compact(
                'request',
                'schedule',
                'capthSche'
            )
        );
    }
    /**
     * Menampilkan data baggae and meal
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function getBaggaeAndMeal(Request $request){
        $this->validate($request,[
            'contactTitle' => 'required|max:200',
            'contactFirstName' => 'required|max:200',
            'contactEmail' => 'required|max:200',
            'contactRemainingPhoneNo' => 'required|max:200',
            'paxDetails.adult.*.title' => 'required|max:200',
            'paxDetails.adult.*.firstName' => 'required|max:200',
            'paxDetails.adult.*.gender' => 'required|max:200',
            'paxDetails.adult.*.birthDate' => 'required|max:200',
        ]);
        // dump($request->all());
        $baggae = $this->airline->getBaggageAndMeal($request);
        $seat = $this->airline->getSeat($request);
        // dump($baggae);
        // dump($seat);
        $result = [];
        if(isset($seat->seatAddOns[0])){
            if(!is_null($seat->seatAddOns[0]->infos)){
                $resSeats = array_values(array_sort($seat->seatAddOns[0]->infos, function ($value) {
                    return $value->Y;
                }));
                foreach ($resSeats as $element) {
                    if($element->seatType == 'NS'){
                        $result[$element->X][] = $element;
                    }
                }
                ksort($result);
            }
        }
        // dump($result);
        return $this->render('frontend.tickets.airline.cart-detail',[
            'seat' => $result,
            'baggae' => $baggae,
            'request' => $request,
        ]);
    }

    /**
     * Menampilkan data checkPrice
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function priceBooking(Request $request){
        if(\Auth::check()){
            $this->validate($request,[
                'contactTitle' => 'required|max:200',
                'contactFirstName' => 'required|max:200',
                'contactEmail' => 'required|max:200',
                'contactRemainingPhoneNo' => 'required|max:200',
                'paxDetails.adult.*.title' => 'required|max:200',
                'paxDetails.adult.*.firstName' => 'required|max:200',
                'paxDetails.adult.*.gender' => 'required|max:200',
                'paxDetails.adult.*.birthDate' => 'required|max:200',
            ]);
            $adult = !is_null($request->paxAdult) ? (int)$request->paxAdult : 0;
            $child = !is_null($request->paxChild) ? (int)$request->paxChild : 0;
            $total = $adult + $child;
            $seat = 0;
            // dd($request->seats);
            if($request->seats){
                if(isset($request->seats['seat']) && (count($request->seats['seat']) > 0)){
                    $seat = count($request->seats['seat']);

                    if($seat < $total){
                        return response([
                            'check' => true,
                            'messTitle' => 'Gagal lengkapi data anda atau',
                            'messSub' => 'Silahkan Pilih '.$total.' Tempat Duduk'
                        ],500);
                    }

                    $arr = [];
                    foreach ($request->paxDetails as $k => $value) {
                        if($k == 'adult'){
                            foreach ($value as $k1 => $value1) {
                                $arr[$k][$k1] = $value1;
                                $arr[$k][$k1]['addOns'][0]['compartment'] = isset($request->seats['compartment'][$k1]) ? $request->seats['compartment'][$k1] : null;
                                $arr[$k][$k1]['addOns'][0]['seat'] = isset($request->seats['seat'][$k1]) ? $request->seats['seat'][$k1] : null;
                            }
                        }elseif($k == 'child'){
                            $arrNo = count($arr['adult']);
                            $resNo = $arrNo;
                            $arr[$k][$resNo] = $value;
                            // dd($arr);
                            $arr[$k][$resNo]['addOns'][0]['compartment'] = isset($request->seats['compartment'][$resNo]) ? $request->seats['compartment'][$resNo] : null;
                            $arr[$k][$resNo]['addOns'][0]['seat'] = isset($request->seats['seat'][$resNo]) ? $request->seats['seat'][$resNo] : null;
                        }else{
                            $arr[$k][$k1] = $value;
                        }
                    }
                    $request->request->add([
                        'paxDetails' => $arr
                    ]);
                }
            }
            // dd($request->all());

            $cekPrice = $this->airline->getPriceAirline($request);
            if($cekPrice->status == 'FAILED'){
                return response([
                    'check' => true,
                    'messTitle' => $cekPrice->status,
                    'messSub' => $cekPrice->respMessage
                ],500);
            }

            $setBooking = $this->airline->setBooking($request);
            // dump($request->all());
            // dump($cekPrice);
            // dump($setBooking);
            if($setBooking->status == 'FAILED'){
                return response([
                    'check' => true,
                    'messTitle' => $setBooking->status,
                    'messSub' => $setBooking->respMessage
                ],500);
            }
            $airline = Airline::where('code', $request->airlineID)->first();
            $record = AirlineBooking::create([
                'user_id' => auth()->user()->id,
                'airline' => $airline->name,
                'airlineID' => $airline->code,
                'bookingCode' => $setBooking->bookingCode,
                'bookingDate' => $setBooking->bookingDate,
                'bookingStatus' => 'HOLD',
            ]);

            return response([
                'url' => url('airlinee/booking/detail/'.$record->id.'?pulang_data='.$request->pulang_data.'&pulang_pergi='.$request->pulang_pergi)
            ]);
        }else{
            return response([
                'url' => url('login')                
            ]);
        }
        
        
    }

    /**
     * Menampilkan data hasil Booking
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function setAirlineBooking(Request $request, $id)
    {

        DB::beginTransaction();
        try {
            if(\Auth::check()){
                    $record = AirlineBooking::findOrFail($id);
                    $cities = TicketingAirport::get();
                    request()['bookingCode'] = $record->bookingCode;
                    request()['bookingDate'] = $record->bookingDate;
                    $booking = $this->airline->getBookingDetail(request());
                    // dd($booking);
                    $airline = Airline::where('code',$booking->airlineID)->first();
                    $nameAlias = ($airline) ? $airline->name : '';

                    $name = $nameAlias.' '.$booking->origin.'-'.$booking->destination.' ('.$booking->bookingCode.')';

                    $saveTrans = [];
                    $saveTrans['user_id'] = auth()->user()->id;
                    $saveTrans['status'] = 'Menunggu Pembayaran';
                    $recordTrans = new TransaksiAmpase;
                    $recordTrans->fill($saveTrans);
                    $recordTrans->save();

                    $generateOrder = generateOrder(strlen(auth()->user()->nama));
                    $recordTrans->order_id = '0'.$generateOrder.'000'.$recordTrans->id;
                    $recordTrans->target_id = $record->id;
                    $recordTrans->target_type = 'AirlineBooking';
                    $recordTrans->save();

                    $toMidtrans = [];
                    $toMidtrans = profileMidtrans();
                    
                    $toMidtrans['item_details'][0]['id'] = $record->id;
                    $toMidtrans['item_details'][0]['name'] = $name;
                    $toMidtrans['item_details'][0]['price'] = (int)$booking->adminFee->ticketPrice;
                    $toMidtrans['item_details'][0]['quantity'] = count($booking->passengers);

                    $resultTotalHarga = (int)$booking->adminFee->ticketPrice;
                    $toMidtrans['transaction_details'] = array(
                      'order_id' => $recordTrans->order_id,
                      'gross_amount' => $resultTotalHarga
                    );
                    $recordTrans->total_harga = $resultTotalHarga;
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
                        'status' => true,
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

  public function getBooking(Request $request, $id){
    $record = AirlineBooking::findOrFail($id);
    $cities = TicketingAirport::get();
    request()['bookingCode'] = $record->bookingCode;
    request()['bookingDate'] = $record->bookingDate;
    $result = $this->airline->getBookingDetail(request());
    return $this->render('frontend.tickets.airline.booking',[
        'result' => $result,
        'request' => $request->all(),
        'cities' => $cities,
        'record' => $record,
    ]); 
}
    /**
     * Menampilkan data hasil Booking
     *
     * @return Illuminate\Http\Response
     */
    public function showFormAirlineBookingList()
    {
        return $this->render('frontend.tickets.airline.booking-list',[
            'mockup' => false,
        ]);
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

    public function getBookingDownload($id){
        $record = AirlineBooking::findOrFail($id);
        $namaSurat = 'Airline_'.auth()->user()->name.''.Carbon::now()->format('dmY_His').'.pdf';
        request()['bookingCode'] = $record->bookingCode;
        request()['bookingDate'] = $record->bookingDate;
        $result = $this->airline->getBookingDetail(request());
        $customPaper = array(0,0,350,550);
        $pdf = PDF::loadView('frontend.tickets.airline.pdf', [
            'record' => $record,
            'result' => $result,
        ])->setPaper($customPaper)->setOptions(
            [
              'isHtml5ParserEnabled' => true,
              'isRemoteEnabled' => true,
              'isPhpEnabled' => true
            ]
        );

        return $pdf->stream($namaSurat);
    }
}
