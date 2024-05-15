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
class TokoController extends Controller
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
                $record = Lapak::orderBy('created_at','desc')->select('*');
                $record = $record->paginate(5);
                return $this->render('backend.dashboard.toko.index',[
                    'record' => $record,
                    'active' => 'toko'
                ]);
            }else {
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
    public function show($id)
    {
        if (Auth::check()) {
            if (auth()->user()) {
                $record = Lapak::find($id);
                $records = LapakBarang::with('lapak')->where('id_trans_lapak',$id)->orderBy('created_at','desc')->paginate(8);
                return $this->render('backend.dashboard.toko.show',[
                    'record' => $record,
                    'records' => $records,
                    'active' => 'toko'
                ]);
            }
        }
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

    public function search(Request $request)
    {
        $isi = $request->isi;
        if ($isi) {
            $record = Lapak::where('nama_lapak','like', '%'.$isi.'%')->select('*');
        }else {
            $record = Lapak::select('*');
        }
        $record = $record->paginate(5);
        return $this->render('backend.dashboard.ajax.toko-ajax',[
            'record' => $record,
            'request' => $request
        ]);
    }

    public function cari(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $record = LapakBarang::with('lapak')->where('id_trans_lapak',$request->id)->where('nama_barang','like', '%'.$search.'%')->select('*');
        }else {
            $record = LapakBarang::with('lapak')->select('*');
        }
        $record = $record->paginate(5);
        return $this->render('backend.dashboard.toko.show-ajax',[
            'record' => $record,
            'request' => $request
        ]);
    }

    public function detail($id)
    {
        if (Auth::check()) {
            if (auth()->user()) {
                $record = TransaksiAmpaseBarangDetail::with('trans_transaksi','user')->find($id);
                $records = TransaksiAmpaseBarangDetail::with('barang')->select('*');
                // dd($record);
                return $this->render('backend.dashboard.toko.detail-transaksi',[
                    'record' => $record,
                    'records' => $records,
                ]);
            }
        }
    }
}
