<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Veritrans_Config;
use Veritrans_Transaction;
use Illuminate\Console\Command;
use App\Models\TransaksiAmpas\TransaksiAmpase;
class cronjobTransaksi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:transaksi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cronjob Update data transaksi sesuai request midtrans';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $record = TransaksiAmpase::get();
        foreach ($record as $value) {
            $data = Veritrans_Transaction::status($value->order_id);
            $carbons = Carbon::parse($data->transaction_time)->addDays(1);
            // dd($data);
            if (isset($data->va_numbers[0])) {
                $value->bank = $data->va_numbers[0]->bank;
                $value->payment_code = $data->va_numbers[0]->va_number;
                $value->payment_type = $data->payment_type;
                $value->transaction_id = $data->transaction_id;
                $value->signature_key = $data->signature_key;
                $value->transaction_status = $data->transaction_status;
                $value->transaction_time = $data->transaction_time;
                $value->transaction_time_expiry = $carbons;
      
              }elseif ($data->payment_type == 'gopay') {
                $value->payment_type = $data->payment_type ?? NULL;
                $value->transaction_id = $data->transaction_id ?? NULL;
                $value->transaction_status = $data->transaction_status;
                $value->transaction_time = $data->transaction_time;
                $value->transaction_time_expiry = $carbons;
                $value->signature_key = $data->signature_key;
      
              }elseif ($data->payment_type == 'credit_card') {
                $value->payment_code = $data->payment_code ?? NULL;
                $value->store = $data->store ?? NULL;
                $value->transaction_status = $data->transaction_status;
                $value->transaction_time = $data->transaction_time;
                $value->transaction_time_expiry = $carbons;
                $value->status_code = $data->status_code;
      
              }elseif (isset($data->store)) {
                $value->payment_type = $data->payment_type;
                $value->transaction_status = $data->transaction_status;
                $value->signature_key = $data->signature_key;
                $value->transaction_status = $data->transaction_status;
                $value->transaction_time = $data->transaction_time;
                $value->transaction_time_expiry = $carbons;
                
              }elseif (isset($data->payment_type)) {
                $value->payment_type = $data->payment_type;
                $value->payment_code = $data->bill_key ?? NULL;
                $value->signature_key = $data->signature_key;
                $value->transaction_status = $data->transaction_status;
                $value->transaction_id = $data->transaction_id;
                $value->fraud_status = $data->fraud_status;
                $value->transaction_time = $data->transaction_time;
                $value->transaction_time_expiry = $carbons;
                $value->merchant_id = $data->merchant_id;
                $value->status_code = $data->status_code;
                
              }
              if ($data->transaction_status == 'settlement') {
                $value->status = 'Sedang Di Packing';
                $value->detail()->update(['status_barang' => 'Sedang Di Packing']);
              }elseif ($data->transaction_status == 'expire') {
                $value->status = 'Pesanan Dibatalkan';
                $value->detail()->update(['status_barang' => 'Pesanan Dibatalkan']);
              }
              $value->save();
          }
        echo 'data berhasil di update';
        $this->info('Cronjob Transaksi Dimulai '.Carbon::now());
    }
}
