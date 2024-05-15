<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Users;
use App\Models\Roles;
use App\Models\Admin\Karyawan;
use App\Models\Lapak\Lapak;
use App\Models\Barang\LapakBarang;
use App\Models\Barang\LapakKategoriBarang;
use Auth;
class KaryawanController extends Controller
{
    protected $link = 'admin/karyawan';
    
    public function __construct()
    {
        $this->setLink($this->link);
    }
    
    public function index()
    {
        $record = Users::orderBy('created_at','desc')->paginate(5);
        if (Auth::check()) {
           if (auth()->user()->status == '1010,1011,1012') {
               $record = Users::where('status',1010)->orWhere('status',1011)->orderBy('created_at','desc')->paginate(5);
               return $this->render('backend.dashboard.karyawan.index',[
                   'record' => $record,
                   'active' => 'karyawan'
               ]);
           }
        }
    }
    public function show($id)
    {
        $record = Users::find($id);
        return $this->render('backend.dashboard.karyawan.show',[
            'record' => $record,
            'active' => 'karyawan'
        ]);
    }
    public function create()
    {
        return $this->render('backend.dashboard.karyawan.create');
    }
    public function store(Request $request)
    {
    //    dd($request->all());
    if (!is_null($request->foto_users[0])) {
        $this->validate($request, [
          'attachment.*' => 'max:5120',
          'attachment.*' => 'image|mimes:jpg,png,jpeg',
          "attachment.*" => "mimes:jpg,png,jpeg,gif"
        ], [
          'attachment.*.max' => 'Gambar tidak boleh lebih dari 5 MB',
          'attachment.*.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
          'attachment.*.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',
        ]);
      }

       try {
           $data = Users::saveData($request);
       } catch (\Throwable $e) {
           return response([
               'status' => 'error',
               'message' => $e,
           ],500);
       }
       return response([
           'status' => true,
           'url'    => 'asd',
       ]);
    }
    public function edit($id)
    {
        return $this->render('backend.dashboard.karyawan.edit',[
            'record' => Users::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!is_null($request->foto_users[0])) {
            $this->validate($request, [
              'attachment.*' => 'max:5120',
              'attachment.*' => 'image|mimes:jpg,png,jpeg',
              "attachment.*" => "mimes:jpg,png,jpeg,gif"
            ], [
              'attachment.*.max' => 'Gambar tidak boleh lebih dari 5 MB',
              'attachment.*.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
              'attachment.*.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',
            ]);
          }
          if (isset($request->password)) {
            $this->validate($request, [
              'password' => 'string|min:6|confirmed',
            ]);
            $cekPass = bcrypt($request->password);
            $request['password'] = $cekPass;
          } else {
            unset($request['password']);
          }
          // dd($request->all());
          $this->validate($request, [
            'attachment.*' => 'max:500',
          ], [
            'attachment.*.max' => 'Gambar tidak boleh lebih dari 500 Kilobyte',
          ]);
          try {
            $data = Users::saveData($request);
          } catch (\Exception $e) {
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

    public function search(Request $request)
    {
        // echo $request->isi;
        $isi = $request->isi;
        if ($isi) {
            $record = Users::where('username','like', '%'.$isi.'%')->orWhere('nama','like', '%'.$isi.'%')->select('*')->paginate(5);
        }else {
            $record = Users::select('*')->paginate(5);
        }
        return $this->render('backend.dashboard.ajax.karyawan-ajax',[
            'record' => $record,
            'request' => $request
        ]);
    }

    public function delete($id)
    {
        Users::find($id)->delete($id);
        return redirect()->route('admin.karyawan')->with('success','Berhasil Menghapus Data');
    }
}
