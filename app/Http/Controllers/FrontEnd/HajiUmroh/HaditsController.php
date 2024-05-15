<?php

namespace App\Http\Controllers\FrontEnd\HajiUmroh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DOMDocument;
use DOMXPath;
use GuzzleHttp\Client;
use App\Models\Users;

class HaditsController extends Controller
{
    public function index()
    {
        $result = file_get_contents("https://api.hadith.sutanlab.id/books/bukhari?range=1-300");
        $decod = json_decode($result);
        return $this->render('frontend.maps.hadits-bukhori', [
            'mockup' => false,
            'hadits' => $decod->data
        ]);
    }
    public function curl(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sunnah.com/v1/collections/bukhari",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "{}",
        CURLOPT_HTTPHEADER => array(
            "x-api-key: SqD712P3E82xnwOAEOkGd5JZH8s9wRR24TqNFzjk"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        dd($response);
        }
    }
}
