<?php

namespace App\Http\Controllers\BackEnd\Lapak;

use Auth;
use Illuminate\Http\Request;
use App\Models\Lapak\Lapak;
use App\Http\Controllers\Controller;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
class PesananController extends Controller
{
    protected $link = 'settings-lapak/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Setting Lapak");
        // $this->setGroup("Master");
        // $this->setSubGroup("Aplikasi");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Setting Lapak' => 'settings-lapak']);
    }

    public function index()
    {
        $lapak = Lapak::where('created_by',auth()->user()->id)->first();
        $id = $lapak->id;
        $record = TransaksiAmpaseBarangDetail::with('trans_transaksi')->where('form_type','img_barang')->whereHas('barang',function($q) use($id){
            $q->where('id_trans_lapak',$id);
        })->select('*');
        $record = $record->paginate(25);
        return $this->render('backend.lapak.pesanan.all',[
            'record' => $record
        ]);
    }

    public function pending()
    {
        $lapak = Lapak::where('created_by',auth()->user()->id)->first();
        $id = $lapak->id;
        $status = 'Menunggu Pembayaran';
        $record = TransaksiAmpaseBarangDetail::with('trans_transaksi')->whereHas('barang',function($q) use($id){
            $q->where('id_trans_lapak',$id);
        })->whereHas('trans_transaksi',function($u) use ($status){
            $u->where('status','like','%'.$status.'%');
        })->select('*');
        $record = $record->paginate(25);
        return $this->render('backend.lapak.pesanan.pending',[
            'record' => $record
        ]);
    }

    public function packing()
    {
        $lapak = Lapak::where('created_by',auth()->user()->id)->first();
        $id = $lapak->id;
        $status = 'Sedang Di Packing';
        $record = TransaksiAmpaseBarangDetail::with('trans_transaksi')->whereHas('barang',function($q) use($id){
            $q->where('id_trans_lapak',$id);
        })->whereHas('trans_transaksi',function($u) use($status){
            $u->where('status','like','%'.$status.'%');
        })->select('*');
        $record = $record->paginate(25);
        return $this->render('backend.lapak.pesanan.packing',[
            'record' => $record
        ]);
    }

    public function setTracking()
    {
        $lapak = Lapak::where('created_by',auth()->user()->id)->first();
        $id = $lapak->id;
        $status = 'Dalam Pengiriman';
        $record = TransaksiAmpaseBarangDetail::with('trans_transaksi')->whereHas('barang',function($q) use($id){
            $q->where('id_trans_lapak',$id);
        })->whereHas('trans_transaksi',function($u) use($status){
            $u->where('status','like','%'.$status.'%');
        })->select('*');
        $record = $record->paginate(25);
        return $this->render('backend.lapak.pesanan.tracking',[
            'record' => $record
        ]);
    }

    public function tracking()
    {
        $lapak = Lapak::where('created_by',auth()->user()->id)->first();
        $id = $lapak->id;
        $status = 'Sedang Di Packing';
        $record = TransaksiAmpaseBarangDetail::with('trans_transaksi')->whereHas('barang',function($q) use($id){
            $q->where('id_trans_lapak',$id);
        })->whereHas('trans_transaksi',function($u) use($status){
            $u->where('status','like','%'.$status.'%');
        })->select('*');
        $record = $record->paginate(25);
        return $this->render('backend.lapak.pesanan.tracking',[
            'record' => $record
        ]);
    }

    public function success()
    {
        $lapak = Lapak::where('created_by',auth()->user()->id)->first();
        $id = $lapak->id;
        $status = 'Telah Diterima';
        $record = TransaksiAmpaseBarangDetail::with('trans_transaksi')->whereHas('barang',function($q) use($id){
            $q->where('id_trans_lapak',$id);
        })->whereHas('trans_transaksi',function($u) use($status){
            $u->where('status','like','%'.$status.'%');
        })->select('*');
        $record = $record->paginate(25);
        return $this->render('backend.lapak.pesanan.tracking',[
            'record' => $record
        ]);
    }

    public function orderCanceled()
    {
        $lapak = Lapak::where('created_by',auth()->user()->id)->first();
        $id = $lapak->id;
        $status = 'Pesanan Dibatalkan';
        $record = TransaksiAmpaseBarangDetail::with('trans_transaksi')->whereHas('barang',function($q) use($id){
            $q->where('id_trans_lapak',$id);
        })->whereHas('trans_transaksi',function($u) use($status){
            $u->where('status','like','%'.$status.'%');
        })->select('*');
        $record = $record->paginate(25);
        return $this->render('backend.lapak.pesanan.tracking',[
            'record' => $record
        ]);
    }

    public function returnProcess()
    {
        $lapak = Lapak::where('created_by',auth()->user()->id)->first();
        $id = $lapak->id;
        $status = 'Proses Pengembalian';
        $record = TransaksiAmpaseBarangDetail::with('trans_transaksi')->whereHas('barang',function($q) use($id){
            $q->where('id_trans_lapak',$id);
        })->whereHas('trans_transaksi',function($u) use($status){
            $u->where('status','like','%'.$status.'%');
        })->select('*');
        $record = $record->paginate(25);
        return $this->render('backend.lapak.pesanan.tracking',[
            'record' => $record
        ]);
    }

    public function chat()
    {
        return $this->render('backend.lapak.chat.index',[
            'user_id' => auth()->user()->id
        ]);
    }
}
