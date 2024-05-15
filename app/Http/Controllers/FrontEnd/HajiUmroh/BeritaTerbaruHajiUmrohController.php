<?php

namespace App\Http\Controllers\FrontEnd\HajiUmroh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HajiUmroh\BeritaTerbaru;
use DOMXPath;
use DOMDocument;

use App\Models\User;

use Zipper;
use Carbon\Carbon;
class BeritaTerbaruHajiUmrohController extends Controller
{
    //
    protected $link = 'berita-terbaru/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Berita Terbaru");
        $this->setGroup("Berita Terbaru");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Berita Terbaru' => '#']);
    }

    public function index()
    {
        $url = "https://republika.co.id/tag/haji";

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
          $cari_judul = $xpath -> query('//*[@id="wrapper"]/div[2]/div/div[2]/div[2]/div/div/div/div/div[2]/h2');
          $isi = $xpath -> query('/html/body/div[4]/div[2]/div/div[2]/div[2]/div/div/div/div[3]/div[2]/h6[2]/p[2]');
        //   $category = $xpath -> query('//*[@id="page-top"]/section/div/div/div[1]/div[1]/article/div[2]/div[1]/a/span');
          $tgl = $xpath -> query('//*[@id="wrapper"]/div[2]/div/div[2]/div[2]/div/div/div/div/div[2]/h6[1]');
          $href = $xpath -> query('//*[@id="wrapper"]/div[2]/div/div[2]/div[2]/div/div/div/div/div[2]/h2/a/@href');
          $gambar = $xpath -> query('//*[@id="wrapper"]/div[2]/div/div[2]/div[2]/div/div/div/div/div[1]/div/img/@src');
        //   $gambar_topic = $xpath -> query('//*[@id="wrapper"]/div[2]/div/em/div[1]/div[2]/div[1]/div[3]/div[1]');
          }
        //   dd($gambar_topic);
          $arraySubClass = array();
          $hot_topic = array();
          
          $jumlah=0;
          foreach ($cari_judul as $value) {
                $arraySubClass['haji']['judul'][] = $value->nodeValue;
                // array_push($arraySubClass,$value->nodeValue);
      
          }
          $jumlah = count($arraySubClass['haji']['judul']);
          // dd($jumlah);

          foreach ($isi as $value) {
            $arraySubClass['haji']['isi'][] = $value->nodeValue;
          }
          foreach ($href as $value) {
            $arraySubClass['haji']['href'][] = $value->nodeValue;
          }
          foreach ($tgl as $value) {
            $arraySubClass['haji']['tgl'][] = $value->nodeValue;
          }
          foreach ($gambar as $value) {
            $arraySubClass['haji']['gambar'][] = $value->nodeValue;
          }
        //   foreach ($gambar_topic as $value) {
        //     $hot_topic['topic']['gambar_topic'][] = $value->nodeValue;
        //   }
        //   dd($arraySubClass['haji']);
        //   dd($hot_topic['topic']);

        $url1 = "https://republika.co.id/kanal/islam-digest";

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
          $judul_tani = $xpath1 -> query('//*[@id="wrapper"]/div[2]/div[1]/div[2]/div[3]/div[2]/div[1]/div[4]/div/div/div[2]/div[1]/h2/a');
          $upload = $xpath1 -> query('//*[@id="wrapper"]/div[2]/div[1]/div[2]/div[3]/div[2]/div[1]/div[4]/div/div/div[2]/div[1]/h1/a/p');
          $tgl_tani = $xpath1 -> query('//*[@id="wrapper"]/div[2]/div[1]/div[2]/div[3]/div[2]/div[1]/div[4]/div/div/div[2]/div[1]/div[3]');
          $href_tani = $xpath1 -> query('//*[@id="wrapper"]/div[2]/div[1]/div[2]/div[3]/div[2]/div[1]/div[4]/div/div/div[2]/div[1]/h2/a/@href');
          $gambar_tani = $xpath1 -> query('//*[@id="wrapper"]/div[2]/div[1]/div[2]/div[3]/div[2]/div[1]/div[4]/div/div/div[1]/img/@src');
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
          // dd($arraySubpos['post_terbaru']);
          

        $record = BeritaTerbaru::orderBy('created_at','desc')->paginate(5);

        return $this->render('frontend.berita-terbaru-haji-umroh.index', [
        'mockup' => false,
        'jumlah' => $jumlah,
        'haji' => $arraySubClass['haji'],
        'post_terbaru' => $arraySubpos['post_terbaru'],
        'record' => $record,
        ]);

    }

    public function bacaHaji(Request $request)
    {
      $arraySubClass = array();
      // dd($request->href);
      if($request->jenis=="ihram"){
        
      $html = file_get_contents($request->href);
      $xpath = new DOMDocument();

      libxml_use_internal_errors(true);

      if (!empty($html)) {
          $xpath -> loadHTML($html);

          libxml_clear_errors();
          $xpath = new DOMXPath($xpath);

          // $penulis = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/div[1]/p/span/a');
          $isi = $xpath -> query('/html/body/div[1]/div[7]/div/div/div[1]/div[3]/p');
          // $category = $xpath -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[1]/div[1]');
          // $tgl = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/time');
          // $href = $xpath -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[2]/a/@href');
          $gambar = $xpath -> query('//*[@id="main"]/div/div/div/div[1]/article/div[1]/a/img/@src');
          }
          foreach ($gambar as $value) {
            $arraySubClass['artikel']['gambar'][] = $value->nodeValue;
          }

          foreach ($isi as $value) {
            $arraySubClass['artikel']['isi'][] = $value->nodeValue;
          }
          
          // dd($arraySubClass['artikel']);
          // end kabar terbaru
      }else {
        $html = file_get_contents($request->href);
      $xpath = new DOMDocument();

      libxml_use_internal_errors(true);

      if (!empty($html)) {
          $xpath -> loadHTML($html);

          libxml_clear_errors();
          $xpath = new DOMXPath($xpath);

          // $penulis = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/div[1]/p/span/a');
          $isi = $xpath -> query('//*[@id="wrapper"]/div[2]/div[1]/div[2]/div[1]/div/div[2]/div[2]/div[1]/div[3]/div/p/text()');
          // $category = $xpath -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[1]/div[1]');
          // $tgl = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/time');
          // $href = $xpath -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[2]/a/@href');
          $gambar = $xpath -> query('//*[@id="wrapper"]/div[2]/div[1]/div[2]/div[1]/div/div[2]/div[2]/div[1]/div[1]/img/@src');
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
      // dd($request->all());
      return $this->render('frontend.berita-terbaru-haji-umroh.baca-haji', [
        'mockup' => false,
        'data' => $arraySubClass['artikel'],
        'request'=> $request
        ]);
    }

    public function show(Request $request, $id){
        return $this->render('frontend.berita-terbaru-haji-umroh.show', [
        'mockup' => false,
        'record' => BeritaTerbaru::find($id)
        ]);
    }
    public function beritaajax(Request $request){
        $berita = $request->berita;
        $record = BeritaTerbaru::orderBy('created_at',$berita)->paginate(50);
        return $this->render('frontend.berita-terbaru-haji-umroh.berita-ajax', [
            'mockup' => false,
            'record' => $record,
            'request' => $request,
        ]);
    }
    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}
