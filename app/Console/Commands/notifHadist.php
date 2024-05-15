<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Users;
class notifHadist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifHadist:check';

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
        $user = Users::get();
        foreach ($user as $key => $value) {
           $value->post_notif = $value->post_notif+1;
           $value->save();
           $no = $value->post_notif;
        }
        $result = file_get_contents("https://api.hadith.sutanlab.id/books/bukhari/$no");
        $decod = json_decode($result);
        $SERVER_API_KEY = 'AAAA7ZHni2A:APA91bH0URz7A6eCqjzFOTf5mLYe_npzrwFGHDve7_VDPIQ4Fd7CwllysyJdyfRWBeM3X6Zt3x7-z4mga4-V3h_9sJDT9tGWoM7ADP7iVT9wC8gp2YLDp3P1bsSgTAn1XbPpagZGF2hl';
        $body = \str_limit($decod->data->contents->id,150);
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => 'Hadits Bukhari Nomor '.$no,
                "body" => $body,
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

        $dataQuran = file_get_contents('http://api.alquran.cloud/v1/quran/quran-uthmani');
        $decodQuran = json_decode($data);
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => 'Surah '.$decodQuran->data->surahs[$no]->englishName,
                "body" => "Baca Ayat hari ini dari Qur'an",
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
  
        echo 'notifikasi Quran berhasil dikirim';
        $this->info('Notifikasi Hadist mulai '.Carbon::now());
    }
}
