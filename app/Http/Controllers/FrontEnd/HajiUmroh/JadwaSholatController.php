<?php

namespace App\Http\Controllers\FrontEnd\HajiUmroh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HajiUmroh\BeritaTerbaru;
use App\Models\Master\AplikasiTentang;

use App\Models\User;
use App\Models\Users;
use Auth;
use Zipper;
use Carbon\Carbon;
class JadwaSholatController extends Controller
{
    public function index()
    {
        $date = date("Y-m-d");
        $data = \file_get_contents("https://api.banghasan.com/sholat/format/json/jadwal/kota/667/tanggal/$date");
        $decodedData = \json_decode($data);
        $kota = \file_get_contents("https://api.banghasan.com/sholat/format/json/kota");
        $decodkota = \json_decode($kota);
        return $this->render('frontend.maps.jadwal-sholat', [
            'mockup' => false,
            'sholat' => $decodedData,
            'kota'  => $decodkota->kota
        ]);
    }
    public function kota(Request $request)
    {
        $kota = $request->id;
        $date = date("Y-m-d");
        $data = \file_get_contents("https://api.banghasan.com/sholat/format/json/jadwal/kota/$kota/tanggal/$date");
        $decodedData = \json_decode($data);
        return $this->render('frontend.maps.show-jadwal', [
            'mockup' => false,
            'sholat' => $decodedData,
        ]);
    }
    public function saveToken(Request $request)
    {
        if (Auth::check()) {
            $data = Users::find(auth()->user()->id);
            $data->login_token = $request->token;
            $data->save();
            return $data;
        }
    }
    public function sendNotif(Request $request)
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
                    "title" => 'jadwal sholat untuk daerah jakarta',
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
      
            dd($response);
        }
    }
    public function quran(){
        $data = file_get_contents('http://api.alquran.cloud/v1/quran/quran-uthmani');
        $decodedData = json_decode($data);
        return $this->render('frontend.maps.al-quran', [
            'mockup' => false,
            'quran' => $decodedData->data->surahs
        ]);
    }
    public function bacaQuran(Request $request){
        $data = file_get_contents('http://api.alquran.cloud/v1/quran/quran-uthmani');
        $dataAudio = file_get_contents('http://api.alquran.cloud/v1/quran/ar.alafasy');
        $decodedData = json_decode($data);
        $decodedDataAudio = json_decode($dataAudio);
        // dd($request->number);
        // dd($decodedData->data->surahs[$request->number-1]);
        // dd($decodedDataAudio->data->surahs[$request->number-1]);
        return $this->render('frontend.maps.baca-quran', [
            'mockup' => false,
            'quranText' => $decodedData->data->surahs[$request->number-1],
            'quranAudio' => $decodedDataAudio->data->surahs[$request->number-1]
        ]);
    }
}
