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
use DOMXPath;
use DOMDocument;
use Carbon\Carbon;
class AdminBeritaController extends Controller
{
    protected $link = 'admin/berita/';
    
    public function __construct()
    {
        $this->setLink($this->link);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            if (auth()->user()->status == '1010,1011,1012') {
                $url = "https://republika.co.id/tag/haji";
                $curl = curl_init();
                        curl_setopt($curl,CURLOPT_URL,$url);
                        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
                        $result = curl_exec($curl);
                $html = file_get_contents($url);
                $xpath = new DOMDocument();

                libxml_use_internal_errors(true);
                if (!empty($html)) {
                    $xpath->loadHTML($html);
                    libxml_clear_errors();
                    $xpath = new DOMXPath($xpath);
                    $cari_judul = $xpath -> query('//*[@id="wrapper"]/div[2]/div/div[2]/div[2]/div/div/div/div/div[2]/h2');
                    $isi = $xpath -> query('/html/body/div[4]/div[2]/div/div[2]/div[2]/div/div/div/div[3]/div[2]/h6[2]/p[2]');
                    //   $category = $xpath -> query('//*[@id="page-top"]/section/div/div/div[1]/div[1]/article/div[2]/div[1]/a/span');
                    $tgl = $xpath -> query('//*[@id="wrapper"]/div[2]/div/div[2]/div[2]/div/div/div/div/div[2]/h6[1]');
                    $href = $xpath -> query('//*[@id="wrapper"]/div[2]/div/div[2]/div[2]/div/div/div/div/div[2]/h2/a/@href');
                    $gambar = $xpath -> query('//*[@id="wrapper"]/div[2]/div/div[2]/div[2]/div/div/div/div/div[1]/div/img/@src');
                }
                    $arraySubClass = array();
                    $hot_topic = array();
                    
                    $jumlah=0;
                    foreach ($cari_judul as $value) {
                            $arraySubClass['haji']['judul'][] = $value->nodeValue;
                            // array_push($arraySubClass,$value->nodeValue);
                
                    }
                    $jumlah = count($arraySubClass['haji']['judul']);
                    // dd($jumlah);

                    foreach ($isi as $value) {
                        $arraySubClass['haji']['isi'][] = $value->nodeValue;
                    }
                    foreach ($href as $value) {
                        $arraySubClass['haji']['href'][] = $value->nodeValue;
                    }
                    foreach ($tgl as $value) {
                        $arraySubClass['haji']['tgl'][] = $value->nodeValue;
                    }
                    foreach ($gambar as $value) {
                        $arraySubClass['haji']['gambar'][] = $value->nodeValue;
                    }
                    // dd($arraySubClass['haji']);
                $record = Berita::with('creator')->where('kategori','Berita')->paginate(5);
                // dd($record);
                return $this->render('backend.dashboard.berita.index',[
                    'record' => $record,
                    'jumlah' => $jumlah,
                    'haji' => $arraySubClass['haji'],
                    'active' => 'berita'
                ]);
            }
         }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->render('backend.dashboard.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BeritaRequest $request)
    {
        $this->validate($request, [
            'attachment.*' => 'required',
            'attachment.*'=>'max:5120',
            'attachment.*' => 'image|mimes:jpg,png,jpeg',
            "attachment.*"=>"mimes:jpg,png,jpeg,gif"
        ],[
          'attachment.*.max' => 'Gambar tidak boleh lebih dari 5 MB',
          'attachment.*.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
          'attachment.*.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',
        ]);
        try {
            $data = Berita::saveData($request);
        }catch (\Exception $e) {
          return response([
            'status' => 'error',
            'message' => $e,
          ], 500);
        }
    
        return response([
          'status' => true,
          'url' => 'asdas'
          
        ]);
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = Berita::with('creator')->where('kategori','Berita')->find($id);
        if ($record != null) {
            return $this->render('backend.dashboard.berita.show',[
                'record' => $record,
            ]);
        }else {
            return redirect('admin/berita');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()) {
            if (auth()->user()) {
                $record = Berita::with('creator')->find($id);
                // dd($record);
                return $this->render('backend.dashboard.berita.edit',[
                    'record' => $record,
                ]);
            }
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BeritaRequest $request, $id)
    {
        if(!is_null($request->attachment[0])){
            $this->validate($request, [
                'attachment.*'=>'max:5120',
                'attachment.*' => 'image|mimes:jpg,png,jpeg',
                "attachment.*"=>"mimes:jpg,png,jpeg,gif"
            ],[
              'attachment.*.max' => 'Gambar tidak boleh lebih dari 5 MB',
              'attachment.*.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
              'attachment.*.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',
            ]);
          }
          try {
             $data = Berita::saveData($request);
          }catch (\Exception $e) {
            return response([
              'status' => 'error',
              'message' => $e,
            ], 500);
          }
      
          return response([
            'status' => true
          ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $cari = $request->cari;
        if ($cari) {
            $record = Berita::with('creator')->where('judul','like', '%'.$cari.'%')->orderBy('created_at','desc')->select('*');
        }else {
            $record = Berita::with('creator')->select('*');
        }
        $record = $record->paginate(5);
        return $this->render('backend.dashboard.berita.search-ajax',[
            'record' => $record,
            'request' => $request,
        ]);
    }
}
