<?php

namespace App\Http\Controllers\FrontEnd\PendaftaranKurir;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AplikasiPanduan;
use App\Models\Kurir\Kurir;
use App\Http\Requests\Kurir\KurirRequest;
use App\Http\Requests\Kurir\NewKurirRequest;
use App\Models\User;

use Zipper;
use Carbon\Carbon;
use Auth;

class PendaftaranKurirController extends Controller
{
    //
    protected $link = 'yokuy-kurir/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Pendfatran Kurir");
        $this->setGroup("Pendfatran Kurir");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Pendfatran Kurir' => '#']);
    }

    public function index()
    {
        $record = AplikasiPanduan::where('kategori', 'Panduan Kurir')->first();
        $recordKurir = [];
        if (Auth::check()) {
            $recordKurir = Kurir::where('user_id', auth()->user()->id)->first();
        }

        return $this->render('frontend.pendaftaran-kurir.index', [
            'mockup' => false,
            'record' => $record,
            'recordKurir' => $recordKurir,
        ]);
    }
    public function tentang()
    {
        return $this->render('frontend.pendaftaran-kurir.tentang');
    }
    public function create()
    {
        if (Auth::check()) {
            // return $this->render('frontend.pendaftaran-kurir.create');
            return $this->render('frontend.pendaftaran-kurir.newcreate');
        } else {
            return redirect('login');
        }
    }

    public function store(KurirRequest $request)
    {
        
        $this->validate($request, [
            'attachment.*' => 'required',
            'attachment.*' => 'max:500',
        ], [
            'attachment.*.max' => 'Lampiran tidak boleh lebih dari 500 Kilobyte',
        ]);
        try {
            $request['user_id'] = auth()->user()->id;
            $data = Kurir::saveData($request);
        } catch (\Exception $e) {
            return response([
                'status' => 'error',
                'message' => 'An error occurred!',
            ], 500);
        }

        return response([
            'status' => true,
            'url' => true
        ]);
    }

    public function newStore(Request $request)
    {

        // dd($request->all());
        $fotoSim = '';
        $fotoKtp = '';
        $swafoto = '';
        $fotocopyKK = '';
        try {
            if(isset($request->modelKendaraan1)){
                $request['modelKendaraan'] = 'Mobil : '.$request->modelKendaraan.', Motor : '.$request->modelKendaraan1;
                $request['NomorPolisiKendaraan'] = 'Nopol Mobil : '.$request->NomorPolisiKendaraan.', Nopol Motor : '.$request->NomorPolisiKendaraan1;
                $request->request->remove('modelKendaraan1');
                $request->request->remove('tahunKendaraan1');
                $request->request->remove('NomorPolisiKendaraan1');
                $request['user_id'] = auth()->user()->id;
                
                if($request->file('fotoSim')){
                    $request->file('fotoSim')->storeAs('kurir_files',str_replace(' ','_',$request->file('fotoSim')->getClientOriginalName()), 'public');
                    $fotoSim = 'kurir_files/'.str_replace(' ','_',$request->fotoSim->getClientOriginalName());

                }

                if($request->file('fotoKtp')){
                    $request->file('fotoKtp')->storeAs('kurir_files',str_replace(' ','_',$request->file('fotoKtp')->getClientOriginalName()), 'public');
                    $fotoKtp = 'kurir_files/'.str_replace(' ','_',$request->fotoKtp->getClientOriginalName());
                }

                if($request->file('swafoto')){
                    $request->file('swafoto')->storeAs('kurir_files',str_replace(' ','_',$request->file('swafoto')->getClientOriginalName()), 'public');
                    $swafoto = 'kurir_files/'.str_replace(' ','_',$request->swafoto->getClientOriginalName());
                }

                if($request->file('fotocopyKK')){
                    $request->file('fotocopyKK')->storeAs('kurir_files',str_replace(' ','_',$request->file('fotocopyKK')->getClientOriginalName()), 'public');
                    $fotocopyKK = 'kurir_files/'.str_replace(' ','_',$request->fotocopyKK->getClientOriginalName());
                }
                // dd($request->all());
                $data = Kurir::saveData($request);
            }
            else {
                $request->request->remove('modelKendaraan1');
                $request->request->remove('tahunKendaraan1');
                $request->request->remove('NomorPolisiKendaraan1');
                $request['user_id'] = auth()->user()->id;
                if($request->file('fotoSim')){
                    $request->file('fotoSim')->storeAs('kurir_files',str_replace(' ','_',$request->file('fotoSim')->getClientOriginalName()), 'public');
                    $fotoS = 'kurir_files/'.str_replace(' ','_',$request->fotoSim->getClientOriginalName());

                }
                // dd($request->fotoSim);
                if($request->file('fotoKtp')){
                    $request->file('fotoKtp')->storeAs('kurir_files',str_replace(' ','_',$request->file('fotoKtp')->getClientOriginalName()), 'public');
                    $fotoKtp = 'kurir_files/'.str_replace(' ','_',$request->fotoKtp->getClientOriginalName());
                }

                if($request->file('swafoto')){
                    $request->file('swafoto')->storeAs('kurir_files',str_replace(' ','_',$request->file('swafoto')->getClientOriginalName()), 'public');
                    $swafoto = 'kurir_files/'.str_replace(' ','_',$request->swafoto->getClientOriginalName());
                }

                if($request->file('fotocopyKK')){
                    $request->file('fotocopyKK')->storeAs('kurir_files',str_replace(' ','_',$request->file('fotocopyKK')->getClientOriginalName()), 'public');
                    $fotocopyKK = 'kurir_files/'.str_replace(' ','_',$request->fotocopyKK->getClientOriginalName());
                }
                $data = Kurir::saveData($request);
                $data->fotoSim = $fotoSim;
                $data->fotoKtp = $fotoKtp;
                $data->swafoto = $swafoto;
                $data->fotocopyKK = $fotocopyKK;
                $data->save();
            }
            // dd($request->modelKendaraan);
            
            // $this->sendMailGlobal(
            //     isset(auth()->user()->email) ? auth()->user()->email : '',
            //     $data,
            //     'Selamat anda telah terdaftar sebagai kurir ayokulakan',
            //     'Hai kepada saudara '.isset(auth()->user()->nama) ? auth()->user()->nama : ''.' selamat bergabung, silahkan baca & taati, kebijakan & aturan dari ayokulakan',
            //     'https://ayokulakan.com/fitur/kurir/panduan-kurir',
            //     'Kebijakan Privasi',
            //     'mails.global-mail'
            // );
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
