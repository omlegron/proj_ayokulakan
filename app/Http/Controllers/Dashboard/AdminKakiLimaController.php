<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Roles;
use App\Models\KakiLima\KakiLima;
use Auth;
class AdminKakiLimaController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (auth()->user()->status == '1010,1011,1012') {
                $semua = KakiLima::with('creator')->paginate(5);
                $records = KakiLima::with('creator')->where('status','2')->paginate(5);
                $aktiv = KakiLima::with('creator')->where('status',3)->paginate(5);
                return $this->render('backend.dashboard.kaki-lima.index',[
                    'semua' => $semua,
                    'records' => $records,
                    'aktiv' => $aktiv,
                    'active' => 'kaki-lima'
                ]);
            }
         }
    }

    public function show($id)
    {
        if (Auth::check()) {
            if (auth()->user()->status == '1010,1011,1012') {
                $record = KakiLima::with('creator')->find($id);
                return $this->render('backend.dashboard.kaki-lima.show',[
                    'record' => $record,
                    'active' => 'kaki-lima'
                ]);
            }
         }
    }

    public function verif(Request $request)
    {
        $record = KakiLima::where('id',$request->id)->update([
            'status' => $request->value
        ]);
        return $record;
    }

    public function batal(Request $request)
    {
        $record = KakiLima::where('id',$request->id)->update([
            'status' => $request->value,
            'subject_verif' => $request->isi,
        ]);
        return $record;
    }

    public function search(Request $request)
    {
        $isi = $request->isi;
        if ($isi) {
            $record = KakiLima::with('creator')->where('name','like','%'.$isi.'%')->paginate(5);
        }
        return $this->render('backend.dashboard.kaki-lima.show-ajax',[
            'record' => $record,
            'request' => $request,
        ]);
    }
}
