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
use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
use Auth;

class UserAyoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            if (auth()->user()->status == '1010,1011,1012') {
                $record = Users::paginate(5);
                return $this->render('backend.dashboard.user.index',[
                    'record' => $record,
                    'active' => 'user'
                ]);
            }else{
                return redirect('/');
            }
         }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if(auth()->user()->status == '1010,1011,1012' ){
            $record = Users::find($id);
            $records = TransaksiAmpase::with('detail')->where(function ($insp) {
                $insp->where('transaction_status','!=','deny')->orWhere('transaction_status','!=','expiers');
            })->whereHas('detail',function($q) use ($record){
                $q->where('form_type','img_barang')->whereHas('barang',function($qq) use ($record){
                $qq->where('created_by',$record->id);
                });
            })->select('*');
        }
        return $this->render('backend.dashboard.user.detail-user',[
            'record' => $record,
            'records' => $records,
            'active' => 'user'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function shows($id)
    {
        if (Auth::check()) {
            if (auth()->user()->status == '1010,1011,1012') {
                $record = TransaksiAmpase::with('detail','kurir')->find($id);
                $records = TransaksiAmpaseBarangDetail::with('barang')->where('trans_transaksi_id',$id)->get();
                // dd($records);
                return $this->render('backend.dashboard.user.detail-transaksi',[
                    'record' => $record,
                    'records' => $records,
                ]);
            }else {
                return redirect('/');
            }
        }
    }
    public function search(Request $request)
    {
        $isi = $request->isi;
        if ($isi) {
            $record = Users::where('username','like', '%'.$isi.'%')->orWhere('nama','like', '%'.$isi.'%')->select('*')->paginate(5);
        }else {
            $record = Users::select('*')->paginate(5);
        }
        return $this->render('backend.dashboard.ajax.user-ajax',[
            'record' => $record,
            'request' => $request
        ]);
    }
}
