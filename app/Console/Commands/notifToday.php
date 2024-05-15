<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Users;
use Carbon\Carbon;
class notifToday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifToday:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $firebaseToken = Users::whereNotNull('login_token')->pluck('login_token')->all();
        $waktu = date("Y-m-d");
        $data = \file_get_contents("https://api.banghasan.com/sholat/format/json/jadwal/kota/667/tanggal/$waktu");
        $decodedData = \json_decode($data);
        $date = Carbon::now()->format('H:i');
        $SERVER_API_KEY = 'AAAA7ZHni2A:APA91bH0URz7A6eCqjzFOTf5mLYe_npzrwFGHDve7_VDPIQ4Fd7CwllysyJdyfRWBeM3X6Zt3x7-z4mga4-V3h_9sJDT9tGWoM7ADP7iVT9wC8gp2YLDp3P1bsSgTAn1XbPpagZGF2hl';
        $body = '';
        if ($decodedData->jadwal->data->subuh == $date) {
            $body = 'waktu Sholat Subuh';
        }elseif ($decodedData->jadwal->data->dzuhur == $date) {
            $body = 'waktu Sholat Dzuhur';
        }elseif ($decodedData->jadwal->data->ashar == $date) {
            $body = 'waktu Sholat Ashar';
        }elseif ($decodedData->jadwal->data->maghrib == $date) {
            $body = 'waktu Sholat Magrib';
        }elseif ($decodedData->jadwal->data->isya == $date) {
            $body = 'waktu Sholat Isya';
        }
        if ($body != '') {
            $data = [
                "registration_ids" => $firebaseToken,
                "notification" => [
                    "title" => 'Waktu sholat untuk daerah DKi Jakarta ',
                    "body" => $body,
                    "sound" => \url('adzan.mpeg')
                ]
            ];
            $dataString = json_encode($data);
        
            $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];
        
            $ch = curl_init();
          
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                   
            $response = curl_exec($ch);
          
            curl_close($ch);
      
            echo 'notifikasi berhasil dikirim';
        }
        $this->info('Notifikasi mulai '.Carbon::now());
    }
}
