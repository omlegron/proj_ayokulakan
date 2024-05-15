<?php

namespace App\Http\Controllers\FrontEnd\KabarTerbaru;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Berita\Berita;
use DOMDocument;
use DOMXPath;


use App\Models\User;

use Zipper;
use Carbon\Carbon;
class KabarTerbaruController extends Controller
{
    //
    protected $link = 'kabar-terbaru/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Kabar Terbaru");
        $this->setGroup("Kabar Terbaru");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Kabar Terbaru' => '#']);
    }

    function getString($teks,$sebelum,$sesudah){
      $teks = ' '.$teks;
      $ini = strpos($teks,$sebelum);
      if($ini==0) return '';
      $ini += strlen($sebelum);
    }

    public function index(Request $request)
    {
      // kabar terbaru
      $url = "https://www.jpnn.com/tag/pertanian";

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

          $cari_judul = $xpath->query('//*[@class="content-list"]/li/div[2]/div/h1/a');
          $isi = $xpath -> query('//*[@class="content-list"]/li/div[2]/div/p');
          $category = $xpath -> query('//*[@class="content-list"]/li/div[2]/div/h6/a/strong');
          $tgl = $xpath -> query('//*[@class="content-list"]/li/div[2]/div/h6/a/span');
          $href = $xpath -> query('//*[@class="content-list"]/li/div[2]/div/h1/a/@href');
          $gambar = $xpath -> query('//*[@class="content-list"]/li/div[1]/a/img/@src');
          }
          $arraySubClass = array();
          
          $jumlah=0;
          foreach ($cari_judul as $value) {
                $arraySubClass['artikel']['judul'][] = $value->nodeValue;
                // array_push($arraySubClass,$value->nodeValue);
      
          }
          $jumlah = count($arraySubClass['artikel']['judul']);
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

          $url1 = "https://sariagri.id/pertanian";

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

          $judul_tani = $xpath1 -> query('//*[@id="box_lnews"]/li/div[2]/h2/a');
          $upload = $xpath1 -> query('//*[@id="box_lnews"]/li/div[2]/h4/a');
          $tgl_tani = $xpath1 -> query('//*[@id="box_lnews"]/li/div[2]/h4/span/text()');
          $href_tani = $xpath1 -> query('//*[@id="box_lnews"]/li/div[2]/h2/a/@href');
          $gambar_tani = $xpath1 -> query('//*[@id="box_lnews"]/li[1]/div[1]/a/img/@src');
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

          $url2 = "https://pilarpertanian.com/";

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

          $judul_pilar = $xpath2 -> query('//*[@id="main"]/div/div/div/div[1]/article/div/div[2]/h2/a');
          $upload_pilar = $xpath2 -> query('//*[@id="main"]/div/div/div/div[1]/article/div/div[1]/div/ul/li/a');
          $tgl_pilar = $xpath2 -> query('//*[@id="main"]/div/div/div/div[1]/article/div/div[2]/div');
          $href_pilar = $xpath2 -> query('//*[@id="main"]/div/div/div/div[1]/article/div/div[2]/h2/a/@href');
          $gambar_pilar = $xpath2 -> query('//*[@id="main"]/div/div/div/div[1]/article/div/div[1]/a/img/@src');
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
          $record = Berita::orderBy('created_at','desc')->paginate(5);
          $diskon = Berita::where('kategori','Diskon')->orderBy('created_at','desc')->limit(10)->get();
          $promo = Berita::where('kategori','Promosi')->orderBy('created_at','desc')->limit(10)->get();

          return $this->render('frontend.kabar-terbaru.index', [
            'mockup' => false,
            'jumlah' => $jumlah,
            'jumlah1' => $jumlah1,
            'record' => $record,
            'data' => $arraySubClass['artikel'],
            'pilar' => $pilar_pertanian['pilar'],
            'post_terbaru' => $arraySubpos['post_terbaru'],
            'diskon' => $diskon,
            'promo' => $promo,
          ]);

    }

    public function baca_berita(Request $request){
      $arraySubClass = array();
      // dd($request->href);
      if($request->jenis=="pilar"){
        
      $html = file_get_contents($request->href);
      $xpath = new DOMDocument();

      libxml_use_internal_errors(true);

      if (!empty($html)) {
          $xpath -> loadHTML($html);

          libxml_clear_errors();
          $xpath = new DOMXPath($xpath);

          // $penulis = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/div[1]/p/span/a');
          $isi = $xpath -> query('//*[@id="main"]/div/div/div/div[1]/article/div[3]/p');
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
      } else if ($request->jenis=="sindo") {
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
      } else {
        $html = file_get_contents($request->href);
      $xpath = new DOMDocument();

      libxml_use_internal_errors(true);

      if (!empty($html)) {
          $xpath -> loadHTML($html);

          libxml_clear_errors();
          $xpath = new DOMXPath($xpath);

          // $penulis = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/div[1]/p/span/a');
          $isi = $xpath -> query('/html/body/main/div[1]/div/div/aside[1]/article/div[2]/p');
          // $category = $xpath -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[1]/div[1]');
          // $tgl = $xpath -> query('/html/body/div[2]/div[8]/div[1]/div[2]/div[1]/time');
          // $href = $xpath -> query('/html/body/section/div[5]/div[1]/ul/li/div[2]/div[2]/a/@href');
          $gambar = $xpath -> query('/html/body/main/div[1]/div/div/aside[1]/article/figure/img/@src');
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
      return $this->render('frontend.kabar-terbaru.baca-berita', [
        'mockup' => false,
        'data' => $arraySubClass['artikel'],
        'request' => $request,
        // 'jumlah' => $jumlah
      ]);
    }

    public function show(Request $request, $id, $name){
      $record = Berita::find($id);
      $diskon = Berita::where('kategori','Diskon')->orderBy('created_at','desc')->limit(5)->get();
      $promo = Berita::where('kategori','Promosi')->orderBy('created_at','desc')->limit(5)->get();

      return $this->render('frontend.kabar-terbaru.show', [
        'mockup' => false,
        'record' => $record,
        'diskon' => $diskon,
        'promo' => $promo,
      ]);
    }
    public function sortajax(Request $request){
      $kabar = $request->kabar;
      if ($kabar != '') {
        $record = Berita::where('kategori',$kabar)
        ->orWhere('kategori',$kabar)
        ->orderBy('created_at','asc')
        ->paginate(5);
      }

      return $this->render('frontend.kabar-terbaru.showajax', [
        'mockup' => false,
        'records' => $record,
        'request' => $request,
        'kabar' => $kabar,
      ]);
    }
    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}
