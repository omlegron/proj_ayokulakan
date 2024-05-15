<?php

namespace App\Http\Controllers\FrontEnd\KakiLima;

use Auth;
use QrCode;
use Zipper;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;

use App\Models\KakiLima\KakiLima;
use App\Http\Controllers\Controller;
use App\Models\Master\WilayahNegara;
use Intervention\Image\Facades\Image;
use App\Models\Master\AplikasiPanduan;
use App\Http\Requests\KakiLima\KakiLimaRequest;

class KakiLimaController extends Controller
{
  //
  protected $link = 'kaki-lima/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Kaki Lima");
    $this->setGroup("Kaki Lima");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Kaki Lima' => '#']);
  }

  public function index()
  {
    $img = Image::make('new-temp.jpg')->insert('img/loggo.png');
    $record = AplikasiPanduan::where('kategori', 'Panduan Kaki Lima')->first();
    $recordKurir = [];
    if (Auth::check()) {
      $recordKurir = KakiLima::where('user_id', auth()->user()->id)->first();
    }
    // dd(QrCode::size(300)->generate('A basic example of QR code!'));
    return $this->render('frontend.kaki-lima.index', [
      'mockup' => false,
      'record' => $record,
      'recordKurir' => $recordKurir,
      'img' => $img
    ]);
  }

  public function tentang()
  {
    return $this->render('frontend.kaki-lima.tentang');
  }

  public function create()
  {
    $record = [];
    if (Auth::check()) {
      $record = Users::find(auth()->user()->id);
      return $this->render('frontend.kaki-lima.create', [
        'mockup' => false,
        'record' => $record
      ]);
    } else {
      return redirect('login');
    }
  }

  public function store(KakiLimaRequest $request)
  {
    
    $this->validate($request, [
      'attachment.*' => 'required',
      'attachment.*' => 'max:500',
    ], [
      'attachment.*.max' => 'Lampiran tidak boleh lebih dari 500 Kilobyte',
    ]);
    
    try {
      $skck = '';
      $ktp = '';
      $swafoto = '';

      $request['user_id'] = auth()->user()->id;

      if($request->file('foto_usaha')){
        $skck = ($request->file('foto_usaha')) ? $request->file('foto_usaha')->storeAs('kurir_files',str_replace(' ','_',$request->file('foto_usaha')->getClientOriginalName()), 'public') : '';
        $pathSkck = 
        $skck = 'kurir_files/'.str_replace(' ','_',$request->file('foto_usaha')->getClientOriginalName());
      }

      if($request->file('foto_ktp')){
        $foto_ktp = ($request->file('foto_ktp')) ? $request->file('foto_ktp')->storeAs('kurir_files',str_replace(' ','_',$request->file('foto_ktp')->getClientOriginalName()), 'public') : '';
        $ktp = 'kurir_files/'.str_replace(' ','_',$request->file('foto_ktp')->getClientOriginalName());
      }

      if($request->file('swa_foto')){
        $swafoto = ($request->file('swa_foto')) ? $request->file('swa_foto')->storeAs('kurir_files',str_replace(' ','_',$request->file('swa_foto')->getClientOriginalName()), 'public') : '';
        $swafoto = 'kurir_files/'.str_replace(' ','_',$request->file('swa_foto')->getClientOriginalName());
      }
      // $request['user_id'] = auth()->user()->id;
      // $request['skck'] = $request->file('foto_usaha')->store('public/kurir_files');
      // $request['ktp'] = $request->file('foto_ktp')->store('public/kurir_files');
      // $request['swafoto'] = $request->file('swa_foto')->store('public/kurir_files');
      
      $data = KakiLima::saveData($request);
      $data->skck = $skck;
      $data->swafoto = $swafoto;
      $data->fotoktp = $foto_ktp;
      $data->save();
      $nama ='';
      if(isset(auth()->user()->nama)){
        $nama = auth()->user()->nama;
      } else {
        $nama = '';
      }
      // $this->sendMailGlobal(
      //   isset(auth()->user()->email) ? auth()->user()->email : '',
      //   $data,
      //   'Selamat anda telah terdaftar sebagai kaki lima ayokulakan',
      //   'Hai kepada saudara '. $nama .'selamat bergabung, silahkan baca & taati, kebijakan & aturan dari ayokulakan',
      //   'https://ayokulakan.com/kaki-lima',
      //   'Kebijakan Privasi',
      //   'mails.global-mail'
      // );
      // dd($data);
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

  public function notFoundPage()
  {
    return $this->render('failed.page', ['mockup' => false]);
  }
}
