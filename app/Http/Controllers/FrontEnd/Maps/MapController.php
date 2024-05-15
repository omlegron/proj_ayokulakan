<?php

namespace App\Http\Controllers\FrontEnd\Maps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HajiUmroh\BeritaTerbaru;
use App\Models\Master\AplikasiTentang;

use App\Models\User;
use App\Models\KakiLima\KakiLima;
use App\Models\Kurir\Kurir;
use DOMDocument;
use DOMXPath;

use Zipper;
use Carbon\Carbon;

class MapController extends Controller
{
    //
    protected $link = 'maps-ayokulakan';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Maps");
        $this->setGroup("Maps");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Maps' => '#']);
    }

    public function index()
    {
        return $this->render('frontend.maps.index');
    }

    public function search()
    {
        return $this->render('frontend.maps.search');
    }

    public function mesjid()
    {
        return $this->render('frontend.maps.mesjid');
    }

    public function kakiLima()
    {
        $record = KakiLima::get();
        return $this->render('frontend.maps.kaki-lima',[
            'record' => $record
        ]);
    }

    public function kurir()
    {
        $record = Kurir::get();
        return $this->render('frontend.maps.kurir',[
            'record' => $record
        ]);
    }

    public function cuaca()
    {
        return $this->render('frontend.maps.prakiraan-cuaca');
    }

    public function tanam()
    {
        $path = storage_path() . "/katam.json"; // ie: /var/www/laravel/app/storage/json/filename.json
        $iklim = storage_path() . "/iklim_katam.json"; // ie: /var/www/laravel/app/storage/json/filename.json
        $rawa = storage_path() . "/katam_rawa.json"; // ie: /var/www/laravel/app/storage/json/filename.json
        $alnista = storage_path(). "/alnista_ternak.json";
        $peternakan = storage_path(). "/peternakan.json";

        $json = json_decode(file_get_contents($path), true);
        $json_iklim = json_decode(file_get_contents($iklim), true);
        $json_rawa = json_decode(file_get_contents($rawa), true);
        $json_alnista = json_decode(file_get_contents($alnista), true);
        $json_ternak = json_decode(file_get_contents($peternakan), true);
        // dd($json_ternak[0]['data']);
        // dd($json[0]['wilayah'][0]['nama']);
        // dd(count($json[0]['wilayah']));
        return $this->render('frontend.maps.kalender-tanam',[
            'katam' => $json,
            'iklim_epidemik' => $json_iklim[0]['data'],
            'iklim_kerusakan' => $json_iklim[1]['data'],
            'iklim_rawan' => $json_iklim[2]['data'],
            'iklim_prediksi' => $json_iklim[3]['data'],
            'standcrop' => $json_iklim[4]['data'],
            'iklim_prediksi_parameter' => $json_iklim[5]['data'],
            'rawa' => $json_rawa,
            'alnista' => $json_alnista[0]['data'],
            'alnista_prov' => $json_alnista[1]['data'],
            'alnista_kec' => $json_alnista[2]['data'],
            'gravik' => $json_ternak[0]['data']
        ]);
    }
    public function ikan()
    {
        $url = "https://darilaut.id/";

        $curl = curl_init();
            curl_setopt($curl,CURLOPT_URL, $url);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            $result = curl_exec($curl);
  
  
        $html = file_get_contents($url);
        $xpath = new DOMDocument();
  
        libxml_use_internal_errors(true);
  
        if (!empty($html)) {
            $xpath -> loadHTML($html);
  
            libxml_clear_errors();
            $xpath = new DOMXPath($xpath);
  
            $cari_judul = $xpath -> query('/html/body/div[2]/div[4]/div/div[1]/div/div[2]/div/div[1]/div/div[1]/div[2]/div[1]/article/div[2]/h3/a');
            $isi = $xpath -> query('/html/body/div[2]/div[4]/div/div[1]/div/div[2]/div/div[1]/div/div[1]/div[2]/div[1]/article/div[2]/div[2]/p');
            $category = $xpath -> query('/html/body/div[2]/div[4]/div/div[1]/div/div[2]/div/div[1]/div/div[1]/div[2]/div[1]/article/div[2]/div[1]/div[1]/a');
            $tgl = $xpath -> query('/html/body/div[2]/div[4]/div/div[1]/div/div[2]/div/div[1]/div/div[1]/div[2]/div[1]/article/div[2]/div[1]/div[2]/a');
            $href = $xpath -> query('/html/body/div[2]/div[4]/div/div[1]/div/div[2]/div/div[1]/div/div[1]/div[2]/div[1]/article/div[2]/h3/a/@href');
            $gambar = $xpath -> query('/html/body/div[2]/div[4]/div/div[1]/div/div[2]/div/div[1]/div/div[1]/div[2]/div[1]/article/div[1]/a/div/img/@src');
            }
            $arraySubClass = array();
            
            $jumlah=0;
            foreach ($cari_judul as $value) {
                  $arraySubClass['artikel']['judul'][] = $value->nodeValue;
                  // array_push($arraySubClass,$value->nodeValue);
        
            }
            // $jumlah = count($arraySubClass['artikel']['judul']);
            // dd($jumlah);
  
            foreach ($isi as $value) {
              $arraySubClass['artikel']['isi'][] = $value->nodeValue;
            }
            foreach ($href as $value) {
              $arraySubClass['artikel']['href'][] = $value->nodeValue;
            }
            foreach ($tgl as $value) {
              $arraySubClass['artikel']['tgl'][] = $value->nodeValue;
            }
  
            foreach ($category as $value) {
              $arraySubClass['artikel']['category'][] = $value->nodeValue;
            }
            foreach ($gambar as $value) {
              $arraySubClass['artikel']['gambar'][] = $value->nodeValue;
            }
  
            
  
            // foreach ($gambar as $value) {
            //   preg_match_all('!<img.*?src="(.*?)".alt="'.$value->nodeValue.'"[^\>]+>!',$result,$match);
            //   $arraySubClass['artikel']['gambar'][] = $match[1][1];
            
            //   // $arraySubClass['artikel']['gambar'][] = $value->nodeValue;
            // }
            // dd($arraySubClass['artikel']);
            // end kabar terbaru

            $url2 = "https://www.tempo.co/tag/perikanan";

      $curl2 = curl_init();
          curl_setopt($curl,CURLOPT_URL, $url2);
          curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
          $result2 = curl_exec($curl2);


      $html2 = file_get_contents($url2);
      $xpath2 = new DOMDocument();

      libxml_use_internal_errors(true);

      if (!empty($html2)) {
          $xpath2 -> loadHTML($html2);

          libxml_clear_errors();
          $xpath2 = new DOMXPath($xpath2);

          $judul_pilar = $xpath2 -> query('//*[@class="wrapper"]/li/div/div/a[2]/h2');
          $upload_pilar = $xpath2 -> query('//*[@class="wrapper"]/li/div/div/a[2]/h6');
          $tgl_pilar = $xpath2 -> query('//*[@class="wrapper"]/li/div/div/a[2]/span');
          $href_pilar = $xpath2 -> query('//*[@class="wrapper"]/li/div/div/a[2]/@href');
          $gambar_pilar = $xpath2 -> query('//*[@class="wrapper"]/li/div/div/a[1]/img/@src');
          }
          $pilar_pertanian = array();
          
          $jumlah2=0;
          foreach ($judul_pilar as $value) {
                $pilar_pertanian['pilar']['judul_pilar'][] = $value->nodeValue;
                // array_push($pilar_pertanian,$value->nodeValue);
      
          }
          $jumlah2 = count($pilar_pertanian['pilar']['judul_pilar']);
          

          foreach ($gambar_pilar as $value) {
            $pilar_pertanian['pilar']['gambar_pilar'][] = $value->nodeValue;
          }
          foreach ($upload_pilar as $value) {
            $pilar_pertanian['pilar']['upload_pilar'][] = $value->nodeValue;
          }
          foreach ($tgl_pilar as $value) {
            $pilar_pertanian['pilar']['tgl_pilar'][] = $value->nodeValue;
          }
          foreach ($href_pilar as $value) {
            $pilar_pertanian['pilar']['href_pilar'][] = $value->nodeValue;
          }
          // dd($pilar_pertanian['pilar']);

        $url1 = "https://www.detik.com/tag/kementerian-kelautan-dan-perikanan";

      $curl1 = curl_init();
          curl_setopt($curl,CURLOPT_URL, $url1);
          curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
          $result1 = curl_exec($curl1);


      $html1 = file_get_contents($url1);
      $xpath1 = new DOMDocument();

      libxml_use_internal_errors(true);

      if (!empty($html1)) {
          $xpath1 -> loadHTML($html1);

          libxml_clear_errors();
          $xpath1 = new DOMXPath($xpath1);
          $judul_tani = $xpath1 -> query('/html/body/div[2]/div/div[1]/div[1]/article/a/span[2]/h2');
          $upload = $xpath1 -> query('//*[@id="main"]/div[2]/div/div[2]/div[1]/article/aside/header/a');
          $tgl_tani = $xpath1 -> query('/html/body/div[2]/div/div[1]/div[1]/article/a/span[2]/span/text()');
          $href_tani = $xpath1 -> query('/html/body/div[2]/div/div[1]/div[1]/article/a/@href');
          $gambar_tani = $xpath1 -> query('/html/body/div[2]/div/div[1]/div[1]/article/a/span[1]/span/img/@src');
          }
          $arraySubpos = array();
          
          $jumlah1=0;
          foreach ($judul_tani as $value) {
                $arraySubpos['post_terbaru']['judul_tani'][] = $value->nodeValue;
                // array_push($arraySubpos,$value->nodeValue);
      
          }
          $jumlah1 = count($arraySubpos['post_terbaru']['judul_tani']);
          

          foreach ($gambar_tani as $value) {
            $arraySubpos['post_terbaru']['gambar_tani'][] = $value->nodeValue;
          }
          foreach ($upload as $value) {
            $arraySubpos['post_terbaru']['upload'][] = $value->nodeValue;
          }
          foreach ($tgl_tani as $value) {
            $arraySubpos['post_terbaru']['tgl_tani'][] = $value->nodeValue;
          }
          foreach ($href_tani as $value) {
            $arraySubpos['post_terbaru']['href_tani'][] = $value->nodeValue;
          }
        //   dd($arraySubpos['post_terbaru']);

        $path = storage_path() . "/pencarian_ikan.json"; // ie: /var/www/laravel/app/storage/json/filename.json
        $json = json_decode(file_get_contents($path), true);
        return $this->render('frontend.maps.pencarian-ikan',[
            'ikan' => $json,
            'data' => $arraySubClass['artikel'],
            'pilar' => $pilar_pertanian['pilar'],
            'post_terbaru' => $arraySubpos['post_terbaru']
        ]);
    }

    public function informasi()
    {
      $url = "https://darilaut.id/";

        $curl = curl_init();
            curl_setopt($curl,CURLOPT_URL, $url);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            $result = curl_exec($curl);
  
  
        $html = file_get_contents($url);
        $xpath = new DOMDocument();
  
        libxml_use_internal_errors(true);
  
        if (!empty($html)) {
            $xpath -> loadHTML($html);
  
            libxml_clear_errors();
            $xpath = new DOMXPath($xpath);
  
            $cari_judul = $xpath -> query('/html/body/div[2]/div[4]/div/div[1]/div/div[2]/div/div[1]/div/div[1]/div[2]/div[1]/article/div[2]/h3/a');
            $isi = $xpath -> query('/html/body/div[2]/div[4]/div/div[1]/div/div[2]/div/div[1]/div/div[1]/div[2]/div[1]/article/div[2]/div[2]/p');
            $category = $xpath -> query('/html/body/div[2]/div[4]/div/div[1]/div/div[2]/div/div[1]/div/div[1]/div[2]/div[1]/article/div[2]/div[1]/div[1]/a');
            $tgl = $xpath -> query('/html/body/div[2]/div[4]/div/div[1]/div/div[2]/div/div[1]/div/div[1]/div[2]/div[1]/article/div[2]/div[1]/div[2]/a');
            $href = $xpath -> query('/html/body/div[2]/div[4]/div/div[1]/div/div[2]/div/div[1]/div/div[1]/div[2]/div[1]/article/div[2]/h3/a/@href');
            $gambar = $xpath -> query('/html/body/div[2]/div[4]/div/div[1]/div/div[2]/div/div[1]/div/div[1]/div[2]/div[1]/article/div[1]/a/div/img/@src');
            }
            $arraySubClass = array();
            
            $jumlah=0;
            foreach ($cari_judul as $value) {
                  $arraySubClass['artikel']['judul'][] = $value->nodeValue;
                  // array_push($arraySubClass,$value->nodeValue);
        
            }
            // $jumlah = count($arraySubClass['artikel']['judul']);
            // dd($jumlah);
  
            foreach ($isi as $value) {
              $arraySubClass['artikel']['isi'][] = $value->nodeValue;
            }
            foreach ($href as $value) {
              $arraySubClass['artikel']['href'][] = $value->nodeValue;
            }
            foreach ($tgl as $value) {
              $arraySubClass['artikel']['tgl'][] = $value->nodeValue;
            }
  
            foreach ($category as $value) {
              $arraySubClass['artikel']['category'][] = $value->nodeValue;
            }
            foreach ($gambar as $value) {
              $arraySubClass['artikel']['gambar'][] = $value->nodeValue;
            }
  
            
  
            // foreach ($gambar as $value) {
            //   preg_match_all('!<img.*?src="(.*?)".alt="'.$value->nodeValue.'"[^\>]+>!',$result,$match);
            //   $arraySubClass['artikel']['gambar'][] = $match[1][1];
            
            //   // $arraySubClass['artikel']['gambar'][] = $value->nodeValue;
            // }
            // dd($arraySubClass['artikel']);
            // end kabar terbaru

            $url2 = "https://www.sindonews.com/topic/181/kementerian-kelautan-dan-perikanan-kkp";

      $curl2 = curl_init();
          curl_setopt($curl,CURLOPT_URL, $url2);
          curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
          $result2 = curl_exec($curl2);


      $html2 = file_get_contents($url2);
      $xpath2 = new DOMDocument();

      libxml_use_internal_errors(true);

      if (!empty($html2)) {
          $xpath2 -> loadHTML($html2);

          libxml_clear_errors();
          $xpath2 = new DOMXPath($xpath2);

          $judul_pilar = $xpath2 -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[2]/a');
          $upload_pilar = $xpath2 -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[1]/div[1]');
          $tgl_pilar = $xpath2 -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[1]/div[2]');
          $href_pilar = $xpath2 -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[2]/a/@href');
          $gambar_pilar = $xpath2 -> query('/html/body/section/div[5]/div[1]/ul/li/div[1]/a/img/@src');
          }
          $pilar_pertanian = array();
          
          $jumlah2=0;
          foreach ($judul_pilar as $value) {
                $pilar_pertanian['pilar']['judul_pilar'][] = $value->nodeValue;
                // array_push($pilar_pertanian,$value->nodeValue);
      
          }
          $jumlah2 = count($pilar_pertanian['pilar']['judul_pilar']);
          

          foreach ($gambar_pilar as $value) {
            $pilar_pertanian['pilar']['gambar_pilar'][] = $value->nodeValue;
          }
          foreach ($upload_pilar as $value) {
            $pilar_pertanian['pilar']['upload_pilar'][] = $value->nodeValue;
          }
          foreach ($tgl_pilar as $value) {
            $pilar_pertanian['pilar']['tgl_pilar'][] = $value->nodeValue;
          }
          foreach ($href_pilar as $value) {
            $pilar_pertanian['pilar']['href_pilar'][] = $value->nodeValue;
          }
          // dd($pilar_pertanian['pilar']);

        $url1 = "https://www.detik.com/tag/kementerian-kelautan-dan-perikanan";

      $curl1 = curl_init();
          curl_setopt($curl,CURLOPT_URL, $url1);
          curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
          $result1 = curl_exec($curl1);


      $html1 = file_get_contents($url1);
      $xpath1 = new DOMDocument();

      libxml_use_internal_errors(true);

      if (!empty($html1)) {
          $xpath1 -> loadHTML($html1);

          libxml_clear_errors();
          $xpath1 = new DOMXPath($xpath1);
          $judul_tani = $xpath1 -> query('/html/body/div[2]/div/div[1]/div[1]/article/a/span[2]/h2');
          $upload = $xpath1 -> query('//*[@id="main"]/div[2]/div/div[2]/div[1]/article/aside/header/a');
          $tgl_tani = $xpath1 -> query('/html/body/div[2]/div/div[1]/div[1]/article/a/span[2]/span/text()');
          $href_tani = $xpath1 -> query('/html/body/div[2]/div/div[1]/div[1]/article/a/@href');
          $gambar_tani = $xpath1 -> query('/html/body/div[2]/div/div[1]/div[1]/article/a/span[1]/span/img/@src');
          }
          $arraySubpos = array();
          
          $jumlah1=0;
          foreach ($judul_tani as $value) {
                $arraySubpos['post_terbaru']['judul_tani'][] = $value->nodeValue;
                // array_push($arraySubpos,$value->nodeValue);
      
          }
          $jumlah1 = count($arraySubpos['post_terbaru']['judul_tani']);
          

          foreach ($gambar_tani as $value) {
            $arraySubpos['post_terbaru']['gambar_tani'][] = $value->nodeValue;
          }
          foreach ($upload as $value) {
            $arraySubpos['post_terbaru']['upload'][] = $value->nodeValue;
          }
          foreach ($tgl_tani as $value) {
            $arraySubpos['post_terbaru']['tgl_tani'][] = $value->nodeValue;
          }
          foreach ($href_tani as $value) {
            $arraySubpos['post_terbaru']['href_tani'][] = $value->nodeValue;
          }
        //   dd($arraySubpos['post_terbaru']);

        $path = storage_path() . "/pencarian_ikan.json"; // ie: /var/www/laravel/app/storage/json/filename.json
        $json = json_decode(file_get_contents($path), true);
        return $this->render('frontend.maps.informasi-ikan',[
            'ikan' => $json,
            'data' => $arraySubClass['artikel'],
            'pilar' => $pilar_pertanian['pilar'],
            'post_terbaru' => $arraySubpos['post_terbaru']
        ]);
    }

    public function bacaIkan(Request $request)
    {
      // dd($request->all());
      $arraySubClass = array();
      // dd($request->href);
      if($request->jenis=="pilar"){
        // $url = "https:".$request->href;
        // $pisah = explode(".",);
        // dd($pisah[0]);
      $html = file_get_contents($request->href);
      $xpath = new DOMDocument();

      libxml_use_internal_errors(true);

      if (!empty($html)) {
          $xpath -> loadHTML($html);

          libxml_clear_errors();
          $xpath = new DOMXPath($xpath);
          
            // $penulis = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/div[1]/p/span/a');
            $isi = $xpath -> query('//*[@id="content"]/text()');
            // $category = $xpath -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[1]/div[1]');
            // $tgl = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/time');
            // $href = $xpath -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[2]/a/@href');
            $gambar = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/figure/img/@src');
          
          
          }
          foreach ($gambar as $value) {
            $arraySubClass['artikel']['gambar'][] = $value->nodeValue;
          }

          foreach ($isi as $value) {
            $arraySubClass['artikel']['isi'][] = $value->nodeValue;
          }
          
          // dd($arraySubClass['artikel']);
          // end kabar terbaru
      } else if ($request->jenis=="sindo") {
        // dd($request->href);
        $html = file_get_contents($request->href);
      $xpath = new DOMDocument();

      libxml_use_internal_errors(true);

      if (!empty($html)) {
          $xpath -> loadHTML($html);

          libxml_clear_errors();
          $xpath = new DOMXPath($xpath);

          // $penulis = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/div[1]/p/span/a');
          $isi = $xpath -> query('/html/body/div[2]/div[4]/div[1]/div[1]/div/div/div/div[2]/div[1]/div/div[6]/div[2]/p');
          // $category = $xpath -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[1]/div[1]');
          // $tgl = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/time');
          // $href = $xpath -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[2]/a/@href');
          $gambar = $xpath -> query('/html/body/div[2]/div[4]/div[1]/div[1]/div/div/div/div[2]/div[1]/div/div[3]/a/div/img/@src');
          }
          
          foreach ($gambar as $value) {
            $arraySubClass['artikel']['gambar'][] = $value->nodeValue;
          }
          foreach ($isi as $value) {
            $arraySubClass['artikel']['isi'][] = $value->nodeValue;
          }
          
          // dd($arraySubClass['artikel']);
          // end kabar terbaru
      } else {
        $html = file_get_contents($request->href);
      $xpath = new DOMDocument();

      libxml_use_internal_errors(true);

      if (!empty($html)) {
          $xpath -> loadHTML($html);

          libxml_clear_errors();
          $xpath = new DOMXPath($xpath);
          $pisah = explode(".",$request->href);
          // dd($pisah);
          if($pisah[0]=="https://finance"){
            
            // $penulis = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/div[1]/p/span/a');
            $isi = $xpath -> query('/html/body/div[5]/div[2]/div[1]/article/div[4]/div[1]/p');
            // $category = $xpath -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[1]/div[1]');
            // $tgl = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/time');
            // $href = $xpath -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[2]/a/@href');
            $gambar = $xpath -> query('/html/body/div[5]/div[2]/div[1]/article/div[2]/figure/img/@src');
          } else if ($pisah[0]=="https://news"){
            // $penulis = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/div[1]/p/span/a');
            $isi = $xpath -> query('/html/body/div[3]/div[2]/div[1]/article/div[3]/div[1]/p');
            // $category = $xpath -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[1]/div[1]');
            // $tgl = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/time');
            // $href = $xpath -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[2]/a/@href');
            $gambar = $xpath -> query('/html/body/div[3]/div[2]/div[1]/article/div[2]/figure/img/@src');
          }
          else {
            // $penulis = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/div[1]/p/span/a');
            $isi = $xpath -> query('/html/body/div[5]/div[2]/div[1]/article/div[3]/div[1]/p');
            // $category = $xpath -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[1]/div[1]');
            // $tgl = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/time');
            // $href = $xpath -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[2]/a/@href');
            $gambar = $xpath -> query('/html/body/div[5]/div[2]/div[1]/article/div[2]/figure/img/@src');
          }
          
          }
          
          foreach ($gambar as $value) {
            $arraySubClass['artikel']['gambar'][] = $value->nodeValue;
          }
          foreach ($isi as $value) {
            $arraySubClass['artikel']['isi'][] = $value->nodeValue;
          }
          
          // dd($arraySubClass['artikel']);
          // end kabar terbaru
      }
      return $this->render('frontend.maps.baca-ikan', [
        'mockup' => false,
        'data' => $arraySubClass['artikel'],
        'request' => $request,
        // 'jumlah' => $jumlah
      ]);
    }

    public function notFoundPage()
    {
        return $this->render('failed.page', ['mockup' => false]);
    }
}
