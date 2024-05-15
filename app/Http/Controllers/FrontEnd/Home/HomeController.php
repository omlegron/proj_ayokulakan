<?php

namespace App\Http\Controllers\FrontEnd\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Berita\Berita;
use App\Models\Barang\LapakBarang;
use App\Models\Master\KategoriBarang;
use App\Models\Master\KategoriBarangSub;
use App\Models\Master\KategoriRental;
use App\Models\Master\PPOBPulsaProvider;
use App\Models\Master\KategoriRentalSub;
use App\Models\Master\KategoriStore;
use App\Models\User;
use App\Helpers\HelpersPPOB;
use App\Helpers\HelpersTiketPesawat;

use Zipper;
use Carbon\Carbon;
use App\Models\TransaksiAmpas\TransaksiAmpase;
class HomeController extends Controller
{
    //
    protected $link = 'fbarang/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Home");
        $this->setGroup("Home");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Home' => '#']);
    }

    public function index()
    {
      // dd(env('GOOGLE_CLIENT_ID'));
      // dd(env('MIDTRANS_CLIENTKEY'));
      // dump(asset('storage'));
      // dump(asset('/'));
      // dd(asset(''));
        // dd(HelpersTiketPesawat::TiketGetKabKot(12));
          // dd(HelpersPPOB::checkBooking('304'));
          // dd(HelpersPPOB::bookingAccept('306'));
          // dd(TransaksiAmpase::with('kereta')->get());
          $user = User::where('nama','ayokulakan')->first();
          $kategoriBarangPertanian = KategoriBarang::where('kat_nama','LIKE' , '%Pertanian%')->first();
          $kategoriBarangPerkebunan = KategoriBarang::where('kat_nama','LIKE' , '%Perkebunan%')->first();
          $kategoriBarangPerikanan= KategoriBarang::where('kat_nama','LIKE' , '%Perikanan%')->first();
          $kategoriBarangPeternakan= KategoriBarang::where('kat_nama','LIKE' , '%Peternakan%')->first();
          $kategoriBarangUkm= KategoriBarang::where('kat_nama','LIKE' , '%UKM%')->first();
          // dd($kategoriBarangPerkebunan->id);
          $perikanan = [];
          $pertanianPerkebunan = [];
          if($kategoriBarangPerikanan){
            $pertanianPerkebunan = LapakBarang::with('kategoriBarang')->whereIn('id_kategori',[$kategoriBarangPertanian->id,$kategoriBarangPerkebunan->id])->limit(24)->get();
            $pertaianOrganik = LapakBarang::with('kategoriBarang')->whereIn('id_kategori',[
              $kategoriBarangPertanian->id,$kategoriBarangPerkebunan->id
            ])->where('nama_barang','LIKE' , '%organik%')->inRandomOrder()->limit(24)->get();
            $perikanan = LapakBarang::with('kategoriBarang','feedback')->inRandomOrder()->limit(5)->get();
            $perikananPeternakan = LapakBarang::with('kategoriBarang')->whereIn('id_kategori',[$kategoriBarangPerikanan->id, $kategoriBarangPeternakan->id])->inRandomOrder()->limit(24)->get();
            $ukm = LapakBarang::with('kategoriBarang')->where('id_kategori',$kategoriBarangUkm->id)->inRandomOrder()->limit(24)->get();
          }
          $date = Carbon::now();
          // $lapakBaru = LapakBarang::with('kategoriBarang','lapak')->whereHas('lapak',function($q) use($date){
          //   $q->whereMonth('created_at',$date->format('m'))->whereYear('created_at',$date->format('Y'));
          // })->get();
          $all = LapakBarang::with('kategoriBarang','lapak')->orderBy('created_at','desc')->limit(24)->get();
          $kategoriRental = KategoriRental::get();
          $subkategori = KategoriBarangSub::get();
          $ppobGame = PPOBPulsaProvider::where('type','game')->get();
          $iklanDisc = Berita::whereIn('kategori',['Diskon','Iklan'])->get();
          $populer = LapakBarang::with('kategoriBarang','feedback')->where('id_kategori',$kategoriBarangPertanian->id)->inRandomOrder()->limit(4)->get();
          $discount = LapakBarang::with('kategoriBarang','feedback')->where('id_kategori',$kategoriBarangPerkebunan->id)->inRandomOrder()->limit(5)->get();
          $populer = LapakBarang::with('kategoriBarang','feedback')->where('id_kategori',$kategoriBarangPertanian->id)->inRandomOrder()->limit(5)->get();
          $discount = LapakBarang::with('kategoriBarang','feedback')->where('id_kategori',$kategoriBarangPerkebunan->id)->inRandomOrder()->limit(8)->get();

          return $this->render('frontend.home.index', [
            'mockup' => false,
            'record' => Berita::where('kategori',['Slider','Berita'])->limit(20)->get(),
            'pertanianPerkebunan' => $pertanianPerkebunan,
            'perikananPeternakan' => $perikananPeternakan,
            'pertaianOrganik'     => $pertaianOrganik,
            'ukm'                 => $ukm,
            'perikanan'           => $perikanan,
            'populer'             => $populer,
            'discount'            => $discount,
            'iklanDisc'           => $iklanDisc,
            'kategoriRental'      => $kategoriRental,
            'subkategori'         => $subkategori,
            'all'                 => $all,
            'ppobGame'            => $ppobGame,
          ]);

    }

    public function show(Request $request, $id, $name){
      // dd(LapakBarang::find($id)->feedback()->where('form_type','=','img_barang')->get());
      return $this->render('frontend.home.show', [
        'mockup' => false,
        'record' => LapakBarang::find($id),
      ]);
    }
    public function ajkategori($id)
    {
      $record = KategoriBarangSub::with('kategori')->where('id_kategori', $id)->get();
      return $this->render('frontend.home.kategori', [
        'mockup' => false,
        'record' => $record,
      ]);
    }
    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }

}
