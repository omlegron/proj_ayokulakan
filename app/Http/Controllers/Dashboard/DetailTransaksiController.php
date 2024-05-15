<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Users;
use App\Models\Roles;
use App\Models\Admin\Karyawan;
use App\Models\Lapak\Lapak;
use App\Models\Attachments;
use App\Models\Barang\LapakBarang;
use App\Models\Barang\LapakKategoriBarang;
use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
use Auth;
use Zipper;
use Carbon\Carbon;

class DetailTransaksiController extends Controller
{
    public function detail($id)
    {
        if (Auth::check()) {
            if (auth()->user()->status == '1010,1011,1012') {
                $record = TransaksiAmpase::with('detail')->find($id);
                $records = TransaksiAmpaseBarangDetail::with('barang')->where('trans_transaksi_id',$id)->get();
                // dd($records);
                return $this->render('backend.dashboard.user.detail-transaksi',[
                    'record' => $record,
                    'records' => $records,
                ]);
            }else {
                return redirect('/');
            }
        }
    }
}
