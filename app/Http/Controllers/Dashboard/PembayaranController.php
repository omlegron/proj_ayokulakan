<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\PPOBPulsaProvider;
use Auth;
class PembayaranController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (auth()->user()->status == '1010,1011,1012') {
                $ppobGame = PPOBPulsaProvider::where('type','game')->get();
                return $this->render('backend.dashboard.pembayaran.index',[
                    'ppobGame' => $ppobGame,
                    'mockup' => false,
                    'active' => 'pembayaran'
                ]);
            }else {
                return redirect('login');
            }
        }
    }
}
