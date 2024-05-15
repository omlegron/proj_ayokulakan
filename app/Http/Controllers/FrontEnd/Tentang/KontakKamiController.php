<?php

namespace App\Http\Controllers\FrontEnd\Tentang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AplikasiTentang;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactKamiMail;
use App\Models\kontak\Kontak;
use App\Models\User;

use Zipper;
use Carbon\Carbon;
class KontakKamiController extends Controller
{
    //
    protected $link = '/kontak-kami';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Kontak Kami");
        $this->setGroup("Kontak Kami");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Kontak Kami' => '#']);
    }

    public function index()
    {     
          $record = AplikasiTentang::where('kategori','Kontak Kami')->first();
          

          return $this->render('frontend.kontak-kami.index', [
            'mockup' => false,
            'record' => $record,
          ]);
          
    }

    public function show(Request $request, $id, $name){
      
      return $this->render('frontend.kontak-kami.show', [
        'mockup' => false,
        'record' => LapakBarang::find($id),
      ]);
    }
    public function kontak(Request $request)
    {
      $data = $request->all();
      $request->validate([
        'nama' => 'required',
        'email' => 'required',
        'subject' => 'required',
        'telphone' => 'required',
      ]);
      $kontak = Kontak::create($data);
      // Mail::send(new ContactKamiMail($data));
      // $kontak->sendMails();
      return back()->with('success','berhasil kirim saran');
    }
    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}
