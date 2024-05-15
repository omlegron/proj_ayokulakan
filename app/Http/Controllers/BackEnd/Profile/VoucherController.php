<?php

namespace App\Http\Controllers\BackEnd\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransaksiAmpas\TransVoucher;

class VoucherController extends Controller
{
    protected $link = 'myvoucher/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle('');
        // $this->setGroup("Master");
        // $this->setSubGroup("Aplikasi");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Setting Profile' => 'myvoucher']);
    }

    public function index()
    {
        $record = TransVoucher::get();
        return $this->render('backend.voucher.index',[
            'record' => $record
        ]);
    }
}
