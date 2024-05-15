<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Roles;
use App\Models\Kurir\Kurir;
use App\Models\Attachments;
use Auth;
class AdminKurirController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (auth()->user()->status == '1010,1011,1012') {
                $semua = Kurir::with('creator','attachments')->orderBy('created_at','desc')->paginate(5);
                $verif = Kurir::with('creator','attachments')->orderBy('created_at','desc')->where('status','<',3)->paginate(5);
                $anggota = Kurir::with('creator','attachments')->orderBy('created_at','desc')->where('status',3)->paginate(5);
                return $this->render('backend.dashboard.kurir.index',[
                    'semua' => $semua,
                    'verif' => $verif,
                    'anggota' => $anggota,
                    'active' => 'kurir'
                ]);
            }
         }
    }

    public function show($id)
    {
        $record = Kurir::with('creator')->find($id);
                // dd($record);
        return $this->render('backend.dashboard.kurir.show',[
            'record' => $record,
            'active' => 'kurir'
        ]);
    }

    public function verif(Request $request)
    {
        $record = Kurir::where('id',$request->id)->update([
            'status' => $request->value
        ]);
        return $record;
    }

    public function batal(Request $request)
    {
        $record = Kurir::where('id',$request->id)->update([
            'status' => $request->value,
            'verived' => $request->isi,
        ]);
        return $record;
    }

    public function search(Request $request)
    {
        $isi = $request->isi;
        if ($isi) {
            $record = Kurir::with('creator')->where('namadepan','like','%'.$isi.'%')->get();
        }
        return $this->render('backend.dashboard.kurir.show-ajax',[
            'record' => $record,
            'request' => $request,
        ]);
    }
}
