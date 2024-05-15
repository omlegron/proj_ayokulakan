<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransaksiAmpas\TransVoucher;
use Auth;

class AdminVoucherController extends Controller
{

    protected $link = 'admin/voucher/';

    public function __construct()
    {
        $this->setLink($this->link);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $record = TransVoucher::with('creator')->get();
        return $this->render('backend.dashboard.voucher.index',[
            'record' => $record,
            'active' => 'voucher'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->render('backend.dashboard.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'kode_voucher' => 'required',
            'nominal_voucher' => 'required|integer',
            'desc_voucher'  => 'required',
            'expire_date'   => 'required|date'
        ]);

        $data = $request->all();
        $data['created_by'] = auth()->user()->id;
        
        TransVoucher::create($data);
        return response([
            'status' => true,
            'url'   => $this->link
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->render('backend.dashboard.voucher.edit',[
            'record' => TransVoucher::find($id)
        ]);
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
        $this->validate($request,[
            'kode_voucher' => 'required',
            'nominal_voucher' => 'required|integer',
            'desc_voucher'  => 'required',
            'expire_date'   => 'required|date'
        ]);

        $data = $request->all();
        $data['updated_by'] = auth()->user()->id;
        $vcr = TransVoucher::findOrFail($id);
        $vcr->update($data);
        return response([
            'status' => true,
            'url'   => $this->link
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = TransVoucher::findOrFail($id);
        $data->delete();

        return response([
            'status' => true,
            'url'   => $this->link
        ]);

    }
}
