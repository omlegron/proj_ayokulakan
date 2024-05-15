<?php

namespace App\Http\Controllers\BackEnd\Lapak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\User;
use App\Models\Roles;
use App\Mail\DaftarLapak;
use App\Models\Lapak\Lapak;
use App\Models\Lapak\LapakBank;
use App\Models\Lapak\NoteLapak;
use App\Models\Lapak\PolicyLapak;
use App\Models\Barang\LapakBarang;
use Illuminate\Support\Facades\Mail;
Use App\Models\Master\KategoriBarang;
use App\Models\Master\KategoriBarangSub;
use App\Http\Requests\Lapak\LapakRequest;
use App\Models\Barang\LapakKategoriBarang;
use App\Models\TransaksiAmpas\TransVoucher;
use App\Http\Requests\Lapak\LapakBarangRequest;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
use DataTables;
use Zipper;
use Carbon\Carbon;
use Auth;

class SettingLapakController extends Controller
{
  //
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
    $chat = '0';
    $pendapatan = '0';
    $record = Lapak::where('created_by',auth()->user()->id)->first();
    if ($record) {
      $bank = LapakBank::where('lapak_id',$record->id)->first();
      if (!$bank) {
        return redirect('daftar-lapak/bank');
      }elseif ($record->id_negara) {
        $id = $record->id;
        $status = 'Sedang Di Packing';
        $packing = TransaksiAmpaseBarangDetail::with('trans_transaksi')->whereHas('barang',function($q) use($id){
            $q->where('id_trans_lapak',$id);
        })->whereHas('trans_transaksi',function($u) use($status){
            $u->where('status','like','%'.$status.'%');
        })->select('*');
        $pending = TransaksiAmpaseBarangDetail::with('trans_transaksi')->whereHas('barang',function($q) use($id){
            $q->where('id_trans_lapak',$id);
        })->whereHas('trans_transaksi',function($u){
            $u->where('status','Menunggu Pembayaran');
        })->select('*');
        $terjual = TransaksiAmpaseBarangDetail::with('trans_transaksi')->whereHas('barang',function($q) use($id){
          $q->where('id_trans_lapak',$id);
        })->whereHas('trans_transaksi',function($u){
            $u->where('status','Telah Diterima');
        })->select('*');
        foreach ($terjual->get() as $value) {
          $pendapatan += (int) $value->trans_transaksi->total_harga;
        }
        // dd($packing->trans_taransaksi()->sum('total_harga'));
        return $this->render('backend.lapak.profile',[
          'mockup' => false,
          'packing' => $packing,
          'pending' => $pending,
          'terjual' => $terjual,
          'pendapatan' => $pendapatan
        ]);
      }
    }else{
      return redirect('daftar-lapak');
    }
  }
  public function daftarLapak()
  { 
    $record = Lapak::where('created_by',auth()->user()->id)->first();
    if (!$record) {
      return $this->render('backend.lapak.index');
    }else {
      return \redirect('daftar-lapak/alamat');
    }
  }

  public function address()
  {
    $record = Lapak::where('created_by',auth()->user()->id)->first();
    if ($record->id_negara == '') {
    return $this->render('backend.lapak.address',[
      'record' => $record
      ]);
    }else {
      return redirect('daftar-lapak/bank');
    }
  }

  public function bank()
  {
    $lapak = Lapak::where('created_by',auth()->user()->id)->first();
    $record = LapakBank::where('created_by',auth()->user()->id)->first();
    if ($record) {
      return redirect($this->link);
    }elseif ($lapak->id_negara == '') {
      return redirect('daftar-lapak/address');
    }
    else{
      return $this->render('backend.lapak.bank');
    }
  }

  public function storeLapak(Request $request)
  {
    $request->validate([
      'phone' => 'required',
      'nama_lapak' => 'required'
    ]);
    try {
      $data = Lapak::saveData($request);
      $detail = [
        'img' => 'ayokulakan.com/img/logo/favicon-16x16.png',
        'url' => url('fitur/pelapak/panduan-pelapak')
      ];
      Mail::to(auth()->user()->email)->send(new DaftarLapak($detail));
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }

    return response([
      'status' => true,
      'url' => 'alamat'

    ]);
  }
  public function storeAddress(Request $request)
  {
    $request->validate([
      'id_negara' => 'required',
      'id_provinsi' => 'required',
      'id_kota' => 'required',
      'id_kecamatan' => 'required',
    ]);
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
      'url' => '/bank'

    ]);
  }
  public function storeBank(Request $request)
  {
    $request->validate([
      'nama_ktp' => 'required',
      'nomor_ktp' => 'required|integer',
      'foto_ktp' => 'required|max:500',
      'swa_foto' => 'required|max:500',
      'nama_rekening' => 'required',
      'nomor_rekening' => 'required',
      'foto_tabungan' => 'required|max:500'
    ]);
    try {
      if($request->file('foto_ktp')){
        $fotoKtp = ($request->file('foto_ktp')) ? $request->file('foto_ktp')->storeAs('img_lapak_bank',str_replace(' ','_',$request->file('foto_ktp')->getClientOriginalName()), 'public') : '';
      }

      if($request->file('swa_foto')){
        $swaFoto = ($request->file('swa_foto')) ? $request->file('swa_foto')->storeAs('img_lapak_bank',str_replace(' ','_',$request->file('swa_foto')->getClientOriginalName()), 'public') : '';
      }

      if($request->file('foto_tabungan')){
        $fotoTabungan = ($request->file('foto_tabungan')) ? $request->file('foto_tabungan')->storeAs('img_lapak_bank',str_replace(' ','_',$request->file('foto_tabungan')->getClientOriginalName()), 'public') : '';
      }
      $data = LapakBank::saveData($request);
      $data->foto_ktp = $fotoKtp;
      $data->swa_foto = $swaFoto;
      $data->foto_tabungan = $fotoTabungan;
      $data->save();
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
  public function createProduct()
  {
    $record = Lapak::where('created_by',auth()->user()->id)->first();
    if ($record) {
      $records = [];
      if(Auth::check()){
        $records = KategoriBarang::with('subkategori')->orderBy('kat_nama','asc')->get();
        $voucher = TransVoucher::where('created_by',auth()->user()->id)->get();
      }
      return $this->render('backend.lapak.barang.index', [
        'mockup' => false,
        'records' => $records,
      ]);
    }else{
      return redirect('/');
    }
  }
  public function add()
  {
    $this->render('backend.lapak.barang.create');
  }
  public function create()
  {
    $lapak = Lapak::where('created_by',auth()->user()->id)->first();
    return $this->render('backend.lapak.create',[
      'record' => $lapak
    ]);
  }

  public function note()
  {
    return $this->render('backend.lapak.note');
  }

  public function storeNote(Request $request)
  {
    $this->validate($request,[
      'lapak_id' => 'required',
      'judul_catatan' => 'required',
      'isi_catatan' => 'required',
    ]);
    try {
      $data = NoteLapak::saveData($request);
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

  public function storeKebijakan(Request $request)
  {
    $this->validate($request,[
      'lapak_id' => 'required',
      'judul_kebijakan' => 'required',
      'isi_kebijakan' => 'required',
    ]);
    try {
      $data = PolicyLapak::saveData($request);
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

  public function setAddress()
  {
    return $this->render('backend.lapak.setting-address',[
      'record' => Lapak::where('created_by',auth()->user()->id)->first()
    ]);
  }

  public function store(LapakRequest $request)
  {
    $this->validate($request, [
        'attachment.*' => 'required',
        'attachment.*'=>'max:5000',
        "attachment.*"=>"mimes:jpg,png,jpeg,gif"
    ],[
      'attachment.*.max' => 'Gambar tidak boleh lebih dari 5MB',
    ]);
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
      'url' => $this->link

    ]);
  }

  public function edit($id)
  {
    return $this->render('backend.lapak.edit',[
        'record' => Lapak::find($id),
    ]);
  }

  public function update(Request $request, $id)
  {
  //   if(!is_null($request->attachment[0])){
  //     $this->validate($request, [
  //         'attachment.*'=>'max:5120',
  //         'attachment.*' => 'image|mimes:jpg,png,jpeg',
  //         "attachment.*"=>"mimes:jpg,png,jpeg,gif"
  //     ],[
  //       'attachment.*.max' => 'Gambar tidak boleh lebih dari 5 MB',
  //       'attachment.*.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
  //       'attachment.*.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',
  //     ]);
  //   }
    try {
       $data = Lapak::saveData($request);
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => 'An error occurred!',
      ], 500);
    }

    return response([
      'status' => true,
      'url' => url('/')
    ]);
  }

  public function show($id)
  {
    // dd($id);
    return $this->render('backend.lapak.show',[
        'record' => Lapak::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      Lapak::destroy($id);
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => 'An error occurred!',
      ], 500);
    }

    return response([
      'status' => true,
      'url' => 'asdas'
    ]);
  }

  // BARANG
  public function historyProduct()
  {
    $id = auth()->user()->lapak->id;
    $detail = TransaksiAmpaseBarangDetail::with('trans_transaksi')->whereHas('barang',function($q) use($id){
      $q->where('id_trans_lapak',$id);
    })->select('*');
    $detail = $detail->paginate(25);
    return $this->render('backend.lapak.barang.history',[
      'record' => $detail
    ]);
  }

  public function showFeedback($id)
  {
    // dd($id);
    return $this->render('backend.lapak.barang.show-feedback',[
        'record' => LapakBarang::find($id),
    ]);
  }

  public function ajlapak($id)
  {
    $record = KategoriBarangSub::with('kategori')->where('id_kategori',$id)->get();
    return $this->render('backend.lapak.barang.ajax-kategori', [
      'mockup' => false,
      'record' => $record,
      'titleModal' => 'Pasang iklan Anda'
    ]);
  }
}
