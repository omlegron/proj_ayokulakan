<?php

namespace App\Http\Controllers\FrontEnd\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\User;

use App\Models\MobilPulsa\KeretaBooking;
use App\Models\MobilPulsa\KeretaPassenger;
use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
use App\Models\TransaksiAmpas\TransaksiAmpaseKereta;
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;
use Zipper;
use Carbon\Carbon;
use Auth;
use DB;
use App\Helpers\HelpersPPOB;

use DataTables;
use PDF;

class CheckTiketController extends Controller
{
    //
    protected $link = 'check-ticket/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Cek Ticket Anda");
        $this->setGroup("Cek Ticket Anda");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Cek Ticket Anda' => '#']);

        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');

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
                'data' => 'tr_id',
                'name' => 'tr_id',
                'label' => 'Booking Code',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'trainName',
                'name' => 'trainName',
                'label' => 'Nama Kereta',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'price',
                'name' => 'price',
                'label' => 'Total Harga',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'message',
                'name' => 'message',
                'label' => 'Status Pesan',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'org',
                'name' => 'org',
                'label' => 'Keberangkatan',
                'searchable' => false,
                'sortable' => true,
                'width' => '20%',
                'className' => "text-center text-nowrap",

            ],
            [
                'data' => 'dest',
                'name' => 'dest',
                'label' => 'Destinasi',
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
            $records = KeretaBooking::select('*');
        }else{
            $records = KeretaBooking::where('created_by',auth()->user()->id)->select('*');
        }
        // dd($records);
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
              // $records->->sort();
              $records->orderBy('created_at', 'desc');
          }
            //Filters
          if ($tr_id = $request->tr_id) {
              $records->where('tr_id', $tr_id);
          }

          if ($trainName = $request->trainName) {
              $records->where('trainName', 'like', '%'.$trainName.'%' );
          }

          if ($org = $request->org) {
              $records->where('org', 'like', '%'.$originTerminal.'%' );
          }

          if ($desc = $request->desc) {
              $records->where('desc', 'like', '%'.$desc.'%' );
          }
        //Filters
      return Datatables::of($records)
      ->addColumn('num', function ($record) use ($request) {
          return $request->get('start');
      })
      ->addColumn('price', function ($record) {
          return isset($record->price) ? moneyFormat($record->price) : '0';
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
              'target' => url('check-ticket/detail/'.$record->id)
          ]);
          // download
          $btn .= $this->makeButton([
              'type' => 'url',
              'tooltip' => 'Download Data',
              'class' => 'btn btn-sm btn-success',
              'label' => '<i class="fa fa-download"></i>',
              'id'   => $record->id,
              'target' => url('check-ticket/download/'.$record->id)
          ]);
          return $btn;
      })
      ->rawColumns(['action','deskripsi'])
      ->make(true);
    }

    public function showList(){
        return $this->render('frontend.tickets.kereta.index-list',[
          'mockup' => false
        ]);
    }

    public function checkKereta(Request $request){
        $recordKepulangan = [];
        if(isset($request->pulang_pergi)){
            if($request->pulang_pergi == 1){
                $this->validate($request,[
                    'tanggal_berangkat' => 'required|date',
                    'tanggal_kepulangan' => 'required|date|after_or_equal:tanggal_berangkat',
                    'dewasa' => 'required|numeric|min:1|max:4'
                ]);
                $kepulangan['rute_asal'] = $request->rute_tujuan;
                $kepulangan['rute_tujuan'] = $request->rute_asal;
                $kepulangan['tanggal_berangkat'] = $request->tanggal_kepulangan;
                $recordKepulangan = HelpersPPOB::findKereta($kepulangan);
            }
        }
        $recordBerangkat = HelpersPPOB::findKereta($request->all());  
        $recBerangkat = json_decode($recordBerangkat);
        if($recordKepulangan){
            $recKepulangan = json_decode($recordKepulangan);
        }else{
            $recKepulangan = [];
        }

        $hasilBerangkat = [];
        
        if(isset($recBerangkat->data)){
            foreach ($recBerangkat->data as $k => $value) {
                $hasilBerangkat[$k] = $value;
            }
        }

        $hasilKepulangan = [];
        if(isset($recKepulangan->data)){
            foreach ($recKepulangan->data as $k => $value) {
                $hasilKepulangan[$k] = $value;
            }
        }
        
        // dump($hasilBerangkat);
        return $this->render('frontend.tickets.kereta.index-schedule', [
            'record' => $hasilBerangkat,
            'hasilKepulangan'=>$hasilKepulangan,
            'request'=>$request->all()
        ]);
    }

    public function checkKursi(Request $request){
        // dd($request->all());

        $dataPenumpang = [];

        $dataPenumpang['desc']['hp']   = auth()->user()->hp;
        $dataPenumpang['desc']['contactName']   = auth()->user()->username;
        $dataPenumpang['desc']['contactEmail']  = auth()->user()->email;
        $dataPenumpang['desc']['fareId']        = $request['berangkat']['trainNo'];
        $dataPenumpang['desc']['adult']         = count($request['berangkat']['passenger']['adult']);
        $no = -1;
        foreach ($request['berangkat']['passenger']['adult'] as $value) {
            $no++;
            $dataPenumpang['desc']['passenger'][$no]['name'] = $value['name'];
            $dataPenumpang['desc']['passenger'][$no]['id'] = $value['id'];
            $dataPenumpang['desc']['passenger'][$no]['category'] = 'A';
        }

        if(isset($request['berangkat']['passenger']['infant'])){
            foreach ($request['berangkat']['passenger']['infant'] as $k => $value) {
                $no++;
                $dataPenumpang['desc']['passenger'][$no]['id'] = $k;
                $dataPenumpang['desc']['passenger'][$no]['name'] = $value['name'];
                $dataPenumpang['desc']['passenger'][$no]['category'] = 'I';
            }
        }
        // dd($request->all());
        $arrayPulang = [];
        $recordKepul = [];
        $recordKepulangan = [];
        $recordBrkt = [];
      
        $dataPenumpang['desc']['fareId']        = $request->berangkat['trainNo'];
        $request['subClass'] = $request->subclassbr;
        $record = HelpersPPOB::seatMapSubClass($dataPenumpang);  
        $record = json_decode($record);  
        // dd($record);
        // dump($record->data);
        // save data
        $result = [];
        if(isset($record->data->tr_id)){
            // dump($record);
            $result = KeretaBooking::create([
                'tr_id' => $record->data->tr_id,
                'code' => $record->data->code,
                'hp' => $record->data->hp,
                'tr_name' => $record->data->tr_name,
                'period' => $record->data->period,
                'nominal' => $record->data->nominal,
                'admin' => $record->data->admin,
                'ref_id' => $record->data->ref_id,
                'response_code' => $record->data->response_code,
                'message' => $record->data->message,
                'price' => $record->data->price,
                'selling_price' => $record->data->selling_price,
                'bookingCode' => $record->data->desc->bookingCode,
                'bookingDateTime' => $record->data->desc->bookingDateTime,
                'bookingTimeLimit' => $record->data->desc->bookingTimeLimit,
                'trainName' => $record->data->desc->trainName,
                'trainNumber' => $record->data->desc->trainNumber,
                'class' => $record->data->desc->class,
                'subClass' => $record->data->desc->subClass,
                'org' => $record->data->desc->org,
                'departDate' => $record->data->desc->departDate,
                'departTime' => $record->data->desc->departTime,
                'dest' => $record->data->desc->dest,
                'arriveDate' => $record->data->desc->arriveDate,
                'arriveTime' => $record->data->desc->arriveTime,
                'discount' => $record->data->desc->discount,
                'eticket' => $record->data->desc->eticket,
                'contactName' => $record->data->desc->contact->name,
                'contactPhone' => $record->data->desc->contact->phone,
                'contactEmail' => $record->data->desc->contact->email,
            ]);

            if($record->data->desc->passenger && (count($record->data->desc->passenger) > 0)){
                foreach ($record->data->desc->passenger as $value) {
                    $result->passenger()->create([
                        'trID' => $value->id,
                        'name' => $value->name,
                        'category' => $value->category,
                        'wagonCode' => $value->wagonCode,
                        'seat' => $value->seat,
                        'amount' => $value->amount,
                        'refundStatus' => $value->refundStatus,
                        'ticketNumber' => $value->ticketNumber,
                    ]);
                }
            }
        }

        $id = ($result) ? $result->id : '-';
        return redirect('check-ticket/detail/'.$id);

    }

    public function show($id){
        $record = [];
        if($id != '-'){
            $record = KeretaBooking::find($id);
        }
        return $this->render('frontend.tickets.kereta.index-detail', [
            'record' => $record,
        ]);
    }

    public function store(Request $request){
        // dd(json_decode(json_encode($this->cekArray())));
        DB::beginTransaction();
        try {
            $record = KeretaBooking::findOrFail($request->id);
            $result = HelpersPPOB::bookingAccept($record->tr_id);
            // dd($result);
            if($record){
                
                $saveTrans = [];
                $saveTrans['user_id'] = auth()->user()->id;
                $saveTrans['status'] = 'Menunggu Pembayaran';
                $recordTrans = new TransaksiAmpase;
                $recordTrans->fill($saveTrans);
                $recordTrans->save();

                $generateOrder = generateOrder(strlen(auth()->user()->nama));
                $recordTrans->order_id = '0'.$generateOrder.'000'.$recordTrans->id;
                $recordTrans->target_id = $record->id;
                $recordTrans->target_type = 'KeretaBooking';
                $recordTrans->save();

                $toMidtrans = profileMidtrans();
                $toMidtrans['item_details'][0]['id'] = $record->tr_id;
                $toMidtrans['item_details'][0]['name'] = $record->trainName.' ('.$record->org.') - ('.$record->dest.')';
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
            }
            DB::commit();
        } catch (Exception $e) {
              DB::rollback();
            return response([
              'status' => false,
              'errors' => $e
            ]);
        }
        return response([
            'status' => true,
            'record' => $recordTrans,
            'url' => url('transaksi/confirmation/'.$recordTrans->order_id)
        ]);
    }

    public function download(Request $request, $id){
        if(\Auth::check()){
            $namaSurat = 'Kereta_'.auth()->user()->name.''.Carbon::now()->format('dmY_His').'.pdf';
            $record = KeretaBooking::with('passenger')->findOrFail($id);

            $capthSche = asset('img/loggo.png');
            if(isset($record->eticket)){
                $capthSche = asset(base64_to_jpeg($record->eticket,'kerta-photo/capthSche'.Carbon::now()->format('Ymdhis').'.png'));
            }

            $customPaper = array(0,0,450,550);
            $pdf = PDF::loadView('frontend.tickets.kereta.pdf', [
                'record' => $record,
                'capthSche' => $capthSche,
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
