<?php

namespace App\Http\Controllers\FrontEnd\OfficialStore;

use App\Models\Lapak\Lapak;
use Illuminate\Http\Request;
use App\Models\Barang\LapakBarang;
use App\Http\Controllers\Controller;
use App\Models\Master\KategoriBarang;

class OfficialStoreController extends Controller
{
    protected $link = 'official-store/';

    function __construct()
    {
        $this->setLink($this->link);
    }
    public function index()
    {
        // $store = Brand::get();
        // dd($store);
        $perikanan = LapakBarang::with('kategoriBarang','feedback')->inRandomOrder()->limit(5)->get();
        $store = 'official store';
        return $this->render('frontend.official-store.index',[
            'record' => KategoriBarang::limit(6)->get(),
            'perikanan' => $perikanan,
            'store'     => Lapak::where('nama_lapak','like','%'.$store.'%')->get()
        ]);
    }

    public function showBrand($slug)
    {
        $req = str_replace('-',' ', $slug);
        $record = LapakBarang::whereHas('lapak',function($q) use($req){
            $q->where('nama_lapak','like','%'.$req.'%');
        })->select('*');
        $record = $record->paginate(25);
        return $this->render('frontend.official-store.show-brand',[
            'record' => $record,
            'slug' => $req
        ]);
    }
}
