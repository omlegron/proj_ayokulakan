<?php

namespace App\Http\Controllers\FrontEnd\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\FrontEnd\Cart\CartMidtransRequest;

use App\Models\User;
use App\Models\Barang\FavoritBarang;

use App\Models\Lapak\Lapak;
use App\Models\Barang\LapakBarang;
use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;
use Zipper;
use Carbon\Carbon;
use Auth;
use DB;


class TransaksiController extends Controller
{
    //
    protected $link = 'transaksi/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Transaksi Anda");
        $this->setGroup("Transaksi Anda");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Transaksi Anda' => '#']);

        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function confirmMidtrans($order_id){
      $record = TransaksiAmpase::where('order_id',$order_id)->first();
      if($record){
        $data = Veritrans_Transaction::status($order_id);
        $carbons = Carbon::parse($data->transaction_time)->addDays(1);
        // dd($data);
        if (isset($data->va_numbers[0])) {
          $record->bank = $data->va_numbers[0]->bank;
          $record->payment_code = $data->va_numbers[0]->va_number;
          $record->payment_type = $data->payment_type;
          $record->transaction_id = $data->transaction_id;
          $record->signature_key = $data->signature_key;
          $record->transaction_status = $data->transaction_status;
          $record->transaction_time = $data->transaction_time;
          $record->transaction_time_expiry = $carbons;

        }elseif ($data->payment_type == 'gopay') {
          $record->payment_type = $data->payment_type ?? NULL;
          $record->transaction_id = $data->transaction_id ?? NULL;
          $record->transaction_status = $data->transaction_status;
          $record->transaction_time = $data->transaction_time;
          $record->transaction_time_expiry = $carbons;
          $record->signature_key = $data->signature_key;

        }elseif ($data->payment_type == 'credit_card') {
          $record->payment_code = $data->payment_code ?? NULL;
          $record->store = $data->store ?? NULL;
          $record->transaction_status = $data->transaction_status;
          $record->transaction_time = $data->transaction_time;
          $record->transaction_time_expiry = $carbons;
          $record->status_code = $data->status_code;

        }elseif (isset($data->store)) {
          $record->payment_type = $data->payment_type;
          $record->transaction_status = $data->transaction_status;
          $record->signature_key = $data->signature_key;
          $record->transaction_status = $data->transaction_status;
          $record->transaction_time = $data->transaction_time;
          $record->transaction_time_expiry = $carbons;

        }elseif (isset($data->payment_type)) {
          $record->payment_type = $data->payment_type;
          $record->payment_code = $data->bill_key ?? NULL;
          $record->signature_key = $data->signature_key;
          $record->transaction_status = $data->transaction_status;
          $record->transaction_id = $data->transaction_id;
          $record->fraud_status = $data->fraud_status;
          $record->transaction_time = $data->transaction_time;
          $record->transaction_time_expiry = $carbons;
          $record->merchant_id = $data->merchant_id;
          $record->status_code = $data->status_code;
          
        }
        if ($data->transaction_status == 'settlement') {
          $record->status = 'Sedang Di Packing';
          $record->detail()->update(['status_barang' => 'Sedang Di Packing']);
        }elseif ($data->transaction_status == 'expire') {
          $record->status = 'Pesanan Dibatalkan';
          $record->detail()->update(['status_barang' => 'Pesanan Dibatalkan']);
        }
        $record->save();
        $user = auth()->user();
        return $this->render('frontend.transaksi.detail', [
          'mockup' => false,
          'record' => $record,
          'status' => $data,
          'batasPembayaran' => $carbons,
          'user' => $user
        ]);
      }else{
         return $this->render('failed.page', ['mockup' => false]);
      }
    }

    public function deleteTransaksi(Request $request){
      $record = TransaksiAmpase::destroy($request->id);
      return response([
            'status' => true,
            'url' => url('/')
        ]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}
