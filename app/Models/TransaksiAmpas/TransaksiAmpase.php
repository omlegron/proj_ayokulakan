<?php

namespace App\Models\TransaksiAmpas;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Helpers\HelpersPPOB;
use App\Models\Notification\NotifFeedback;
use Carbon\Carbon;
use App\Helpers\Darmawisata\Travel;
use App\Helpers\Darmawisata\Tour;

class TransaksiAmpase extends Model
{

    // public function __construct()
    // {
    //     $this->travel = new Travel();
    //     $this->tour = new Tour();
    // }

    protected $table 		= 'trans_ampas_transaksi';
    protected $log_table 	= 'log_trans_ampas_transaksi';
    protected $log_table_fk	= 'trans_id';
    protected $fillable 	= [
        'user_id',
        'payment_type',
        'order_id',
        'status',
        'snap_token',
        'created_by',
        'transaction_id',
        'signature_key',
        'total_harga',
        'transaction_status',
        'fraud_status',
        'store',
        'bank',
        'card_number',
        'payment_code',
        'transaction_time',
        'status_code',
        'redirect_url',
        'merchant_id',
        'transaction_time_expiry',
        'target_id',
        'target_type',
        'ppob_sn',
        'ppob_pin'
    ];

    public function filesMorphClass()
    {
        return 'Transaksi';
    }
    
    public function target()
    {
        return $this->morphTo();
    }

    public function attach(){
        return $this->hasMany(TransaksiAmpaseAttach::class,'trans_id');
    }

    public function kereta()
    {
        return $this->hasMany(TransaksiAmpaseKereta::class,'target_id');
    }

    public function prepaid()
    {
        return $this->hasOne(TransaksiAmpasePrepaid::class,'target_id');
    }

    public function postpaid()
    {
        return $this->hasOne(TransaksiAmpasePostpaid::class,'target_id');
    }

    public function detail(){
        return $this->hasMany(TransaksiAmpaseBarangDetail::class, 'trans_transaksi_id');
    }

    public function kurir(){
        return $this->hasOne(TransaksiKurir::class, 'trans_id');
    }

    public function user(){
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function getBayar()
    {
        switch ($this->store) {
            case 'indomaret':
                return ' <img src="'.asset("img/rajaongkir/indomaret.png").'" alt="" srcset="">';
                break;

            case 'alfamart':
                return ' <img src="'.asset("img/rajaongkir/alfamart.png").'" alt="" srcset="">';
                break;
            
            default:
                # code...
                break;
        }
    }
    public function getBank()
    {
        switch ($this->payment_type) {
            case 'bank_transfer':
                return ' <img src="'.asset("img/rajaongkir/bca.jpg").'" alt="" srcset="" width="100" height="50">';
                break;
            
            default:
                # code...
                break;
        }
    }
    public function checkTransaksi($request){
        if($this->prepaid){
            if ($request->transaction_status == 'capture') {
                if ($request->payment_type == 'credit_card') {
                  if($request->fraud_status != 'challenge') {
                    $sendMobil['hp'] = $this->prepaid->pelanggan;
                    $sendMobil['pulsa_code'] = $this->prepaid->form->pulsa_code;
                    $recordChargePPOB = json_decode(HelpersPPOB::post($this->order_id,$this->prepaid->server,$sendMobil));

                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'detail pesanan';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                  }
                }
            }elseif($request->transaction_status == 'settlement') {
                $sendMobil['hp'] = $this->prepaid->pelanggan;
                $sendMobil['pulsa_code'] = $this->prepaid->form->pulsa_code;
                $recordChargePPOB = json_decode(HelpersPPOB::post($this->order_id,$this->prepaid->server,$sendMobil));

                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'success';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                $saveDataFeed['message'] = 'detail pesanan';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }elseif($request->transaction_status == 'success'){
                $sendMobil['hp'] = $this->prepaid->pelanggan;
                $sendMobil['pulsa_code'] = $this->prepaid->form->pulsa_code;
                $recordChargePPOB = json_decode(HelpersPPOB::post($this->order_id,$this->prepaid->server,$sendMobil));

                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'success';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                $saveDataFeed['message'] = 'detail pesanan';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }

        }elseif($this->postpaid){
            if ($request->transaction_status == 'capture') {
                if ($request->payment_type == 'credit_card') {
                  if($request->fraud_status != 'challenge') {
                    $recordPPOB = HelpersPPOB::postPayPasca($this->postpaid->tr_id);
                    if($recordPPOB){
                        if(isset($recordPPOB->data->tr_id)){
                            $this->status = $recordPPOB->data->message;
                            $this->status_code = $recordPPOB->data->rc;
                            $this->ppob_sn = isset($recordPPOB->data->sn) ? $recordPPOB->data->sn : null;
                            $this->ppob_pin = isset($recordPPOB->data->pin) ? $recordPPOB->data->pin : null;
                            $this->save();
                        }
                    }
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'detail pesanan';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                  }
                }
            }elseif($request->transaction_status == 'settlement') {
                $recordPPOB = HelpersPPOB::postPayPasca($this->postpaid->tr_id);
                if($recordPPOB){
                    if(isset($recordPPOB->data->tr_id)){
                        $this->status = $recordPPOB->data->message;
                        $this->status_code = $recordPPOB->data->rc;
                        $this->ppob_sn = isset($recordPPOB->data->sn) ? $recordPPOB->data->sn : null;
                        $this->ppob_pin = isset($recordPPOB->data->pin) ? $recordPPOB->data->pin : null;
                        $this->save();
                    }
                }
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'success';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                $saveDataFeed['message'] = 'detail pesanan';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }elseif($request->transaction_status == 'success') {
                $recordPPOB = HelpersPPOB::postPayPasca($this->postpaid->tr_id);
                if($recordPPOB){
                    if(isset($recordPPOB->data->tr_id)){
                        $this->status = $recordPPOB->data->message;
                        $this->status_code = $recordPPOB->data->rc;
                        $this->ppob_sn = isset($recordPPOB->data->sn) ? $recordPPOB->data->sn : null;
                        $this->ppob_pin = isset($recordPPOB->data->pin) ? $recordPPOB->data->pin : null;
                        $this->save();
                    }
                }
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'success';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                $saveDataFeed['message'] = 'detail pesanan';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }
        }
    }

    public function checkTransaksiBarangRental($request){
        if($this->detail){
            if($this->detail->count() > 0){
                if ($request->transaction_status == 'capture') {
                    if ($request->payment_type == 'credit_card') {
                      if($request->fraud_status != 'challenge') {
                        foreach ($this->detail as $value) {
                            if($value->form_type == 'img_barang'){
                                $tambah = (int)$value->form->barang_terjual + (int)$value->jumlah_barang;
                                $value->form->barang_terjual = $tambah;
                                $value->form->stock_barang = (int)$value->form->stock_barang - (int)$value->jumlah_barang;
                                $value->form->save();
                            }else if($value->form_type == 'img_rental'){
                                $tambah = (int)$value->form->unit_tersewa + (int)$value->jumlah_barang;
                                $value->form->unit_tersewa = $tambah;
                                $value->form->unit = (int)$value->form->unit_tersewa - (int)$value->jumlah_barang;
                                $value->form->save();
                            }
                        }
                        // Notiff Feedback
                        $recNotifFeedback = new NotifFeedback;
                        $saveDataFeed['trans_id'] = $this->id;
                        $saveDataFeed['user_id'] = $this->user_id;
                        $saveDataFeed['status'] = 'success';
                        $saveDataFeed['review'] = 1;
                        $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                        $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                        $recNotifFeedback->fill($saveDataFeed);
                        $recNotifFeedback->save();
                      }
                    }
                }elseif($request->transaction_status == 'settlement') {
                    foreach ($this->detail as $value) {
                        if($value->form_type == 'img_barang'){
                            $tambah = (int)$value->form->barang_terjual + (int)$value->jumlah_barang;
                            $value->form->barang_terjual = $tambah;
                            $value->form->stock_barang = (int)$value->form->stock_barang - (int)$value->jumlah_barang;
                            $value->form->save();
                        }else if($value->form_type == 'img_rental'){
                            $tambah = (int)$value->form->unit_tersewa + (int)$value->jumlah_barang;
                            $value->form->unit_tersewa = $tambah;
                            $value->form->unit = (int)$value->form->unit_tersewa - (int)$value->jumlah_barang;
                            $value->form->save();
                        }
                    }
                    // Notiff Feedback
                        $recNotifFeedback = new NotifFeedback;
                        $saveDataFeed['trans_id'] = $this->id;
                        $saveDataFeed['user_id'] = $this->user_id;
                        $saveDataFeed['status'] = 'success';
                        $saveDataFeed['review'] = 1;
                        $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                        $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                        $recNotifFeedback->fill($saveDataFeed);
                        $recNotifFeedback->save();
                }elseif($request->transaction_status == 'success'){
                    if($request->fraud_status == 'accept'){
                        foreach ($this->detail as $value) {
                            if($value->form_type == 'img_barang'){
                                $tambah = (int)$value->form->barang_terjual + (int)$value->jumlah_barang;
                                $value->form->barang_terjual = $tambah;
                                $value->form->stock_barang = (int)$value->form->stock_barang - (int)$value->jumlah_barang;
                                $value->form->save();
                            }else if($value->form_type == 'img_rental'){
                                $tambah = (int)$value->form->unit_tersewa + (int)$value->jumlah_barang;
                                $value->form->unit_tersewa = $tambah;
                                $value->form->unit = (int)$value->form->unit_tersewa - (int)$value->jumlah_barang;
                                $value->form->save();
                            }
                        }
                        // Notiff Feedback
                        $recNotifFeedback = new NotifFeedback;
                        $saveDataFeed['trans_id'] = $this->id;
                        $saveDataFeed['user_id'] = $this->user_id;
                        $saveDataFeed['status'] = 'success';
                        $saveDataFeed['review'] = 1;
                        $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                        $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                        $recNotifFeedback->fill($saveDataFeed);
                        $recNotifFeedback->save();
                    }
                }elseif($request->transaction_status == 'pending'){
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'pending';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Silahkan Lakukan Pembayaran';
                    $saveDataFeed['message'] = 'anda yakin mengabaikan pesanan anda, silahkan lakukan pembayaran segera';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }elseif($request->transaction_status == 'expiers'){
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'expiers';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Ahh Sayang Sekali';
                    $saveDataFeed['message'] = 'pesanan anda telah kadluarsa, silahkan lakukan pembelian ulang';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }
            }elseif($request->transaction_status == 'pending'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'pending';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Silahkan Lakukan Pembayaran';
                $saveDataFeed['message'] = 'anda yakin mengabaikan pesanan anda, silahkan lakukan pembayaran segera';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }elseif($request->transaction_status == 'expiers'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'expiers';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Ahh Sayang Sekali';
                $saveDataFeed['message'] = 'pesanan anda telah kadaluarsa, silahkan lakukan pembelian ulang';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }
        }
    }

    public function checkTarget($request){
        if($this->target_type == 'AirlineBooking'){
            $this->AirlineBooking($request);
        }else if($this->target_type == 'HotelBooking'){
            $this->HotelBooking($request);
        }else if($this->target_type == 'BusBooking'){
            $this->BusBooking($request);
        }else if($this->target_type == 'KapalBooking'){
            $this->KapalBooking($request);
        }else if($this->target_type == 'TourBooking'){
            $this->TourBooking($request);
        }else if($this->target_type == 'TravelBooking'){
            $this->TravelBooking($request);
        }else if($this->target_type == 'KeretaBooking'){
            $this->KeretaBooking($request);
        }
    }

    public function AirlineBooking($request){
        if($this->target){
            
            if ($this->target && $request->transaction_status == 'capture') {
                if ($request->payment_type == 'credit_card') {
                    if($request->fraud_status != 'challenge') {
                        request()['bookingCode'] = $this->target->bookingCode;
                        request()['bookingDate'] = $this->target->bookingDate;
                        $result = guzzleGet(request(), '/api/darmawisata/booking/detail')->data;
                        
                        if($result){
                            request()['userID'] = isset($result->userID) ? $result->userID : '';
                            request()['accessToken'] = isset($result->accessToken) ? $result->accessToken : '';
                            request()['airlineID'] = isset($result->airlineID) ? $result->airlineID : '';
                            request()['origin'] = isset($result->origin) ? $result->origin : '';
                            request()['destination'] = isset($result->destination) ? $result->destination : '';
                            request()['tripType'] = isset($result->tripType) ? $result->tripType : '';
                            request()['departDate'] = isset($result->departDate) ? $result->departDate : '';
                            request()['returnDate'] = isset($result->returnDate) ? $result->returnDate : '';
                            request()['bookingCode'] = isset($result->bookingCode) ? $result->bookingCode : '';
                            request()['bookingDate'] = isset($result->bookingDate) ? $result->bookingDate : '';
                            request()['airlineAccessCode'] = "";
                            $cekIssued = guzzlePost(request(),'/api/darmawisata/issued')->data;
                            if($cekIssued){
                                $res = $this->target->fill([
                                    'status' => $cekIssued->status,
                                    'respMessage' => $cekIssued->respMessage,
                                    'bookingStatus' => $cekIssued->bookingStatus,
                                ]);
                                $res->save();
                            }
                            // Notiff Feedback
                            $recNotifFeedback = new NotifFeedback;
                            $saveDataFeed['trans_id'] = $this->id;
                            $saveDataFeed['user_id'] = $this->user_id;
                            $saveDataFeed['status'] = 'success';
                            $saveDataFeed['review'] = 1;
                            $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                            $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                            $recNotifFeedback->fill($saveDataFeed);
                            $recNotifFeedback->save();
                        }
                    }
                }
            }elseif($this->target && $request->transaction_status == 'settlement') {
                request()['bookingCode'] = $this->target->bookingCode;
                request()['bookingDate'] = $this->target->bookingDate;
                $result = guzzleGet(request(), '/api/darmawisata/booking/detail')->data;
                
                if($result){
                    request()['userID'] = isset($result->userID) ? $result->userID : '';
                    request()['accessToken'] = isset($result->accessToken) ? $result->accessToken : '';
                    request()['airlineID'] = isset($result->airlineID) ? $result->airlineID : '';
                    request()['origin'] = isset($result->origin) ? $result->origin : '';
                    request()['destination'] = isset($result->destination) ? $result->destination : '';
                    request()['tripType'] = isset($result->tripType) ? $result->tripType : '';
                    request()['departDate'] = isset($result->departDate) ? $result->departDate : '';
                    request()['returnDate'] = isset($result->returnDate) ? $result->returnDate : '';
                    request()['bookingCode'] = isset($result->bookingCode) ? $result->bookingCode : '';
                    request()['bookingDate'] = isset($result->bookingDate) ? $result->bookingDate : '';
                    request()['airlineAccessCode'] = "";
                    $cekIssued = guzzlePost(request(),'/api/darmawisata/issued')->data;
                    if($cekIssued){
                        $res = $this->target->fill([
                            'status' => $cekIssued->status,
                            'respMessage' => $cekIssued->respMessage,
                            'bookingStatus' => $cekIssued->bookingStatus,
                        ]);
                        $res->save();
                    }
                // Notiff Feedback
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }
            }elseif($this->target && $request->transaction_status == 'success'){
                    request()['bookingCode'] = $this->target->bookingCode;
                    request()['bookingDate'] = $this->target->bookingDate;
                    $result = guzzleGet(request(), '/api/darmawisata/booking/detail')->data;
                    if($result){
                        request()['userID'] = isset($result->userID) ? $result->userID : '';
                        request()['accessToken'] = isset($result->accessToken) ? $result->accessToken : '';
                        request()['airlineID'] = isset($result->airlineID) ? $result->airlineID : '';
                        request()['origin'] = isset($result->origin) ? $result->origin : '';
                        request()['destination'] = isset($result->destination) ? $result->destination : '';
                        request()['tripType'] = isset($result->tripType) ? $result->tripType : '';
                        request()['departDate'] = isset($result->departDate) ? $result->departDate : '';
                        request()['returnDate'] = isset($result->returnDate) ? $result->returnDate : '';
                        request()['bookingCode'] = isset($result->bookingCode) ? $result->bookingCode : '';
                        request()['bookingDate'] = isset($result->bookingDate) ? $result->bookingDate : '';
                        request()['airlineAccessCode'] = "";
                        $cekIssued = guzzlePost(request(),'/api/darmawisata/issued')->data;
                        if($cekIssued){
                            $res = $this->target->fill([
                                'status' => $cekIssued->status,
                                'respMessage' => $cekIssued->respMessage,
                                'bookingStatus' => $cekIssued->bookingStatus,
                            ]);
                            $res->save();
                        }
                        
                        // Notiff Feedback
                        $recNotifFeedback = new NotifFeedback;
                        $saveDataFeed['trans_id'] = $this->id;
                        $saveDataFeed['user_id'] = $this->user_id;
                        $saveDataFeed['status'] = 'success';
                        $saveDataFeed['review'] = 1;
                        $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                        $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                        $recNotifFeedback->fill($saveDataFeed);
                        $recNotifFeedback->save();

                    }
            }elseif($request->transaction_status == 'pending'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'pending';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Silahkan Lakukan Pembayaran';
                $saveDataFeed['message'] = 'anda yakin mengabaikan pesanan anda, silahkan lakukan pembayaran segera';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }elseif($request->transaction_status == 'expiers'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'expiers';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Ahh Sayang Sekali';
                $saveDataFeed['message'] = 'pesanan anda telah kadaluarsa, silahkan lakukan pembelian ulang';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }
        }
    }

    public function HotelBooking($request){
        if($this->target){
            if ($this->target && $request->transaction_status == 'capture') {
                if ($request->payment_type == 'credit_card') {
                    if($request->fraud_status != 'challenge') {
                        
                        request()["accessToken"] = ($this->target->accessToken) ? $this->target->accessToken : '';
                        request()["paxPassport"] = ($this->target->paxPassport) ? $this->target->paxPassport : '';
                        request()["countryID"] = ($this->target->countryID) ? $this->target->countryID : '';
                        request()["cityID"] = ($this->target->cityID) ? $this->target->cityID : '';
                        request()["checkInDate"] = ($this->target->checkInDate) ? $this->target->checkInDate : '';
                        request()["checkOutDate"] = ($this->target->checkOutDate) ? $this->target->checkOutDate : '';
                        request()["hotelID"] = ($this->target->hotelID) ? $this->target->hotelID : '';
                        request()["internalCode"] = ($this->target->internalCode) ? $this->target->internalCode : '';
                        request()["roomType"] = ($this->target->roomType) ? $this->target->roomType : '';
                        request()["isRequestChildBed"] = ($this->target->isRequestChildBed) ? $this->target->isRequestChildBed : '';
                        request()["breakfast"] = ($this->target->breakfast) ? $this->target->breakfast : '';
                        request()["price"] = ($this->target->price) ? $this->target->price : '';
                        request()["roomID"] = ($this->target->roomID) ? $this->target->roomID : '';
                        request()["bedTypeBed"] = ($this->target->bedTypeBed) ? $this->target->bedTypeBed : '';
                        request()["bedTypeID"] = ($this->target->bedTypeID) ? $this->target->bedTypeID : '';
                        request()["smookingRoom"] = ($this->target->smookingRoom) ? $this->target->smookingRoom : '';
                        request()["email"] = ($this->target->email) ? $this->target->email : '';
                        request()["phone"] = ($this->target->phone) ? $this->target->phone : '';
                        request()["alamat"] = ($this->target->alamat) ? $this->target->alamat : '';
                        $age = [];
                        if($this->target->age && ($this->target->age->count() > 0)){
                            foreach ($this->target->age as $k => $value) {
                                $age[$k] = $value;
                            }
                        }
                        request()["childNum"] = $age;
                        $paxe = [];
                        if($this->target->paxe && ($this->target->paxe->count() > 0)){
                            foreach ($this->target->paxe as $k => $value) {
                                $paxe[$k]['title'] = $value->title;   
                                $paxe[$k]['firstName'] = $value->firstName;   
                                $paxe[$k]['lastName'] = $value->lastName;   
                            }
                        }
                        request()["paxes"] = $paxe;

                        $special = [];
                        if($this->target->special && ($this->target->special->count() > 0)){
                            foreach ($this->target->special as $k => $value) {
                                $special[$k]['ID'] = $value->special_id;   
                                $special[$k]['description'] = $value->description;   
                            }
                        }
                        request()["specialRequestArray"] = $special;
                        request()["agentOsRef"] = $this->order_id;

                        $result = guzzlePost(request(),'/api/darmawisata/hotel/booking')->data;
                        if($result){
                            $recSave = $this->target;
                    
                            $recSave->agentOsRef = $result->agentOsRef;
                            $recSave->osRefNo = $result->osRefNo;
                            $recSave->reservationNo = $result->reservationNo;
                            $recSave->bookingStatus = $result->bookingStatus;
                            $recSave->status = $result->status;
                            $recSave->respMessage = $result->respMessage;
                            $recSave->save();

                            // Notiff Feedback
                            $recNotifFeedback = new NotifFeedback;
                            $saveDataFeed['trans_id'] = $this->id;
                            $saveDataFeed['user_id'] = $this->user_id;
                            $saveDataFeed['status'] = 'success';
                            $saveDataFeed['review'] = 1;
                            $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                            $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                            $recNotifFeedback->fill($saveDataFeed);
                            $recNotifFeedback->save();
                        }
                    }
                }
            }elseif($this->target && $request->transaction_status == 'settlement') {
                request()["accessToken"] = ($this->target->accessToken) ? $this->target->accessToken : '';
                request()["paxPassport"] = ($this->target->paxPassport) ? $this->target->paxPassport : '';
                request()["countryID"] = ($this->target->countryID) ? $this->target->countryID : '';
                request()["cityID"] = ($this->target->cityID) ? $this->target->cityID : '';
                request()["checkInDate"] = ($this->target->checkInDate) ? $this->target->checkInDate : '';
                request()["checkOutDate"] = ($this->target->checkOutDate) ? $this->target->checkOutDate : '';
                request()["hotelID"] = ($this->target->hotelID) ? $this->target->hotelID : '';
                request()["internalCode"] = ($this->target->internalCode) ? $this->target->internalCode : '';
                request()["roomType"] = ($this->target->roomType) ? $this->target->roomType : '';
                request()["isRequestChildBed"] = ($this->target->isRequestChildBed) ? $this->target->isRequestChildBed : '';
                request()["breakfast"] = ($this->target->breakfast) ? $this->target->breakfast : '';
                request()["price"] = ($this->target->price) ? $this->target->price : '';
                request()["roomID"] = ($this->target->roomID) ? $this->target->roomID : '';
                request()["bedTypeBed"] = ($this->target->bedTypeBed) ? $this->target->bedTypeBed : '';
                request()["bedTypeID"] = ($this->target->bedTypeID) ? $this->target->bedTypeID : '';
                request()["smookingRoom"] = ($this->target->smookingRoom) ? $this->target->smookingRoom : '';
                request()["email"] = ($this->target->email) ? $this->target->email : '';
                request()["phone"] = ($this->target->phone) ? $this->target->phone : '';
                request()["alamat"] = ($this->target->alamat) ? $this->target->alamat : '';
                $age = [];
                if($this->target->age && ($this->target->age->count() > 0)){
                    foreach ($this->target->age as $k => $value) {
                        array_push($age,$value);
                    }
                }
                request()["childNum"] = $age;
                $paxe = [];
                if($this->target->paxe && ($this->target->paxe->count() > 0)){
                    foreach ($this->target->paxe as $k => $value) {
                        $paxe[$k]['title'] = $value->title;   
                        $paxe[$k]['firstName'] = $value->firstName;   
                        $paxe[$k]['lastName'] = $value->lastName;   
                    }
                }
                request()["paxes"] = $paxe;
                $special = [];
                if($this->target->special && ($this->target->special->count() > 0)){
                    foreach ($this->target->special as $k => $value) {
                        $special[$k]['ID'] = $value->special_id;   
                        $special[$k]['description'] = $value->description;   
                    }
                }
                request()["specialRequestArray"] = $special;
                request()["agentOsRef"] = $this->order_id;

                $result = guzzlePost(request(),'/api/darmawisata/hotel/booking')->data;
                
                if($result){
                    $recSave = $this->target;
                    $recSave->agentOsRef = $result->agentOsRef;
                    $recSave->osRefNo = $result->osRefNo;
                    $recSave->reservationNo = $result->reservationNo;
                    $recSave->bookingStatus = $result->bookingStatus;
                    $recSave->status = $result->status;
                    $recSave->respMessage = $result->respMessage;
                    $recSave->save();

                    // Notiff Feedback
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }
            }elseif($this->target && $request->transaction_status == 'success'){
                request()["accessToken"] = ($this->target->accessToken) ? $this->target->accessToken : '';
                request()["paxPassport"] = ($this->target->paxPassport) ? $this->target->paxPassport : '';
                request()["countryID"] = ($this->target->countryID) ? $this->target->countryID : '';
                request()["cityID"] = ($this->target->cityID) ? $this->target->cityID : '';
                request()["checkInDate"] = ($this->target->checkInDate) ? $this->target->checkInDate : '';
                request()["checkOutDate"] = ($this->target->checkOutDate) ? $this->target->checkOutDate : '';
                request()["hotelID"] = ($this->target->hotelID) ? $this->target->hotelID : '';
                request()["internalCode"] = ($this->target->internalCode) ? $this->target->internalCode : '';
                request()["roomType"] = ($this->target->roomType) ? $this->target->roomType : '';
                request()["isRequestChildBed"] = ($this->target->isRequestChildBed) ? $this->target->isRequestChildBed : '';
                request()["breakfast"] = ($this->target->breakfast) ? $this->target->breakfast : '';
                request()["price"] = ($this->target->price) ? $this->target->price : '';
                request()["roomID"] = ($this->target->roomID) ? $this->target->roomID : '';
                request()["bedTypeBed"] = ($this->target->bedTypeBed) ? $this->target->bedTypeBed : '';
                request()["bedTypeID"] = ($this->target->bedTypeID) ? $this->target->bedTypeID : '';
                request()["smookingRoom"] = ($this->target->smookingRoom) ? $this->target->smookingRoom : '';
                request()["email"] = ($this->target->email) ? $this->target->email : '';
                request()["phone"] = ($this->target->phone) ? $this->target->phone : '';
                request()["alamat"] = ($this->target->alamat) ? $this->target->alamat : '';
                $age = [];
                if($this->target->age && ($this->target->age->count() > 0)){
                    foreach ($this->target->age as $k => $value) {
                        array_push($age,$value);
                    }
                }
                request()["childNum"] = $age;
                $paxe = [];
                if($this->target->paxe && ($this->target->paxe->count() > 0)){
                    foreach ($this->target->paxe as $k => $value) {
                        $paxe[$k]['title'] = $value->title;   
                        $paxe[$k]['firstName'] = $value->firstName;   
                        $paxe[$k]['lastName'] = $value->lastName;   
                    }
                }
                request()["paxes"] = $paxe;
                $special = [];
                if($this->target->special && ($this->target->special->count() > 0)){
                    foreach ($this->target->special as $k => $value) {
                        $special[$k]['ID'] = $value->special_id;   
                        $special[$k]['description'] = $value->description;   
                    }
                }
                request()["specialRequestArray"] = $special;
                request()["agentOsRef"] = $this->order_id;

                $result = guzzlePost(request(),'/api/darmawisata/hotel/booking')->data;
                
                if($result){
                    $recSave = $this->target;
                    $recSave->agentOsRef = $result->agentOsRef;
                    $recSave->osRefNo = $result->osRefNo;
                    $recSave->reservationNo = $result->reservationNo;
                    $recSave->bookingStatus = $result->bookingStatus;
                    $recSave->status = $result->status;
                    $recSave->respMessage = $result->respMessage;
                    $recSave->save();

                    // Notiff Feedback
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }
            }elseif($request->transaction_status == 'pending'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'pending';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Silahkan Lakukan Pembayaran';
                $saveDataFeed['message'] = 'anda yakin mengabaikan pesanan anda, silahkan lakukan pembayaran segera';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }elseif($request->transaction_status == 'expiers'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'expiers';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Ahh Sayang Sekali';
                $saveDataFeed['message'] = 'pesanan anda telah kadaluarsa, silahkan lakukan pembelian ulang';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }
        }
    }

    public function BusBooking($request){
        if($this->target){
            
            if ($this->target && $request->transaction_status == 'capture') {
                if ($request->payment_type == 'credit_card') {
                    if($request->fraud_status != 'challenge') {
                        request()['accessToken'] = $this->target->accessToken;
                        request()['bookingCode'] = $this->target->bookingCode;
                        request()['bookingDate'] = Carbon::parse($this->target->bookingTime)->format('Y-m-d');

                        $result = guzzlePost(request(),'/api/darmawisata/bus/issued')->data;
                        $this->target()->update([
                            'status' => $result->status,
                            'respMessage' => $result->respMessage,
                        ]);
                        if($result && $result->status == 'SUCCESS'){
                            // Notiff Feedback
                            $recNotifFeedback = new NotifFeedback;
                            $saveDataFeed['trans_id'] = $this->id;
                            $saveDataFeed['user_id'] = $this->user_id;
                            $saveDataFeed['status'] = 'success';
                            $saveDataFeed['review'] = 1;
                            $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                            $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                            $recNotifFeedback->fill($saveDataFeed);
                            $recNotifFeedback->save();
                        }
                    }
                }
            }elseif($this->target && $request->transaction_status == 'settlement') {
                request()['accessToken'] = $this->target->accessToken;
                request()['bookingCode'] = $this->target->bookingCode;
                request()['bookingDate'] = Carbon::parse($this->target->bookingTime)->format('Y-m-d');

                $result = guzzlePost(request(),'/api/darmawisata/bus/issued')->data;
                $this->target()->update([
                    'status' => $result->status,
                    'respMessage' => $result->respMessage,
                ]);
                if($result && $result->status == 'SUCCESS'){
                    // Notiff Feedback
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }
            }elseif($this->target && $request->transaction_status == 'success'){
                request()['accessToken'] = $this->target->accessToken;
                request()['bookingCode'] = $this->target->bookingCode;
                request()['bookingDate'] = Carbon::parse($this->target->bookingTime)->format('Y-m-d');

                $result = guzzlePost(request(),'/api/darmawisata/bus/issued')->data;
                $this->target()->update([
                    'status' => $result->status,
                    'respMessage' => $result->respMessage,
                ]);
                if($result && $result->status == 'SUCCESS'){
                    // Notiff Feedback
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }
            }elseif($request->transaction_status == 'pending'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'pending';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Silahkan Lakukan Pembayaran';
                $saveDataFeed['message'] = 'anda yakin mengabaikan pesanan anda, silahkan lakukan pembayaran segera';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }elseif($request->transaction_status == 'expiers'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'expiers';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Ahh Sayang Sekali';
                $saveDataFeed['message'] = 'pesanan anda telah kadaluarsa, silahkan lakukan pembelian ulang';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }
        }
    }

    public function KapalBooking($request){
        if($this->target){
            
            if ($this->target && $request->transaction_status == 'capture') {
                if ($request->payment_type == 'credit_card') {
                    if($request->fraud_status != 'challenge') {
                        request()['accessToken'] = $this->target->accessToken;
                        request()['numCode'] = $this->target->numCode;
                        request()['bookingDate'] = Carbon::parse($this->target->bookingDate)->format('Y-m-d');

                        $result = guzzlePost(request(),'/api/darmawisata/ship/issued')->data;
                        $this->target()->update([
                            'status' => $result->status,
                            'respMessage' => $result->respMessage,
                            'bookingStatus' => $result->bookingStatus,
                            // 'bokingNumber' => $result->bokingNumber,
                        ]);
                        if($result && $result->status == 'SUCCESS'){
                            // Notiff Feedback
                            $recNotifFeedback = new NotifFeedback;
                            $saveDataFeed['trans_id'] = $this->id;
                            $saveDataFeed['user_id'] = $this->user_id;
                            $saveDataFeed['status'] = 'success';
                            $saveDataFeed['review'] = 1;
                            $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                            $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                            $recNotifFeedback->fill($saveDataFeed);
                            $recNotifFeedback->save();
                        }
                    }
                }
            }elseif($this->target && $request->transaction_status == 'settlement') {
                request()['accessToken'] = $this->target->accessToken;
                request()['numCode'] = $this->target->numCode;
                request()['bookingDate'] = Carbon::parse($this->target->bookingDate)->format('Y-m-d');

                $result = guzzlePost(request(),'/api/darmawisata/ship/issued')->data;
                $this->target()->update([
                    'status' => $result->status,
                    'respMessage' => $result->respMessage,
                    'bookingStatus' => $result->bookingStatus,
                    // 'bokingNumber' => $result->bokingNumber,
                ]);
                if($result && $result->status == 'SUCCESS'){
                    // Notiff Feedback
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }
            }elseif($this->target && $request->transaction_status == 'success'){
                request()['accessToken'] = $this->target->accessToken;
                request()['numCode'] = $this->target->numCode;
                request()['bookingDate'] = Carbon::parse($this->target->bookingDate)->format('Y-m-d');

                $result = guzzlePost(request(),'/api/darmawisata/ship/issued')->data;
                $this->target()->update([
                    'status' => $result->status,
                    'respMessage' => $result->respMessage,
                    'bookingStatus' => $result->bookingStatus,
                    // 'bokingNumber' => $result->bokingNumber,
                ]);
                if($result && $result->status == 'SUCCESS'){
                    // Notiff Feedback
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }
            }elseif($request->transaction_status == 'pending'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'pending';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Silahkan Lakukan Pembayaran';
                $saveDataFeed['message'] = 'anda yakin mengabaikan pesanan anda, silahkan lakukan pembayaran segera';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }elseif($request->transaction_status == 'expiers'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'expiers';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Ahh Sayang Sekali';
                $saveDataFeed['message'] = 'pesanan anda telah kadaluarsa, silahkan lakukan pembelian ulang';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }
        }
    }

    public function TravelBooking($request){
        $this->travel = new Travel();
        if($this->target){
            
            if ($this->target && $request->transaction_status == 'capture') {
                if ($request->payment_type == 'credit_card') {
                    if($request->fraud_status != 'challenge') {
                        request()['accessToken'] = $this->target->accessToken;
                        request()['bookingCode'] = $this->target->bookingCode;
                        request()['bookingDate'] = Carbon::parse($this->target->bookingDate)->format('Y-m-d');

                        $result = $this->travel->setShuttleIssued(request());
                        // dd($result);
                        $this->target()->update([
                            'status' => $result->status,
                            'ticketStatus' => ($result->bookingStatus) ? $result->bookingStatus : $result->ticketStatus,
                            'respMessage' => $result->respMessage,
                        ]);
                        if($result && $result->status == 'SUCCESS'){
                            // Notiff Feedback
                            $recNotifFeedback = new NotifFeedback;
                            $saveDataFeed['trans_id'] = $this->id;
                            $saveDataFeed['user_id'] = $this->user_id;
                            $saveDataFeed['status'] = 'success';
                            $saveDataFeed['review'] = 1;
                            $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                            $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                            $recNotifFeedback->fill($saveDataFeed);
                            $recNotifFeedback->save();
                        }
                    }
                }
            }elseif($this->target && $request->transaction_status == 'settlement') {
                request()['accessToken'] = $this->target->accessToken;
                request()['bookingCode'] = $this->target->bookingCode;
                request()['bookingDate'] = Carbon::parse($this->target->bookingDate)->format('Y-m-d');

                $result = $this->travel->setShuttleIssued(request());
                $this->target()->update([
                    'status' => $result->status,
                    'ticketStatus' => ($result->bookingStatus) ? $result->bookingStatus : $result->ticketStatus,
                    'respMessage' => $result->respMessage,
                ]);
                if($result && $result->status == 'SUCCESS'){
                    // Notiff Feedback
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }
            }elseif($this->target && $request->transaction_status == 'success'){
                request()['accessToken'] = $this->target->accessToken;
                request()['bookingCode'] = $this->target->bookingCode;
                request()['bookingDate'] = Carbon::parse($this->target->bookingDate)->format('Y-m-d');

                $result = $this->travel->setShuttleIssued(request());
                $this->target()->update([
                    'status' => $result->status,
                    'ticketStatus' => ($result->bookingStatus) ? $result->bookingStatus : $result->ticketStatus,
                    'respMessage' => $result->respMessage,
                ]);
                if($result && $result->status == 'SUCCESS'){
                    // Notiff Feedback
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }
            }elseif($request->transaction_status == 'pending'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'pending';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Silahkan Lakukan Pembayaran';
                $saveDataFeed['message'] = 'anda yakin mengabaikan pesanan anda, silahkan lakukan pembayaran segera';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }elseif($request->transaction_status == 'expiers'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'expiers';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Ahh Sayang Sekali';
                $saveDataFeed['message'] = 'pesanan anda telah kadaluarsa, silahkan lakukan pembelian ulang';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }
        }
    }

    public function TourBooking($request){
        $this->tour = new Tour();

        if($this->target){
            
            if ($this->target && $request->transaction_status == 'capture') {
                if ($request->payment_type == 'credit_card') {
                    if($request->fraud_status != 'challenge') {
                        request()['accessToken'] = $this->target->accessToken;
                        request()['BookingCode'] = $this->target->BookingCode;
                        request()['TourVariant'] = $this->target->TourVariant;

                        $result = $this->tour->setIssuedTourBooking(request());
                        $this->target()->update([
                            'status' => $result->status,
                            'respMessage' => $result->respMessage,
                        ]);
                        if($result && $result->status == 'SUCCESS'){
                            // Notiff Feedback
                            $recNotifFeedback = new NotifFeedback;
                            $saveDataFeed['trans_id'] = $this->id;
                            $saveDataFeed['user_id'] = $this->user_id;
                            $saveDataFeed['status'] = 'success';
                            $saveDataFeed['review'] = 1;
                            $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                            $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                            $recNotifFeedback->fill($saveDataFeed);
                            $recNotifFeedback->save();
                        }
                    }
                }
            }elseif($this->target && $request->transaction_status == 'settlement') {
                request()['accessToken'] = $this->target->accessToken;
                request()['BookingCode'] = $this->target->BookingCode;
                request()['TourVariant'] = $this->target->TourVariant;

                $result = $this->tour->setIssuedTourBooking(request());
                $this->target()->update([
                    'status' => $result->status,
                    'respMessage' => $result->respMessage,
                ]);
                if($result && $result->status == 'SUCCESS'){
                    // Notiff Feedback
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }
            }elseif($this->target && $request->transaction_status == 'success'){
                request()['accessToken'] = $this->target->accessToken;
                request()['BookingCode'] = $this->target->BookingCode;
                request()['TourVariant'] = $this->target->TourVariant;

                $result = $this->tour->setIssuedTourBooking(request());
                $this->target()->update([
                    'status' => $result->status,
                    'respMessage' => $result->respMessage,
                ]);
                if($result && $result->status == 'SUCCESS'){
                    // Notiff Feedback
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }
            }elseif($request->transaction_status == 'pending'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'pending';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Silahkan Lakukan Pembayaran';
                $saveDataFeed['message'] = 'anda yakin mengabaikan pesanan anda, silahkan lakukan pembayaran segera';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }elseif($request->transaction_status == 'expiers'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'expiers';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Ahh Sayang Sekali';
                $saveDataFeed['message'] = 'pesanan anda telah kadaluarsa, silahkan lakukan pembelian ulang';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }
        }
    }

    public function KeretaBooking($request){
        if($this->target){
            
            if ($this->target && $request->transaction_status == 'capture') {
                if ($request->payment_type == 'credit_card') {
                    if($request->fraud_status != 'challenge') {

                        $result = HelpersPPOB::bookingAccept($this->target->tr_id);

                        if(isset($result->data->tr_id)){
                            $this->target()->update([
                                'message' => $result->data->message,
                                'eticket' => $result->data->desc->eticket,
                                'response_code' => $result->response_code,
                            ]);

                            $recNotifFeedback = new NotifFeedback;
                            $saveDataFeed['trans_id'] = $this->id;
                            $saveDataFeed['user_id'] = $this->user_id;
                            $saveDataFeed['status'] = 'success';
                            $saveDataFeed['review'] = 1;
                            $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                            $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                            $recNotifFeedback->fill($saveDataFeed);
                            $recNotifFeedback->save();
                        }else{
                            $this->target()->update([
                                'message' => $result->data->message,
                                'response_code' => $result->response_code,
                            ]);
                            $recNotifFeedback = new NotifFeedback;
                            $saveDataFeed['trans_id'] = $this->id;
                            $saveDataFeed['user_id'] = $this->user_id;
                            $saveDataFeed['status'] = 'Gagal';
                            $saveDataFeed['review'] = 1;
                            $saveDataFeed['judul'] = 'Maaf Pemesanan Tiket Kerta Anda Gagal';
                            $saveDataFeed['message'] = 'Terimakasih Sebelumnya, Silahkan Hubungi Call Center Kami Untuk Merefound Pembayaran';
                            $recNotifFeedback->fill($saveDataFeed);
                            $recNotifFeedback->save();
                        }
                    }
                }
            }elseif($this->target && $request->transaction_status == 'settlement') {
                $result = HelpersPPOB::bookingAccept($this->target->tr_id);

                if(isset($result->data->tr_id)){
                    $this->target()->update([
                        'message' => $result->data->message,
                        'eticket' => $result->data->desc->eticket,
                        'response_code' => $result->response_code,
                    ]);

                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }else{
                    $this->target()->update([
                        'message' => $result->data->message,
                        'response_code' => $result->response_code,
                    ]);
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'Gagal';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Maaf Pemesanan Tiket Kerta Anda Gagal';
                    $saveDataFeed['message'] = 'Terimakasih Sebelumnya, Silahkan Hubungi Call Center Kami Untuk Merefound Pembayaran';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }
            }elseif($this->target && $request->transaction_status == 'success'){
                $result = HelpersPPOB::bookingAccept($this->target->tr_id);

                if(isset($result->data->tr_id)){
                    $this->target()->update([
                        'message' => $result->data->message,
                        'eticket' => $result->data->desc->eticket,
                        'response_code' => $result->response_code,
                    ]);

                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }else{
                    $this->target()->update([
                        'message' => $result->data->message,
                        'response_code' => $result->response_code,
                    ]);
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'Gagal';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Maaf Pemesanan Tiket Kerta Anda Gagal';
                    $saveDataFeed['message'] = 'Terimakasih Sebelumnya, Silahkan Hubungi Call Center Kami Untuk Merefound Pembayaran';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }
            }elseif($request->transaction_status == 'pending'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'pending';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Silahkan Lakukan Pembayaran';
                $saveDataFeed['message'] = 'anda yakin mengabaikan pesanan anda, silahkan lakukan pembayaran segera';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }elseif($request->transaction_status == 'expiers'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'expiers';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Ahh Sayang Sekali';
                $saveDataFeed['message'] = 'pesanan anda telah kadaluarsa, silahkan lakukan pembelian ulang';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }
        }
    }

}
