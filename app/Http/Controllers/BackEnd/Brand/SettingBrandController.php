<?php

namespace App\Http\Controllers\BackEnd\Brand;

use App\Http\Requests\Brand\BrandStoreRequest;
use App\Http\Requests\Brand\BrandRequest;
use App\Models\Master\KategoriBarang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lapak\Lapak;
use App\Models\Barang\LapakBarang;
use Auth;

class SettingBrandController extends Controller
{
    protected $link = 'settings-brand/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Setting Brand");
        // $this->setGroup("Master");
        // $this->setSubGroup("Aplikasi");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Setting Brand' => 'settings-brand']);
    }

    public function index()
    {
        return $this->render('backend.brand.index');
    }

    
    public function create()
    {
        $record = Lapak::where('created_by',auth()->user()->id)->first();
        return $this->render('backend.brand.create',[
            'record' => $record,
        ]);
    }

    public function craeteBrand()
    {
        $record = Lapak::where('created_by',auth()->user()->id)->first();
        if (isset($record)) {
            return $this->render('backend.brand.create-product',[
                'record' => $record,
                'store' => KategoriBarang::get()
            ]);
        }else{
            return \redirect($this->link.'create');
        }
    }

    public function showProduct()
    {
        $record = LapakBarang::where('created_by',auth()->user()->id)->select('*');
        $record = $record->paginate(25);   
        return $this->render('backend.brand.show-product',[
            'record' => $record,
        ]);
    }

    public function storeBrand(BrandStoreRequest $request)
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
            $harga_barang = preg_replace('/[^0-9]/','', $request->harga_barang);
            $sub = \substr($harga_normal,0,-2);
            $harga = \substr($harga_barang,0,-2);
            $request['harga_normal'] = $sub;
            $request['harga_barang'] = $harga;
    
            $data = LapakBarang::saveData($request);
        } catch (\Exception $e) {
            return response([
                'status' => 'error',
                'message' => $e,
            ], 500);
        }
        return response([
            'status' => true,
            'url' => $this->link
        ]);
        
    }

    public function store(BrandRequest $request)
    {
        $this->validate($request, [
            'attachment.*' => 'required',
            'attachment.*'=>'max:5000',
            "attachment.*"=>"mimes:jpg,png,jpeg,gif"
        ],[
          'attachment.*.max' => 'Gambar tidak boleh lebih dari 5MB',
        ]);
        try {
            $data = Brand::saveData($request);
        }catch (\Exception $e) {
          return response([
            'status' => 'error',
            'message' => $e,
          ], 500);
        }
    
        return response([
          'status' => true,
          'url' => $this->link
    
        ]);
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(BrandRequest $request, $id)
    {
        try {
            $data = Lapak::saveData($request);
        }catch (\Exception $e) {
          return response([
            'status' => 'error',
            'message' => $e,
          ], 500);
        }
    
        return response([
          'status' => true,
          'url' => '/'
    
        ]);
    }

    
    public function destroy($id)
    {
        //
    }
}
