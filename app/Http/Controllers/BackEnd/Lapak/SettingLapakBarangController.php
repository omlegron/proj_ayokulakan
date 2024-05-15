<?php

namespace App\Http\Controllers\BackEnd\Lapak;

use App\Models\Lapak\Lapak;
use Illuminate\Http\Request;
use App\Models\Barang\LapakBarang;
use App\Http\Controllers\Controller;
use App\Models\Master\KategoriBarang;
use App\Models\Master\KategoriBarangSub;
use App\Http\Requests\Lapak\LapakBarangRequest;
use Auth;

class SettingLapakBarangController extends Controller
{
    protected $link = 'settings-barang/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Setting Lapak Barang");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Setting Lapak Barang' => 'settings-lapak-barang']);
    }
    public function index()
    {
        $record = Lapak::where('created_by',auth()->user()->id)->first();
        if ($record) {
            $records = [];
            if(Auth::check()){
                $records = KategoriBarang::with('subkategori')->orderBy('kat_nama','asc')->get();
                // $voucher = TransVoucher::where('created_by',auth()->user()->id)->get();
            }
            return $this->render('backend.lapak.barang.index', [
                'mockup' => false,
                'records' => $records,
            ]);
        }else{
            return redirect('/');
        }
    }

    public function show()
    {
        $lapak = Lapak::where('created_by',auth()->user()->id)->first();
        if ($lapak) {
            $record = LapakBarang::where('id_trans_lapak',$lapak->id)->select('*');
            $record = $record->paginate(25);
            return $this->render('backend.lapak.barang.show-barang',[
                'record' => $record
            ]);
        }else{
            return redirect('/');
        }
    }
    public function create(Request $request, $id)
    {
        $record = Lapak::where('created_by',auth()->user()->id)->first();
        $sub = KategoriBarangSub::with('kategori')->where('id', $id)->first();
        return $this->render('backend.lapak.barang.lowongan',[
            'record' => $record,
            'sub'     => $sub,
            'titleModal' => 'Pasang iklan Anda'
        ]);
    }

    public function edit($id)
    {
        return $this->render('backend.lapak.barang.edit',[
            'record' => LapakBarang::find($id),
        ]);
    }

    public function store(LapakBarangRequest $request)
    {
        $request->validate([
            'attachment' => 'required',
            'attachment.*' => 'required|image|mimes:png,jpg,jpeg|dimensions:min_width=250,min_height=250|max:500',
          ],[
            'attachment.*.max' => 'Gambar tidak boleh lebih dari 500 Kilobyte',
            'attachment.*.dimensions' => 'minimal lebar dan tinggi gambar 250px'
          ]);
        
          try {
              $harga_normal = preg_replace('/[^0-9]/','', $request->harga_normal);
              $harga_barang = preg_replace('/[Rp. ]/','', $request->harga_barang);
              $sub = \substr($harga_normal,0,-2);
              $request['harga_normal'] = $sub;
              $request['harga_barang'] = $harga_barang;
        
              $data = LapakBarang::saveData($request);
              // $dataKategori = LapakKategoriBarang::saveData($request);
          }catch (\Exception $e) {
            return response([
              'status' => 'error',
              'message' => $e,
            ], 500);
          }
        
          return response([
            'status' => true,
            'url' => 'settings-lapak'
        
          ]);
    }

    public function update(LapakBarangRequest $request, $id)
    {
        $this->validate($request, [
            'attachment.*'=>'max:500',
        ],[
          'attachment.*.max' => 'Gambar tidak boleh lebih dari 500 Kilobyte',
        ]);
    
        try {
          $harga_normal = preg_replace('/[^0-9]/','', $request->harga_normal);
          $harga_barang = preg_replace('/[Rp. ]/','', $request->harga_barang);
          $sub = \substr($harga_normal,0,-2);
          $request['harga_normal'] = $sub;
          $request['harga_barang'] = $harga_barang;
    
          $data = LapakBarang::saveData($request);
            // $dataKategori = LapakKategoriBarang::saveData($request);
        }catch (\Exception $e) {
          return response([
            'status' => 'error',
            'message' => $e,
          ], 500);
        }
    
        return response([
          'status' => true,
          'url' => true
    
        ]);
    }

    public function delete(Request $request)
    {
        try {
            LapakBarang::destroy($request->id);
          }catch (\Exception $e) {
            return response([
              'status' => 'error',
              'message' => $e,
            ], 500);
        }
      
        return response([
            'status' => true,
            'url' => true
        ]);
    }
}
