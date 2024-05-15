<?php

namespace App\Http\Controllers\BackEnd\Pesanan;

use DataTables;
use Carbon\Carbon;
use Veritrans_Config;
use App\Models\Users;
use Veritrans_Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Barang\FavoritBarang;
use Illuminate\Support\Facades\Auth;
use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
class PesananController extends Controller
{
    protected $link = 'pesanan/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle('');
        // $this->setGroup("Master");
        // $this->setSubGroup("Aplikasi");
        $this->setModalSize("lg");
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
        $records = TransaksiAmpase::where('created_by',auth()->user()->id)->select('*');
    
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
        $record = TransaksiAmpase::with('detail.barang')->where('created_by',auth()->user()->id)->whereHas('detail',function($q){
            $q->where('created_by',auth()->user()->id);
        })->orderBy('created_at','desc')->select('*');
        $record = $record->paginate(25);
        $date = Carbon::now()->toDateTimeString();
        return $this->render('backend.pesanan.all',[
            'product' => $record,
            'record' => Users::find(Auth::id()),
        ]);
    }

    public function pending()
    {
        $record = TransaksiAmpase::with('detail.barang')->where('created_by',auth()->user()->id)->whereHas('detail',function($q){
            $q->where('status_barang','Menunggu Pembayaran');
        })->orderBy('created_at','desc')->select('*');
        $record = $record->paginate(25);
        return $this->render('backend.pesanan.pending',[
            'product' => $record,
            'record' => Users::find(Auth::id()),
        ]);
    }

    public function payment()
    {

        $data = TransaksiAmpase::where('created_by',auth()->user()->id)->orderBy('created_at','desc')->get();
        $date = Carbon::now()->toDateTimeString();
        return $this->render('backend.pesanan.payment', [
            'data' => $data,
            'date' => $date,
            'record' => Users::find(Auth::id()),
        ]);
        
    }

    public function cronjob()
    {
        $date = Carbon::now()->toDateTimeString();
        $tran = TransaksiAmpase::where('transaction_time','<=',$date)->delete();
        return 'berhasil';
    }

    public function history(Request $req)
    {
        $data = TransaksiAmpase::where('created_by',auth()->user()->id)->orderBy('created_at','desc')->select('*');
        $data = $data->paginate(25);
        return $this->render('backend.pesanan.history',[
            'data' => $data,
            'record' => Users::find(Auth::id()),
        ]);
    }

    public function packing()
    {
        $data = TransaksiAmpase::with('detail.barang')->where('created_by',auth()->user()->id)->whereHas('detail',function($q){
            $q->where('status_barang','Sedang Di Packing');
        })->orderBy('created_at','desc')->select('*');
        $data = $data->paginate(25);
        return $this->render('backend.pesanan.packing',[
            'data' => $data,
            'record' => Users::find(Auth::id()),
        ]);
    }

    public function orderCanceled()
    {
        $data = TransaksiAmpase::with('detail.barang')->where('created_by',auth()->user()->id)->whereHas('detail',function($q){
            $q->where('status_barang','Pesanan Dibatalkan');
        })->orderBy('created_at','desc')->select('*');
        $data = $data->paginate(25);
        // dd($data);
        return $this->render('backend.pesanan.cancel',[
            'data' => $data,
            'record' => Users::find(Auth::id()),
        ]);
    }

    public function search(Request $req)
    {
        if ($req->_token) {
            if ($req->value != '') {
                $record = TransaksiAmpase::where('order_id','like', '%'.$req->value.'%')->where('created_by',auth()->user()->id)->orderBy('created_at','desc')->select('*');
            }else{
                $record = TransaksiAmpase::where('created_by',auth()->user()->id)->orderBy('created_at','desc')->select('*');
            }
            $record = $record->paginate(25);
            return $this->render('backend.pesanan.ajax-history',[
                'record' => $record
            ]);
        }else{
            return \abort(404);
        }
    }
}
