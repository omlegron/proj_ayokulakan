<?php

namespace App\Http\Controllers\BackEnd\Profile;

use App\Models\Users;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\CreditCard\CreditCard;
use App\Models\RekeningBank\RekeningBank;
use App\Models\GantiPassword\GantiPassword;
class Bankcontroller extends Controller
{
    protected $link = 'profile-bank/';
    public function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle('');
        // $this->setGroup("Master");
        // $this->setSubGroup("Aplikasi");
        $this->setModalSize("lg");
    }

    public function index()
    {
        $rek = RekeningBank::where('user_id',Auth::id())->first();
        $card = CreditCard::where('user_id',Auth::id())->first();
        $record = Users::find(Auth::id());
        return $this->render('backend.profile.bank-kart',[
          'rekening' => $rek,
          'card' => $card,
          'record' => $record
        ]);
    }

    public function storeRekening(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'no_rekening' => 'required',
            'nama_bank' => 'required',
            'alamat' => 'required',
            'kode_pos' => 'required|integer',
          ]);
      
          $card = RekeningBank::where('user_id',Auth::id())->first();
          try {
            if ($card) {
              $data = $card->update($request->all());
            }else {
              $data = RekeningBank::saveData($request);
            }
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

    public function storeCard(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'no_kartu' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'cvv' => 'required',
            'alamat' => 'required',
            'kode_pos' => 'required|integer',
          ]);
          $card = CreditCard::where('user_id',Auth::id())->first();
          try {
            if ($card) {
              $data = $card->update($request->all());
            }else {
              $data = CreditCard::saveData($request);
            }
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

    public function gantiPass()
    {
        return $this->render('backend.profile.reset-pass',[
          'record' => Users::find(Auth::id()),
        ]);
    }

    public function sendVerif(Request $request)
    {
      $fordigit = rand(1000,9999);
      $kode = GantiPassword::create([
          'user_id' => Auth::id(),
          'kode_verivikasi' => $fordigit
      ]);
      
      Mail::to(Auth::user()->email)->send(new ResetPassword($kode));
      return response([
          'status' => true,
          'url'    => 'ganti-pass'
      ]);
    }

    public function resetPass(Request $request)
    {
      $request->validate([
        'password' => 'required|string|min:6|confirmed',
        'kode_verivikasi' => 'required|integer|min:4'
      ]);
      $verif = GantiPassword::where('user_id',Auth::id())->where('kode_verivikasi',$request->kode_verivikasi)->orderBy('created_at','desc')->first();
      // dd($verif);
      if ($verif != null) {
        $data = Users::where('id',Auth::id())->update([
          'password' => \bcrypt($request->password)
        ]);
        $verif->delete();
        return response([
          'status' => true,
          'url' => 'ganti-pass'
        ]);
      }else {
        return response([
          'status' => 'error',
          'message' => 'data tidak ditemukan',
        ], 500);
      }
        
    }
}
