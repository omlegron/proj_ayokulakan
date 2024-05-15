<?php

namespace App\Http\Controllers\FrontEnd\Searching;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lapak\Lapak;
use App\Models\Barang\LapakBarang;
use Unlu\Laravel\Api\QueryBuilder;
use App\Models\Chat\ChatRoom;
use App\Models\Rental\Rental;
use App\Models\Master\KategoriRental;
use App\Models\Master\WilayahKota;
use App\Models\Attachments;
use App\Models\User;
use DB;
use Zipper;
use Carbon\Carbon;
class SearchingController extends Controller
{
    //
    protected $link = 'sc/barang/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Barang");
        $this->setGroup("Barang");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Barang' => '#']);
    }

    public function index(Request $request)
    {     
        $input = $request->input('search_ampas');
        $record = LapakBarang::join('ref_kategori_barang','ref_kategori_barang.id','trans_lapak_barang.id_kategori')
                                ->join('ref_kategori_barang_sub','ref_kategori_barang_sub.id','trans_lapak_barang.id_sub_kategori');
                    // dd($record->where('nama_barang','Buah Naga Mantap'));
        $serch = $request->search_ampas;
        if($serch){
            // $this->setBreadcrumb(['Barang' => '#', ''.$request->search_ampas.'' => '#' ]);
            $record->where('nama_barang','like', '%'.$serch.'%')
                    ->orWhere('kat_nama','like', '%'.$serch.'%')
                    ->orWhere('sub_nama','like', '%'.$serch.'%')
                    ->select(['trans_lapak_barang.*','ref_kategori_barang.kat_nama','ref_kategori_barang_sub.sub_nama']);
                    // ->orWhere('nama','like', '%'.$request->search_ampas.'%');
        }
        
        // for sewa
        $record = $record->paginate(20);

        $recordRental = Rental::select('*');
        if($request->search_ampas){
            $recordRental->where('judul','like', '%'.$request->search_ampas.'%');
        }
        $recordRental = $recordRental->paginate(20);
        return $this->render('frontend.searching.index', [
            'mockup' => false,
            'input' => $input,
            'record' => $record,
            'recordRental' => $recordRental,
            'search' => $request->search_ampas,
        ]);

    }
    public function ajcat(Request $request)
    {
         $record = LapakBarang::join('ref_kategori_barang','ref_kategori_barang.id','trans_lapak_barang.id_kategori')
                               ->join('ref_kategori_barang_sub','ref_kategori_barang_sub.id','trans_lapak_barang.id_sub_kategori');
        // $cat = $request->search_ampas;
        $cat = $request->categ;
        $harga = $request->subtotal;
         if ($cat != '') {
            $record->where('nama_barang',$request->categ)
             ->orWhere('kat_nama',$request->categ)
             ->orWhere('sub_nama',$request->categ)
             ->orderBy($harga,$request->terendah)
             ->select(['trans_lapak_barang.*','ref_kategori_barang.kat_nama','ref_kategori_barang_sub.sub_nama']);
         }elseif ($cat = '') {
            $record->where('nama_barang',$request->kon)
            ->orWhere('kondisi_barang',$request->terendah)
             ->orWhere('kat_nama',$request->kon)
             ->orWhere('sub_nama',$request->kon)
             ->select(['trans_lapak_barang.*','ref_kategori_barang.kat_nama','ref_kategori_barang_sub.sub_nama']);
         }
        //  if($cat){
        //     if(strlen($cat) == 13){
        //         $record->orderBy(substr($harga,0,12),$request->rendah);
        //     }else{
        //         $record->orderBy($harga,$request->rendah);
        //     }
        // }
         $record = $record->paginate(50);
         return $this->render('frontend.searching.show-search-ajax', [
             'mockup' => false,
             'record' => $record,
             'search' => $request->categ,
             'request' => $request,
         ]);
    }
    public function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $record = LapakBarang::join('ref_kategori_barang','ref_kategori_barang.id','trans_lapak_barang.id_kategori')
            ->join('ref_kategori_barang_sub','ref_kategori_barang_sub.id','trans_lapak_barang.id_sub_kategori')
            ->select(['trans_lapak_barang.*','ref_kategori_barang.kat_nama','ref_kategori_barang_sub.sub_nama']);
            $record = $record->paginate(50);
        }
            return $this->render('frontend.searching.show-search-ajax', [
            'mockup' => false,
            'record' => $record,
            // 'search' => $request->categ,
            'request' => $request,
        ]);
    }
    public function ajIndex(Request $request)
    {  
        $record = LapakBarang::select('*');
        if($request->search_ampas){
            $record->where('nama_barang','like', '%'.$request->search_ampas.'%');
        }
        
        if($request->ampasCategories == 'kategori'){
            $record->where('id_kategori',$request->ampasId);
            
            
        }

        if($request->ampasCategories == 'sub_kategori'){
            $record->where('id_kategori',$request->ampasId);
        }

        if($request->ampasCategories == 'child_kategori'){
            $record->where('id_kategori',$request->ampasId);
        }

        if(isset($request->ampasKondisi)){
            if(count($request->ampasKondisi) == 1){
                $record->where('kondisi_barang',$request->ampasKondisi[0]);
            }
        }


        // dd($request->currentLoca);
        if(isset($request->currentLoca)){
            $wilKot = WilayahKota::where('kota','like', '%'.$request->currentLoca.'%')->first();
            if($wilKot){
                $record->whereHas('lapak', function($q) use($wilKot){ 
                    $q->where('id_kota',$wilKot->id);
                }); 
            }
        }else{
            if(isset($request->ampasWilayah['ampasProvinsi'])){
                if($request->ampasWilayah['ampasProvinsi'] != 'Current_Location'){
                    $record->whereHas('lapak', function($q) use($request){ 
                        $q->where('id_provinsi',$request->ampasWilayah['ampasProvinsi']);
                    });
                }
            }
        }

        if(isset($request->ampasWilayah['ampasKot'])){
            $record->whereHas('lapak', function($q) use($request){ 
                $q->where('id_kota',$request->ampasWilayah['ampasKot']);
            });
        }


        if($request->ampasHarga){
            $harga_barang = str_replace(".", "", $request->ampasHarga['ampasUang']);
            $record->whereRaw('harga_barang '.$request->ampasHarga['ampasHargaKondisi'].''.(float)$harga_barang);
        }

        if($request->ampasOrder){
            if(strlen($request->ampasOrder) == 13){
                $record->orderBy(substr($request->ampasOrder,0,12),$request->ampasOrderVal);
            }else{
                $record->orderBy($request->ampasOrder,$request->ampasOrderVal);
            }
        }
        if ($request->ajax()) {
            if($request->search_ampas){
                $record->where('nama_barang','like', '%'.$request->search_ampas.'%');
            }
            
            if($request->ampasCategories == 'kategori'){
                $record->where('id_kategori',$request->ampasId);
                
                
            }
    
            if($request->ampasCategories == 'sub_kategori'){
                $record->where('id_kategori',$request->ampasId);
            }
    
            if($request->ampasCategories == 'child_kategori'){
                $record->where('id_kategori',$request->ampasId);
            }
    
            if(isset($request->ampasKondisi)){
                if(count($request->ampasKondisi) == 1){
                    $record->where('kondisi_barang',$request->ampasKondisi[0]);
                }
            }
    
    
            // dd($request->currentLoca);
            if(isset($request->currentLoca)){
                $wilKot = WilayahKota::where('kota','like', '%'.$request->currentLoca.'%')->first();
                if($wilKot){
                    $record->whereHas('lapak', function($q) use($wilKot){ 
                        $q->where('id_kota',$wilKot->id);
                    }); 
                }
            }else{
                if(isset($request->ampasWilayah['ampasProvinsi'])){
                    if($request->ampasWilayah['ampasProvinsi'] != 'Current_Location'){
                        $record->whereHas('lapak', function($q) use($request){ 
                            $q->where('id_provinsi',$request->ampasWilayah['ampasProvinsi']);
                        });
                    }
                }
            }
    
            if(isset($request->ampasWilayah['ampasKot'])){
                $record->whereHas('lapak', function($q) use($request){ 
                    $q->where('id_kota',$request->ampasWilayah['ampasKot']);
                });
            }
    
    
            if($request->ampasHarga){
                $harga_barang = str_replace(".", "", $request->ampasHarga['ampasUang']);
                $record->whereRaw('harga_barang '.$request->ampasHarga['ampasHargaKondisi'].''.(float)$harga_barang);
            }
    
            if($request->ampasOrder){
                if(strlen($request->ampasOrder) == 13){
                    $record->orderBy(substr($request->ampasOrder,0,12),$request->ampasOrderVal);
                }else{
                    $record->orderBy($request->ampasOrder,$request->ampasOrderVal);
                }
            }
        }

        $record = $record->paginate(20);
        
        // for Rental
        $recordRental = $this->searchRental($request);

        return $this->render('frontend.searching.show-search-ajax', [
            'mockup' => false,
            'record' => $record,
            'recordRental' => $recordRental,
            'search' => $request->search_ampas,
            'request' => $request,
        ]);

    }


    public function searchRental(Request $request){
        $recordRental = Rental::select('*');
        if($request->search_ampas){
            $recordRental->where('judul','like', '%'.$request->search_ampas.'%');
        }

        if(isset($request->currentLoca)){
            $wilKot = WilayahKota::where('kota','like', '%'.$request->currentLoca.'%')->first();
            if($wilKot){
                $recordRental->whereHas('user', function($user) use($wilKot){ 
                    $user->whereHas('lapak',function($q) use($wilKot){
                        $q->where('id_kota',$wilKot->id);
                    });
                }); 
            }
        }else{
            if(isset($request->ampasWilayah['ampasProvinsi'])){
                if($request->ampasWilayah['ampasProvinsi'] != 'Current_Location'){
                    $recordRental->whereHas('user', function($user) use($request){ 
                        $user->whereHas('lapak',function($q) use($request){
                            $q->where('id_provinsi',$request->ampasWilayah['ampasProvinsi']);
                        });
                    }); 
                }
            }
        }

        if(isset($request->ampasWilayah['ampasKot'])){
            $recordRental->whereHas('user', function($user) use($request){ 
                $user->whereHas('lapak',function($q) use($request){
                    $q->where('id_kota',$request->ampasWilayah['ampasKot']);
                });
            }); 
        }


        if($request->ampasHarga){
            $harga_barang = str_replace(".", "", $request->ampasHarga['ampasUang']);
            $recordRental->whereRaw('harga_sewa '.$request->ampasHarga['ampasHargaKondisi'].''.(float)$harga_barang);
        }

        if($request->ampasOrder){
            if(strlen($request->ampasOrder) == 11){
                $recordRental->orderBy(substr($request->ampasOrder,0,10),$request->ampasOrderVal);
            }else{
                $recordRental->orderBy($request->ampasOrder,$request->ampasOrderVal);
            }
        }

        $recordRental = $recordRental->paginate(20);
        return $recordRental;
    }

    public function categorySearch(Request $request, $categ, $name)
    {
        $kategoriRental = KategoriRental::get();
        $name = preg_replace('/[^a-zA-Z0-9]/', ' ', $name);

        if($categ == 'amps'){
            $record = LapakBarang::whereHas('kategoriBarang',function($q) use($name){
                $q->where('kat_nama','like', '%'.$name.'%');
            })->select('*');
        }elseif ($categ == 'mps') {
            $record = LapakBarang::whereHas('subKategoriBarang',function($q) use($name){
                $q->where('sub_nama','like', '%'.$name.'%');
            })->select('*');
        }else if ($categ == 'spm') {
            $record = LapakBarang::whereHas('childKategoriBarang',function($q) use($name){
                $q->where('nama','like', '%'.$name.'%');
            })->select('*');
        }else{
            $record = LapakBarang::select('*');
        }
        $record = $record->paginate(20);
        
        $recordRental = $this->searchRental($request);

        return $this->render('frontend.searching.index', [
            'mockup' => false,
            'record' => $record,
            'search' => $request->search_ampas,
            'kategoriRental' => $kategoriRental,
            'recordRental' => $recordRental,
            'input'        => $name,
        ]);

    }
    public function closes(Request $req)
    {   
        $val = $req->value;
        if($val){
            $record = Lapak::with('barang')->where('id_kota', 'like', '%'.$val.'%')->select('*');
        }
        if ($req->ajax()) {
            $record = Lapak::with('barang')->where('id_kota', 'like', '%'.$val.'%')->select('*');
        }
        $record = $record->paginate(20);
        return $this->render('frontend.searching.show-search', [
            'mockup' => false,
            'record' => $record,
            'request' => $req,
        ]);
    }
    public function show(Request $request, $id, $name){
      
      return $this->render('frontend.home.show', [
        'mockup' => false,
        'record' => LapakBarang::find($id),
      ]);
    }
    
    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }

    // FOR RENTAL
    public function ajRen(Request $request)
    {
        // $record = ;
        $cat = $request->cat_id;
        $provinsi = $request->provinsi;
        $harga = $request->harga;
         if ($cat != '') {
            $record = Rental::join('ref_kategori_rental','ref_kategori_rental.id','trans_rental.kategori_id')->where('judul','like', '%'.$cat.'%')
                    ->orWhere('nama','like', '%'.$cat.'%')
                    ->orderBy($harga,$request->rendah)
                    ->select(['trans_rental.*','ref_kategori_rental.nama']);
         }elseif ($request->kon != '') {
            $record = Rental::join('ref_kategori_rental','ref_kategori_rental.id','trans_rental.kategori_id')
                    ->where('judul','like', '%'.$request->kon.'%')
                    ->orWhere('nama','like', '%'.$request->kon.'%')
                    ->select(['trans_rental.*','ref_kategori_rental.nama']);
         }elseif ($provinsi != '') {
            $record = Rental::join('ref_kategori_rental','ref_kategori_rental.id','trans_rental.kategori_id')
            ->join('ref_wilayah_provinsi','ref_wilayah_provinsi.id','trans_rental.id_provinsi')->where('id_provinsi','like', '%'.$request->provinsi.'%')
            ->select(['trans_rental.*','ref_kategori_rental.nama','ref_wilayah_provinsi.provinsi']);
         }elseif ($request->kota != ''){
            $record = Rental::join('ref_kategori_rental','ref_kategori_rental.id','trans_rental.kategori_id')
            ->join('ref_wilayah_kota','ref_wilayah_kota.id','trans_rental.id_kota')->where('id_kota','like', '%'.$request->kota.'%')
            ->select(['trans_rental.*','ref_kategori_rental.nama','ref_wilayah_kota.kota']);
         }
         $record = $record->paginate(20);
         return $this->render('frontend.searching.rental.show-search-ajax', [
             'mockup' => false,
             'record' => $record,
             'search' => $cat,
             'request' => $request,
         ]);
    }
    public function rentalSerch(Request $request)
    {
        $input = $request->input('search_rental');
        $record = Rental::join('ref_kategori_rental','ref_kategori_rental.id','trans_rental.kategori_id');
        $serch = $request->search_rental;
        if($serch){
            // $this->setBreadcrumb(['Barang' => '#', ''.$request->search_rental.'' => '#' ]);
            $record->where('judul','like', '%'.$serch.'%')
                    ->orWhere('nama','like', '%'.$serch.'%')
                    ->select('trans_rental.*','ref_kategori_rental.nama');
                    // ->orWhere('nama','like', '%'.$request->search_rental.'%');
        }
        $record = $record->paginate(20);

        return $this->render('frontend.searching.rental.index', [
            'mockup' => false,
            'input' => $input,
            'record' => $record,
            'search' => $request->search_rental,
            'rental' => 'ada',
        ]);
    }
    public function categorySearchRental(Request $request, $categ, $name)
    {
        $this->setLink('sc/rental/');
        $this->setTitle("Rental");
        $this->setBreadcrumb(['Rental' => '#']);
            $name = preg_replace('/[^a-zA-Z0-9]/', ' ', $name);
            $record = Rental::whereHas('kategori',function($q) use($name){
                $q->where('nama','like', '%'.$name.'%');
            })->select('*');
            $record = $record->paginate(20);
            // dd($record);
        return $this->render('frontend.searching.rental.index', [
            'mockup' => false,
            'record' => $record,
            'search' => $request->search_ampas,
            'name'   => $name,
            'rental' => 'ada',
        ]);

    }

    public function showRental(Request $request, $id, $name)
    {
      return $this->render('frontend.searching.rental.show', [
        'mockup' => false,
        'record' => Rental::find($id),
      ]);
    }

    public function ajIndexRental(Request $request)
    {     
        
        $record = Rental::select('*');

        if($request->ampasOrder){
            if(strlen($request->ampasOrder) == 11){
                $record->orderBy(substr($request->ampasOrder,0,10),$request->ampasOrderVal);
            }else{
                $record->orderBy($request->ampasOrder,$request->ampasOrderVal);
            }
        }
        if($request->judul){
            $record->where('judul','like', '%'.$request->judul.'%');
        }

        if($request->catCateg == 'kategori'){
            $record->where('id_kategori',$request->categId);
            
        }

        if($request->catCateg == 'sub_kategori'){
            $record->where('sub_kategori_id',$request->categId);
        }

        if(isset($request->id_provinsi)){
            $record->whereHas('user', function($q) use($request){ 
                $q->where('id_provinsi',$request->id_provinsi);
            });
        }

        if(isset($request->id_kota)){
            $record->whereHas('user', function($q) use($request){ 
                $q->where('id_kota',$request->id_kota);
            });
        }

        if($request->harga_sewa){
            $harga_sewa = str_replace(".", "", $request->harga_sewa);

            $record->where('harga_sewa', $request->harga_kondisi.'=' , $harga_sewa);
        }

        $record = $record->paginate(20);
        
        return $this->render('frontend.searching.rental.show-search-ajax', [
            'mockup' => false,
            'record' => $record,
            'search' => $request->search_ampas,
            'request' => $request,
        ]);

    }

    public function detail($id){
        $record = LapakBarang::with('lapak.users')->find($id);
        $data = ChatRoom::where('id_barang',$record->id)->where('type','diskusi')->select('*');
        $value = $data->get();
        if($record){
              return $this->render('frontend.home.detail', [
                'mockup' => false,
                'record' => $record,
                'message' => $value,
              ]);
        }else{
            return $this->render('failed.page', ['mockup' => false]);
        }
    }
    public function details($id){
        $record = Rental::find($id);
        if($record){
              return $this->render('frontend.home.detail-sewa', [
                'mockup' => false,
                'record' => $record,
              ]);
        }else{
            return $this->render('failed.page', ['mockup' => false]);
        }
    }
    public function allapak(){
        $date = Carbon::now();
        $record = LapakBarang::with('kategoriBarang','lapak')->orderBy('created_at','desc')->get();
          return $this->render('frontend.searching.rental.all-lapak', [
            'mockup' => false,
            'record' => $record,
        ]);
    }
}
