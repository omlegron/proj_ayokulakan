<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Roles;
use App\Models\Berita\Berita;
use App\Http\Requests\Berita\BeritaRequest;
Use Auth;
use Zipper;
use Carbon\Carbon;
class KontenWebController extends Controller
{
    protected $link = 'admin/konten-web/';
    
    public function __construct()
    {
        $this->setLink($this->link);
    }
    
    public function index()
    {
        if (Auth::check()) {
            if (auth()->user()->status == '1010,1011,1012') {
                $record = Berita::with('creator')->where('kategori','Slider')->get();
                $promo = Berita::with('creator')->where('kategori','Promosi')->get();
                return $this->render('backend.dashboard.konten-web.index',[
                    'record' => $record,
                    'promo' => $promo,
                    'active' => 'konten-web'
                ]);
            }else {
                return redirect('admin/login');
            }
         }
    }

    public function create()
    {
        return $this->render('backend.dashboard.konten-web.create',[
            'record' => true,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $data = Berita::saveData($request);
        } catch (\Throwable $e) {
            return response([
                'status' => 'error',
                'message' => $e,
            ],500);
        }
        return response([
            'status' => true,
            'url'    => 'asd',
        ]);
    }

    public function edit($id)
    {

        return $this->render('backend.dashboard.konten-web.edit',[
            'record' => Berita::find($id),
        ]);
    }
    public function update(Request $request, $id)
    {
        try {
            $data = Berita::saveData($request);
         }catch (\Exception $e) {
           return response([
             'status' => 'error',
             'message' => $e,
           ], 500);
         }
     
         return redirect('admin/konten-web');
    }
}
