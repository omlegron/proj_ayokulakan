<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Barang\LapakBarang;
use App\Models\Rental\Rental;
use App\Models\Lapak\Lapak;
use App\Models\User;
use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
use Auth;
class SewaController extends Controller
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
                // $records = Rental::get();
                // foreach ($records as $key => $value) {
                //     foreach ($value->trans_rental as $key => $e) {
                //         dd($e);
                //     }
                // }
                $record = Lapak::orderBy('created_at','desc')->select('*');
                $record = $record->paginate(5);
                return $this->render('backend.dashboard.sewa.index',[
                    'record' => $record,
                    'active' => 'sewa'
                ]);
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
            if (auth()->user()->status == '1010,1011,1012') {
                $record = Lapak::find($id);
                $transaksi = Rental::with('rental')->select('*');
                return $this->render('backend.dashboard.sewa.show',[
                    'record' => $record,
                    'transaksi' => $transaksi,
                    'active' => 'sewa'
                ]);
            }else {
                return redirect('/');
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

    public function detail($id)
    {
        if (Auth::check()) {
            if (auth()->user()) {
                $record = TransaksiAmpaseBarangDetail::with('trans_transaksi','user')->find($id);
                $records = TransaksiAmpaseBarangDetail::with('rent')->select('*');
                // dd($record);
                return $this->render('backend.dashboard.sewa.detail-transaksi',[
                    'record' => $record,
                    'records' => $records,
                ]);
            }
        }
    }
}
