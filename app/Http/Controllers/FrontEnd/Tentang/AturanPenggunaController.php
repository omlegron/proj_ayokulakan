<?php

namespace App\Http\Controllers\FrontEnd\Tentang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AplikasiTentang;

use App\Models\User;

use Zipper;
use Carbon\Carbon;
class AturanPenggunaController extends Controller
{
    //
    protected $link = '/aturan-pengguna';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Tentang");
        $this->setGroup("Tentang");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Tentang' => '#']);
    }

    public function index()
    {     
          $record = AplikasiTentang::where('kategori','Aturan Pengguna')->first();
          

          return $this->render('frontend.aturan-pengguna.index', [
            'mockup' => false,
            'record' => $record,
          ]);
          
    }

    public function show(Request $request, $id, $name){
      
      return $this->render('frontend.aturan-pengguna.show', [
        'mockup' => false,
        'record' => LapakBarang::find($id),
      ]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}
