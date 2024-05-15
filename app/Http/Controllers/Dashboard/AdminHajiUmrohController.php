<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HajiUmroh\HajiDaftar;
use App\Models\HajiUmroh\HajiPaket;
use App\Models\HajiUmroh\HajiJadwal;
use App\Models\HajiUmroh\HajiRekap;
use Auth;
class AdminHajiUmrohController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (auth()->user()->status == '1010,1011,1012') {
                $record = HajiDaftar::with('creator')->select('*');
                return $this->render('backend.dashboard.haji-umroh.index',[
                    'record' => $record,
                    'active' => 'haji-umroh'
                ]);
            }
         }
    }
    public function show($id)
    {
        if (Auth::check()) {
            if (auth()->user()) {
                $record = HajiDaftar::with('creator','jadwal','paket')->find($id);
                $pembayaran = HajiRekap::select('*');
                return $this->render('backend.dashboard.haji-umroh.show',[
                    'record' => $record,
                    'pembayaran' => $pembayaran,
                    'active' => 'haji-umroh'
                ]);
            }else {
                return redirect('login');
            }
         }
    }
}
